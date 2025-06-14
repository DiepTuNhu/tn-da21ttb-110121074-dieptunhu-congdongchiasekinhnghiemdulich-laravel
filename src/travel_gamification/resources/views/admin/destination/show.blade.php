@extends('admin.index')

@section('content')
<div class="container mt-4">
    <h2>Chi tiết địa điểm du lịch</h2>
    <table class="table table-bordered mt-3">
        <tr>
            <th>ID</th>
            <td>{{ $destination->id }}</td>
        </tr>
        <tr>
            <th>Tên địa điểm</th>
            <td>{{ $destination->name }}</td>
        </tr>
        <tr>
            <th>Giá</th>
            <td>{{ $destination->price }}</td>
        </tr>
        <tr>
            <th>Điểm nổi bật</th>
            <td>{!!($destination->highlights ) !!}</td>
        </tr>
        <tr>
            <th>Thời điểm lý tưởng</th>
            <td>{!! ($destination->best_time) !!}</td>
        </tr>
        <tr>
            <th>Ẩm thực địa phương</th>
            <td>{!! ($destination->local_cuisine) !!}</td>
        </tr>
        <tr>
            <th>Phương tiện di chuyển</th>
            <td>{!! ($destination->transportation) !!}</td>
        </tr>
        <tr>
            <th>Địa chỉ</th>
            <td>{{ $destination->address }}</td>
        </tr>
        <tr>
            <th>Vĩ độ</th>
            <td>{{ $destination->latitude }}</td>
        </tr>
        <tr>
            <th>Kinh độ</th>
            <td>{{ $destination->longitude }}</td>
        </tr>
        <tr>
            <th>Trạng thái</th>
            <td>{{ $destination->status }}</td>
        </tr>
        <tr>
            <th>Người tạo</th>
            <td>{{ optional($destination->users)->username ?? 'Ẩn danh' }}</td>
        </tr>
        <tr>
            <th>Loại hình du lịch</th>
            <td>{{ optional($destination->travel_types)->name ?? 'Không xác định' }}</td>
        </tr>
        <tr>
            <th>Ngày tạo</th>
            <td>{{ $destination->created_at }}</td>
        </tr>
        <tr>
            <th>Ngày cập nhật</th>
            <td>{{ $destination->updated_at }}</td>
        </tr>
    </table>
    <a href="{{ route('destinations.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
</div>
@endsection