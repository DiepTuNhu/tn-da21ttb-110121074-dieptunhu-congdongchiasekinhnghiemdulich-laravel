@extends('admin.index')
@section('title_name')
    Sửa slide
@endsection
@section('path')
    Sửa slide
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
            <form id="quickForm" action="{{route('slides.update',['id'=>$slide->id])}}" method = "post" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Id</label>
                  <input type="text" name="slideID" class="form-control" value="{{$slide->id}}"id="slideID" readonly>
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
                  @if($slide->image)
                  <div id="currentImage" style="margin-top: 10px;">
                      <img src="{{ asset('storage/slide_image/' . $slide->image) }}" alt="Ảnh hiện tại" width="150">
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
                  <label for="status">Trạng thái</label>
                  <select name="status" class="form-control" id="status">
                      <option value="0" {{ $slide->status == 0 ? 'selected' : '' }}>Hiện</option>
                      <option value="1" {{ $slide->status == 1 ? 'selected' : '' }}>Ẩn</option>
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
<script>
  function previewImage(inputId) {
      const input = document.getElementById(`image${inputId}`);
      const previewContainer = document.getElementById(`imagePreview${inputId}`);
      previewContainer.innerHTML = ""; // Xóa ảnh xem trước cũ
  
      if (input.files && input.files[0]) {
          const file = input.files[0];
          const reader = new FileReader();
  
          reader.onload = function(e) {
              const img = document.createElement("img");
              img.src = e.target.result;
              img.alt = "Ảnh xem trước";
              img.style.width = "150px";
              previewContainer.appendChild(img);
          };
  
          reader.readAsDataURL(file);
      }
  }
  </script>
  

