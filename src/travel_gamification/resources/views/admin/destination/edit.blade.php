@extends('admin.index')
@section('title_name')
    Sửa địa điểm
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
            <form id="quickForm" action="{{route('destinations.update',['id'=>$destination->id])}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Id</label>
                  <input type="text" name="name" class="form-control" value="{{$destination->id}}"id="name" readonly>
                </div>
                <div class="form-group">
                  <label for="type">Loại hình</label>
                  <select name="id_type" class="form-control" id="type">
                    <option value="">Chọn loại hình</option>
                    @foreach($travel_types as $travel_type)
                        <option value="{{ $travel_type->id }}" {{ $destination->travel_type_id == $travel_type->id ? 'selected' : '' }}>{{ $travel_type->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="">Tên địa điểm</label>
                  <input type="text" name="name" class="form-control" id="name" value="{{$destination->name}}">
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

                <div class="form-group">
                  <label for="price">Giá</label>
                  <input type="text" name="price" class="form-control" id="price" value="{{$destination->price}}">
                </div>
             
                <div class="form-group">
                  <label for="highlights">Đặc điểm nổi bật</label>
                  <textarea name="highlights" id="highlights" class="form-control">{{ old('highlights', $destination->highlights) }}</textarea>
                </div>
        
                <div class="form-group">
                    <label for="best_time">Thời gian lý tưởng</label>
                    <textarea name="best_time" id="best_time" class="form-control">{{ old('best_time', $destination->best_time) }}</textarea>
                </div>
        
                <div class="form-group">
                    <label for="local_cuisine">Ẩm thực địa phương</label>
                    <textarea name="local_cuisine" id="local_cuisine" class="form-control">{{ old('local_cuisine', $destination->local_cuisine) }}</textarea>
                </div>
        
                <div class="form-group">
                    <label for="transportation">Phương tiện di chuyển</label>
                    <textarea name="transportation" id="transportation" class="form-control">{{ old('transportation', $destination->transportation) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="latitude">Vĩ độ (Latitude)</label>
                    <input type="text" name="latitude" class="form-control" id="latitude" value="{{ old('latitude', $destination->latitude) }}">
                </div>
                <div class="form-group">
                    <label for="longitude">Kinh độ (Longitude)</label>
                    <input type="text" name="longitude" class="form-control" id="longitude" value="{{ old('longitude', $destination->longitude) }}">
                </div>
                <div class="form-group">
                  <label for="status">Trạng thái</label>
                  <select name="status" class="form-control" id="status">
                      <option value="0" {{ $destination->status == 0 ? 'selected' : '' }}>Hiện</option>
                      <option value="1" {{ $destination->status == 1 ? 'selected' : '' }}>Ẩn</option>
                      <option value="2" {{ $destination->status == 2 ? 'selected' : '' }}>Nổi bật</option>
                  </select>
                </div>
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </form>
          </div>

          <!-- /.card -->
          </div>
        <!--/.col (left) -->
        <!-- right column -->
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
        document.addEventListener('DOMContentLoaded', function () {
            const editorFields = ['#highlights', '#best_time', '#local_cuisine', '#transportation'];
            editorFields.forEach(selector => {
                ClassicEditor
                    .create(document.querySelector(selector), {
                        ckfinder: {
                            uploadUrl: '{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}'
                        },
                        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 'insertTable', 'uploadImage', 'undo', 'redo']
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        });
      </script>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section> 
@endsection


