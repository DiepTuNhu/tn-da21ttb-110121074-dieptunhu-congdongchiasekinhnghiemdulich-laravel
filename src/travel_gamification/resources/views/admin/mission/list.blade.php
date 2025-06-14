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
                    {{-- <th>Mô tả</th> --}}
                    {{-- <th>Điểm thưởng</th> --}}
                    <th>Loại điều kiện</th>
                    {{-- <th>Giá trị điều kiện</th> --}}
                    <th>Huy hiệu</th>
                    <th>Tần suất</th>
                    {{-- <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th> --}}
                    <th>Trạng thái</th>
                    <th width="130px" class="text-center">Thao tác</th>
                </tr>
                </thead>
                <a href="{{ route('missions.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Thêm mới</a><br>
                <tbody>
                    @foreach ($missions as $mission)
                    <tr>
                        <td>{{ $mission->id }}</td>
                        <td>{{ $mission->name }}</td>
                        {{-- <td>{{ $mission->description }}</td> --}}
                        {{-- <td>{{ $mission->points_reward }}</td> --}}
                        <td>{{ $mission->condition_type }}</td>
                        {{-- <td>{{ $mission->condition_value }}</td> --}}
                        <td>{{ $mission->badge ? $mission->badge->name : 'Không có' }}</td>
                        <td>{{ $mission->frequency }}</td>
                        {{-- <td>{{ $mission->start_date }}</td>
                        <td>{{ $mission->end_date }}</td> --}}
                        <td>
                            @if($mission->status)
                                <span class="text-danger" title="Ẩn"><i class="fas fa-eye-slash"></i></span>
                            @else
                                <span class="text-success" title="Hiện"><i class="fas fa-eye"></i></span>
                            @endif
                        </td>
                        <td class="text-center">
                            <!-- Nút xem chi tiết -->
                            <a class="btn btn-info" title="Xem chi tiết" href="{{ route('missions.show', ['id' => $mission->id]) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <!-- Nút sửa -->
                            <a class="btn btn-primary" title="Sửa" href="{{ route('missions.edit', ['id' => $mission->id]) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <!-- Nút xóa -->
                            <form action="{{ route('missions.destroy', ['id' => $mission->id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có thật sự muốn xóa không?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit" title="Xóa">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
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



