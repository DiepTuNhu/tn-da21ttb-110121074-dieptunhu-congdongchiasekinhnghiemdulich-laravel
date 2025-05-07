@extends('admin.index')
@section('title_name')
    Sửa hình ảnh
@endsection
@section('path')
    Sửa hình ảnh
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
            <form id="quickForm" action="{{route('photos.update',['id'=>$photo->id])}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Id</label>
                  <input type="text" name="name" class="form-control" value="{{$photo->id}}"id="name" readonly>
                </div>

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
                  @if($photo->id)
                      <div id="currentImage" style="margin-top: 10px;">
                          <img src="{{ asset('storage/location_image/' . $photo->name) }}" alt="Ảnh hiện tại" width="150">
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

              <div class="form-group">
                <label for="caption">Caption</label>
                <input type="text" name="caption" class="form-control" id="caption" placeholder="Nhập chú thích" value="{{ $photo->caption }}">
              </div>
                <!-- Hiển thị URL -->
              <div class="form-group">
                <label for="url">URL</label>
                <input type="text" name="url" class="form-control" id="url" placeholder="Nhập URL" value="{{ $photo->url }}">
              </div>
            
              <!-- Hiển thị Địa điểm -->
              <div class="form-group">
                  <label for="location">Địa điểm</label>
                  <select name="id_location" class="form-control" id="location">
                      <option value="">Chọn địa điểm</option>
                      @foreach($locations as $location)
                          <option value="{{ $location->id }}" {{ $photo->id_location == $location->id ? 'selected' : '' }}>
                              {{ $location->name }}
                          </option>
                      @endforeach
                  </select>
              </div>

              <!-- Hiển thị Trạng thái -->
              <div class="form-group">
                  <label for="status">Trạng thái</label>
                  <select name="status" class="form-control" id="status">
                      <option value="0" {{ $photo->status == 0 ? 'selected' : '' }}>Phụ</option>
                      <option value="1" {{ $photo->status == 1 ? 'selected' : '' }}>Ẩn</option>
                      <option value="2" {{ $photo->status == 2 ? 'selected' : '' }}>Chính</option>
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


