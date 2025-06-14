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
              {{-- <table id="example1" class="table table-bordered table-striped"> --}}
                <table id="logTable" class="table table-striped mt-3">
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
                    <th width="150px">Thao tác</th>
                </tr>
                </thead>
                <a href = "{{route('users.create')}}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Thêm mới</a><br>
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
                                @if(Str::startsWith($user->avatar, ['http://', 'https://']))
                                    <img src="{{ $user->avatar }}" alt="User Image" width="100">
                                @else
                                    <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="User Image" width="100">
                                @endif
                            @else
                                <span>Chưa có ảnh</span>
                            @endif
                          </td>
                        <td>{{ $user->role->name }}</td>
                        <td>
                          @if($user->status == 0)
                              <span class="text-success" title="Hiện"><i class="fas fa-eye"></i></span>
                          @else
                              <span class="text-danger" title="Ẩn"><i class="fas fa-eye-slash"></i></span>
                          @endif
                        </td>
                        <td>
                            <a class="btn btn-primary" title="Sửa" href="{{ route('users.edit', ['id' => $user->id]) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('users.destroy', ['id' => $user->id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có thật sự muốn xóa không?')">
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



