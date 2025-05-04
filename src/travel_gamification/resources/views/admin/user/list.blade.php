@extends('admin.index')
@section('title_name')
    Người dùng
@endsection
@section('path')
    Người dùng
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên đăng nhập</th>
                    <th>Email</th>
                    {{-- <th>Địa chỉ</th> --}}
                    {{-- <th>Mật khẩu</th> --}}
                    <th>Hình ảnh</th>
                    <th>Phân quyền</th>
                    <th>Trạng thái</th>
                    <th width="105px">Thao tác</th>
                </tr>
                </thead>
                <a href = "{{route('users.create')}}" class="btn btn-primary mb-3">Thêm mới</a><br>
                <tbody>
                    @foreach ($users as $user)
                    <tr>   
                        <td>{{$user->id}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        {{-- <td>{{$user->address}}</td> --}}
                        {{-- <td>{{$user->password}}</td> --}}
                          <td>    
                            @if($user->avatar)
                              <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="User Image" width="100">
                            @else
                                <span>Chưa có ảnh</span>
                            @endif
                          </td>
                        <td>{{ $user->role->name }}</td>
                        <td>
                          @if($user->status == 0)
                              <span class="text-success">Hiện</span>
                          @else
                              <span class="text-danger">Ẩn</span>
                          @endif
                        </td>
                        <td>
                            <a class = "btn btn-primary" href = "{{route('users.edit',['id'=>$user->id])}}">Sửa</a>
                            <a onclick = "return confirm('Bạn có thật sự muốn xóa không?')" class = "btn btn-danger" href = "{{route('users.destroy',['id'=>$user->id])}}">Xóa</a>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Tên đăng nhập</th>
                    <th>Email</th>
                    {{-- <th>Địa chỉ</th> --}}
                    {{-- <th>Mật khẩu</th> --}}
                    <th>Hình ảnh</th>
                    <th>Phân quyền</th>
                    <th>Trạng thái</th>
                    <th width="105px">Thao tác</th>               
                </tr>
                </tfoot>
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



