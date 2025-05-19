@extends('admin.index')
@section('title_name')
    Nhiệm vụ
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="logTable" class="table table-striped mt-3">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên nhiệm vụ</th>
                    <th>Mô tả</th>
                    {{-- <th>Điểm thưởng</th> --}}
                    <th>Loại điều kiện</th>
                    {{-- <th>Giá trị điều kiện</th> --}}
                    <th>Huy hiệu</th>
                    <th>Tần suất</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Trạng thái</th>
                    <th width="105px" class="text-center">Thao tác</th>
                </tr>
                </thead>
                <a href="{{ route('missions.create') }}" class="btn btn-primary mb-3">Thêm mới</a><br>
                <tbody>
                    @foreach ($missions as $mission)
                    <tr>
                        <td>{{ $mission->id }}</td>
                        <td>{{ $mission->name }}</td>
                        <td>{{ $mission->description }}</td>
                        {{-- <td>{{ $mission->points_reward }}</td> --}}
                        <td>{{ $mission->condition_type }}</td>
                        {{-- <td>{{ $mission->condition_value }}</td> --}}
                        <td>{{ $mission->badge ? $mission->badge->name : 'Không có' }}</td>
                        <td>{{ $mission->frequency }}</td>
                        <td>{{ $mission->start_date }}</td>
                        <td>{{ $mission->end_date }}</td>
                        <td>{{ $mission->status ? 'Ẩn' : 'Hiện' }}</td>
                        <td class="text-center">
                            <a class="btn btn-primary" href="{{ route('missions.edit', ['id' => $mission->id]) }}">Sửa</a>
                            <a onclick="return confirm('Bạn có thật sự muốn xóa không?')" class="btn btn-danger" href="{{ route('missions.destroy', ['id' => $mission->id]) }}">Xóa</a>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
@endsection



