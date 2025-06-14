@extends('admin.index')

@section('content')
<div class="container mt-4">
    <h2>Chi tiết loại hình du lịch</h2>
    <table class="table table-bordered mt-3">
        <tr>
            <th>ID</th>
            <td>{{ $travelType->id }}</td>
        </tr>
        <tr>
            <th>Tên loại hình</th>
            <td>{{ $travelType->name }}</td>
        </tr>
        <tr>
            <th>Trạng thái</th>
            <td>
                @if($travelType->status == 0)
                    <span class="badge bg-success">Hiện</span>
                @else
                    <span class="badge bg-secondary">Ẩn</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Ngày tạo</th>
            <td>{{ $travelType->created_at }}</td>
        </tr>
        <tr>
            <th>Ngày cập nhật</th>
            <td>{{ $travelType->updated_at }}</td>
        </tr>
    </table>
    <a href="{{ route('travel_types.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
</div>
@endsection