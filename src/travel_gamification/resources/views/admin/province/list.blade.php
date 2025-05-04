@extends('admin.index')
@section('title_name')
    Tỉnh / Thành phố
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
                    <th>Mã tỉnh / thành phố</th>
                    <th>Tên tỉnh / thành phố</th>
                    <th>Vùng miền</th>
                    <th width="105px" class="text-center">Thao tác</th>
                </tr>
                </thead>
                <a href="{{ route('provinces.create') }}" class="btn btn-primary mb-3">Thêm mới</a><br>
                <tbody>
                    @foreach ($provinces as $province)
                    <tr>   
                        <td>{{ $province->id }}</td>
                        <td>{{ $province->code }}</td>
                        <td>{{ $province->name }}</td>
                        <td>{{ $province->region }}</td>
                        <td class="text-center">
                            <a class="btn btn-primary" href="{{ route('provinces.edit', ['id' => $province->id]) }}">Sửa</a>
                            <a onclick="return confirm('Bạn có thật sự muốn xóa không?')" class="btn btn-danger" href="{{ route('provinces.destroy', ['id' => $province->id]) }}">Xóa</a>
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



