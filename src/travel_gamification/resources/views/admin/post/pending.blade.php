@extends('admin.index')
@section('title_name')
    Danh sách bài đăng chờ duyệt
@endsection

@section('content')
<div class="container">
    <table id="logTable" class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Loại bài đăng</th>
                <th>Nội dung</th>
                <th>Người đăng</th>
                <th>Ngày đăng</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>
                    @if($post->post_type === 'utility')
                        Tiện ích
                    @elseif($post->post_type === 'destination')
                        Địa điểm
                    @else
                        Khác
                    @endif
                </td>
                <td style="max-width:300px; white-space:pre-line; word-break:break-word;">
                    {!! Str::limit(strip_tags($post->content), 200) !!}
                </td>
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