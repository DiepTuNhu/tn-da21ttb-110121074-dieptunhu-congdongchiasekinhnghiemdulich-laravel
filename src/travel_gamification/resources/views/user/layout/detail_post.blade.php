@extends('user.master')
@section('content')
<div class="container-dtp">
  <div class="main">
    <h1>{{ $post->title }}</h1>
    <div class="meta user-meta">
      <img class="author-avatar" src="{{ $post->user && $post->user->avatar ? asset('storage/avatars/' . $post->user->avatar) : asset('storage/default.jpg') }}" alt="avatar" />
      <div class="user-info">
        <span class="author-name">{{ $post->user->username ?? 'Ẩn danh' }}</span>
        <span class="meta-details">
          {{-- <i class="fas fa-calendar-alt"></i> 12/04/2025 <i class="fas fa-chart-bar"></i> 1234
          lượt xem <i class="fas fa-heart"></i> 256 lượt thích --}}
          <span class="badge">Địa điểm</span>
          <i class="fas fa-calendar-alt"></i> {{ $post->updated_at->format('d/m/Y') }} <i class="fas fa-heart"></i> {{ $post->likes->count() }} lượt thích
          {{-- Nếu có lượt xem, lượt thích thì hiển thị ở đây --}}
        </span>
      </div>
    </div>

    <p>
      {!! $post->content !!}
    </p>

    {{-- @if($post->destination && $post->destination->destinationImages && $post->destination->destinationImages->isNotEmpty())
      <img src="{{ $post->destination->destinationImages->first()->image_url }}" alt="ảnh minh họa" />
    @endif --}}

    <p>Bạn có thể xem bản đồ bên dưới để biết thêm chi tiết:</p>
    @php
      $googleMapsApiKey = env('GOOGLE_MAPS_API_KEY');
      $mapUrl = "https://www.google.com/maps/embed/v1/place?key={$googleMapsApiKey}&q=" . urlencode(($post->destination->name ?? '') . ', ' . ($post->destination->address ?? ''));
    @endphp
    <iframe src="{{ $mapUrl }}" allowfullscreen="" loading="lazy"></iframe>

    <div class="post-interact">
      <div class="post-actions">
        <button class="btn like" id="like-btn" data-post="{{ $post->id }}">
            <i class="fas fa-heart"></i> Thích
            <span id="like-count">{{ $post->likes->count() }}</span>
        </button>
        <button class="btn save"><i class="fas fa-bookmark"></i> Lưu bài viết</button>
        <button class="btn report"><i class="fas fa-flag"></i> Báo cáo</button>
      </div>

      <div class="post-badges">
        <span><i class="fas fa-star"></i> 120 XP</span>
        <span><i class="fas fa-medal"></i> Top 10 bài viết tuần</span>
      </div>
    </div>

      <!-- Bình luận -->
    <div class="comment-section">
      <h3>Bình luận</h3>

      <form class="comment-form" id="comment-form">
        <textarea rows="3" name="content" placeholder="Viết bình luận..." required></textarea>
        <input type="hidden" name="parent_comment_id" value="">
        <button type="submit">Gửi bình luận</button>
      </form>
      <div id="comment-list">
        @foreach($comments as $comment)
            @if(!$comment->parent_comment_id)
            <div class="comment">
                <img src="{{ $comment->user && $comment->user->avatar ? asset('storage/avatars/' . $comment->user->avatar) : asset('storage/default.jpg') }}" alt="avatar" />
                <div class="comment-body">
                    <strong>{{ $comment->user->username ?? 'Ẩn danh' }}</strong>
                    <div>{{ $comment->content }}</div>
                    <div class="comment-actions">
                        <span class="comment-time">{{ $comment->created_at->format('d/m/Y H:i') }}</span>
                        <a href="#" class="reply-btn action-btn" data-id="{{ $comment->id }}"><i class="fas fa-reply"></i> Trả lời</a>
                        <a href="#" class="report-comment action-btn report" data-id="{{ $comment->id }}"><i class="fas fa-flag"></i> Báo cáo</a>
                        <a href="#" class="like-comment-btn action-btn like" data-id="{{ $comment->id }}">
                            <i class="fas fa-heart"></i> Thích
                            <span id="comment-like-count-{{ $comment->id }}" class="like-count">{{ $comment->likes->count() }}</span>
                        </a>
                    </div>
                </div>
            </div>
            {{-- Hiển thị các reply --}}
            @foreach($comments as $reply)
                @if($reply->parent_comment_id == $comment->id)
                <div class="comment reply">
                    <img src="{{ $reply->user && $reply->user->avatar ? asset('storage/avatars/' . $reply->user->avatar) : asset('storage/default.jpg') }}" alt="avatar" />
                    <div class="comment-body">
                        <strong>{{ $reply->user->username ?? 'Ẩn danh' }}</strong>
                        <div>{{ $reply->content }}</div>
                        <div class="comment-actions">
                            <span class="comment-time">{{ $reply->created_at->format('d/m/Y H:i') }}</span>
                            <a href="#" class="reply-btn action-btn" data-id="{{ $reply->id }}"><i class="fas fa-reply"></i> Trả lời</a>
                            <a href="#" class="report-comment action-btn report" data-id="{{ $reply->id }}"><i class="fas fa-flag"></i> Báo cáo</a>
                            <a href="#" class="like-comment-btn action-btn like" data-id="{{ $reply->id }}">
                                <i class="fas fa-heart"></i> Thích
                                <span id="comment-like-count-{{ $reply->id }}" class="like-count">{{ $reply->likes->count() }}</span>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
            @endif
        @endforeach
    </div>
    {{-- Hiển thị phân trang --}}
    <div class="pagination" style="display: flex; justify-content: center; margin-top: 24px; margin-bottom: 16px;">
        {{ $comments->links() }}
    </div>
    </div>
  </div>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="author-box">
      <p>
        <img src="{{ $post->user && $post->user->avatar ? asset('storage/avatars/' . $post->user->avatar) : asset('default-avatar.png') }}" alt="" />
        <strong>{{ $post->user->username ?? 'Ẩn danh' }}</strong>
      </p>
      <a href="{{ route('detail_user_follow', ['id' => $post->user->id]) }}">Xem hồ sơ</a>
    </div>

    <div class="related-box">
      <strong>Bài viết liên quan</strong>
      @forelse($relatedPosts as $related)
        <a href="{{ route('post.detail', $related->id) }}">{{ $related->title }}</a>
      @empty
        <div>Không có bài viết liên quan</div>
      @endforelse
    </div>
  </div>
  </div>

  <script>
document.getElementById('like-btn').onclick = function() {
    fetch('{{ route('posts.like', $post->id) }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            document.getElementById('like-count').innerText = data.like_count;
        } else if(data.error) {
            alert(data.error);
        } else if(data.message) {
            alert(data.message);
        }
    });
};

document.getElementById('comment-form').onsubmit = function(e) {
    e.preventDefault();
    fetch('{{ route('posts.comment', $post->id) }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            content: this.content.value,
            parent_comment_id: this.parent_comment_id.value
        })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            let html = `<div class="comment">
                <img src="${data.avatar}" alt="avatar" />
                <div class="comment-body">
                    <strong>${data.username}</strong>
                    ${data.content}
                    <div class="comment-actions">${data.created_at}</div>
                </div>
            </div>`;
            const commentList = document.getElementById('comment-list');
            commentList.insertAdjacentHTML('afterbegin', html);

            // Nếu số bình luận > 5 thì xóa bình luận cuối cùng
            if (commentList.children.length > 5) {
                commentList.removeChild(commentList.lastElementChild);
            }
            this.reset();
        } else if(data.error) {
            alert(data.error);
        }
    });
};

document.querySelectorAll('.reply-btn').forEach(btn => {
    btn.onclick = function(e) {
        e.preventDefault();
        const parentId = this.getAttribute('data-id');
        document.querySelector('#comment-form [name=parent_comment_id]').value = parentId;
        document.querySelector('#comment-form textarea').focus();
    }
});

document.querySelectorAll('.report-comment').forEach(btn => {
    btn.onclick = function(e) {
        e.preventDefault();
        const commentId = this.getAttribute('data-id');
        if(confirm('Bạn có chắc muốn báo cáo bình luận này không?')) {
            // Gửi AJAX hoặc chuyển hướng đến route báo cáo
            alert('Đã gửi báo cáo cho quản trị viên!');
        }
    }
});

document.querySelectorAll('.like-comment-btn').forEach(btn => {
    btn.onclick = function(e) {
        e.preventDefault();
        const commentId = this.getAttribute('data-id');
        fetch('{{ url("comments/like") }}/' + commentId, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                document.getElementById('comment-like-count-' + commentId).innerText = data.like_count;
            } else if(data.error) {
                alert(data.error);
            }
        });
    }
});
  </script>
@endsection