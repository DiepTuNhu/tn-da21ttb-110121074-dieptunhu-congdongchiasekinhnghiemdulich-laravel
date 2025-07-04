@extends('user.master')
@section('content')
<style>
    img.centered {
text-align: center
}
    .post-content {
        text-align: justify;
    }
</style>
<div class="container-dtp">
  <div class="main">
    <h1>{{ $post->title }}</h1>
    <div class="meta user-meta" style="display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; align-items: center;">
    @if($post->user && $post->user->avatar)
        @if(Str::startsWith($post->user->avatar, ['http://', 'https://']))
            <img class="author-avatar" src="{{ $post->user->avatar }}" alt="avatar" />
        @else
            <img class="author-avatar" src="{{ asset('storage/avatars/' . $post->user->avatar) }}" alt="avatar" />
        @endif
    @else
        <img class="author-avatar" src="{{ asset('storage/default.jpg') }}" alt="avatar" />
    @endif
    <div class="user-info" style="margin-left: 12px;">
        <span class="author-name">{{ $post->user->username ?? 'Ẩn danh' }}</span>
            @php
                $isCurrentUser = Auth::check() && Auth::id() === $post->user->id;
            @endphp      
@if($isCurrentUser)
    <a href="{{ route('page.profile') }}" class="profile-button">Xem hồ sơ</a>
@else
    <a href="{{ route('detail_user_follow', ['id' => $post->user->id]) }}" class="profile-button">Xem hồ sơ</a>
@endif

        <span class="meta-details">
            <span class="badge">Địa điểm</span>
            <i class="fas fa-calendar-alt"></i> {{ $post->updated_at->format('d/m/Y') }}
            <i class="fas fa-heart"></i> {{ $post->likes->count() }} lượt thích
        </span>
    </div>
</div>
@auth
    @if(Auth::id() === $post->user_id)
        <div style="display: flex; gap: 10px; align-items: center;">
            <a href="{{ route('post.edit', $post->id) }}" class="btn edit edit-post-btn" style="background: #f6c177; color: #fff; border: none; border-radius: 6px; padding: 7px 18px; font-weight: 600;">
                <i class="fas fa-pen"></i> Sửa bài viết
            </a>
            <form action="{{ route('post.delete', $post->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc muốn xóa bài viết này không?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" style="background: #e74c3c; color: #fff; border: none; border-radius: 6px; padding: 7px 18px; font-weight: 600;">
                    <i class="fas fa-trash"></i> Xóa bài viết
                </button>
            </form>
        </div>
    @endif
@endauth
    </div>
        <p>Bạn có thể xem bản đồ bên dưới để biết thêm chi tiết:</p>
    {{-- @php
      $googleMapsApiKey = env('GOOGLE_MAPS_API_KEY');
      $mapUrl = "https://www.google.com/maps/embed/v1/place?key={$googleMapsApiKey}&q=" . urlencode(($post->destination->name ?? '') . ', ' . ($post->destination->address ?? ''));
    @endphp
    <iframe src="{{ $mapUrl }}" allowfullscreen="" loading="lazy"></iframe> --}}
@php
    $googleMapsApiKey = env('GOOGLE_MAPS_API_KEY');
    if ($post->post_type == 'destination') {
        $placeName = $post->destination->name ?? '';
        $placeAddress = $post->destination->address ?? '';
    } elseif ($post->post_type == 'utility') {
        // Lấy tên tiện ích từ quan hệ utility
        $placeName = $post->utility->name ?? '';
        $placeAddress = $post->utility->address ?? '';
    } else {
        $placeName = '';
        $placeAddress = '';
    }
    $mapUrl = "https://www.google.com/maps/embed/v1/place?key={$googleMapsApiKey}&q=" . urlencode($placeName . ', ' . $placeAddress);
@endphp
<iframe src="{{ $mapUrl }}" allowfullscreen="" loading="lazy"></iframe>

<div>
    @if($post->post_type == 'destination')
        {{-- Bài viết về địa điểm --}}
        @if(!empty($post->price))
            <div class="post-extra">
                <strong>Giá:</strong> {{ $post->price }}
            </div>
        @endif
    @elseif($post->post_type == 'utility')
        {{-- Bài viết về tiện ích --}}
        <div class="post-extra">
            @if(!empty($post->price))
                <div><strong>Giá:</strong> {{ $post->price }}</div>
            @endif
            @if(!empty($post->opening_hours))
                <div><strong>Giờ phục vụ:</strong> {{ $post->opening_hours }}</div>
            @endif
            @if(!empty($post->phone))
                <div><strong>Số điện thoại:</strong> {{ $post->phone }}</div>
            @endif
        </div>
    @endif
</div>
    <div class="post-content">
      {!! $post->content !!}
    </div>

    {{-- @if($post->destination && $post->destination->destinationImages && $post->destination->destinationImages->isNotEmpty())
      <img src="{{ $post->destination->destinationImages->first()->image_url }}" alt="ảnh minh họa" />
    @endif --}}


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
            <div class="comment" data-id="{{ $comment->id }}">
                <img 
                    src="@if($comment->user && $comment->user->avatar)
                            @if(Str::startsWith($comment->user->avatar, ['http://', 'https://']))
                                {{ $comment->user->avatar }}
                            @else
                                {{ asset('storage/avatars/' . $comment->user->avatar) }}
                            @endif
                        @else
                            {{ asset('storage/default.jpg') }}
                        @endif"
                    alt="avatar" />                
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
                        @auth
                            @if(Auth::id() === $comment->user_id)
                                <div class="comment-menu-wrapper">
                                    <button class="comment-menu-btn" style="background: none; border: none; cursor: pointer;">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="comment-menu" style="display: none; position: absolute; right: 0; top: 100%; background: #fff; border: 1px solid #ccc; border-radius: 4px; min-width: 100px; z-index: 10;">
                                        <a href="#" class="edit-comment-btn action-btn" data-id="{{ $comment->id }}" data-content="{{ e($comment->content) }}" style="display: block; padding: 8px 12px;"><i class="fas fa-edit"></i> Sửa</a>
                                        <a href="#" class="delete-comment-btn action-btn" data-id="{{ $comment->id }}" style="display: block; padding: 8px 12px;"><i class="fas fa-trash"></i> Xóa</a>
                                    </div>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
            {{-- Hiển thị các reply --}}
            @foreach($comments as $reply)
                @if($reply->parent_comment_id == $comment->id)
                <div class="comment reply">
                    <img 
                        src="@if($reply->user && $reply->user->avatar)
                            @if(Str::startsWith($reply->user->avatar, ['http://', 'https://']))
                                {{ $reply->user->avatar }}
                            @else
                                {{ asset('storage/avatars/' . $reply->user->avatar) }}
                            @endif
                        @else
                            {{ asset('storage/default.jpg') }}
                        @endif"
                        alt="avatar" />                     
                    <div class="comment-body">
                        <strong>{{ $reply->user->username ?? 'Ẩn danh' }}</strong>
                        <div>{{ $reply->content }}</div>
                        <div class="comment-actions">
                            <span class="comment-time">{{ $reply->created_at->format('d/m/Y H:i') }}</span>
                            {{-- <a href="#" class="reply-btn action-btn" data-id="{{ $reply->id }}"><i class="fas fa-reply"></i> Trả lời</a> --}}
                            <a href="#" class="report-comment action-btn report" data-id="{{ $reply->id }}"><i class="fas fa-flag"></i> Báo cáo</a>
                            <a href="#" class="like-comment-btn action-btn like" data-id="{{ $reply->id }}">
                                <i class="fas fa-heart"></i> Thích
                                <span id="comment-like-count-{{ $reply->id }}" class="like-count">{{ $reply->likes->count() }}</span>
                            </a>
                            @auth
                                @if(Auth::id() === $reply->user_id)
                                    <div class="comment-menu-wrapper" >
                                        <button class="comment-menu-btn" style="background: none; border: none; cursor: pointer;">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="comment-menu" style="display: none; position: absolute; right: 0; top: 100%; background: #fff; border: 1px solid #ccc; border-radius: 4px; min-width: 100px; z-index: 10;">
                                            <a href="#" class="edit-comment-btn action-btn" data-id="{{ $reply->id }}" data-content="{{ e($reply->content) }}" style="display: block; padding: 8px 12px;"><i class="fas fa-edit"></i> Sửa</a>
                                            <a href="#" class="delete-comment-btn action-btn" data-id="{{ $reply->id }}"  style="display: block; padding: 8px 12px;"><i class="fas fa-trash"></i> Xóa</a>
                                        </div>
                                    </div>
                                @endif
                            @endauth
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
        <div class="post-interact">
            <!-- Nút hành động -->
            <div class="post-actions">
                <button class="btn action-btn like" id="like-btn" data-post="{{ $post->id }}">
                    <i id="like-icon" class="{{ $post->likedByCurrentUser() ? 'fas' : 'far' }} fa-heart"></i> Thích
                    <span id="like-count">{{ $post->likes->count() }}</span>
                </button>
                <!-- Nút chia sẻ -->
                {{-- <button class="btn action-btn save" id="share-btn">
                    <i class="fas fa-bookmark"></i> Chia sẻ
                </button> --}}

                <!-- Modal chọn chế độ chia sẻ -->
                <div id="share-modal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.3); z-index:9999; align-items:center; justify-content:center;">
    <div style="
        background: #fff;
        padding: 32px 28px 24px 28px;
        border-radius: 16px;
        min-width: 320px;
        max-width: 95vw;
        margin:auto;
        box-shadow: 0 8px 32px rgba(0,0,0,0.18);
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    ">
        <button type="button" id="close-share-modal" style="
            position: absolute;
            top: 12px; right: 16px;
            background: none;
            border: none;
            font-size: 22px;
            color: #888;
            cursor: pointer;
        " title="Đóng">&times;</button>
        <h3 style="margin-bottom: 18px; color: #1a202c;">Chia sẻ bài viết</h3>
        <form id="share-form" method="POST" action="{{ route('post.share', $post->id) }}" style="width:100%; text-align:center;">
            @csrf
            <div style="margin-bottom:18px;">
                <label style="margin-right:20px; font-weight:500;">
                    <input type="radio" name="is_public" value="1" checked style="margin-right:6px;"> Công khai
                </label>
                <label style="font-weight:500;">
                    <input type="radio" name="is_public" value="0" style="margin-right:6px;"> Riêng tư
                </label>
            </div>
            <button type="submit" class="btn btn-primary" style="padding: 8px 22px; border-radius: 6px;">Chia sẻ</button>
        </form>
    </div>
</div>

                <button class="btn action-btn report">
                    <i class="fas fa-flag"></i> Báo cáo
                </button>
            </div>

            <!-- Huy hiệu -->
            <div class="post-badges">
                {{-- <span class="badge-item">
                    <i class="fas fa-star"></i> 120 XP
                </span> --}}
@if(isset($rank))
    <span class="badge-item">
        <i class="fas fa-medal"></i>
        Top {{ $rank }} bài viết tháng
    </span>
@endif
            </div>
            <div class="post-rating-input">
                <span class="rating-label">Đánh giá của bạn:</span>
                <div class="rating-stars-input" id="rating-stars-input">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fa-star {{ $post->ratings->where('user_id', Auth::id())->first()?->score >= $i ? 'fas' : 'far' }}" data-score="{{ $i }}"></i>
                    @endfor
                </div>
                    <!-- Hiển thị điểm trung bình -->
                <div class="avg-rating-box">
                    <span class="avg-star"><i class="fas fa-star"></i></span>
                    <span class="avg-score">{{ number_format($post->average_rating, 1) }}</span>
                    <span class="avg-outof">/5 ({{ $post->ratings->count() }} đánh giá)</span>
                </div>
                <div class="avg-stars-row">
                @php
                    $fullStars = floor($post->average_rating);
                    $halfStar = ($post->average_rating - $fullStars) >= 0.5;
                @endphp
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $fullStars)
                        <i class="fas fa-star" style="color: #ffd700"></i>
                    @elseif ($i == $fullStars + 1 && $halfStar)
                        <i class="fas fa-star-half-alt" style="color:#ffd700"></i>
                    @else
                        <i class="far fa-star" style="color:#ffd700"></i>
                    @endif
                @endfor
            </div>
            <span id="rating-message" style="margin-left:8px;color:green;"></span>
            <div class="rating-distribution" style="margin-top:16px;">
                @for ($i = 5; $i >= 1; $i--)
                    @php
                        $count = $ratingCounts[$i] ?? 0;
                        $percent = $totalRatings > 0 ? round($count / $totalRatings * 100, 1) : 0;
                    @endphp
                    <div style="display: flex; align-items: center; margin-bottom: 4px;">
                        <span style="width: 18px; text-align: right;">{{ $i }}</span>
                        <i class="fas fa-star" style="color: #ffd700; margin: 0 4px;"></i>
                        <div style="flex:1; background: #eee; height: 8px; border-radius: 4px; margin: 0 6px; position:relative;">
                            <div style="background: #4da3ff; height: 100%; border-radius: 4px; width: {{ $percent }}%;"></div>
                        </div>
                        <span style="width: 45px; text-align: right;">{{ $count }}</span>
                    </div>
                @endfor
    </div>
            @guest
                <div style="color: #f00; margin-top: 8px;">Bạn cần <a href="{{ route('login') }}">đăng nhập</a> để đánh giá!</div>
            @endguest
        </div>
    </div>
</div>



    <div class="related-box">
      <strong>Danh sách bài viết</strong>
      @php
        use App\Models\DestinationUtility;
        use App\Models\Post;

        $destinationId = null;
        if ($post->post_type == 'destination') {
            $destinationId = $post->destination_id;
        } elseif ($post->post_type == 'utility' && $post->utility) {
            $destinationUtilities = $post->utility->destinationUtilities ?? null;
            if ($destinationUtilities && $destinationUtilities->isNotEmpty()) {
                $destinationId = $destinationUtilities->first()->destination_id;
            }
        }

        $relatedPosts = collect();
        if ($destinationId) {
            $relatedPosts = Post::where('post_type', 'destination')
                ->where('destination_id', $destinationId)
                ->where('id', '!=', $post->id)
                ->where('status', 0)
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        }
      @endphp
      @forelse($relatedPosts as $related)
        <a href="{{ route('post.detail', $related->id) }}">{{ $related->title }}</a>
      @empty
        <div>0 bài viết</div>
      @endforelse
    </div>

    <div class="related-box">
      <strong>Tiện ích liên quan</strong>
      @php
        // use App\Models\DestinationUtility;
        // use App\Models\Post;

        if ($post->post_type == 'destination') {
            // Lấy các utility_id thuộc địa điểm này
            $utilityIds = DestinationUtility::where('destination_id', $post->destination_id)
                ->pluck('utility_id');
            // Lấy các bài viết tiện ích có utility_id này
            $relatedUtilityPosts = Post::where('post_type', 'utility')
                ->whereIn('utility_id', $utilityIds)
                ->where('status', 0)
                ->where('id', '!=', $post->id)
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        }
        // Nếu là bài viết về tiện ích
        elseif ($post->post_type == 'utility' && $post->utility) {
            $relatedUtilityPosts = Post::where('post_type', 'utility')
                ->where('destination_id', $post->utility->destination_id)
                ->where('id', '!=', $post->id)
                ->where('status', 0)
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        }
      @endphp
      @forelse($relatedUtilityPosts as $related)
        <a href="{{ route('post.detail', $related->id) }}">{{ $related->title }}</a>
      @empty
        <div>0 bài viết</div>
      @endforelse
    </div>
  </div>
  </div>


  <script>
var isCurrentUser = {{ Auth::check() && Auth::id() === $post->user_id ? 'true' : 'false' }};
document.getElementById('like-btn').onclick = function() {
    if(isCurrentUser) {
        alert('Bạn không thể tự thích bài viết của mình!');
        return;
    }
    fetch('{{ route('posts.like', $post->id) }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => {
        if (res.status === 401) {
            // Lưu lại trang hiện tại rồi chuyển hướng login
            localStorage.setItem('intended_url', window.location.href);
            window.location.href = '{{ route('login') }}';
            return;
        }
        return res.json();
    })
    .then(data => {
        if(!data) return;
        if(data.success) {
            document.getElementById('like-count').innerText = data.like_count;
            const icon = document.getElementById('like-icon');
            if(data.liked) {
                icon.classList.remove('far');
                icon.classList.add('fas');
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
            }
        } else if(data.error) {
            alert(data.error);
        }
    });
};


document.getElementById('comment-form').onsubmit = function(e) {
    e.preventDefault();
    const editId = this.getAttribute('data-edit-id');
    const url = editId
        ? '{{ url("comments/update") }}/' + editId
        : '{{ route('posts.comment', $post->id) }}';

    fetch(url, {
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
    .then(res => {
        if (res.status === 401) {
            // Nếu chưa đăng nhập, lưu lại trang hiện tại rồi chuyển hướng login
            localStorage.setItem('intended_url', window.location.href);
            window.location.href = '{{ route('login') }}';
            return;
        }
        return res.json();
    })
    .then(data => {
        if(!data) return;
        if(data.success) {
            if(editId) {
                // Cập nhật lại nội dung comment trên giao diện
                const commentBody = document.querySelector('.comment[data-id="' + editId + '"] .comment-body div');
                if(commentBody) commentBody.innerText = data.content;
                this.removeAttribute('data-edit-id');
                this.querySelector('button[type=submit]').innerText = 'Gửi bình luận';
                this.reset();
            } else {
                // Xác định là bình luận chính hay reply
                const parentId = this.parent_comment_id.value;
                let html = '';
                if(parentId) {
                    // Bình luận con (reply)
                    html = `
                    <div class="comment reply" data-id="${data.id}">
                        <img src="${data.avatar ? data.avatar : '/storage/default.jpg'}" alt="avatar" />
                        <div class="comment-body">
                            <strong>${data.username ?? 'Ẩn danh'}</strong>
                            <div>${data.content}</div>
                            <div class="comment-actions">
                                <span class="comment-time">${data.created_at}</span>
                                <a href="#" class="reply-btn action-btn" data-id="${data.id}"><i class="fas fa-reply"></i> Trả lời</a>
                                <a href="#" class="report-comment action-btn report" data-id="${data.id}"><i class="fas fa-flag"></i> Báo cáo</a>
                                <a href="#" class="like-comment-btn action-btn like" data-id="${data.id}">
                                    <i class="fas fa-heart"></i> Thích
                                    <span id="comment-like-count-${data.id}" class="like-count">${data.like_count}</span>
                                </a>
                                ${data.can_edit ? `
                                    <div class="comment-menu-wrapper" >
                                        <button class="comment-menu-btn" style="background: none; border: none; cursor: pointer;">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="comment-menu" style="display: none; position: absolute; right: 0; top: 100%; background: #fff; border: 1px solid #ccc; border-radius: 4px; min-width: 100px; z-index: 10;">
                                            <a href="#" class="edit-comment-btn action-btn" data-id="${data.id}" data-content="${data.content}" style="display: block; padding: 8px 12px;"><i class="fas fa-edit"></i> Sửa</a>
                                            <a href="#" class="delete-comment-btn action-btn" data-id="${data.id}"  style="display: block; padding: 8px 12px;"><i class="fas fa-trash"></i> Xóa</a>
                                        </div>
                                    </div>
                                    ` : ''}
                            </div>
                        </div>
                    </div>`;
                    // Chèn sau bình luận cha
                    const parentComment = document.querySelector('.comment[data-id="' + parentId + '"]');
                    if(parentComment) {
                        parentComment.insertAdjacentHTML('afterend', html);
                    }
                } else {
                    // Bình luận chính
                    html = `
                    <div class="comment" data-id="${data.id}">
                        <img src="${data.avatar ? data.avatar : '/storage/default.jpg'}" alt="avatar" />
                        <div class="comment-body">
                            <strong>${data.username ?? 'Ẩn danh'}</strong>
                            <div>${data.content}</div>
                            <div class="comment-actions">
                                <span class="comment-time">${data.created_at}</span>
                                <a href="#" class="reply-btn action-btn" data-id="${data.id}"><i class="fas fa-reply"></i> Trả lời</a>
                                <a href="#" class="report-comment action-btn report" data-id="${data.id}"><i class="fas fa-flag"></i> Báo cáo</a>
                                <a href="#" class="like-comment-btn action-btn like" data-id="${data.id}">
                                    <i class="fas fa-heart"></i> Thích
                                    <span id="comment-like-count-${data.id}" class="like-count">${data.like_count}</span>
                                </a>
                                ${data.can_edit ? `
                                    <div class="comment-menu-wrapper">
                                        <button class="comment-menu-btn" style="background: none; border: none; cursor: pointer;">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="comment-menu" style="display: none; position: absolute; right: 0; top: 100%; background: #fff; border: 1px solid #ccc; border-radius: 4px; min-width: 100px; z-index: 10;">
                                            <a href="#" class="edit-comment-btn action-btn" data-id="${data.id} data-content="${data.content}" style="display: block; padding: 8px 12px;"><i class="fas fa-edit"></i> Sửa</a>
                                            <a href="#" class="delete-comment-btn action-btn" data-id="${data.id} style="display: block; padding: 8px 12px;"><i class="fas fa-trash"></i> Xóa</a>
                                        </div>
                                    </div>
                                ` : ''}
                            </div>
                        </div>
                    </div>`;
                    // Chèn vào đầu danh sách
                    document.getElementById('comment-list').insertAdjacentHTML('afterbegin', html);
                }
                this.reset();
            }
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
        reportType = 'comment';
        reportId = this.getAttribute('data-id');
        document.getElementById('report-modal').style.display = 'flex';
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

document.querySelectorAll('.edit-comment-btn').forEach(btn => {
    btn.onclick = function(e) {
        e.preventDefault();
        const content = this.getAttribute('data-content');
        const commentId = this.getAttribute('data-id');
        // Đưa nội dung lên textarea và gán id comment đang sửa
        document.querySelector('#comment-form textarea').value = content;
        document.querySelector('#comment-form [name=parent_comment_id]').value = '';
        document.querySelector('#comment-form').setAttribute('data-edit-id', commentId);
        document.querySelector('#comment-form button[type=submit]').innerText = 'Cập nhật bình luận';
        document.querySelector('#comment-form textarea').focus();
    }
});

function bindCommentEvents() {
    // Sự kiện xóa bình luận
    document.querySelectorAll('.delete-comment-btn').forEach(btn => {
        btn.onclick = function(e) {
            e.preventDefault();
            if(confirm('Bạn có chắc muốn xóa bình luận này không?')) {
                const commentId = this.getAttribute('data-id');
                fetch(`/comments/delete/${commentId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if(data.success) {
                        // Xóa bình luận khỏi giao diện
                        const commentEl = document.querySelector('.comment[data-id="' + commentId + '"]');
                        if(commentEl) commentEl.remove();
                    } else if(data.error) {
                        alert(data.error);
                    }
                });
            }
        }
    });

}

// Hiện menu khi bấm vào nút 3 chấm
document.querySelectorAll('.comment-menu-btn').forEach(btn => {
    btn.onclick = function(e) {
        e.stopPropagation();
        // Ẩn tất cả menu khác
    document.querySelectorAll('.comment-menu').forEach(menu => {
        if(menu !== this.nextElementSibling) menu.style.display = 'none';
    });
    // Toggle menu của nút này
    this.nextElementSibling.style.display = 
        this.nextElementSibling.style.display === 'block' ? 'none' : 'block';
}
});
// Ẩn menu khi click ra ngoài
document.addEventListener('click', function() {
    document.querySelectorAll('.comment-menu').forEach(menu => menu.style.display = 'none');
});

bindCommentEvents(); // Gọi khi trang load và sau khi thêm bình luận mới

// Xử lý đánh giá
const ratingStarsInput = document.getElementById('rating-stars-input');
const ratingMessage = document.getElementById('rating-message');
let userRating = {{ $post->ratings->where('user_id', Auth::id())->first()?->score ?? 0 }};
if (userRating > 0) {
    document.getElementById('rating-stars-input').setAttribute('data-rated', userRating);
}


@auth
document.querySelectorAll('#rating-stars-input .fa-star').forEach(star => {
    star.addEventListener('mouseenter', function() {
        const score = parseInt(this.getAttribute('data-score'));
        document.querySelectorAll('#rating-stars-input .fa-star').forEach((s, idx) => {
            s.classList.toggle('fas', idx < score);
            s.classList.toggle('far', idx >= score);
        });
    });
    star.addEventListener('mouseleave', function() {
        const rated = document.querySelector('#rating-stars-input').getAttribute('data-rated');
        if (rated) {
            document.querySelectorAll('#rating-stars-input .fa-star').forEach((s, idx) => {
                s.classList.toggle('fas', idx < rated);
                s.classList.toggle('far', idx >= rated);
            });
        } else {
            document.querySelectorAll('#rating-stars-input .fa-star').forEach(s => {
                s.classList.remove('fas');
                s.classList.add('far');
            });
        }
    });
    star.addEventListener('click', function() {
        const score = parseInt(this.getAttribute('data-score'));
        fetch('{{ route('posts.rating', $post->id) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ score })
        })
        .then(res => {
            if (res.status === 401) {
                // Nếu chưa đăng nhập, lưu lại trang hiện tại rồi chuyển hướng login
                localStorage.setItem('intended_url', window.location.href);
                window.location.href = '{{ route('login') }}';
                return;
            }
            return res.json();
        })
        .then(data => {
            if(!data) return;
            if(data.success) {
                document.getElementById('rating-message').innerText = 'Đã đánh giá!';
                document.querySelector('#rating-stars-input').setAttribute('data-rated', score);
                document.querySelectorAll('#rating-stars-input .fa-star').forEach((s, idx) => {
                    s.classList.toggle('fas', idx < score);
                    s.classList.toggle('far', idx >= score);
                });
                document.querySelector('.post-rating .rating-stars').innerHTML =
                    [...Array(5)].map((_,i) =>
                        `<i class="fas fa-star${i < Math.round(data.average_rating) ? '' : '-o'}"></i>`
                    ).join('');
                document.querySelector('.post-rating .rating-text').innerText =
                    `${data.average_rating}/5 (cập nhật)`;
            } else if(data.error) {
                alert(data.error);
            }
        });
    });
});
@endauth

@if(!Auth::check())
document.querySelectorAll('#rating-stars-input .fa-star').forEach(star => {
    star.addEventListener('click', function() {
        if (confirm('Bạn cần đăng nhập để đánh giá!')) {
            localStorage.setItem('intended_url', window.location.href);
            window.location.href = '{{ route('login') }}';
        }
    });
});
@endif

document.getElementById('share-btn').onclick = function() {
    document.getElementById('share-modal').style.display = 'flex';
};
document.getElementById('close-share-modal').onclick = function() {
    document.getElementById('share-modal').style.display = 'none';
};
// Đóng modal khi click ra ngoài
document.getElementById('share-modal').onclick = function(e) {
    if(e.target === this) this.style.display = 'none';
};
document.getElementById('share-btn').onclick = function() {
    // Kiểm tra có phải bài của mình không (Laravel sẽ render biến này)
    var isCurrentUser = {{ Auth::check() && Auth::id() === $post->user_id ? 'true' : 'false' }};
    if(isCurrentUser) {
        alert('Bạn không thể tự chia sẻ bài viết của mình!');
        return;
    }
    document.getElementById('share-modal').style.display = 'flex';
};
  </script>
  @if(session('success'))
<script>
    alert("{{ session('success') }}");
</script>
@endif
@if(session('error'))
<script>
    alert("{{ session('error') }}");
</script>
@endif
<script>
document.querySelector('.post-actions .report').onclick = function(e) {
    e.preventDefault();
    reportType = 'post';
    reportId = {{ $post->id }};
    document.getElementById('report-modal').style.display = 'flex';
};
</script>

<!-- Thêm vào sau nút báo cáo trong .post-actions -->
<!-- Popup báo cáo -->
<div id="report-modal">
    <div class="modal-content">
        <button type="button" id="close-report-modal" title="Đóng">&times;</button>
        <h3 style="margin-bottom: 16px; color: #1a202c;">Lý do bạn muốn báo cáo?</h3>
        <form id="report-form" style="width:100%; text-align:center;">
            <div style="margin-bottom:14px; text-align:left;">
                <label><input type="radio" name="reason" value="Nội dung không phù hợp" required> Nội dung không phù hợp</label>
                <label><input type="radio" name="reason" value="Spam/quảng cáo"> Spam/quảng cáo</label>
                <label><input type="radio" name="reason" value="Thông tin sai sự thật"> Thông tin sai sự thật</label>
                <label>
                    <input type="radio" name="reason" value="other"> Khác:
                    <input type="text" id="other-reason" name="other_reason" placeholder="Nhập lý do khác..." disabled>
                </label>
            </div>
            <button type="submit" class="btn btn-danger">Gửi báo cáo</button>
        </form>
    </div>
</div>

<script>
    let reportType = null; // 'post' hoặc 'comment'
let reportId = null;
// Hiện popup khi bấm nút báo cáo
document.querySelector('.post-actions .report').onclick = function(e) {
    e.preventDefault();
    reportType = 'post';
    reportId = {{ $post->id }};
    document.getElementById('report-modal').style.display = 'flex';
};
// Đóng popup
document.getElementById('close-report-modal').onclick = function() {
    document.getElementById('report-modal').style.display = 'none';
};
// Đóng khi click ra ngoài
document.getElementById('report-modal').onclick = function(e) {
    if(e.target === this) this.style.display = 'none';
};
// Enable/disable input khi chọn "Khác"
document.querySelectorAll('input[name="reason"]').forEach(radio => {
    radio.onchange = function() {
        document.getElementById('other-reason').disabled = this.value !== 'other';
        if(this.value !== 'other') document.getElementById('other-reason').value = '';
    }
});
// Gửi báo cáo
document.getElementById('report-form').onsubmit = function(e) {
    e.preventDefault();
    let reason = document.querySelector('input[name="reason"]:checked').value;
    if(reason === 'other') {
        reason = document.getElementById('other-reason').value.trim();
        if(!reason) {
            alert('Vui lòng nhập lý do báo cáo!');
            return;
        }
    }
    let url = '';
    if(reportType === 'post') {
        url = '{{ route('posts.report', ':id') }}'.replace(':id', reportId);
    } else if(reportType === 'comment') {
        url = '{{ route('comments.report', ':id') }}'.replace(':id', reportId);
    }
    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ reason })
    })
    .then(res => {
        if (res.status === 401) {
            // Nếu chưa đăng nhập, lưu lại trang hiện tại rồi chuyển hướng login
            localStorage.setItem('intended_url', window.location.href);
            window.location.href = '{{ route('login') }}';
            return;
        }
        return res.json();
    })
    .then(data => {
        if(!data) return;
        if(data.success) {
            alert(data.message || 'Đã gửi báo cáo cho quản trị viên!');
            document.getElementById('report-modal').style.display = 'none';
        } else if(data.error) {
            alert(data.error);
        }
    });
};

function resetReportModal() {
    // Reset radio
    document.querySelectorAll('#report-form input[name="reason"]').forEach(radio => {
        radio.checked = false;
    });
    // Reset input khác
    document.getElementById('other-reason').value = '';
    document.getElementById('other-reason').disabled = true;
}

// Mở modal báo cáo bài viết
document.querySelector('.post-actions .report').onclick = function(e) {
    e.preventDefault();
    reportType = 'post';
    reportId = {{ $post->id }};
    resetReportModal();
    document.getElementById('report-modal').style.display = 'flex';
};

// Mở modal báo cáo bình luận
document.querySelectorAll('.report-comment').forEach(btn => {
    btn.onclick = function(e) {
        e.preventDefault();
        reportType = 'comment';
        reportId = this.getAttribute('data-id');
        resetReportModal();
        document.getElementById('report-modal').style.display = 'flex';
    }
});
</script>
@endsection