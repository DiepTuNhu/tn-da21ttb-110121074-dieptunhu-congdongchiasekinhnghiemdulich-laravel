@extends('admin.index')
@section('title_name')
    Thêm huy hiệu
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
            <form id="quickForm" action="{{route('badges.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="badgeName">Tên huy hiệu</label>
                    <input type="text" name="name" class="form-control" id="badgeName" placeholder="Nhập tên huy hiệu">
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="badgeDescription">Mô tả</label>
                    <textarea type="text" name="description" class="form-control" id="badgeDescription" placeholder="Nhập mô tả"></textarea>
                  </div>
                </div>

                <div class="card-body">
                  <div class="form-group">
                    <label for="image1" class="form-label">Chọn ảnh</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="image1" name="image1" accept="image/*" onchange="previewImage(1)">
                      <label class="custom-file-label" for="image1">Chọn tệp...</label>
                    </div>
                  </div>             
                       
                  <!-- Hiển thị ảnh xem trước -->
                  <div class="form-group">
                      <label for="imagePreview1">Ảnh xem trước:</label>
                      <div id="imagePreview1" style="margin-top: 10px;"></div>
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


