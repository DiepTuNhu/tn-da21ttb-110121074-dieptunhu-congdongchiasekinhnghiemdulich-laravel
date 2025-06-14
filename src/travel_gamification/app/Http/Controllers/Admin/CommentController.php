<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $reviews = \App\Models\Comment::with(['user', 'post']) // hoặc quan hệ đúng với bảng của bạn
            ->orderBy('created_at', 'desc')
            ->get();

        if (request()->ajax()) {
            // Nếu là request AJAX, chỉ trả phần nội dung @section('content')
            return view('admin.comment.list', compact('reviews'))->render();
        }

        // Nếu là request bình thường, trả toàn bộ layout
        return view('admin.comment.list', compact('reviews'));
    }
    public function toggleStatus($id)
    {
        $review = \App\Models\Comment::findOrFail($id);
        $newStatus = $review->status == 0 ? 1 : 0;
        $review->status = $newStatus;
        $review->save();

        // Cập nhật status cho tất cả bình luận con (1 cấp)
        \App\Models\Comment::where('parent_comment_id', $review->id)->update(['status' => $newStatus]);

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
    }
    public function destroy($id)
    {
        $review = \App\Models\Comment::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Xóa bình luận thành công!');
    }
    public function show($id)
    {
        $comment = \App\Models\Comment::with(['user', 'post', 'parent'])->findOrFail($id);
        return view('admin.comment.show', compact('comment'));
    }
}
