<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = \App\Models\Post::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        if (request()->ajax()) {
            // Nếu là request AJAX, chỉ trả phần nội dung @section('content')
            return view('admin.post.list', compact('posts'))->render();
        }

        // Nếu là request bình thường, trả toàn bộ layout
        return view('admin.post.list', compact('posts'));
    }

    public function toggleStatus($id)
    {
        $post = \App\Models\Post::findOrFail($id);
        $post->status = $post->status == 0 ? 1 : 0;
        $post->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
    }

    public function destroy($id)
    {
        $post = \App\Models\Post::findOrFail($id);
        $post->delete();

        return redirect()->back()->with('success', 'Xóa bài viết thành công!');
    }

    public function approve($id)
    {
        $post = Post::findOrFail($id);
        $post->status = 0; // Đổi về 0 để hiện ra ngoài web
        $post->save();
        return redirect()->back()->with('success', 'Đã duyệt bài!');
    }

    public function pending()
    {
        // Lấy các bài chờ duyệt (status = 1 theo quy ước của bạn)
        $posts = Post::where('status', 1)->latest()->paginate(20);
        return view('admin.post.pending', compact('posts'));
    }
}
