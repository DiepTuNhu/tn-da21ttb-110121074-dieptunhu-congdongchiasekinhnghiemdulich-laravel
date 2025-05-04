@extends('admin.index')
@section('title_name')
    Sửa loại hình du lịch
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
            <form id="quickForm" action="{{ route('wards.update', ['id' => $ward->id]) }}" method="post">
                @csrf
                {{-- @method('PUT') <!-- Sử dụng PUT để cập nhật --> --}}
                <div class="card-body">
                    <div class="form-group">
                        <label for="wardId">ID</label>
                        <input type="text" name="id" class="form-control" value="{{ $ward->id }}" id="wardId" readonly>
                    </div>
                    <div class="form-group">
                        <label for="wardCode">Mã huyện</label>
                        <input type="text" name="code" class="form-control" value="{{ $ward->code }}" id="wardCode">
                    </div>
                    <div class="form-group">
                        <label for="wardName">Tên huyện</label>
                        <input type="text" name="name" class="form-control" value="{{ $ward->name }}" id="wardName">
                    </div>
                    {{-- <div class="form-group">
                        <label for="region">Vùng miền</label>
                        <select name="region" class="form-control" id="region">
                            <option value="">Chọn vùng miền</option>
                            <option value="Miền Bắc" {{ $province->region == 'Miền Bắc' ? 'selected' : '' }}>Miền Bắc</option>
                            <option value="Miền Trung" {{ $province->region == 'Miền Trung' ? 'selected' : '' }}>Miền Trung</option>
                            <option value="Miền Nam" {{ $province->region == 'Miền Nam' ? 'selected' : '' }}>Miền Nam</option>
                        </select>
                    </div> --}}
                    {{-- <div class="form-group">
                        <label for="status">Trạng thái</label>
                        <select name="status" class="form-control" id="status">
                            <option value="0" {{ $province->status == 0 ? 'selected' : '' }}>Hiện</option>
                            <option value="1" {{ $province->status == 1 ? 'selected' : '' }}>Ẩn</option>
                        </select>
                    </div> --}}
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


