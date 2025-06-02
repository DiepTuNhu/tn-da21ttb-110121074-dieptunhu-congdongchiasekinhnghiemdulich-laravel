@extends('admin.index')
@section('title_name')
    Sửa phần thưởng
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
            <form id="quickForm" action="{{ route('rewards.update', ['id' => $reward->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- @method('PUT') --}}
                <div class="card-body">
                    <div class="form-group">
                        <label for="rewardId">ID</label>
                        <input type="text" name="id" class="form-control" value="{{ $reward->id }}" id="rewardId" readonly>
                    </div>
                    <div class="form-group">
                        <label for="rewardName">Tên phần thưởng</label>
                        <input type="text" name="name" class="form-control" value="{{ $reward->name }}" id="rewardName">
                    </div>
                    <div class="form-group">
                        <label for="rewardDescription">Mô tả</label>
                        <textarea name="description" class="form-control" id="rewardDescription">{{ $reward->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="costPoints">Điểm cần đổi</label>
                        <input type="number" name="cost_points" class="form-control" id="costPoints" min="0" value="{{ $reward->cost_points }}">
                    </div>
                    <div class="form-group">
                        <label for="type">Loại quà</label>
                        <select name="type" class="form-control" id="type">
                            <option value="virtual" {{ $reward->type == 'virtual' ? 'selected' : '' }}>Ảo</option>
                            <option value="physical" {{ $reward->type == 'physical' ? 'selected' : '' }}>Hiện vật</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="stock">Số lượng tồn kho</label>
                        <input type="number" name="stock" class="form-control" id="stock" min="0" value="{{ $reward->stock }}">
                    </div>
                    <div class="form-group">
                        <label for="image" class="form-label">Chọn ảnh</label>
                        <div class="custom-file">
                              <input type="file" class="custom-file-input" id="image" name="image" accept="image/*" onchange="previewImage(1)">
                            <label class="custom-file-label" for="image">Chọn tệp...</label>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="currentImage">Ảnh hiện tại:</label>
                        @if($reward->image)
                        <div id="currentImage" style="margin-top: 10px;">
                            <img src="{{ asset('storage/rewards/' . $reward->image) }}" alt="Ảnh hiện tại" width="150">
                        </div>
                        @else
                            <p>Không có ảnh hiện tại.</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="imagePreview1">Ảnh xem trước:</label>
                        <div id="imagePreview1" style="margin-top: 10px;"></div>
                    </div>
                    <div class="form-group">
                        <label for="active">Trạng thái</label>
                        <select name="active" class="form-control" id="active">
                            <option value="1" {{ $reward->active == 1 ? 'selected' : '' }}>Hiện</option>
                            <option value="0" {{ $reward->active == 0 ? 'selected' : '' }}>Ẩn</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Sửa</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section> 
@endsection


