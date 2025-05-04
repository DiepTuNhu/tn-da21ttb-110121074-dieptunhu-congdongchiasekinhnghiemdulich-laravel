@extends('admin.index')
@section('title_name')
    Sửa người dùng
@endsection
@section('path')
    Sửa người dùng
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- jquery validation -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="quickForm" action="{{route('users.update',['id'=>$user->id])}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Id</label>
                  <input type="text" name="userName" class="form-control" value="{{$user->id}}"id="userName" readonly>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Tên người dùng</label>
                  <input type="text" name="userName" class="form-control" value="{{$user->username}}"id="userName">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" name="email" class="form-control" value="{{$user->email}}"id="email">
                </div>
                <div class="form-group">
                  <label for="description">Mô tả</label>
                  <input type="text" name="description" class="form-control" value="{{$user->description}}" id="description">
                </div>
                {{-- <div class="form-group">
                  <label for="password">Mật khẩu</label>
                  <input type="password" name="password" class="form-control" id="password">
                </div>  --}}
                <div class="form-group">
                  <label for="role">Phân quyền</label>
                  <select name="role_id" class="form-control" id="role">
                    <option value="">Chọn phân quyền</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="status">Trạng thái</label>
                  <select name="status" class="form-control" id="status">
                      <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Hiện </option>
                      <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Ẩn</option>
                  </select>
                </div>
                
                {{-- <div class="form-group">
                  <label for="image" class="form-label">Hình ảnh</label>
                  <div class="custom-file">
                      <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                      <label class="custom-file-label" for="image">Chọn tệp...</label>
                  </div>
                  @if($user->image) <!-- Hiển thị ảnh cũ nếu có -->
                      <div class="mt-2">
                          <img src="{{ asset('storage/images/' . $user->image) }}" alt="Current Image" width="100">
                      </div>
                  @endif
                  <small class="form-text text-muted mt-2" id="file-name">Chưa có tệp nào được chọn.</small>
                </div> --}}
                
                <div class="form-group">
                  <label for="image1" class="form-label">Chọn ảnh</label>
                  <div class="custom-file">
                      <input type="file" class="custom-file-input" id="image1" name="image1" accept="image/*" onchange="previewImage(1)">
                      <label class="custom-file-label" for="image1">Chọn tệp...</label>
                  </div>
                </div>
              
              <!-- Hiển thị ảnh hiện tại -->
              <div class="form-group">
                  <label for="currentImage">Ảnh hiện tại:</label>
                  @if($user->avatar)
                      <div id="currentImage" style="margin-top: 10px;">
                          <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Ảnh hiện tại" width="150">
                      </div>
                  @else
                      <p>Không có ảnh hiện tại.</p>
                  @endif
              </div>
              
              <!-- Hiển thị ảnh xem trước -->
              <div class="form-group">
                  <label for="imagePreview1">Ảnh xem trước:</label>
                  <div id="imagePreview1" style="margin-top: 10px;"></div>
              </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Sửa</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
          </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section> 
@endsection


