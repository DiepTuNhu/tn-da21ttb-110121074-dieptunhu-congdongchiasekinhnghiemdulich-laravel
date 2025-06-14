@extends('admin.index')
@section('title_name')
    Loại tiện ích
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <!-- /.card-header -->
            <div class="card-body">
              {{-- <table id="example1" class="table table-bordered table-striped"> --}}
              <table id="logTable" class="table table-striped mt-3">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên loại tiện ích</th>
                    <th>Trạng thái</th>
                    <th width="130px" class="text-center">Thao tác</th>
                </tr>
                </thead>
                <a href = "{{route('utility_types.create')}}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Thêm mới</a><br>
                <tbody>
                    @foreach ($utility_types as $utility_type)
                    <tr>   
                        <td>{{$utility_type->id}}</td>
                        <td>{{$utility_type->name}}</td>
                        <td>
                          @if($utility_type->status == 0)
                              <span class="text-success" title="Hiện"><i class="fas fa-eye"></i></span>
                          @else
                              <span class="text-danger" title="Ẩn"><i class="fas fa-eye-slash"></i></span>
                          @endif
                        </td>
                        <td>
                            <!-- Nút xem chi tiết -->
                            <a class="btn btn-info" title="Xem chi tiết" href="{{ route('utility_types.show', ['id' => $utility_type->id]) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <!-- Nút sửa -->
                            <a class="btn btn-primary" title="Sửa" href="{{ route('utility_types.edit', ['id' => $utility_type->id]) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <!-- Nút xóa -->
                            <form action="{{ route('utility_types.destroy', ['id' => $utility_type->id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có thật sự muốn xóa không?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit" title="Xóa">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
@endsection



