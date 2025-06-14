@extends('admin.index')

@section('content')
<div class="container mt-4">
    <h2>Chi tiết nhiệm vụ</h2>
    <table class="table table-bordered mt-3">
        <tr>
            <th>ID</th>
            <td>{{ $mission->id }}</td>
        </tr>
        <tr>
            <th>Tên nhiệm vụ</th>
            <td>{{ $mission->name }}</td>
        </tr>
        <tr>
            <th>Mô tả</th>
            <td>{{ $mission->description }}</td>
        </tr>
        <tr>
            <th>Điểm thưởng</th>
            <td>{{ $mission->points_reward }}</td>
        </tr>
        <tr>
            <th>Tần suất</th>
            <td>{{ $mission->frequency }}</td>
        </tr>
        <tr>
            <th>Loại điều kiện</th>
            <td>{{ $mission->condition_type }}</td>
        </tr>
        <tr>
            <th>Giá trị điều kiện</th>
            <td>{{ $mission->condition_value }}</td>
        </tr>
        <tr>
            <th>Ngày bắt đầu</th>
            <td>{{ $mission->start_date }}</td>
        </tr>
        <tr>
            <th>Ngày kết thúc</th>
            <td>{{ $mission->end_date }}</td>
        </tr>
        <tr>
            <th>Trạng thái</th>
            <td>
                @if($mission->status == 0 || $badge->status == '0')
                    <span class="badge bg-success">Hiện</span>
                @else
                    <span class="badge bg-secondary">Ẩn</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Huy hiệu thưởng</th>
            <td>
                @if($mission->badge)
                    {{ $mission->badge->name }}
                    @if($mission->badge->icon_url)
                        <img src="{{ asset($mission->badge->icon_url) }}" alt="Icon" style="max-width:40px;">
                    @endif
                @else
                    Không có
                @endif
            </td>
        </tr>
        <tr>
            <th>Ngày tạo</th>
            <td>{{ $mission->created_at }}</td>
        </tr>
        <tr>
            <th>Ngày cập nhật</th>
            <td>{{ $mission->updated_at }}</td>
        </tr>
    </table>
    <a href="{{ route('missions.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
</div>
@endsection