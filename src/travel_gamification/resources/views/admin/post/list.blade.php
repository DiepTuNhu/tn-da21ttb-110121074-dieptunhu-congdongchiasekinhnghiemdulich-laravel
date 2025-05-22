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
                    <th>Nội dung</th>
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
                    <td>{{ strip_tags($post->content) }}</td>
                    <td>{{ $post->user->username }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>
                        <div style="display: flex; align-items: center;">
                            @if($post->status == 0)
                                <span class="text-success">Hiện</span>
                            @else
                                <span class="text-danger">Ẩn</span>
                            @endif
                            
                        </div>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px; align-items: center;">
                            <form action="{{ route('admin.posts.toggleStatus', $post->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $post->status == 0 ? 'btn-warning' : 'btn-success' }}">
                                    {{ $post->status == 0 ? 'Ẩn' : 'Hiện' }}
                                </button>
                            </form>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Bạn có thật sự muốn xóa không?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
                </tbody>
              </table>
              <div class="d-flex justify-content-center mt-3">
                {{ $posts->links() }}
              </div>
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
