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
                    {{-- <th>Mô tả</th> --}}
                    {{-- <th>Biểu tượng</th> --}}
                    <th>Trạng thái</th>
                    <th width="130px" class="text-center">Thao tác</th>
                </tr>
                </thead>
                <a href="{{ route('badges.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Thêm mới</a><br>
                <tbody>
                    @foreach ($badges as $badge)
                    <tr>   
                        <td>{{ $badge->id }}</td>
                        <td>{{ $badge->name }}</td>
                        {{-- <td>{{ $badge->description }}</td> --}}
                        {{-- <td>
                          @if ($badge->icon_url)
                          <img src="{{ $badge->icon_url }}" alt="{{ $badge->name }}" width="50" height="50">
                      @else
                          Không có hình
                      @endif
                        </td> --}}
                        <td>
                          @if($badge->status == 0)
                              <span class="text-success" title="Hiện"><i class="fas fa-eye"></i></span>
                          @else
                              <span class="text-danger" title="Ẩn"><i class="fas fa-eye-slash"></i></span>
                          @endif
                        </td>
                        {{-- <td>{{ $badge->region }}</td> --}}
                        <td class="text-center">
                            <!-- Nút xem chi tiết -->
                            <a class="btn btn-info" title="Xem chi tiết" href="{{ route('badges.show', ['id' => $badge->id]) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <!-- Nút sửa -->
                            <a class="btn btn-primary" title="Sửa" href="{{ route('badges.edit', ['id' => $badge->id]) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <!-- Nút xóa -->
                            <form action="{{ route('badges.destroy', ['id' => $badge->id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có thật sự muốn xóa không?')">
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



