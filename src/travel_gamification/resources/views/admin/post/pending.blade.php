@extends('admin.index')

@section('title_name', 'Duyệt bài đăng')

@section('content')
<div class="container">
    <h3 class="mb-4">Danh sách bài viết chờ duyệt</h3>
    <table class="table table-bordered" id="logTable">
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Người đăng</th>
                <th>Ngày đăng</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->user->username ?? 'Ẩn danh' }}</td>
                <td>{{ $post->created_at }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.posts.approve', $post->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Duyệt</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $posts->links() }}
</div>
@endsection