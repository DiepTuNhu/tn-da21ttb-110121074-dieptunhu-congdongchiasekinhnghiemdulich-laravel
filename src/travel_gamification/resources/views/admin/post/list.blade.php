@extends('admin.index')
@section('title_name')
    Danh sách bài viết
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
                    <th>Tiêu đề</th>
                    {{-- <th>Nội dung</th> --}}
                    <th>Người dùng</th>
                    <th>Thời gian</th>
                    <th>Trạng thái</th>
                    <th width="105px">Thao tác</th>
                </tr>
                </thead>
                
                <tbody>
                  @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    {{-- <td>{{ strip_tags($post->content) }}</td> --}}
                    <td>{{ $post->user->username }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>
                        <div style="display: flex; align-items: center;">
                            @if($post->status == 0)
                                <span class="text-success" title="Hiện"><i class="fas fa-eye"></i></span>
                            @else
                                <span class="text-danger" title="Ẩn"><i class="fas fa-eye-slash"></i></span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px; align-items: center;">
                            <!-- Nút xem chi tiết -->
                            <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-info btn-sm" title="Xem chi tiết">
                                <i class="fas fa-eye"></i>
                            </a>
                            <!-- Nút Ẩn/Hiện -->
                            <form action="{{ route('admin.posts.toggleStatus', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $post->status == 0 ? 'btn-warning' : 'btn-success' }}" title="{{ $post->status == 0 ? 'Ẩn' : 'Hiện' }}">
                                    @if($post->status == 0)
                                        <i class="fas fa-eye-slash"></i>
                                    @else
                                        <i class="fas fa-eye"></i>
                                    @endif
                                </button>
                            </form>
                            <!-- Nút xóa -->
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có thật sự muốn xóa không?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Xóa">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
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
