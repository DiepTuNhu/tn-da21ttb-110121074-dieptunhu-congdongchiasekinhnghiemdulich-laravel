@extends('admin.index')

@section('content')
<div class="container mt-4">
    <h2>Chi tiết phần thưởng</h2>
    <table class="table table-bordered mt-3">
        <tr>
            <th>ID</th>
            <td>{{ $reward->id }}</td>
        </tr>
        <tr>
            <th>Tên phần thưởng</th>
            <td>{{ $reward->name }}</td>
        </tr>
        <tr>
            <th>Mô tả</th>
            <td>{{ $reward->description }}</td>
        </tr>
        <tr>
            <th>Điểm cần để đổi</th>
            <td>{{ $reward->cost_points }}</td>
        </tr>
        <tr>
            <th>Loại quà</th>
            <td>
                @if($reward->type == 'virtual')
                    <span class="badge bg-info">Ảo</span>
                @else
                    <span class="badge bg-warning text-dark">Vật lý</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Số lượng tồn kho</th>
            <td>{{ $reward->stock }}</td>
        </tr>
        <tr>
            <th>Hình ảnh</th>
            <td>
                @if($reward->image)
                    <img src="{{ asset('storage/rewards/' . $reward->image) }}" alt="Hình phần thưởng" style="max-width:120px;">
                @else
                    Không có ảnh
                @endif
            </td>
        </tr>
        <tr>
            <th>Trạng thái</th>
            <td>
                @if($reward->active)
                    <span class="badge bg-success">Đang mở</span>
                @else
                    <span class="badge bg-secondary">Đã đóng</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Ngày tạo</th>
            <td>{{ $reward->created_at }}</td>
        </tr>
        <tr>
            <th>Ngày cập nhật</th>
            <td>{{ $reward->updated_at }}</td>
        </tr>
    </table>
    <a href="{{ route('rewards.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
</div>
@endsection