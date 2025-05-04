@extends('admin.index')
@section('title_name')
    Sửa huy hiệu
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
              @include('admin.alert')
           </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="quickForm" action="{{ route('badges.update', ['id' => $badge->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- @method('PUT') <!-- Sử dụng PUT để cập nhật --> --}}
                <div class="card-body">
                    <div class="form-group">
                        <label for="badgeId">ID</label>
                        <input type="text" name="id" class="form-control" value="{{ $badge->id }}" id="badgeId" readonly>
                    </div>
                    <div class="form-group">
                        <label for="badgeName">Tên huy hiệu</label>
                        <input type="text" name="name" class="form-control" value="{{ $badge->name }}" id="badgeName">
                    </div>
                    <div class="form-group">
                        <label for="badgeDescription">Mô tả</label>
                        <input type="text" name="description" class="form-control" value="{{ $badge->description }}" id="badgeDescription">
                    </div>

                    <div class="form-group">
                        <label for="image1" class="form-label">Chọn ảnh</label>
                        <div class="custom-file">
                              <input type="file" class="custom-file-input" id="image1" name="image1" accept="image/*" onchange="previewImage(1)">
                            <label class="custom-file-label" for="image1">Chọn tệp...</label>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label for="currentImage">Ảnh hiện tại:</label>
                        @if($badge->icon_url)
                        <div id="currentImage" style="margin-top: 10px;">
                            <img src="{{ asset($badge->icon_url) }}" alt="Ảnh hiện tại" width="150">
                        </div>
                        @else
                            <p>Không có ảnh hiện tại.</p>
                        @endif
                    
                      </div>badge
                      <!-- Hiển thị ảnh xem trước -->
                      <div class="form-group">
                          <label for="imagePreview1">Ảnh xem trước:</label>
                          <div id="imagePreview1" style="margin-top: 10px;"></div>
                      </div>
                      <div class="form-group">
                        <label for="status">Trạng thái</label>
                        <select name="status" class="form-control" id="status">
                            <option value="0" {{ $badge->status == 0 ? 'selected' : '' }}>Hiện</option>
                            <option value="1" {{ $badge->status == 1 ? 'selected' : '' }}>Ẩn</option>
                        </select>
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


