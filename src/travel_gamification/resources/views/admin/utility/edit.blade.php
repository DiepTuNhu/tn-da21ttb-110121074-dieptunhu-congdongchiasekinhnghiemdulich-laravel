@extends('admin.index')
@section('title_name')
    Sửa tiện ích
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
            <form id="quickForm" action="{{ route('utilities.update', ['id' => $utility->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <!-- Hiển thị lỗi nếu có -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="id">Id</label>
                        <input type="text" name="id" class="form-control" value="{{ $utility->id }}" id="id" readonly>
                    </div>

                    <div class="form-group">
                        <label for="utility_type">Loại tiện ích</label>
                        <select name="utility_type_id" class="form-control" id="utility_type" required>
                            <option value="">Chọn loại tiện ích</option>
                            @foreach($utility_types as $utility_type)
                                <option value="{{ $utility_type->id }}" {{ $utility->utility_type_id == $utility_type->id ? 'selected' : '' }}>
                                    {{ $utility_type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Tên tiện ích</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $utility->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="price">Giá</label>
                        <input type="text" name="price" class="form-control" id="price" value="{{ $utility->price }}">
                    </div>

                    <div class="form-group">
                      <label for="tinh">Tỉnh</label>
                      <select class="form-control" id="tinh" name="tinh" required>
                          <option value="">Chọn Tỉnh</option>
                      </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="quan">Huyện</label>
                        <select class="form-control" id="quan" name="quan" required>
                            <option value="">Chọn Huyện</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="phuong">Xã</label>
                        <select class="form-control" id="phuong" name="phuong" required>
                            <option value="">Chọn Xã</option>
                        </select>
                    </div>
                    
                    <input type="hidden" name="tinh_text" id="tinh_text">
                    <input type="hidden" name="quan_text" id="quan_text">
                    <input type="hidden" name="phuong_text" id="phuong_text">

                    {{-- <div class="form-group">
                        <label for="distance">Khoảng cách</label>
                        <input type="number" name="distance" class="form-control" id="distance" value="{{ $utility->distance }}" min="0">
                    </div> --}}

                    <div class="form-group">
                        <label for="time">Giờ phục vụ</label>
                        <input type="text" name="time" class="form-control" id="time" value="{{ $utility->time }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea name="description" id="description" class="form-control">{{ old('description', $utility->description) }}</textarea>
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
                        @if($utility->image)
                            <div id="currentImage" style="margin-top: 10px;">
                                <img src="{{ asset('storage/utility_image/' . $utility->image) }}" alt="Ảnh hiện tại" width="150">
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
                            <option value="0" {{ $utility->status == 0 ? 'selected' : '' }}>Hiện</option>
                            <option value="1" {{ $utility->status == 1 ? 'selected' : '' }}>Ẩn</option>
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

    <script>
        // Hiển thị ảnh xem trước
        function previewImage(id) {
            const file = document.getElementById(`image${id}`).files[0];
            const preview = document.getElementById(`imagePreview${id}`);
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Ảnh xem trước" width="150">`;
                };
                reader.readAsDataURL(file);
            } else {
                preview.innerHTML = '';
            }
        }
    </script>
    <script src="https://esgoo.net/scripts/jquery.js"></script>
    <script>
      $(document).ready(function() {
          // Lấy danh sách tỉnh
          $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm', function(data_tinh) {
              if (data_tinh.error == 0) {
                  $.each(data_tinh.data, function(key_tinh, val_tinh) {
                      const selected = val_tinh.full_name === "{{ $tinh }}" ? 'selected' : '';
                      $("#tinh").append('<option value="' + val_tinh.id + '" ' + selected + '>' + val_tinh.full_name + '</option>');
                  });
  
                  // Khi chọn tỉnh, lấy danh sách huyện
                  $("#tinh").change(function() {
                      var idtinh = $(this).val();
                      $.getJSON('https://esgoo.net/api-tinhthanh/2/' + idtinh + '.htm', function(data_quan) {
                          if (data_quan.error == 0) {
                              $("#quan").html('<option value="">Chọn Huyện</option>');
                              $("#phuong").html('<option value="">Chọn Xã</option>');
                              $.each(data_quan.data, function(key_quan, val_quan) {
                                  const selected = val_quan.full_name === "{{ $quan }}" ? 'selected' : '';
                                  $("#quan").append('<option value="' + val_quan.id + '" ' + selected + '>' + val_quan.full_name + '</option>');
                              });
  
                              // Khi chọn huyện, lấy danh sách xã
                              $("#quan").change(function() {
                                  var idquan = $(this).val();
                                  $.getJSON('https://esgoo.net/api-tinhthanh/3/' + idquan + '.htm', function(data_phuong) {
                                      if (data_phuong.error == 0) {
                                          $("#phuong").html('<option value="">Chọn Xã</option>');
                                          $.each(data_phuong.data, function(key_phuong, val_phuong) {
                                              const selected = val_phuong.full_name === "{{ $phuong }}" ? 'selected' : '';
                                              $("#phuong").append('<option value="' + val_phuong.id + '" ' + selected + '>' + val_phuong.full_name + '</option>');
                                          });
                                      }
                                  });
                              });
  
                              // Kích hoạt sự kiện change để tự động tải xã khi trang được tải
                              $("#quan").trigger('change');
                          }
                      });
                  });
  
                  // Kích hoạt sự kiện change để tự động tải huyện khi trang được tải
                  $("#tinh").trigger('change');
              }
          });
          $('form').submit(function() {
          $('#tinh_text').val($('#tinh option:selected').text());
          $('#quan_text').val($('#quan option:selected').text());
          $('#phuong_text').val($('#phuong option:selected').text());
      });
      });
  </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'), {
                ckfinder: {
                    uploadUrl: '{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}'
                },
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 'insertTable', 'uploadImage', 'undo', 'redo']
            })
            .catch(error => {
                console.error(error);
            });
    </script>
  </section> 
@endsection


