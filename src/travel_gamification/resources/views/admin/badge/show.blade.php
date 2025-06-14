@extends('admin.index')

@section('title_name')
    Chi tiết huy hiệu
@endsection

@section('content')
<div class="container mt-4">
    <h2>Chi tiết huy hiệu</h2>
    <table class="table table-bordered mt-3">
        <tr>
            <th>ID</th>
            <td>{{ $badge->id }}</td>
        </tr>
        <tr>
            <th>Tên huy hiệu</th>
            <td>{{ $badge->name }}</td>
        </tr>
        <tr>
            <th>Mô tả</th>
            <td>{{ $badge->description }}</td>
        </tr>
        <tr>
            <th>Icon</th>
            <td>
                @if($badge->icon_url)
                    <img src="{{ asset($badge->icon_url) }}" alt="Icon huy hiệu" style="max-width:80px;">
                @else
                    Không có icon
                @endif
            </td>
        </tr>
        <tr>
            <th>Trạng thái</th>
            <td>
                @if($badge->status == 0 || $badge->status == '0')
                    <span class="badge bg-success">Hiện</span>
                @else
                    <span class="badge bg-secondary">Ẩn</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Ngày tạo</th>
            <td>{{ $badge->created_at }}</td>
        </tr>
        <tr>
            <th>Ngày cập nhật</th>
            <td>{{ $badge->updated_at }}</td>
        </tr>
    </table>
    <a href="{{ route('badges.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
</div>
@endsection