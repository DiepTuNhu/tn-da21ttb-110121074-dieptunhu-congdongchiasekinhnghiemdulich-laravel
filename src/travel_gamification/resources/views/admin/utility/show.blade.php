@extends('admin.index')

@section('content')
<style>
  th {
      width: 200px;
      /* background-color: #f8f9fa; */
  }
</style>
<div class="container mt-4">
    <h2>Chi tiết tiện ích</h2>
    <table class="table table-bordered mt-3">
        <tr>
            <th>ID</th>
            <td>{{ $utility->id }}</td>
        </tr>
        <tr>
            <th>Tên tiện ích</th>
            <td>{{ $utility->name }}</td>
        </tr>
        <tr>
            <th>Giá</th>
            <td>{{ $utility->price }}</td>
        </tr>
        <tr>
            <th>Địa chỉ</th>
            <td>{{ $utility->address }}</td>
        </tr>
        <tr>
            <th>Vĩ độ</th>
            <td>{{ $utility->latitude }}</td>
        </tr>
        <tr>
            <th>Kinh độ</th>
            <td>{{ $utility->longitude }}</td>
        </tr>
        <tr>
            <th>Thời gian</th>
            <td>{{ $utility->time }}</td>
        </tr>
        <tr>
            <th>Hình ảnh</th>
            <td>
                @if($utility->image)
                    <img src="{{ asset('storage/utility_image/' . $utility->image) }}" alt="Hình tiện ích" style="max-width:150px;">
                @else
                    Không có ảnh
                @endif
            </td>
        </tr>
        <tr>
            <th>Trạng thái</th>
            <td>{{ $utility->status }}</td>
        </tr>
        <tr>
            <th>Mô tả</th>
            <td>{!! ($utility->description) !!}</td>
        </tr>
        <tr>
            <th>Loại tiện ích</th>
            <td>{{ optional($utility->utility_types)->name ?? 'Không xác định' }}</td>
        </tr>
        <tr>
            <th>Ngày tạo</th>
            <td>{{ $utility->created_at }}</td>
        </tr>
        <tr>
            <th>Ngày cập nhật</th>
            <td>{{ $utility->updated_at }}</td>
        </tr>
    </table>
    <a href="{{ route('utilities.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
</div>
@endsection