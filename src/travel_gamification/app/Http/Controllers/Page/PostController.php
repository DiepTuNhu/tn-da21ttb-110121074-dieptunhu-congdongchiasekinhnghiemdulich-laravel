<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Destination;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $destinations = Destination::all();
        // ... các dữ liệu khác ...
        $isLoggedIn = Auth::check();
        return view('user.layout.community', compact('destinations', 'isLoggedIn'));
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'location' => 'required|integer|exists:destinations,id',
            'cost'        => 'nullable|string|max:255',
        ]);

        // Lấy destination
        $destination = Destination::find($validatedData['location']);

        $post = new Post();
        $post->title          = $validatedData['title'];
        $post->content        = $validatedData['content'];
        $post->status         = 0;
        $post->user_id        = Auth::id();
        $post->destination_id = $destination->id;
        $post->address        = $destination->address; // Gán địa chỉ tại đây
        $post->price          = $validatedData['cost'] ?? null;

        $post->save();

        return redirect()->route('page.community')->with('success', 'Đăng bài thành công!');
    }

    public function showDetailPost($id)
    {
        $post = Post::with(['user', 'destination', 'destination.destinationImages'])->findOrFail($id);
        $comments = \App\Models\Comment::where('post_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        // Lấy các bài viết liên quan cùng địa điểm, loại trừ bài hiện tại
        $relatedPosts = Post::where('destination_id', $post->destination_id)
            ->where('id', '!=', $post->id)
            ->limit(5)
            ->get();

        return view('user.layout.detail_post', compact('post', 'comments', 'relatedPosts'));
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
            return response()->json(['message' => 'Bạn đã thích bài viết này!']);
        }

        \App\Models\Like::create([
            'user_id' => $user->id,
            'post_id' => $id,
        ]);

        // Đếm lại số lượt thích
        $likeCount = \App\Models\Like::where('post_id', $id)->count();

        return response()->json(['success' => true, 'like_count' => $likeCount]);
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
        ]);

        // Trả về dữ liệu bình luận mới để render lên giao diện
        return response()->json([
            'success' => true,
            'username' => auth()->user()->username,
            'avatar' => auth()->user()->avatar ? asset('storage/avatars/' . auth()->user()->avatar) : asset('default-avatar.png'),
            'content' => $comment->content,
            'created_at' => $comment->created_at->format('d/m/Y H:i'),
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
}
