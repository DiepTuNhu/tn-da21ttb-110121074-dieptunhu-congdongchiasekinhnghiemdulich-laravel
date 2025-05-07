@extends('admin.index')
@section('title_name')
  Hình ảnh
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Hình ảnh</th>
                    <th>Đường dẫn</th>
                    <th>Tiêu đề</th>
                    <th>Địa điểm</th>
                    <th>Trạng thái</th>
                    <th width="105px">Thao tác</th>
                </tr>
                </thead>
                {{-- <a href = "{{route('photos.create')}}" class="btn btn-primary mb-3">Thêm mới</a><br> --}}
                <tbody>
                  @foreach ($photos as $photo)
                  <tr>   
                      <td>{{$photo->id}}</td>
                      <td>
                        @if($photo->name) <!-- Kiểm tra xem có tên ảnh trong cột name không -->
                            <img src="{{ asset('storage/location_image/' . $photo->name) }}" alt="Ảnh của {{$photo->name}}" width="100">
                        @else
                            <span>Chưa có ảnh</span>
                        @endif
                      </td>       
                      <td>{{$photo->url}}</td>  <!-- Chắc chắn rằng bạn đang lấy đúng trường url -->
                      <td>{{ $photo->caption }}</td>  <!-- Đảm bảo caption được gọi đúng -->
                      <td>{{$photo->location->name ?? 'Chưa xác định' }}</td>  <!-- Sửa 'Locations' thành 'location' -->
                      <td>
                          @if($photo->status == 2)  <!-- Sửa $location thành $photo -->
                              <span class="text-success">Chính</span>
                          @elseif($photo->status == 0)
                              <span class="text-success">Phụ</span>
                          @elseif($photo->status == 1)
                              <span class="text-danger">Ẩn</span>
                          @endif
                      </td>
                      <td>
                          <a class="btn btn-primary" href="{{ route('photos.edit', ['id' => $photo->id]) }}">Sửa</a>
                          <a onclick="return confirm('Bạn có thật sự muốn xóa không?')" class="btn btn-danger" href="{{ route('photos.destroy', ['id' => $photo->id]) }}">Xóa</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                    <th>Hình ảnh</th>
                    <th>URL</th>
                    <th>Caption</th>
                    <th>Địa điểm</th>
                    <th>Trạng thái</th>
                    <th width="105px">Thao tác</th>          
                </tr>
                </tfoot>
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



