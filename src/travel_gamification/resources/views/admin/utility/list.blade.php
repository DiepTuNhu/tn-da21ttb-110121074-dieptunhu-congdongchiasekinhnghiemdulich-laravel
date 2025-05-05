@extends('admin.index')
@section('title_name')
    Tiện ích
@endsection
@section('path')
    Tiện ích
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
                    <th>Tên tiện ích</th>
                    <th>Địa chỉ</th>
                    <th>Hình ảnh</th>
                    <th>Loại tiện ích</th>
                    <th>Trạng thái</th>
                    <th width="105px">Thao tác</th>
                </tr>
                </thead>
                <a href = "{{route('utilities.create')}}" class="btn btn-primary mb-3">Thêm mới</a><br>
                <tbody>
                  @foreach ($utilities as $utility)
            <tr>   
                <td>{{$utility->id}}</td>
                <td>{{$utility->name}}</td>
                <td>{{$utility->address}}</td>
                <td>    
                  @if($utility->image)
                    <img src="{{ asset('storage/utility_image/' . $utility->image) }}" alt="Utility Image" width="100">
                  @else
                      <span>Chưa có ảnh</span>
                  @endif
                </td>
                <td>{{$utility->utility_types->name ?? 'Chưa xác định' }}</td>  <!-- Hiển thị tên loại hình -->
                {{-- <td>{{$utility->location->name ?? 'Chưa xác định' }}</td>  <!-- Hiển thị tên thành phố --> --}}
                <td>
                    @if($utility->status == 0)
                        <span class="text-success">Hiện</span>
                    @else
                        <span class="text-danger">Ẩn</span>
                    @endif
                </td>
                <td>

                    <a class="btn btn-primary" href="{{ route('utilities.edit', ['id' => $utility->id]) }}">Sửa</a>
                    <a onclick="return confirm('Bạn có thật sự muốn xóa không?')" class="btn btn-danger" href="{{ route('utilities.destroy', ['id' => $utility->id]) }}">Xóa</a>
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



