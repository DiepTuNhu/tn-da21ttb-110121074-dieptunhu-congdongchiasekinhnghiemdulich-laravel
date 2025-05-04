@extends('admin.index')
@section('title_name')
    Thêm xã / phường
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
            <form id="quickForm" action="{{route('wards.store')}}" method = "post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="wardCode">Mã xã / phường</label>
                    <input type="text" name="code" class="form-control" id="wardCode" placeholder="Nhập mã xã / phường">
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="wardName">Tên xã / phường</label>
                    <input type="text" name="name" class="form-control" id="wardName" placeholder="Nhập tên xã / phường">
                  </div>
                </div>
                {{-- <div class="card-body">
                  <div class="form-group">
                    <label for="region">Vùng miền</label>
                    <select name="region" class="form-control" id="region">
                      <option value="">Chọn vùng miền</option>
                      <option value="Miền Bắc">Miền Bắc</option>
                      <option value="Miền Trung">Miền Trung</option>
                      <option value="Miền Nam">Miền Nam</option>
                    </select>
                  </div>
                </div> --}}
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


