@extends('admin.index')
@section('title_name')
    Thêm hình ảnh 
@endsection
@section('path')
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
            <form id="quickForm" action="{{ route('photos.store') }}" method="post" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id_location" value="{{ $locationId }}">

                  <!-- Hiển thị tên địa điểm -->
                  
                  <div class="card-body">
                <div class="form-group">
                  <label for="location_name">Tên địa điểm</label>
                  <input type="text" class="form-control" id="location_name" value="{{ $locationName }}" readonly>
                </div>
                <!-- Khung 1: Chọn 1 ảnh, status = 2 -->
                {{-- <div class="form-group">
                  <label for="image1" class="form-label">Chọn ảnh (Ảnh chính)</label>
                  <div class="custom-file">
                      <input type="file" class="custom-file-input" id="image1" name="image1" accept="image/*" onchange="previewImage(1)">
                      <label class="custom-file-label" for="image1">Chọn tệp...</label>
                  </div>
                </div> --}}

                <div class="form-group">
                  <label for="image1" class="form-label">Chọn ảnh (Ảnh chính)</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image1" name="image1" accept="image/*" onchange="previewImage(1)" 
                      @if($existingMainPhoto) disabled @endif> <!-- Vô hiệu hóa nếu đã có ảnh chính -->
                    <label class="custom-file-label" for="image1">Chọn tệp...</label>
                  </div>
                </div>             

                <!-- Khung 2: Chọn tối đa 4 ảnh, status = 0 -->
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
              {{-- </div> --}}
              
                
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
                    <label for="caption">Caption</label>
                    <input type="text" name="caption" class="form-control" id="caption" placeholder="Nhập địa chỉ">
                </div>
                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="text" name="url" class="form-control" id="url" placeholder="Nhập địa chỉ">
                </div>     
              
                {{-- <div class="form-group">
                  <label for="location">Địa điểm</label>
                  <select name="id_location" class="form-control" id="location">
                      <option value="">Chọn tỉnh/thành phố</option>
                      @foreach($locations as $location)
                          <option value="{{ $location->id }}">{{ $location->name }}</option>
                      @endforeach
                  </select>
                </div>                  --}}
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

      // Kiểm tra ảnh phụ (tối đa 4 ảnh phụ)
      var image2Input = document.getElementById('image2');
      
      @if(isset($existingPhotosCount) && $existingPhotosCount >= 4)
          // Vô hiệu hóa ô nhập ảnh phụ nếu đã đủ 4 ảnh
          image2Input.disabled = true;
          image2Input.closest('.custom-file').querySelector('label').innerText = 'Đã đủ 4 ảnh phụ';
      @else
          // Nếu chưa đủ 4 ảnh phụ thì cho phép chọn ảnh
          image2Input.disabled = false;
      @endif
  });
</script>

