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
use App\Models\Rating;
use Illuminate\Support\Facades\DB;
use App\Notifications\ReportSubmitted;


class PostController extends Controller
{
    public function index(Request $request)
    {
        $destinations = Destination::all();

        $query = Post::query();

        if ($request->filled('destination_id')) {
            $query->where('destination_id', $request->destination_id);
        }
        if ($request->filled('utility_type_id')) {
            $query->whereHas('utility', function($q) use ($request) {
                $q->where('utility_type_id', $request->utility_type_id);
            });
        }
        // ... các filter khác ...
        $posts = $query->latest()->paginate(10);

        // ... các dữ liệu khác ...
        $isLoggedIn = Auth::check();
        return view('user.layout.community', compact('destinations','posts', 'isLoggedIn'));
    }
public function share(Request $request, Post $post)
{
    // Không cho phép người đăng bài tự chia sẻ bài của mình
    if (auth()->id() == $post->user_id) {
        return back()->with('error', 'Bạn không thể tự chia sẻ bài viết của mình!');
    }

    $request->validate([
        'is_public' => 'required|boolean',
    ]);
    // Kiểm tra đã chia sẻ chưa
    $exists = DB::table('shares')
        ->where('user_id', auth()->id())
        ->where('post_id', $post->id)
        ->exists();

    if ($exists) {
        return back()->with('error', 'Bạn đã chia sẻ bài viết này rồi!');
    }
    // Lưu vào bảng shares với status = 0
    DB::table('shares')->insert([
        'user_id' => auth()->id(),
        'post_id' => $post->id,
        'is_public' => $request->is_public,
        'status' => 0,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Gửi notify cho chủ bài viết
    if ($post->user && $post->user_id != auth()->id()) {
        $post->user->notify(new \App\Notifications\PostSharedNotification($post, auth()->user()));
    }

    return back()->with('success', 'Chia sẻ bài viết thành công!');
}
    public function showPostShare(Request $request)
    {
        $destinations = \App\Models\Destination::where('status', 0)->get();
        // $provinces = \App\Models\Province::all(); // Lấy danh sách tỉnh/thành
        $utilityTypes = \App\Models\UtilityType::all(); // Lấy danh sách loại tiện ích (nếu cần)
        return view('user.layout.post_share', compact('destinations', 'utilityTypes'));
    }

    public function create(Request $request)
    {
        // Lấy loại bài đăng: 'destination' (mặc định) hoặc 'utility'
        $postType = $request->get('type', 'destination');

        // Lấy danh sách địa điểm
        $destinations = \App\Models\Destination::where('status', 0)->get();

        // Lấy id địa điểm được chọn (nếu có)
        $selectedDestination = $request->input('id'); // hoặc tên param bạn truyền

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
            'step' => 2,
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
            $post->status        = 1;
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

        // foreach ($admins as $admin) {
        //     $admin->notify(new NewPostSubmitted($post));
        // }

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

        $ratingCounts = [];
        $totalRatings = $post->ratings->count();
        for ($i = 1; $i <= 5; $i++) {
            $ratingCounts[$i] = $post->ratings->where('score', $i)->count();
        }

        // ==== Thêm đoạn này để xác định thứ hạng ====
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();
        $topPosts = \App\Models\Post::with('user')
            ->whereBetween('posts.created_at', [$startOfMonth, $endOfMonth])
            ->leftJoin('ratings', 'posts.id', '=', 'ratings.post_id')
            ->leftJoin('likes', 'posts.id', '=', 'likes.post_id')
            ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
            ->select(
                'posts.*',
                DB::raw('AVG(ratings.score) as average_rating'),
                DB::raw('COUNT(DISTINCT ratings.id) as rating_count'),
                DB::raw('COUNT(DISTINCT likes.id) as like_count'),
                DB::raw('COUNT(DISTINCT comments.id) as comment_count'),
                DB::raw("((COUNT(DISTINCT ratings.id) / (COUNT(DISTINCT ratings.id) + 5)) * AVG(ratings.score) + (5 / (COUNT(DISTINCT ratings.id) + 5)) * (SELECT AVG(score) FROM ratings)) as score")
            )
            ->groupBy('posts.id')
            ->orderByDesc('score')
            ->orderByDesc('like_count')
            ->orderByDesc('comment_count')
            ->orderByDesc('posts.created_at')
            ->take(10)
            ->get();

        $rank = null;
        foreach ($topPosts as $i => $item) {
            if ($item->id == $post->id) {
                $rank = $i + 1;
                break;
            }
        }
        // ==== Kết thúc đoạn thêm ====

        return view('user.layout.detail_post', compact(
            'post',
            'comments',
            'relatedPosts',
            'relatedUtilityPosts',
            'ratingCounts',
            'totalRatings',
            'rank' // truyền thêm biến này sang view
        ));
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

            // Gửi notify cho chủ bài viết (nếu không phải tự like)
            if ($post->user_id != $user->id && $post->user) {
                $post->user->notify(new \App\Notifications\PostLikedNotification($post, $user));
            }
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

        $user = auth()->user();
        $post = Post::findOrFail($id);

        $comment = \App\Models\Comment::create([
            'user_id' => $user->id,
            'post_id' => $id,
            'content' => $request->content,
            'parent_comment_id' => $request->parent_comment_id ?? null,
            'status' => '0',
        ]);

        // Gửi notify cho chủ bài viết (nếu không phải tự comment)
        if ($post->user_id != $user->id && $post->user) {
            $post->user->notify(new \App\Notifications\PostCommentedNotification($post, $user, $comment));
        }

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
            'can_edit' => auth()->id() === $comment->user_id,
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
    public function destroy($id)
{
    $post = Post::findOrFail($id);
    if (auth()->id() !== $post->user_id) {
        abort(403, 'Bạn không có quyền xóa bài viết này.');
    }
    $post->delete();
    return redirect()->route('page.community')->with('success', 'Đã xóa bài viết!');
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

    public function ajaxDestinations(Request $request)
    {
        $query = \App\Models\Destination::query()->where('status', 0);

        if ($request->filled('province')) {
            $query->where('address', 'like', '%' . $request->province . '%');
        }

        $perPage = 20;
        $page = $request->input('page', 1);

        // Nếu có tìm kiếm q thì lọc trên PHP không dấu, không ký tự đặc biệt
        if ($request->filled('q')) {
            $q = $request->q;
            $qNorm = $this->normalizeSearch($q);

            // Lấy tất cả để lọc trên PHP (chỉ khi có q)
            $all = $query->with(['destinationImages' => function($q) {
                $q->where('status', 2)->orderBy('id');
            }])->get()->filter(function($item) use ($qNorm) {
                $nameNorm = $this->normalizeSearch($item->name);
                return strpos($nameNorm, $qNorm) !== false;
            })->values();

            // Phân trang thủ công trên collection
            $total = $all->count();
            $results = $all->slice(($page - 1) * $perPage, $perPage)->map(function($item) {
                $image = $item->destinationImages->first();
                return [
                    'id' => $item->id,
                    'text' => $item->name,
                    'image' => $image ? asset($image->image_url) : asset('images/no-image.png'),
                ];
            })->values();

            return response()->json([
                'results' => $results,
                'current_page' => $page,
                'last_page' => ceil($total / $perPage),
                'total' => $total,
            ]);
        }

        if ($request->input('all')) {
            $all = $query->get()->map(function($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->name,
                ];
            });
            return response()->json([
                'all_results' => $all,
            ]);
        }

        $paginator = $query->with(['destinationImages' => function($q) {
            $q->where('status', 2)->orderBy('id');
        }])->paginate($perPage, ['*'], 'page', $page);

        $results = $paginator->getCollection()->map(function($item) {
            $image = $item->destinationImages->first();
            return [
                'id' => $item->id,
                'text' => $item->name,
                'image' => $image ? asset($image->image_url) : asset('images/no-image.png'),
            ];
        });

        return response()->json([
            'results' => $results,
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'total' => $paginator->total(),
        ]);
    }
    public function ajaxUtilities(Request $request)
    {
        $query = \App\Models\Utility::query()->where('status', 0);

        if ($request->filled('destination_id')) {
            $query->whereHas('destinations', function($q) use ($request) {
                $q->where('destinations.id', $request->destination_id);
            });
        }
        if ($request->filled('utility_type_id')) {
            $query->where('utility_type_id', $request->utility_type_id);
        }

        // Nếu có all=1 thì trả về tất cả cho dropdown
        if ($request->input('all')) {
            $all = $query->get()->map(function($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->name,
                ];
            });
            return response()->json([
                'all_results' => $all,
            ]);
        }

        $perPage = 20;
        $page = $request->input('page', 1);

        // Nếu có tìm kiếm q thì lọc trên PHP không dấu, không ký tự đặc biệt
        if ($request->filled('q')) {
            $q = $request->q;
            $qNorm = $this->normalizeSearch($q);

            // Lấy tất cả để lọc trên PHP (chỉ khi có q)
            $all = $query->get()->filter(function($item) use ($qNorm) {
                $nameNorm = $this->normalizeSearch($item->name);
                return strpos($nameNorm, $qNorm) !== false;
            })->values();

            // Phân trang thủ công trên collection
            $total = $all->count();
            $results = $all->slice(($page - 1) * $perPage, $perPage)->map(function($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->name,
                    'image' => $item->image, // <-- Đảm bảo trả về tên file ảnh
                ];
            })->values();

            return response()->json([
                'results' => $results,
                'current_page' => $page,
                'last_page' => ceil($total / $perPage),
                'total' => $total,
            ]);
        }

        $paginator = $query->paginate($perPage, ['*'], 'page', $page);

        $results = $paginator->getCollection()->map(function($item) {
            return [
                'id' => $item->id,
                'text' => $item->name,
                'image' => $item->image, // <-- Đảm bảo trả về tên file ảnh
            ];
        });

        return response()->json([
            'results' => $results,
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'total' => $paginator->total(),
        ]);
    }

    private function normalizeSearch($str)
    {
        $str = mb_strtolower($str, 'UTF-8');
        $str = preg_replace([
            '/[àáạảãâầấậẩẫăằắặẳẵ]/u',
            '/[èéẹẻẽêềếệểễ]/u',
            '/[ìíịỉĩ]/u',
            '/[òóọỏõôồốộổỗơờớợởỡ]/u',
            '/[ùúụủũưừứựửữ]/u',
            '/[ỳýỵỷỹ]/u',
            '/[đ]/u'
        ], [
            'a','e','i','o','u','y','d'
        ], $str);
        $str = preg_replace('/[^a-z0-9 ]/', '', $str); // chỉ giữ chữ, số, khoảng trắng
        return $str;
    }
    public function postArticles(Request $request, $id)
    {
        $postType = $request->get('postType', 'location'); // <-- Đúng tên biến trên URL
        $utilities = [];
        $selectedUtility = null;

        if ($postType === 'utility') {
            $utilities = \App\Models\Utility::where('status', 0)->get();
            $selectedUtility = $id;
        }

        // Các biến khác như $destinations, $selectedDestination...
        $destinations = \App\Models\Destination::where('status', 0)->get();
        $selectedDestination = $postType === 'location' ? $id : null;

        return view('user.layout.post_articles', [
            'postType' => $postType,
            'utilities' => $utilities,
            'selectedUtility' => $selectedUtility,
            'destinations' => $destinations,
            'selectedDestination' => $selectedDestination,
            'step' => $postType === 'utility' ? 3 : 2,
            'stepsType' => $postType === 'utility' ? 'utility' : 'destination',
        ]);
    }
    public function rate(Request $request, $id)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Bạn cần đăng nhập!'], 401);
        }

        $request->validate([
            'score' => 'required|integer|min:1|max:5',
        ]);

        $user = auth()->user();
        $post = Post::findOrFail($id);

        // Không cho phép tự đánh giá bài viết của mình
        if ($post->user_id == $user->id) {
            return response()->json(['error' => 'Bạn không thể tự đánh giá bài viết của mình!'], 403);
        }

        // Cập nhật hoặc tạo mới đánh giá
        $rating = Rating::updateOrCreate(
            ['user_id' => $user->id, 'post_id' => $post->id],
            ['score' => $request->score]
        );

        // Tính lại điểm trung bình
        $avg = Rating::where('post_id', $post->id)->avg('score');
        $post->average_rating = $avg ?? 0; // Nếu $avg là null thì gán 0
        $post->save();

        return response()->json([
            'success' => true,
            'average_rating' => round($avg, 1),
        ]);
    }
    public function reportComment(Request $request, $id)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Bạn cần đăng nhập để báo cáo!'], 401);
        }

        $comment = \App\Models\Comment::findOrFail($id);

        // Không cho phép tự báo cáo bình luận của mình
        if ($comment->user_id == auth()->id()) {
            return response()->json(['error' => 'Bạn không thể tự báo cáo bình luận của mình!'], 403);
        }

        // Kiểm tra đã báo cáo chưa
        $exists = DB::table('reports')
            ->where('user_id', auth()->id())
            ->where('comment_id', $id)
            ->exists();

        if ($exists) {
            return response()->json(['error' => 'Bạn đã báo cáo bình luận này rồi!']);
        }

        // Lưu báo cáo, thêm reason
        DB::table('reports')->insert([
            'user_id' => auth()->id(),
            'comment_id' => $id,
            'reason' => $request->input('reason'),
            'created_at' => now(),
            'updated_at' => now(),
            'status' => 0,
        ]);

        // Gửi notify cho admin
        $adminUsers = \App\Models\User::whereHas('role', function($query) {
            $query->whereRaw('LOWER(name) = ?', ['quản trị']);
        })->get();
        foreach ($adminUsers as $admin) {
            $admin->notify(new \App\Notifications\ReportSubmitted([
                'type' => 'comment', // hoặc 'post'
                'id' => $id,
                'reason' => $request->input('reason'),
                'user_name' => auth()->user()->username,
                'object_title' => $comment->content, // hoặc $post->title
            ]));
        }

        return response()->json(['success' => true, 'message' => 'Đã gửi báo cáo cho quản trị viên!']);
    }
    public function reportPost(Request $request, $id)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Bạn cần đăng nhập để báo cáo!'], 401);
        }

        $post = \App\Models\Post::findOrFail($id);

        // Không cho phép tự báo cáo bài viết của mình
        if ($post->user_id == auth()->id()) {
            return response()->json(['error' => 'Bạn không thể tự báo cáo bài viết của mình!'], 403);
        }

        // Kiểm tra đã báo cáo chưa (giả sử có bảng reports)
        $exists = DB::table('reports')
            ->where('user_id', auth()->id())
            ->where('post_id', $id)
            ->exists();

        if ($exists) {
            return response()->json(['error' => 'Bạn đã báo cáo bài viết này rồi!']);
        }

        // Lưu báo cáo
        DB::table('reports')->insert([
            'user_id' => auth()->id(),
            'post_id' => $id,
            'reason' => $request->input('reason'),
            'created_at' => now(),
            'updated_at' => now(),
            'status' => 0,
        ]);

        // Gửi notify cho admin về báo cáo
        $adminUsers = User::where('role_id', 1)->get(); // Giả sử role_id=1 là admin

        foreach ($adminUsers as $admin) {
            $admin->notify(new ReportSubmitted([
                'type' => 'post', // hoặc 'comment'
                'id' => $id,
                'reason' => $request->input('reason'),
                'user_name' => auth()->user()->username,
                'object_title' => $post->title ?? null, // hoặc $comment->content
            ]));
        }

        return response()->json(['success' => true, 'message' => 'Đã gửi báo cáo cho quản trị viên!']);
    }
}
