@extends('admin.index')
@section('title_name')
    Danh sách phần thưởng
@endsection

@section('content')
<section class="content">
<div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="logTable" class="table table-striped mt-3">

                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên phần thưởng</th>
                    <th>Mô tả</th>
                    <th>Điểm cần đổi</th>
                    <th>Loại</th>
                    <th>Tồn kho</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <a href="{{ route('rewards.create') }}" class="btn btn-primary mb-3">Thêm mới</a><br>
                <tbody>
                  @foreach($rewards as $reward)
                  <tr>
                    <td>{{ $reward->id }}</td>
                    <td>
                        @if($reward->image)
                            <img src="{{ asset('storage/rewards/' . $reward->image) }}" alt="" width="60">
                        @endif
                    </td>
                    <td>{{ $reward->name }}</td>
                    <td>{{ $reward->description }}</td>
                    <td>{{ number_format($reward->cost_points, 0, ',', '.') }}</td>
                    <td>{{ $reward->type == 'virtual' ? 'Ảo' : 'Hiện vật' }}</td>
                    <td>{{ $reward->stock }}</td>
                    <td>
                        @if($reward->active)
                            <span class="text-success">Hiện</span>
                        @else
                            <span class="text-danger">Ẩn</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('rewards.edit', $reward->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                        <form action="{{ route('rewards.destroy', $reward->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xóa phần thưởng này?')">Xóa</button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection



