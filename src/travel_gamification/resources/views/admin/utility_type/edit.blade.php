@extends('admin.index')
@section('title_name')
    Sửa loại tiện ích
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
            <form id="quickForm" action="{{route('utility_types.update',['id'=>$utility_type->id])}}" method = "post">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Id</label>
                  <input type="text" name="utility_typeName" class="form-control" value="{{$utility_type->id}}"id="utility_typeName" readonly>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Tên loại tiện ích</label>
                  <input type="text" name="utility_typeName" class="form-control" value="{{$utility_type->name}}"id="utility_typeName">
                </div>
                <div class="form-group">
                  <label for="status">Trạng thái</label>
                  <select name="status" class="form-control" id="status">
                      <option value="0" {{ $utility_type->status == 0 ? 'selected' : '' }}>Hiện</option>
                      <option value="1" {{ $utility_type->status == 1 ? 'selected' : '' }}>Ẩn</option>
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
        <div class="col-md-6">

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section> 
@endsection


