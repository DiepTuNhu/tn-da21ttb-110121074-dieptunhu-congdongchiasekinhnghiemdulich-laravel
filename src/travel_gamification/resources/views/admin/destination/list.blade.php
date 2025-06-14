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
                    {{-- <th>Địa chỉ</th> --}}
                    {{-- <th>Mô tả</th> --}}
                    <th>Loại hình</th>
                    <th>Người đăng</th>
                    <th>Trạng thái</th>
                    <th width="170px">Thao tác</th>
                </tr>
                </thead>
                <a href = "{{route('destinations.create')}}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Thêm mới</a><br>
                <tbody>
                  @foreach ($destinations as $destination)
                    <tr>   
                      <td>{{$destination->id}}</td>
                      <td>{{$destination->name}}</td>
                      {{-- <td>{{$destination->address}}</td> --}}
                      {{-- <td>{{strip_tags($destination->description) }}</td> --}}
                      <td>{{$destination->travel_types->name ?? 'Chưa xác định' }}</td>  <!-- Hiển thị tên loại hình -->
                      {{-- <td>{{$destination->provinces->name ?? 'Chưa xác định' }}</td>  <!-- Hiển thị tên thành phố --> --}}
                      <td>{{$destination->users->username ?? 'Chưa xác định' }}</td>
                      <td>
                        @if($destination->status == 0)
                            <span class="text-success" title="Hiện"><i class="fas fa-eye"></i></span>
                        @elseif($destination->status == 1)
                            <span class="text-danger" title="Ẩn"><i class="fas fa-eye-slash"></i></span>
                        @else
                            <span class="text-warning" title="Nổi bật"><i class="fas fa-star"></i></span>
                        @endif
                      </td>
                      <td>
                        <!-- Nút quản lý hình ảnh -->
                        <a class="btn btn-warning" title="Quản lý hình ảnh" href="{{ route('destination_images.index', ['id' => $destination->id]) }}">
                            <i class="fas fa-images"></i>
                        </a>
                        <!-- Nút xem chi tiết -->
                        <a class="btn btn-info" title="Xem chi tiết" href="{{ route('destinations.show', ['id' => $destination->id]) }}">
                            <i class="fas fa-eye"></i>
                        </a>
                        <!-- Nút sửa -->
                        <a class="btn btn-primary" title="Sửa" href="{{ route('destinations.edit', ['id' => $destination->id]) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <!-- Nút xóa -->
                        <form action="{{ route('destinations.destroy', ['id' => $destination->id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có thật sự muốn xóa không?')">
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



