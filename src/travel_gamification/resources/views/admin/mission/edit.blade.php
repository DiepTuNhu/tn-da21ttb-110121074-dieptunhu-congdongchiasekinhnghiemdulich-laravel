@extends('admin.index')
@section('title_name')
    Sửa nhiệm vụ
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
            <form id="quickForm" action="{{ route('missions.update', ['id' => $mission->id]) }}" method="post">
                @csrf
                {{-- @method('PUT') <!-- Sử dụng PUT để cập nhật --> --}}
                <div class="card-body">
                    <div class="form-group">
                        <label for="missionId">ID</label>
                        <input type="text" name="id" class="form-control" value="{{ $mission->id }}" id="missionId" readonly>
                    </div>
                    <div class="form-group">
                        <label for="missionName">Tên nhiệm vụ</label>
                        <input type="text" name="name" class="form-control" value="{{ $mission->name }}" id="missionName" placeholder="Nhập tên nhiệm vụ">
                    </div>
                    <div class="form-group">
                        <label for="missionDescription">Mô tả</label>
                        <textarea name="description" class="form-control" id="missionDescription" placeholder="Nhập mô tả">{{ $mission->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="pointsReward">Điểm thưởng</label>
                        <input type="number" name="points_reward" class="form-control" value="{{ $mission->points_reward }}" id="pointsReward" placeholder="Nhập điểm thưởng">
                    </div>
                    <div class="form-group">
                        <label for="conditionType">Loại điều kiện</label>
                        <select name="condition_type" class="form-control" id="conditionType">
                            <option value="">Chọn loại điều kiện</option>
                            <option value="like" {{ $mission->condition_type == 'like' ? 'selected' : '' }}>Like</option>
                            <option value="comment" {{ $mission->condition_type == 'comment' ? 'selected' : '' }}>Comment</option>
                            <option value="post" {{ $mission->condition_type == 'post' ? 'selected' : '' }}>Post</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="conditionValue">Giá trị điều kiện</label>
                        <input type="number" name="condition_value" class="form-control" value="{{ $mission->condition_value }}" id="conditionValue" placeholder="Nhập giá trị điều kiện (ví dụ: ID bài viết)">
                    </div>
                    <div class="form-group">
                        <label for="badgeId">Huy hiệu</label>
                        <select name="badge_id" class="form-control" id="badgeId">
                            <option value="">Chọn huy hiệu</option>
                            @foreach ($badges as $badge)
                                <option value="{{ $badge->id }}" {{ $mission->badge_id == $badge->id ? 'selected' : '' }}>{{ $badge->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="frequency">Tần suất</label>
                        <select name="frequency" class="form-control" id="frequency">
                            <option value="daily" {{ $mission->frequency == 'daily' ? 'selected' : '' }}>Hàng ngày</option>
                            <option value="weekly" {{ $mission->frequency == 'weekly' ? 'selected' : '' }}>Hàng tuần</option>
                            <option value="monthly" {{ $mission->frequency == 'monthly' ? 'selected' : '' }}>Hàng tháng</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Ngày bắt đầu</label>
                        <input type="datetime-local" name="start_date" class="form-control" id="start_date"
                            value="{{ $mission->start_date ? \Carbon\Carbon::parse($mission->start_date)->format('Y-m-d\TH:i') : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="end_date">Ngày kết thúc</label>
                        <input type="datetime-local" name="end_date" class="form-control" id="end_date"
                            value="{{ $mission->end_date ? \Carbon\Carbon::parse($mission->end_date)->format('Y-m-d\TH:i') : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="status">Trạng thái</label>
                        <select name="status" class="form-control" id="status">
                            <option value="0" {{ $mission->status ? 'selected' : '' }}>Hiện</option>
                            <option value="1" {{ !$mission->status ? 'selected' : '' }}>Ẩn</option>
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


