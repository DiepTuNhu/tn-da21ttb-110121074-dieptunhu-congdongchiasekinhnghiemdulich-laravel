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
              <table id="logTable" class="table table-striped mt-3">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Hình ảnh</th>
                    <th>Đường dẫn</th>
                    <th>Địa điểm</th>
                    <th>Trạng thái</th>
                    <th width="105px">Thao tác</th>
                </tr>
                </thead>
                <a href="{{ route('destination_images.create', ['destination_id' => request('id')]) }}" class="btn btn-primary mb-3">
                  <i class="fas fa-plus"></i> Thêm mới
                </a>
                <br>
                <tbody>
                  @foreach ($destination_images as $destination_image)
                  <tr>   
                      <td>{{$destination_image->id}}</td>
                      <td>
                        @if($destination_image->name) <!-- Kiểm tra xem có tên ảnh trong cột name không -->
                            <img src="{{ asset('storage/destination_image/' . $destination_image->name) }}" alt="Ảnh của {{$destination_image->name}}" width="100">
                        @else
                            <span>Chưa có ảnh</span>
                        @endif
                      </td>       
                      <td>{{$destination_image->image_url}}</td> 
                      <td>{{$destination_image->destination->name ?? 'Chưa xác định' }}</td>  <!-- Sửa 'destinations' thành 'destination' -->
                      <td>
                          @if($destination_image->status == 2)  <!-- Sửa $destination thành $destination_image -->
                              <span class="text-success">Chính</span>
                          @elseif($destination_image->status == 0)
                              <span class="text-success">Phụ</span>
                          @elseif($destination_image->status == 1)
                              <span class="text-danger">Ẩn</span>
                          @endif
                      </td>
                      <td>
                          <a class="btn btn-primary" title="Sửa" href="{{ route('destination_images.edit', ['id' => $destination_image->id]) }}">
                              <i class="fas fa-edit"></i>
                          </a>
                          <form action="{{ route('destination_images.destroy', ['id' => $destination_image->id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có thật sự muốn xóa không?')">
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



