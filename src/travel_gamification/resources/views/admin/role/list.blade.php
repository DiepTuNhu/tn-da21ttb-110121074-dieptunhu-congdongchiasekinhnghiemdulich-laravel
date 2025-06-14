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
                <a href = "{{route('roles.create')}}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Thêm mới</a><br>
                <tbody>
                  @foreach ($roles as $role)
                  <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a class="btn btn-primary" title="Sửa" href="{{ route('roles.edit', ['id' => $role->id]) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('roles.destroy', ['id' => $role->id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có thật sự muốn xóa không?')">
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



