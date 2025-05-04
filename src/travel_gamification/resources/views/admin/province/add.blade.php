@extends('admin.index')
@section('title_name')
    Thêm loại hình du lịch
@endsection
@section('path')
    Thêm loại hình du lịch
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
            <form id="quickForm" action="{{route('provinces.store')}}" method = "post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="provinceCode">Mã tỉnh</label>
                    <input type="text" name="code" class="form-control" id="provinceCode" placeholder="Nhập mã tỉnh">
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="provinceName">Tên tỉnh</label>
                    <input type="text" name="name" class="form-control" id="provinceName" placeholder="Nhập tên tỉnh">
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="region">Vùng miền</label>
                    <select name="region" class="form-control" id="region">
                      <option value="">Chọn vùng miền</option>
                      <option value="Miền Bắc">Miền Bắc</option>
                      <option value="Miền Trung">Miền Trung</option>
                      <option value="Miền Nam">Miền Nam</option>
                    </select>
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


