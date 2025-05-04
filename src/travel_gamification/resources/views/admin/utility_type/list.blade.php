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
                    <th width="105px" class="text-center">Thao tác</th>
                </tr>
                </thead>
                <a href = "{{route('utility_types.create')}}" class="btn btn-primary mb-3">Thêm mới</a><br>
                <tbody>
                    @foreach ($utility_types as $utility_type)
                    <tr>   
                        <td>{{$utility_type->id}}</td>
                        <td>{{$utility_type->name}}</td>
                        <td>
                          @if($utility_type->status == 0)
                              <span class="text-success">Hiện</span>
                          @else
                              <span class="text-danger">Ẩn</span>
                          @endif
                        </td>
                        <td>
                            <a class = "btn btn-primary" href = "{{route('utility_types.edit',['id'=>$utility_type->id])}}">Sửa</a>
                            <a onclick = "return confirm('Bạn có thật sự muốn xóa không?')" class = "btn btn-danger" href = "{{route('utility_types.destroy',['id'=>$utility_type->id])}}">Xóa</a>
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



