@extends('admin.index')
@section('title_name')
    Phân quyền
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
                    <th>Hình ảnh</th>
                    <th width="105px" class="text-center">Thao tác</th>
                  </tr>
                </thead>
                <a href = "{{route('roles.create')}}" class="btn btn-primary mb-3">Thêm mới</a><br>
                <tbody>
                  @foreach ($roles as $role)
                  <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                      <a class="btn btn-primary" href="{{ route('roles.edit', ['id' => $role->id]) }}">Sửa</a>
                      <a onclick="return confirm('Bạn có thật sự muốn xóa không?')" class="btn btn-danger" href="{{ route('roles.destroy', ['id' => $role->id]) }}">Xóa</a>
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



