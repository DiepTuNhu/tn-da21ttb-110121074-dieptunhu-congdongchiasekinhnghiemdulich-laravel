@extends('admin.index')
@section('title_name')
    Thêm hình ảnh 
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
            <form id="quickForm" action="{{ route('destination_images.store') }}" method="post" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="destination_id" value="{{ $destinationId }}">

                  <!-- Hiển thị tên địa điểm -->
                  
                  <div class="card-body">
                <div class="form-group">
                  <label for="destination_name">Tên địa điểm</label>
                  <input type="text" class="form-control" id="destination_name" value="{{ $destinationName }}" readonly>
                </div>

                <div class="form-group">
                  <label for="image1" class="form-label">Chọn ảnh (Ảnh chính)</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image1" name="image1" accept="image/*" onchange="previewImage(1)" 
                      @if($existingMainPhoto) disabled @endif> <!-- Vô hiệu hóa nếu đã có ảnh chính -->
                    <label class="custom-file-label" for="image1">Chọn tệp...</label>
                  </div>
                </div>             

                <!-- Khung 2: Chọn ảnh phụ -->
                <div class="form-group">
                  <label for="image2" class="form-label">Chọn ảnh (không giới hạn số lượng)</label>
                  <div class="custom-file">
                      <input type="file" 
                             class="custom-file-input" 
                             id="image2" 
                             name="images[]" 
                             accept="image/*" 
                             multiple 
                             onchange="previewImages(2)">
                      <label class="custom-file-label" for="image2">Chọn tệp...</label>
                  </div>              
                
                  <!-- Hiển thị lỗi liên quan đến việc upload ảnh -->
                  @if ($errors->has('images'))
                    <span class="text-danger">{{ $errors->first('images') }}</span>
                  @endif
                </div>
                        
                <!-- Hiển thị ảnh xem trước -->
                <div class="form-group">
                  <label for="imagePreview1">Ảnh xem trước (Ảnh chính):</label>
                  <div id="imagePreview1" style="margin-top: 10px;"></div>
                </div>

                <div class="form-group">
                  <label for="imagePreview2">Ảnh xem trước (Ảnh phụ):</label>
                  <div id="imagePreview2" style="margin-top: 10px;"></div>
                </div>
                <div class="form-group">    

                </div>               
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Thêm</button>
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
  document.addEventListener("DOMContentLoaded", function() {
      // Kiểm tra ảnh chính
      var image1Input = document.getElementById('image1');
      
      @if($existingMainPhoto)
          // Vô hiệu hóa ô nhập ảnh chính nếu đã có ảnh chính
          image1Input.disabled = true;
          image1Input.closest('.custom-file').querySelector('label').innerText = 'Ảnh chính đã được chọn';
      @endif

      // Hiển thị xem trước ảnh chính
      window.previewImage = function(index) {
          const input = document.getElementById(`image${index}`);
          const preview = document.getElementById(`imagePreview${index}`);
          preview.innerHTML = '';
          if (input.files && input.files[0]) {
              const reader = new FileReader();
              reader.onload = function(e) {
                  const img = document.createElement('img');
                  img.src = e.target.result;
                  img.style.maxWidth = '200px';
                  img.style.marginRight = '10px';
                  preview.appendChild(img);
              };
              reader.readAsDataURL(input.files[0]);
          }
      };

      // Hiển thị xem trước ảnh phụ
      window.previewImages = function(index) {
          const input = document.getElementById(`image${index}`);
          const preview = document.getElementById(`imagePreview${index}`);
          preview.innerHTML = '';
          if (input.files) {
              Array.from(input.files).forEach(file => {
                  const reader = new FileReader();
                  reader.onload = function(e) {
                      const img = document.createElement('img');
                      img.src = e.target.result;
                      img.style.maxWidth = '200px';
                      img.style.marginRight = '10px';
                      preview.appendChild(img);
                  };
                  reader.readAsDataURL(file);
              });
          }
      };
  });
</script>

