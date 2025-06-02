@extends('user.master')
@section('content')

    {{-- Thêm style cho profile-info --}}
    <style>
    .profile-info {
        position: relative;
    }
    .profile-reward-btn {
        position: absolute;
        margin: 10px;
        top: 0;
        right: 0;
        font-weight: 600;
        font-size: 0.98rem;
        color: #fff;
        background: linear-gradient(90deg,#e67e22 60%,#f6c177 100%);
        border: none;
        border-radius: 6px;
        padding: 7px 18px;
        box-shadow: 0 2px 8px rgba(230,126,34,0.08);
        display: inline-block;
        z-index: 2;
    }
    @media (max-width: 600px) {
        .profile-reward-btn {
            font-size: 0.92rem;
            padding: 6px 10px;
        }
    }
    </style>

    <div class="profile-container">
      <!-- Thông tin cá nhân -->
      <div class="profile-info">
            {{-- Nút đổi thưởng nằm góc phải --}}
            <a href="{{ route('user.rewards') }}" class="btn btn-warning profile-reward-btn">
                🎁 Đổi thưởng
            </a>
            <img 
                src="@if($user->avatar)
                        @if(Str::startsWith($user->avatar, ['http://', 'https://']))
                            {{ $user->avatar }}
                        @else
                            {{ asset('storage/avatars/' . $user->avatar) }}
                        @endif
                    @else
                        {{ asset('storage/avatars/default.jpg') }}
                    @endif"
                alt="avatar" />
        <div>
            <h2>
                {{ $user->username }}
                <span class="profile-badge">🥇 Nhà chinh phục</span>
            </h2>

            <div class="profile-meta">
                <p><i class="fas fa-calendar-alt"></i> Tham gia từ: {{ $user->created_at->format('d/m/Y') }}</p>
                <p><i class="fas fa-star"></i> Điểm tích lũy: <strong>{{ number_format($user->total_points ?? 0, 0, ',', '.') }}</strong></p>
            </div>

            <div class="profile-stats">
                <span><i class="fas fa-file-alt"></i> {{ $user->posts_count ?? 0 }} bài viết</span>
                <span><i class="fas fa-heart"></i> {{ $user->likes_count ?? 0 }} lượt thích</span>
                <span><i class="fas fa-user-friends"></i> {{ $followers->count() }} người theo dõi</span>
                <span><i class="fas fa-user-plus"></i> {{ $followings->count() }} đang theo dõi</span>
            </div>
        </div>
      </div>

      <!-- Tabs -->
      <div class="profile-tabs">
        <div class="profile-tab active" data-tab="posts">📄 Bài viết</div>
        {{-- <div class="profile-tab" data-tab="missions">🎯 Nhiệm vụ</div> --}}
        <div class="profile-tab" data-tab="likes">❤️ Đã thích</div>
        <div class="profile-tab" data-tab="shared">📢 Đã chia sẻ</div>
        <div class="profile-tab" data-tab="followers">👥 Người theo dõi</div>
        <div class="profile-tab" data-tab="following">🔍 Đang theo dõi</div>
      </div>

      <!-- Nội dung: Bài viết -->
      <div class="profile-tab-content active" id="posts">
{{-- PHẦN 1: Bài viết về địa điểm --}}
    <h3 style="margin-bottom: 12px;">Bài viết về địa điểm</h3>
    <div class="profile-card-grid">
        @php
            $locationPosts = $posts->where('destination_id', '!=', null);
        @endphp
        @forelse($locationPosts as $post)
            <div class="profile-card-item">
                <a href="{{ route('post.detail', $post->id) }}" style="text-decoration: none; color: inherit;">
                    @php
                        $firstImage = null;
                        if ($post->content) {
                            preg_match('/<img[^>]+src="([^">]+)"/i', $post->content, $matches);
                            $firstImage = $matches[1] ?? null;
                        }
                        // Ảnh có status = 2 trong destination_images
                        $destinationImageStatus2 = null;
                        if (!$firstImage && $post->destination && $post->destination->destinationImages) {
                            $destinationImageStatus2 = $post->destination->destinationImages->where('status', 2)->first();
                        }
                    @endphp

                    @if ($firstImage)
                        <img class="profile-card-img" src="{{ $firstImage }}" alt="{{ $post->title }}" />
                    @elseif ($destinationImageStatus2)
                        <img class="profile-card-img" src="{{ $destinationImageStatus2->image_url }}" alt="{{ $post->destination->name }}" />
                    @elseif ($post->destination && $post->destination->destinationImages && $post->destination->destinationImages->isNotEmpty())
                        <img class="profile-card-img" src="{{ $post->destination->destinationImages->first()->image_url }}" alt="{{ $post->destination->name }}" />
                    @else
                        <img class="profile-card-img" src="{{ asset('canh.png') }}" alt="Default Image" />
                    @endif
                    <div class="profile-card-content">
                        <h4>{{ $post->title }}</h4>
                        <p>
                            ❤️ {{ $post->likes_count ?? 0 }} lượt thích · 
                            {{ $post->comments_count ?? 0 }} bình luận
                        </p>
                    </div>
                </a>
            </div>
        @empty
            <p>Bạn chưa đăng bài viết về địa điểm nào.</p>
        @endforelse
    </div>

    {{-- PHẦN 2: Bài viết về tiện ích --}}
    <h3 style="margin:32px 0 12px 0;">Bài viết về tiện ích</h3>
    <div class="profile-card-grid">
        @php
            $utilityPosts = $posts->where('utility_id', '!=', null);
        @endphp
        @forelse($utilityPosts as $post)
            <div class="profile-card-item">
                <a href="{{ route('post.detail', $post->id) }}" style="text-decoration: none; color: inherit;">
                    @php
                        $firstImage = null;
                        if ($post->content) {
                            preg_match('/<img[^>]+src="([^">]+)"/i', $post->content, $matches);
                            $firstImage = $matches[1] ?? null;
                        }
                    @endphp

                    @if ($firstImage)
                        <img class="profile-card-img" src="{{ $firstImage }}" alt="{{ $post->title }}" />
                    @elseif ($post->utility && $post->utility->image)
                        <img class="profile-card-img" src="{{ asset('storage/utility_image/' . $post->utility->image) }}" alt="{{ $post->utility->name }}" />
                    @else
                        <img class="profile-card-img" src="{{ asset('canh.png') }}" alt="Default Image" />
                    @endif
                    <div class="profile-card-content">
                        <h4>{{ $post->title }}</h4>
                        <p>
                            ❤️ {{ $post->likes_count ?? 0 }} lượt thích · 
                            {{ $post->comments_count ?? 0 }} bình luận
                        </p>
                    </div>
                </a>
            </div>
        @empty
            <p>Bạn chưa đăng bài viết về tiện ích nào.</p>
        @endforelse
    </div>
      </div>

      <!-- Nội dung: Nhiệm vụ -->
      {{-- <div class="profile-tab-content" id="missions">
        <div class="profile-card-grid">
          <div class="profile-card-item">
            <div class="profile-card-content">
              <h4>📝 Đăng bài đầu tiên</h4>
              <p class="profile-status">Đã hoàn thành</p>
            </div>
          </div>
          <div class="profile-card-item">
            <div class="profile-card-content">
              <h4>💬 Viết 3 bình luận</h4>
              <p class="profile-status">Đã hoàn thành</p>
            </div>
          </div>
        </div>
      </div> --}}

      <!-- Nội dung: Đã thích -->
      <div class="profile-tab-content" id="likes">
          <div class="profile-card-grid">
              @forelse($likedPosts as $post)
                  <div class="profile-card-item">
                      <a href="{{ route('post.detail', $post->id) }}" style="text-decoration: none; color: inherit;">
                          @php
                              // Lấy ảnh đầu tiên trong content (nếu có)
                              $firstImage = null;
                              if ($post->content) {
                                  preg_match('/<img[^>]+src="([^">]+)"/i', $post->content, $matches);
                                  $firstImage = $matches[1] ?? null;
                              }
                          @endphp

                          @if ($firstImage)
                              <img class="profile-card-img" src="{{ $firstImage }}" alt="{{ $post->title }}" />
                          @elseif ($post->destination && $post->destination->destinationImages && $post->destination->destinationImages->isNotEmpty())
                              <img class="profile-card-img" src="{{ $post->destination->destinationImages->first()->image_url }}" alt="{{ $post->destination->name }}" />
                          @else
                              <img class="profile-card-img" src="{{ asset('canh.png') }}" alt="Default Image" />
                          @endif
                          <div class="profile-card-content">
                              <h4>{{ $post->title }}</h4>
                              <p>
                                  ❤️ {{ $post->likes_count ?? 0 }} lượt thích · 
                                  {{ $post->comments_count ?? 0 }} bình luận
                              </p>
                          </div>
                      </a>
                  </div>
              @empty
                  <p>Bạn chưa thích bài viết nào của người khác.</p>
              @endforelse
          </div>
      </div>

      <!-- Nội dung: Đã chia sẻ -->
      <div class="profile-tab-content" id="shared">
<!-- Chia sẻ công khai -->
    <h3 style="margin-bottom: 12px;">Bài viết chia sẻ công khai</h3>
    <div class="profile-card-grid">
        @php
            $publicShares = $sharedPosts->where('pivot.is_public', 1)->where('pivot.status', 0);
        @endphp
        @forelse($publicShares as $post)
            @php
                $firstImage = null;
                if ($post->content) {
                    preg_match('/<img[^>]+src="([^">]+)"/i', $post->content, $matches);
                    $firstImage = $matches[1] ?? null;
                }
            @endphp
            <div class="profile-card-item" data-share-id="{{ $post->pivot->id }}">
                <a href="{{ route('post.detail', $post->id) }}">
                    @if ($firstImage)
                        <img class="profile-card-img" src="{{ $firstImage }}" alt="{{ $post->title }}" />
                    @else
                        <img class="profile-card-img" src="{{ asset('canh.png') }}" alt="{{ $post->title }}" />
                    @endif
                    <div class="profile-card-content">
                        <h4>{{ $post->title }}</h4>
                        <p>📤 Đã chia sẻ công khai · ❤️ {{ $post->likes->count() }} lượt thích</p>
                    </div>
                </a>
                <div class="share-actions" style="margin-top:8px;">
                    <button class="btn-toggle-share" data-share-id="{{ $post->pivot->id }}" data-current="public">Chuyển thành riêng tư</button>
                    <button class="btn-delete-share" data-share-id="{{ $post->pivot->id }}">Xóa chia sẻ</button>
                </div>
            </div>
        @empty
            <p>Bạn chưa chia sẻ bài viết công khai nào.</p>
        @endforelse
    </div>

    <!-- Chia sẻ riêng tư -->
    <h3 style="margin:32px 0 12px 0;">Bài viết chia sẻ riêng tư</h3>
    <div class="profile-card-grid">
        @php
            $privateShares = $sharedPosts->where('pivot.is_public', 0)->where('pivot.status', 0);
        @endphp
        @forelse($privateShares as $post)
            @php
                $firstImage = null;
                if ($post->content) {
                    preg_match('/<img[^>]+src="([^">]+)"/i', $post->content, $matches);
                    $firstImage = $matches[1] ?? null;
                }
            @endphp
            <div class="profile-card-item" data-share-id="{{ $post->pivot->id }}">
                <a href="{{ route('post.detail', $post->id) }}">
                    @if ($firstImage)
                        <img class="profile-card-img" src="{{ $firstImage }}" alt="{{ $post->title }}" />
                    @else
                        <img class="profile-card-img" src="{{ asset('canh.png') }}" alt="{{ $post->title }}" />
                    @endif
                    <div class="profile-card-content">
                        <h4>{{ $post->title }}</h4>
                        <p>📤 Đã chia sẻ riêng tư · ❤️ {{ $post->likes->count() }} lượt thích</p>
                    </div>
                </a>
                <div class="share-actions" style="margin-top:8px;">
                    <button class="btn-toggle-share" data-share-id="{{ $post->pivot->id }}" data-current="private">Chuyển thành công khai</button>
                    <button class="btn-delete-share" data-share-id="{{ $post->pivot->id }}">Xóa chia sẻ</button>
                </div>
            </div>
        @empty
            <p>Bạn chưa chia sẻ bài viết riêng tư nào.</p>
        @endforelse
    </div>
      </div>

      <!-- Nội dung: Người theo dõi -->

{{-- filepath: resources/views/user/layout/profile.blade.php --}}
<div class="profile-tab-content" id="followers">
    <div class="follower-list">
        @forelse($followers as $follower)
            <div class="follower-item">
                <a href="{{ route('detail_user_follow', $follower->id) }}" style="display: flex; align-items: center; text-decoration: none; color: inherit;">
                    <img 
                        src="@if($follower->avatar)
                                @if(Str::startsWith($follower->avatar, ['http://', 'https://']))
                                    {{ $follower->avatar }}
                                @else
                                    {{ asset('storage/avatars/' . $follower->avatar) }}
                                @endif
                            @else
                                {{ asset('storage/avatars/default.jpg') }}
                            @endif"
                        alt="avatar" />
                    <div class="follower-info">
                        <h4>{{ $follower->username }}</h4>
                        <p>Đã theo dõi bạn từ {{ \Carbon\Carbon::parse($follower->pivot->created_at)->format('d/m/Y') }}</p>
                    </div>
                </a>

            </div>
        @empty
            <p>Chưa có ai theo dõi bạn.</p>
        @endforelse
    </div>
</div>
      

<!-- Nội dung: Đang theo dõi -->
<div class="profile-tab-content" id="following">
  <div class="follower-list">
    {{-- Followings --}}
    @forelse($followings as $following)
      <div class="follower-item">
        <a href="{{ route('detail_user_follow', $following->id) }}" style="display: flex; align-items: center; text-decoration: none; color: inherit;">
            <img 
                src="@if($following->avatar)
                        @if(Str::startsWith($following->avatar, ['http://', 'https://']))
                            {{ $following->avatar }}
                        @else
                            {{ asset('storage/avatars/' . $following->avatar) }}
                        @endif
                    @else
                        {{ asset('storage/avatars/default.jpg') }}
                    @endif"
                alt="avatar" />
            <div class="follower-info">
                <h4>{{ $following->username }}</h4>
                <p>Bạn theo dõi từ {{ \Carbon\Carbon::parse($following->pivot->created_at)->format('d/m/Y') }}</p>
            </div>
        </a>
        <button class="unfollow-btn" data-user="{{ $following->id }}">Hủy theo dõi</button>
      </div>
    @empty
      <p>Bạn chưa theo dõi ai.</p>
    @endforelse
  </div>
</div>


    </div>
    <script>
      const tabs = document.querySelectorAll(".profile-tab");
      const contents = document.querySelectorAll(".profile-tab-content");

      tabs.forEach((tab) => {
        tab.addEventListener("click", () => {
          tabs.forEach((t) => t.classList.remove("active"));
          contents.forEach((c) => c.classList.remove("active"));
          tab.classList.add("active");
          document.getElementById(tab.dataset.tab).classList.add("active");
        });
      });
      
    </script>

    <script>
document.querySelectorAll('.unfollow-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const userId = this.dataset.user;
        fetch(`/user/${userId}/unfollow`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'unfollowed') {
                this.closest('.follower-item').remove();
            }
        });
    });
});
</script>

<script>
document.querySelectorAll('.btn-toggle-share').forEach(btn => {
    btn.addEventListener('click', function() {
        const shareId = this.dataset.shareId;
        const current = this.dataset.current;
        fetch(`/user/share/${shareId}/toggle`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'updated') {
                // Reload tab or move card to other section
                location.reload();
            }
        });
    });
});

document.querySelectorAll('.btn-delete-share').forEach(btn => {
    btn.addEventListener('click', function() {
        if(!confirm('Bạn có chắc muốn xóa chia sẻ này?')) return;
        const shareId = this.dataset.shareId;
        fetch(`/user/share/${shareId}/delete`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'deleted') {
                document.querySelector(`.profile-card-item[data-share-id="${shareId}"]`).remove();
            }
        });
    });
});
</script>
    @endsection
