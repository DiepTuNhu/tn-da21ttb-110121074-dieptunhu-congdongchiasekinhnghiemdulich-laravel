@extends('admin.index')
@section('title_name')
    Huy hiệu
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
                    <th>Tên huy hiệu</th>
                    <th>Mô tả</th>
                    <th>Biểu tượng</th>
                    <th>Trạng thái</th>
                    <th width="105px" class="text-center">Thao tác</th>
                </tr>
                </thead>
                <a href="{{ route('badges.create') }}" class="btn btn-primary mb-3">Thêm mới</a><br>
                <tbody>
                    @foreach ($badges as $badge)
                    <tr>   
                        <td>{{ $badge->id }}</td>
                        <td>{{ $badge->name }}</td>
                        <td>{{ $badge->description }}</td>
                        <td>
                          @if ($badge->icon_url)
                          <img src="{{ $badge->icon_url }}" alt="{{ $badge->name }}" width="50" height="50">
                      @else
                          Không có hình
                      @endif
                        </td>
                        <td>
                          @if($badge->status == 0)
                              <span class="text-success">Hiện</span>
                          @else
                              <span class="text-danger">Ẩn</span>
                          @endif
                        </td>
                        {{-- <td>{{ $badge->region }}</td> --}}
                        <td class="text-center">
                            <a class="btn btn-primary" href="{{ route('badges.edit', ['id' => $badge->id]) }}">Sửa</a>
                            <a onclick="return confirm('Bạn có thật sự muốn xóa không?')" class="btn btn-danger" href="{{ route('badges.destroy', ['id' => $badge->id]) }}">Xóa</a>
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



