<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use App\Models\Destination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Notifications\NewPostSubmitted;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $destinations = Destination::all();
        // ... các dữ liệu khác ...
        $isLoggedIn = Auth::check();
        return view('user.layout.community', compact('destinations', 'isLoggedIn'));
    }

    public function create(Request $request)
    {
        // Lấy loại bài đăng: 'destination' (mặc định) hoặc 'utility'
        $postType = $request->get('type', 'destination');

        // Lấy danh sách địa điểm
        $destinations = \App\Models\Destination::where('status', 0)->get();

        // Lấy id địa điểm được chọn (nếu có)
        $selectedDestination = $request->input('destination_id', null);

        // Nếu là đăng tiện ích thì lấy danh sách tiện ích
        $utilities = [];
        $selectedUtility = $request->input('utility_id', null); // <-- lấy từ URL
        if ($postType === 'utility') {
            $utilities = \App\Models\Utility::all();
        }

        // Trả về view, truyền thêm biến postType và utilities
        return view('user.layout.post_articles', [
            'destinations' => $destinations,
            'selectedDestination' => $selectedDestination,
            'postType' => $postType,
            'utilities' => $utilities,
            'selectedUtility' => $selectedUtility, // <-- truyền về view
        ]);
    }
    
    public function store(Request $request)
    {
        $postType = $request->input('post_type', 'destination');

        if ($postType === 'utility') {
            // Validate cho tiện ích
            $validatedData = $request->validate([
                'title'         => 'required|string|max:255',
                'content'       => 'required|string',
                'utility_id'    => 'required|integer|exists:utilities,id',
                'price'         => 'nullable|string|max:255',
                'opening_hours' => 'nullable|string|max:255',
                'phone'         => 'nullable|string|max:20',
            ]);

            // Lấy tiện ích để lấy địa chỉ
            $utility = \App\Models\Utility::find($validatedData['utility_id']);

            $post = new Post();
            $post->title         = $validatedData['title'];
            $post->content       = $validatedData['content'];
            $post->status        = 0;
            $post->user_id       = Auth::id();
            $post->utility_id    = $validatedData['utility_id'];
            $post->price         = $validatedData['price'] ?? null;
            $post->opening_hours = $validatedData['opening_hours'] ?? null;
            $post->phone         = $validatedData['phone'] ?? null;
            $post->post_type     = 'utility';
            $post->address       = $utility ? $utility->address : null; // <-- Lưu địa chỉ tiện ích
            $post->save();

        } else {
            // Validate cho địa điểm
            $validatedData = $request->validate([
                'title'     => 'required|string|max:255',
                'content'   => 'required|string',
                'location'  => 'required|integer|exists:destinations,id',
                'cost'      => 'nullable|string|max:255',
            ]);

            $destination = Destination::find($validatedData['location']);

            $post = new Post();
            $post->title          = $validatedData['title'];
            $post->content        = $validatedData['content'];
            $post->status         = 1;
            $post->user_id        = Auth::id();
            $post->destination_id = $destination->id;
            $post->address        = $destination->address;
            $post->price          = $validatedData['cost'] ?? null;
            $post->post_type      = 'destination';
            $post->save();
        }

        // Gửi thông báo cho admin
        $admins = User::whereHas('role', function($query) {
            $query->whereRaw('LOWER(name) = ?', ['quản trị']);
        })->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewPostSubmitted($post));
        }

        return redirect()->route('page.community')->with('success', 'Bài viết của bạn đã được gửi và đang chờ duyệt bởi quản trị viên.');
    }

    public function showDetailPost($id)
    {
        $post = Post::with(['user', 'destination', 'destination.destinationImages', 'utility'])->findOrFail($id);
        $comments = \App\Models\Comment::where('post_id', $id)
            ->where('status', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        // Danh sách bài viết về địa điểm du lịch cùng địa điểm, chỉ lấy status = 0
        $relatedPosts = Post::where('id', '!=', $post->id)
            ->where('post_type', 'destination')
            ->where('destination_id', $post->destination_id)
            ->where('status', 0)
            ->limit(5)
            ->get();

        // Tiện ích liên quan: các bài viết về tiện ích thuộc địa điểm này, chỉ lấy status = 0
        $relatedUtilityPosts = Post::where('post_type', 'utility')
            ->where('destination_id', $post->destination_id)
            ->where('status', 0)
            ->limit(5)
            ->get();

        return view('user.layout.detail_post', compact('post', 'comments', 'relatedPosts', 'relatedUtilityPosts'));
    }

    public function like($id)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Bạn cần đăng nhập!'], 401);
        }

        $user = auth()->user();
        $post = \App\Models\Post::findOrFail($id);

        // Kiểm tra đã like chưa
        $liked = \App\Models\Like::where('user_id', $user->id)->where('post_id', $id)->first();
        if ($liked) {
            $liked->delete();
            $likedStatus = false;
        } else {
            \App\Models\Like::create([
                'user_id' => $user->id,
                'post_id' => $id,
            ]);
            $likedStatus = true;
        }

        // Đếm lại số lượt thích
        $likeCount = \App\Models\Like::where('post_id', $id)->count();

        return response()->json([
            'success' => true,
            'like_count' => $likeCount,
            'liked' => $likedStatus
        ]);
    }

    public function comment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        if (!auth()->check()) {
            return response()->json(['error' => 'Bạn cần đăng nhập!'], 401);
        }

        $comment = \App\Models\Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $id,
            'content' => $request->content,
            'parent_comment_id' => $request->parent_comment_id ?? null,
            'status' => '0', // Thêm dòng này để mặc định trạng thái là 0
        ]);

        // Trả về dữ liệu bình luận mới để render lên giao diện
        return response()->json([
            'success' => true,
            'id' => $comment->id,
            'username' => $comment->user->username ?? 'Ẩn danh',
            'avatar' => $comment->user && $comment->user->avatar
                ? (Str::startsWith($comment->user->avatar, ['http://', 'https://'])
                    ? $comment->user->avatar
                    : asset('storage/avatars/' . $comment->user->avatar))
                : asset('storage/default.jpg'),
            'content' => $comment->content,
            'created_at' => $comment->created_at->format('d/m/Y H:i'),
            'like_count' => $comment->likes->count(),
            'can_edit' => auth()->id() === $comment->user_id, // Thêm dòng này để JS biết có hiển thị nút Sửa/Xóa không
        ]);
    }

    public function detail($id)
    {
        $post = Post::with(['user', 'destination', 'likes'])->findOrFail($id);
        $comments = \App\Models\Comment::where('post_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('user.layout.detail_post', compact('post', 'comments'));
    }
    public function likeComment($id)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Bạn cần đăng nhập!'], 401);
        }
        $user = auth()->user();
        // Kiểm tra đã like chưa
        $liked = \App\Models\Like::where('user_id', $user->id)
            ->where('comment_id', $id)
            ->whereNull('post_id')
            ->first();
        if ($liked) {
            return response()->json(['message' => 'Bạn đã thích bình luận này!']);
        }
        \App\Models\Like::create([
            'user_id' => $user->id,
            'comment_id' => $id,
            'post_id' => null,
        ]);
        $likeCount = \App\Models\Like::where('comment_id', $id)->whereNull('post_id')->count();
        return response()->json(['success' => true, 'like_count' => $likeCount]);
    }

    public function updateComment(Request $request, $id)
    {
        $comment = \App\Models\Comment::findOrFail($id);

        // Chỉ cho phép người tạo comment được sửa
        if (auth()->id() !== $comment->user_id) {
            return response()->json(['error' => 'Bạn không có quyền sửa bình luận này!'], 403);
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->content = $request->input('content');
        $comment->save();

        return response()->json([
            'success' => true,
            'content' => $comment->content,
        ]);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // Chỉ cho phép người đăng bài được sửa
        if (auth()->id() !== $post->user_id) {
            abort(403, 'Bạn không có quyền sửa bài viết này.');
        }

        $postType = $post->post_type ?? 'destination';
        $destinations = \App\Models\Destination::where('status', 0)->get();
        $utilities = [];
        $selectedDestination = $post->destination_id ?? null;
        $selectedUtility = $post->utility_id ?? null;

        if ($postType === 'utility') {
            $utilities = \App\Models\Utility::all();
        }

        return view('user.layout.edit_post_articles', [
            'post' => $post,
            'postType' => $postType,
            'destinations' => $destinations,
            'utilities' => $utilities,
            'selectedDestination' => $selectedDestination,
            'selectedUtility' => $selectedUtility,
        ]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Chỉ cho phép người đăng bài được sửa
        if (auth()->id() !== $post->user_id) {
            abort(403, 'Bạn không có quyền sửa bài viết này.');
        }

        $postType = $request->input('post_type', 'destination');

        if ($postType === 'utility') {
            $validatedData = $request->validate([
                'title'         => 'required|string|max:255',
                'content'       => 'required|string',
                'utility_id'    => 'required|integer|exists:utilities,id',
                'price'         => 'nullable|string|max:255',
                'opening_hours' => 'nullable|string|max:255',
                'phone'         => 'nullable|string|max:20',
            ]);

            $utility = \App\Models\Utility::find($validatedData['utility_id']);

            $post->title         = $validatedData['title'];
            $post->content       = $validatedData['content'];
            $post->utility_id    = $validatedData['utility_id'];
            $post->price         = $validatedData['price'] ?? null;
            $post->opening_hours = $validatedData['opening_hours'] ?? null;
            $post->phone         = $validatedData['phone'] ?? null;
            $post->address       = $utility ? $utility->address : null;
            $post->post_type     = 'utility';
            $post->save();

        } else {
            $validatedData = $request->validate([
                'title'     => 'required|string|max:255',
                'content'   => 'required|string',
                'location'  => 'required|integer|exists:destinations,id',
                'cost'      => 'nullable|string|max:255',
            ]);

            $destination = \App\Models\Destination::find($validatedData['location']);

            $post->title          = $validatedData['title'];
            $post->content        = $validatedData['content'];
            $post->destination_id = $destination->id;
            $post->address        = $destination->address;
            $post->price          = $validatedData['cost'] ?? null;
            $post->post_type      = 'destination';
            $post->save();
        }

        return redirect()->route('page.community')->with('success', 'Cập nhật bài viết thành công!');
    }
    
    public function deleteComment($id)
    {
        $comment = \App\Models\Comment::findOrFail($id);
        if (auth()->id() !== $comment->user_id) {
            return response()->json(['error' => 'Bạn không có quyền xóa bình luận này!']);
        }
        $comment->delete();
        return response()->json(['success' => true]);
    }
}
