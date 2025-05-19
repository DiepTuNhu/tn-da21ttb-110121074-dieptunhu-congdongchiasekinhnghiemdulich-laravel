@extends('admin.index')
@section('title_name')
    Thêm nhiệm vụ
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
            <form id="quickForm" action="{{ route('missions.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="missionName">Tên nhiệm vụ</label>
                        <input type="text" name="name" class="form-control" id="missionName" placeholder="Nhập tên nhiệm vụ">
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="missionDescription">Mô tả</label>
                        <textarea name="description" class="form-control" id="missionDescription" placeholder="Nhập mô tả"></textarea>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="pointsReward">Điểm thưởng</label>
                        <input type="number" name="points_reward" class="form-control" id="pointsReward" placeholder="Nhập điểm thưởng">
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="conditionType">Loại điều kiện</label>
                        <select name="condition_type" class="form-control" id="conditionType">
                            <option value="">Chọn loại điều kiện</option>
                            <option value="like">Like</option>
                            <option value="comment">Comment</option>
                            <option value="post">Post</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="conditionValue">Giá trị điều kiện</label>
                        <input type="number" name="condition_value" class="form-control" id="conditionValue" placeholder="Nhập giá trị điều kiện (ví dụ: ID bài viết)">
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="badgeId">Huy hiệu</label>
                        <select name="badge_id" class="form-control" id="badgeId">
                            <option value="">Chọn huy hiệu</option>
                            @foreach ($badges as $badge)
                                <option value="{{ $badge->id }}">{{ $badge->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="frequency">Tần suất</label>
                        <select name="frequency" class="form-control" id="frequency">
                            <option value="daily">Hàng ngày</option>
                            <option value="weekly">Hàng tuần</option>
                            <option value="monthly">Hàng tháng</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="start_date">Ngày bắt đầu</label>
                        <input type="datetime-local" name="start_date" class="form-control" id="start_date">
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="end_date">Ngày kết thúc</label>
                        <input type="datetime-local" name="end_date" class="form-control" id="end_date">
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="status">Trạng thái</label>
                        <select name="status" class="form-control" id="status">
                            <option value="0">Hiện</option>
                            <option value="1">Ẩn</option>
                        </select>
                    </div>
                </div>
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


