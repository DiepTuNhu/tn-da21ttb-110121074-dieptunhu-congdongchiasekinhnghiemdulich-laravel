@extends('admin.index')
@section('title_name')
    Loại hình du lịch
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
                    <th>Tên loại hình</th>
                    <th>Trạng thái</th>
                    <th width="130px" class="text-center">Thao tác</th>
                </tr>
                </thead>
                <a href = "{{route('travel_types.create')}}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Thêm mới</a><br>
                <tbody>
                    @foreach ($types as $type)
                    <tr>   
                        <td>{{$type->id}}</td>
                        <td>{{$type->name}}</td>
                        <td>
                          @if($type->status == 0)
                              <span class="text-success" title="Hiện"><i class="fas fa-eye"></i></span>
                          @else
                              <span class="text-danger" title="Ẩn"><i class="fas fa-eye-slash"></i></span>
                          @endif
                        </td>
                        <td>
                            <a class="btn btn-info" title="Xem chi tiết" href="{{ route('travel_types.show', ['id' => $type->id]) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="btn btn-primary" title="Sửa" href="{{ route('travel_types.edit', ['id' => $type->id]) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a onclick="return confirm('Bạn có thật sự muốn xóa không?')" class="btn btn-danger" title="Xóa" href="{{ route('travel_types.destroy', ['id' => $type->id]) }}">
                                <i class="fas fa-trash-alt"></i>
                            </a>
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



