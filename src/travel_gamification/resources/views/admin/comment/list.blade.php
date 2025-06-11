@extends('admin.index')
@section('title_name')
    Bình luận từ người dùng
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
                    <th>Bình luận</th>
                    <th>Thời gian</th>
                    <th>Người dùng</th>
                    <th>Bài viết</th>
                    <th>Trạng thái</th>
                    <th width="105px">Thao tác</th>
                </tr>
                </thead>
                
                <tbody>
                  @foreach ($reviews as $review)
            <tr>   
                <td>{{ $review->id }}</td>
                <td>{{ $review->content ?? $review->comment }}</td>
                <td>{{ $review->created_at ?? $review->time }}</td>
                <td>{{ $review->user->username ?? 'Chưa xác định' }}</td>
                <td>{{ $review->post->title ?? $review->location->name ?? 'Chưa xác định' }}</td>
                <td>
                    <div style="display: flex; align-items: center;">
                        @if($review->status == 0)
                            <span class="text-success">Hiện</span>
                        @else
                            <span class="text-danger">Ẩn</span>
                        @endif
                        <form action="{{ route('reviews.toggleStatus', $review->id) }}" method="POST" style="margin-left: 10px;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary">
                                {{ $review->status == 0 ? 'Ẩn' : 'Hiện' }}
                            </button>
                        </form>
                    </div>
                </td>
                <td>
                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button onclick = "return confirm('Bạn có thật sự muốn xóa không?')" type="submit" class="btn btn-sm btn-danger">Xóa</button>
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
