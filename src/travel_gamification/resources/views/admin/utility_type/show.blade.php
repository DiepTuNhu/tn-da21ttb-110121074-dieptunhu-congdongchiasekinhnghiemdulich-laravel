@extends('admin.index')

@section('content')
<div class="container mt-4">
    <h2>Chi tiết loại tiện ích</h2>
    <table class="table table-bordered mt-3">
        <tr>
            <th>ID</th>
            <td>{{ $utilityType->id }}</td>
        </tr>
        <tr>
            <th>Tên loại tiện ích</th>
            <td>{{ $utilityType->name }}</td>
        </tr>
        <tr>
            <th>Trạng thái</th>
            <td>
                @if($utilityType->status == 0 || $utilityType->status == '0')
                    <span class="badge bg-success">Hiện</span>
                @else
                    <span class="badge bg-secondary">Ẩn</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Ngày tạo</th>
            <td>{{ $utilityType->created_at }}</td>
        </tr>
        <tr>
            <th>Ngày cập nhật</th>
            <td>{{ $utilityType->updated_at }}</td>
        </tr>
    </table>
    <a href="{{ route('utility_types.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
</div>
@endsection