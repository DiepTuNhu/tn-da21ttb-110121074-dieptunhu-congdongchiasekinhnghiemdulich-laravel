@extends('admin.index')
@section('title_name')
    Địa điểm
@endsection

@section('content')
<section class="content">
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="logTable" class="table table-striped mt-3">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên địa điểm</th>
                    <th>Địa chỉ</th>
                    {{-- <th>Mô tả</th> --}}
                    <th>Loại hình</th>
                    <th>Người đăng</th>
                    <th>Trạng thái</th>
                    <th width="130px">Thao tác</th>
                </tr>
                </thead>
                <a href = "{{route('destinations.create')}}" class="btn btn-primary mb-3">Thêm mới</a><br>
                <tbody>
                  @foreach ($destinations as $destination)
                    <tr>   
                      <td>{{$destination->id}}</td>
                      <td>{{$destination->name}}</td>
                      <td>{{$destination->address}}</td>
                      {{-- <td>{{strip_tags($destination->description) }}</td> --}}
                      <td>{{$destination->travel_types->name ?? 'Chưa xác định' }}</td>  <!-- Hiển thị tên loại hình -->
                      {{-- <td>{{$destination->provinces->name ?? 'Chưa xác định' }}</td>  <!-- Hiển thị tên thành phố --> --}}
                      <td>{{$destination->users->username ?? 'Chưa xác định' }}</td>
                      <td>
                        @if($destination->status == 0)
                          <span class="text-success">Hiện</span>
                        @elseif($destination->status == 1)
                          <span class="text-danger">Ẩn</span>
                        @else
                          <span class="text-danger">Nổi bật</span>
                        @endif
                      </td>
                      <td>
                        <a class="btn btn-info" style="margin-bottom: 5px; width: 105px" href="{{ route('destination_images.create', ['destination_id' => $destination->id]) }}">Thêm ảnh</a>
                        <a class="btn btn-success" style="margin-bottom: 5px; width: 105px" href="{{ route('destination_images.index', ['id' => $destination->id]) }}">Xem ảnh</a>
                        <a class="btn btn-primary" href="{{ route('destinations.edit', ['id' => $destination->id]) }}">Sửa</a>
                        <a onclick="return confirm('Bạn có thật sự muốn xóa không?')" class="btn btn-danger" href="{{ route('destinations.destroy', ['id' => $destination->id]) }}">Xóa</a>
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



