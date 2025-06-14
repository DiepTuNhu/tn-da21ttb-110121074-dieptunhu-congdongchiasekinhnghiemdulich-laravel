@extends('admin.index')

@section('content')
<div class="container mt-4">
    <h2>Chi tiết bình luận</h2>
    <table class="table table-bordered mt-3">
        <tr>
            <th>ID</th>
            <td>{{ $comment->id }}</td>
        </tr>
        <tr>
            <th>Nội dung</th>
            <td>{{ $comment->content }}</td>
        </tr>
        <tr>
            <th>Trạng thái</th>
            <td>
                @if($comment->status == 0 || $comment->status == '0')
                    <span class="badge bg-success">Hiện</span>
                @else
                    <span class="badge bg-secondary">Ẩn</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Người bình luận</th>
            <td>{{ optional($comment->user)->name ?? 'Ẩn danh' }}</td>
        </tr>
        <tr>
            <th>Bài viết</th>
            <td>
                @if($comment->post)
                    <a href="{{ route('admin.posts.show', $comment->post->id) }}" target="_blank">
                        {{ $comment->post->title }}
                    </a>
                @else
                    Không xác định
                @endif
            </td>
        </tr>
        <tr>
            <th>Bình luận cha</th>
            <td>
                @if($comment->parent)
                    #{{ $comment->parent->id }}: {{ \Illuminate\Support\Str::limit($comment->parent->content, 50) }}
                @else
                    Không
                @endif
            </td>
        </tr>
        <tr>
            <th>Ngày tạo</th>
            <td>{{ $comment->created_at }}</td>
        </tr>
        <tr>
            <th>Ngày cập nhật</th>
            <td>{{ $comment->updated_at }}</td>
        </tr>
    </table>
    <a href="{{ route('comments.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
</div>
@endsection