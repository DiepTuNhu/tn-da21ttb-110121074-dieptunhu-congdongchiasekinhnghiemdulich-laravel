@extends('admin.index')
@section('title_name')
    Quận / Huyện
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
                    <th>Mã tỉnh</th>
                    <th>Tên tỉnh</th>
                    {{-- <th>Vùng miền</th> --}}
                    <th width="105px" class="text-center">Thao tác</th>
                </tr>
                </thead>
                <a href="{{ route('districts.create') }}" class="btn btn-primary mb-3">Thêm mới</a><br>
                <tbody>
                    @foreach ($districts as $district)
                    <tr>   
                        <td>{{ $district->id }}</td>
                        <td>{{ $district->code }}</td>
                        <td>{{ $district->name }}</td>
                        {{-- <td>{{ $district->region }}</td> --}}
                        <td class="text-center">
                            <a class="btn btn-primary" href="{{ route('districts.edit', ['id' => $district->id]) }}">Sửa</a>
                            <a onclick="return confirm('Bạn có thật sự muốn xóa không?')" class="btn btn-danger" href="{{ route('districts.destroy', ['id' => $district->id]) }}">Xóa</a>
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



