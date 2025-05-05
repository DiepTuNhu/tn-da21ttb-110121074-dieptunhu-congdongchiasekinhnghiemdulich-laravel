@extends('admin.index')
@section('title_name')
    Thêm tiện ích 
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
            <form id="quickForm" action="{{ route('utilities.store') }}" method="post" enctype="multipart/form-data">
              @csrf
              <meta name="csrf-token" content="{{ csrf_token() }}">
              <div class="card-body">
                <div class="form-group">
                    <label for="utility_type">Loại tiện ích</label>
                    <select name="id_typeofutility" class="form-control" id="typeofutility" required>
                        <option value="">Chọn loại tiện ích</option>
                        @foreach($utility_types as $utility_type)
                            <option value="{{ $utility_type->id }}">{{ $utility_type->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Tên tiện ích</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Nhập tên tiện ích" required>
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
                      <input type="text" name="price" class="form-control" id="price" placeholder="Nhập giá" min="0">
                  </div>

                  <div class="form-group">
                    <label for="time">Giờ phục vụ</label>
                    <input type="text" name="time" class="form-control" id="time">
                </div>
             
                  <div class="form-group">
                      <label for="description">Mô tả</label>
                      <textarea name="description" id="description" class="form-control" placeholder="Nhập mô tả">{{ old('description') }}</textarea>
                  </div>
                  <div class="form-group">
                      <label for="image">Hình ảnh</label>
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                          <label class="custom-file-label" for="image">Chọn tệp...</label>
                      </div>
                      <small class="form-text text-muted mt-2" id="file-name">Chưa có tệp nào được chọn.</small>
                  </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Thêm</button>
              </div>
          </form>
          
          <script>
              document.getElementById('image').addEventListener('change', function (e) {
                  const fileName = e.target.files[0]?.name || 'Chưa có tệp nào được chọn.';
                  document.querySelector('.custom-file-label').textContent = fileName;
                  document.getElementById('file-name').textContent = `Tệp được chọn: ${fileName}`;
              });
            
          </script>
          
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
          </div>
          <!-- /.card -->
          </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">

            <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
            <script>
                ClassicEditor
                    .create(document.querySelector('#description'), {
                        ckfinder: {
                            uploadUrl: '{{ route('ckeditor.upload') }}', // Đường dẫn xử lý upload ảnh
                        },
                        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 'insertTable', 'uploadImage', 'undo', 'redo']
                    })
                    .catch(error => {
                        console.error(error);
                    });
            </script>
          

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section> 
@endsection


