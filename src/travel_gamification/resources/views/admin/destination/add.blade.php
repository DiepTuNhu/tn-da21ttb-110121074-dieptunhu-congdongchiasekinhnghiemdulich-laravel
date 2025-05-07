@extends('admin.index')
@section('title_name')
    Thêm địa điểm 
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
            <form id="quickForm" action="{{ route('destinations.store') }}" method="post">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="type">Loại hình</label>
                  <select name="id_type" class="form-control" id="type">
                      <option value="">Chọn loại hình</option>
                      @foreach($travel_types as $travel_type)
                          <option value="{{ $travel_type->id }}">{{ $travel_type->name }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="name">Tên địa điểm</label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="Nhập tên địa điểm">
                </div>

                <div class="form-group">
                  <label for="province">Tỉnh</label>
                  <select class="css_select form-control" id="tinh" name="tinh" title="Chọn Tỉnh Thành">
                      <option value="0">Tỉnh Thành</option>
                    </select> 
                </div>

                <div class="form-group">
                    <label for="district">Huyện</label>
                    <select class="css_select form-control" id="quan" name="quan" title="Chọn Quận Huyện">
                        <option value="0">Quận Huyện</option>
                    </select> 
                </div>

                <div class="form-group">
                    <label for="ward">Xã</label>
                    <select class="css_select form-control" id="phuong" name="phuong" title="Chọn Phường Xã">
                        <option value="0">Phường Xã</option>
                    </select>
                </div>
            
                <div class="form-group">
                    <label for="price">Giá</label>
                    <input type="text" name="price" class="form-control" id="price" placeholder="Nhập giá">
                </div>

                <div class="form-group">
                  <label for="highlights">Đặc điểm nổi bật</label>
                  <textarea name="highlights" id="highlights" class="form-control">{{ old('highlights') }}</textarea>
                </div>
        
                <div class="form-group">
                    <label for="best_time">Thời gian lý tưởng</label>
                    <textarea name="best_time" id="best_time" class="form-control">{{ old('best_time') }}</textarea>
                </div>
        
                <div class="form-group">
                    <label for="local_cuisine">Ẩm thực địa phương</label>
                    <textarea name="local_cuisine" id="local_cuisine" class="form-control">{{ old('local_cuisine') }}</textarea>
                </div>
        
                <div class="form-group">
                    <label for="transportation">Phương tiện di chuyển</label>
                    <textarea name="transportation" id="transportation" class="form-control">{{ old('transportation') }}</textarea>
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
        
      </div>
      <script src="https://esgoo.net/scripts/jquery.js"></script>
      <script>
          $(document).ready(function() {
              //Lấy tỉnh thành
              $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm',function(data_tinh){	       
                  if(data_tinh.error==0){
                  $.each(data_tinh.data, function (key_tinh,val_tinh) {
                      $("#tinh").append('<option value="'+val_tinh.id+'">'+val_tinh.full_name+'</option>');
                  });
                  $("#tinh").change(function(e){
                          var idtinh=$(this).val();
                          //Lấy quận huyện
                          $.getJSON('https://esgoo.net/api-tinhthanh/2/'+idtinh+'.htm',function(data_quan){	       
                              if(data_quan.error==0){
                              $("#quan").html('<option value="0">Quận Huyện</option>');  
                              $("#phuong").html('<option value="0">Phường Xã</option>');   
                              $.each(data_quan.data, function (key_quan,val_quan) {
                                  $("#quan").append('<option value="'+val_quan.id+'">'+val_quan.full_name+'</option>');
                              });
                              //Lấy phường xã  
                              $("#quan").change(function(e){
                                      var idquan=$(this).val();
                                      $.getJSON('https://esgoo.net/api-tinhthanh/3/'+idquan+'.htm',function(data_phuong){	       
                                          if(data_phuong.error==0){
                                          $("#phuong").html('<option value="0">Phường Xã</option>');   
                                          $.each(data_phuong.data, function (key_phuong,val_phuong) {
                                              $("#phuong").append('<option value="'+val_phuong.id+'">'+val_phuong.full_name+'</option>');
                                          });
                                          }
                                      });
                              });
                                  
                              }
                          });
                  });   
                      
                  }
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
                            uploadUrl: '{{ route('ckeditor.upload') }}',
                        },
                        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 'insertTable', 'uploadImage', 'undo', 'redo']
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        });
      </script>
    </div><!-- /.container-fluid -->
  </section> 
@endsection


