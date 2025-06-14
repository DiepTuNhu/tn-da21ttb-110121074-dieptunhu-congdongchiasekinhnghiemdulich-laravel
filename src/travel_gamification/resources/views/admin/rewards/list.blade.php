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
                    {{-- <th>Mô tả</th> --}}
                    {{-- <th>Điểm cần đổi</th> --}}
                    {{-- <th>Loại</th> --}}
                    <th>Tồn kho</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <a href="{{ route('rewards.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Thêm mới</a><br>
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
                    {{-- <td>{{ $reward->description }}</td>
                    <td>{{ number_format($reward->cost_points, 0, ',', '.') }}</td> --}}
                    {{-- <td>{{ $reward->type == 'virtual' ? 'Ảo' : 'Hiện vật' }}</td> --}}
                    <td>{{ $reward->stock }}</td>
                    <td>
                        @if($reward->active)
                            <span class="text-success" title="Hiện"><i class="fas fa-eye"></i></span>
                        @else
                            <span class="text-danger" title="Ẩn"><i class="fas fa-eye-slash"></i></span>
                        @endif
                    </td>
                    <td>
                        <!-- Nút xem chi tiết -->
                        <a href="{{ route('rewards.show', $reward->id) }}" class="btn btn-info btn-sm" title="Xem chi tiết">
                            <i class="fas fa-eye"></i>
                        </a>
                        <!-- Nút sửa -->
                        <a href="{{ route('rewards.edit', $reward->id) }}" class="btn btn-primary btn-sm" title="Sửa">
                            <i class="fas fa-edit"></i>
                        </a>
                        <!-- Nút xóa -->
                        <form action="{{ route('rewards.destroy', $reward->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Xóa" onclick="return confirm('Xóa phần thưởng này?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
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



