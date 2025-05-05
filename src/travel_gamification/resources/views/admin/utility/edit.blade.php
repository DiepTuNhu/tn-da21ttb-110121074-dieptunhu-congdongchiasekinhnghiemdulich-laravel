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
              <h3 class="card-title"></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="quickForm" action="{{route('utilities.update',['id'=>$utility->id])}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Id</label>
                  <input type="text" name="name" class="form-control" value="{{$utility->id}}"id="name" readonly>
                </div>
                <div class="form-group">
                  <label for="utility_type">Loại tiện ích</label>
                  <select name="id_utility_type" class="form-control" id="utility_type" required>
                      <option value="">Chọn loại tiện ích</option>
                      @foreach($typeofutilities as $utility_type)
                          <option value="{{ $utility_type->id }}" {{ $utility->utility_type_id == $utility_type->id ? 'selected' : '' }}>{{ $utility_type->name }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                    <label for="location">Địa điểm</label>
                    <select name="id_location" class="form-control" id="location">
                        <option value="">Chọn địa điểm</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}" {{ $utility->id_location == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                  <label for="name">Tên tiện ích</label>
                  <input type="text" name="name" class="form-control" id="name" value="{{$utility->name}}">
                </div>
                <div class="form-group">
                    <label for="price">Giá</label>
                    <input type="text" name="price" class="form-control" id="price" value="{{$utility->price}}" min="0">
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <input type="text" name="address" class="form-control" id="address" value="{{$utility->address}}">
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="tel" name="phone" class="form-control" id="phone" value="{{$utility->phonenumber}}" pattern="^(\+84|0)[1-9][0-9]{8}$" title="Vui lòng nhập số điện thoại hợp lệ" required>
                </div>
                {{-- <div class="form-group">
                    <label for="openingtime">Giờ mở cửa</label>
                    <input type="time" name="openingtime" class="form-control" id="openingtime" value="{{$utility->openingtime}}">
                </div>
                <div class="form-group">
                    <label for="closingtime">Giờ đóng cửa</label>
                    <input type="time" name="closingtime" class="form-control" id="closingtime" value="{{$utility->closingtime}}">
                </div> --}}
                <div class="form-group">
                    <label for="time">Giờ phục vụ</label>
                    <input type="text" name="time" class="form-control" id="time" value="{{$utility->time}}">
                </div>
                <div class="form-group">
                    <label for="rank">Xếp hạng</label>
                    <input type="number" name="rank" class="form-control" id="rank"  value="{{$utility->rank}}" min="1" max="5" step="0.1" required>
                </div>
                <div class="form-group">
                    <label for="distance">Khoảng cách (km)</label>
                    <input type="number" name="distance" class="form-control" id="distance"  value="{{$utility->distance}}" min="0" step="0.1">
                </div>
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea name="description" id="description" class="form-control">{{ old('description', $utility->description)}}</textarea>
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
  </section> 
@endsection


