@extends('admin.index')
@section('title_name')
    Thêm phần thưởng
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
               @include('admin.alert')
            </div>
            <form id="quickForm" action="{{route('rewards.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="rewardName">Tên phần thưởng</label>
                    <input type="text" name="name" class="form-control" id="rewardName" placeholder="Nhập tên phần thưởng">
                  </div>
                  <div class="form-group">
                    <label for="rewardDescription">Mô tả</label>
                    <textarea name="description" class="form-control" id="rewardDescription" placeholder="Nhập mô tả"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="costPoints">Điểm cần đổi</label>
                    <input type="number" name="cost_points" class="form-control" id="costPoints" min="0" placeholder="Nhập số điểm">
                  </div>
                  <div class="form-group">
                    <label for="type">Loại quà</label>
                    <select name="type" class="form-control" id="type">
                        <option value="virtual">Ảo</option>
                        <option value="physical">Hiện vật</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="stock">Số lượng tồn kho</label>
                    <input type="number" name="stock" class="form-control" id="stock" min="0" value="0">
                  </div>
                  <div class="form-group">
                    <label for="image" class="form-label">Chọn ảnh</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="image" name="image" accept="image/*" onchange="previewImage(1)">
                      <label class="custom-file-label" for="image">Chọn tệp...</label>
                    </div>
                  </div>
                  <div class="form-group">
                      <label for="imagePreview1">Ảnh xem trước:</label>
                      <div id="imagePreview1" style="margin-top: 10px;"></div>
                  </div>
                  <div class="form-group">
                    <label for="active">Trạng thái</label>
                    <select name="active" class="form-control" id="active">
                        <option value="1">Hiện</option>
                        <option value="0">Ẩn</option>
                    </select>
                  </div>
                </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Thêm</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section> 
@endsection


