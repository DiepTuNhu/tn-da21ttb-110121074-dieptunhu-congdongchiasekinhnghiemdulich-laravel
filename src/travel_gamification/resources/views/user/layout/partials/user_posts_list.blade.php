<div class="posts" id="user-posts">
  @if($posts->count())
    <!-- Các post của người dùng -->
    @foreach ($posts as $post)
      <a href="{{ route('post.detail', $post->id) }}" style="text-decoration:none; color:inherit;">

        <div class="post-card user-post">
          @php
              // Lấy ảnh đầu tiên trong content (nếu có)
              $firstImage = null;
              if ($post->content) {
                  preg_match('/<img[^>]+src="([^">]+)"/i', $post->content, $matches);
                  $firstImage = $matches[1] ?? null;
              }
          @endphp

          @if ($firstImage)
              <img src="{{ $firstImage }}" alt="{{ $post->title }}" />
          @elseif ($post->destination && $post->destination->destinationImages && $post->destination->destinationImages->isNotEmpty())
              <img src="{{ $post->destination->destinationImages->first()->image_url }}" alt="{{ $post->destination->name }}" />
          @else
              <img src="canh.png" alt="Default Image" />
          @endif

          <h4 style="text-align: center">{{ $post->title }}</h4>

          <p class="post-excerpt" style="text-align: justify">
            {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}
          </p>

          <div class="post-meta">
            <div class="meta-left">
              <i class="fas fa-user"></i> {{ $post->user->username ?? 'Ẩn danh' }}
            </div>
            <div class="meta-right">
              <i class="fas fa-calendar-alt"></i>
              @if ($post->updated_at->diffInHours() < 24)
                {{ $post->updated_at->diffForHumans() }}
              @else
                {{ $post->updated_at->format('d/m/Y') }}
              @endif
            </div>

          </div>

          <div class="post-stats">
            <div class="likes"><i class="fas fa-heart"></i> {{ $post->likes->count() }} lượt thích</div>
            <div class="comments"><i class="fas fa-comment-alt"></i> {{ $post->comments->count() }} bình luận</div>
            {{-- <div class="comments"><i class="fas fa-comment-alt"></i> {{ $post->comments->where('parent_comment_id', null)->count() }} bình luận</div> --}}
          
          </div>
        </div>
      </a>
    @endforeach
  @else
      <div class="alert alert-warning" style="margin-top: 30px;">
          Không tìm thấy bài chia sẻ phù hợp.
      </div>
  @endif
  </div>  