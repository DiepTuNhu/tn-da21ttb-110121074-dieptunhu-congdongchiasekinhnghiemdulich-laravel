@extends('admin.index')
@section('title_name')
    Xã / Phường
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
                    <th>Mã xã / phường</th>
                    <th>Tên xã / phường</th>
                    {{-- <th>Vùng miền</th> --}}
                    <th width="105px" class="text-center">Thao tác</th>
                </tr>
                </thead>
                <a href="{{ route('wards.create') }}" class="btn btn-primary mb-3">Thêm mới</a><br>
                <tbody>
                    @foreach ($wards as $ward)
                    <tr>   
                        <td>{{ $ward->id }}</td>
                        <td>{{ $ward->code }}</td>
                        <td>{{ $ward->name }}</td>
                        {{-- <td>{{ $district->region }}</td> --}}
                        <td class="text-center">
                            <a class="btn btn-primary" href="{{ route('wards.edit', ['id' => $ward->id]) }}">Sửa</a>
                            <a onclick="return confirm('Bạn có thật sự muốn xóa không?')" class="btn btn-danger" href="{{ route('wards.destroy', ['id' => $ward->id]) }}">Xóa</a>
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



