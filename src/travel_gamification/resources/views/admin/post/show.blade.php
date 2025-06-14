@extends('admin.index')

@section('content')
<div class="container mt-4">
    <h2>Chi tiết bài viết</h2>
    <table class="table table-bordered mt-3">
        <tr>
            <th>ID</th>
            <td>{{ $post->id }}</td>
        </tr>
        <tr>
            <th>Tiêu đề</th>
            <td>{{ $post->title }}</td>
        </tr>
        <tr>
            <th>Nội dung</th>
            <td>{!! ($post->content) !!}</td>
        </tr>
        <tr>
            <th>Địa chỉ</th>
            <td>{{ $post->address }}</td>
        </tr>
        <tr>
            <th>Giá</th>
            <td>{{ $post->price }}</td>
        </tr>
        <tr>
            <th>Loại bài viết</th>
            <td>{{ $post->post_type }}</td>
        </tr>
        <tr>
            <th>Giờ mở cửa</th>
            <td>{{ $post->opening_hours }}</td>
        </tr>
        <tr>
            <th>Số điện thoại</th>
            <td>{{ $post->phone }}</td>
        </tr>
        <tr>
            <th>Trạng thái</th>
            <td>
                @if($post->status == 0 || $post->status == '0')
                    <span class="badge bg-success">Hiện</span>
                @else
                    <span class="badge bg-secondary">Ẩn</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Điểm đánh giá trung bình</th>
            <td>{{ $post->average_rating }}</td>
        </tr>
        <tr>
            <th>Người đăng</th>
            <td>{{ optional($post->user)->name ?? 'Ẩn danh' }}</td>
        </tr>
        <tr>
            <th>Địa điểm liên quan</th>
            <td>{{ optional($post->destination)->name ?? 'Không có' }}</td>
        </tr>
        <tr>
            <th>Tiện ích liên quan</th>
            <td>{{ optional($post->utility)->name ?? 'Không có' }}</td>
        </tr>
        <tr>
            <th>Ngày tạo</th>
            <td>{{ $post->created_at }}</td>
        </tr>
        <tr>
            <th>Ngày cập nhật</th>
            <td>{{ $post->updated_at }}</td>
        </tr>
    </table>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
</div>
@endsection