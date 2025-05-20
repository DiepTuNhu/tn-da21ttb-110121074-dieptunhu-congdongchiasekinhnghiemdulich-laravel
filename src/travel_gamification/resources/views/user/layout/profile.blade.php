@extends('user.master')
@section('content')

    <div class="profile-container">
      <!-- Thông tin cá nhân -->
      <div class="profile-info">
        <img
            src="{{ $user->avatar ? asset('storage/avatars/' . $user->avatar) : asset('storage/default.jpg') }}"
            alt="avatar"
        />
        <div>
            <h2>
                {{ $user->username }}
                <span class="profile-badge">🥇 Nhà chinh phục</span>
            </h2>

            <div class="profile-meta">
                <p><i class="fas fa-calendar-alt"></i> Tham gia từ: {{ $user->created_at->format('d/m/Y') }}</p>
                <p><i class="fas fa-star"></i> Điểm tích lũy: <strong>{{ number_format($user->score ?? 0, 0, ',', '.') }}</strong></p>
            </div>

            <div class="profile-stats">
                <span><i class="fas fa-file-alt"></i> {{ $user->posts_count ?? 0 }} bài viết</span>
                <span><i class="fas fa-heart"></i> {{ $user->likes_count ?? 0 }} lượt thích</span>
                <span><i class="fas fa-check-circle"></i> {{ $user->missions_count ?? 0 }} nhiệm vụ</span>
            </div>
        </div>
      </div>

      <!-- Tabs -->
      <div class="profile-tabs">
        <div class="profile-tab active" data-tab="posts">📄 Bài viết</div>
        <div class="profile-tab" data-tab="missions">🎯 Nhiệm vụ</div>
        <div class="profile-tab" data-tab="likes">❤️ Đã thích</div>
        <div class="profile-tab" data-tab="shared">📢 Đã chia sẻ</div>
        <div class="profile-tab" data-tab="followers">👥 Người theo dõi</div>
        <div class="profile-tab" data-tab="following">🔍 Đang theo dõi</div>
      </div>

      <!-- Nội dung: Bài viết -->
      <div class="profile-tab-content active" id="posts">
        <div class="profile-card-grid">
            @forelse($posts as $post)
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
                <p>Bạn chưa đăng bài viết nào.</p>
            @endforelse
        </div>
      </div>

      <!-- Nội dung: Nhiệm vụ -->
      <div class="profile-tab-content" id="missions">
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
      </div>

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
        <div class="profile-card-grid">
          <div class="profile-card-item">
            <img class="profile-card-img" src="../5.png" alt="" />
            <div class="profile-card-content">
              <h4>Cẩm nang du lịch miền Tây</h4>
              <p>📤 Đã chia sẻ từ TravelShare · ❤️ 80 lượt thích</p>
            </div>
          </div>
          <div class="profile-card-item">
            <img class="profile-card-img" src="../6.png" alt="" />
            <div class="profile-card-content">
              <h4>Top 5 địa điểm ngắm hoàng hôn</h4>
              <p>📤 Chia sẻ từ Hương Giang · ❤️ 92 lượt thích</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Nội dung: Người theo dõi -->
      <div class="profile-tab-content" id="followers">
        <div class="follower-list">
          <div class="follower-item">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="" />
            <div class="follower-info">
              <h4>Trần Thị B</h4>
              <p>Đã theo dõi bạn từ 15/03/2024</p>
            </div>
          </div>
          <div class="follower-item">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="" />
            <div class="follower-info">
              <h4>Lê Văn C</h4>
              <p>Đã theo dõi bạn từ 28/03/2024</p>
            </div>
          </div>
        </div>
      </div>
      

<!-- Nội dung: Đang theo dõi -->
<div class="profile-tab-content" id="following">
  <div class="follower-list">
    <div class="follower-item">
      <img src="https://randomuser.me/api/portraits/women/55.jpg" alt="" />
      <div class="follower-info">
        <h4>Nguyễn Thị D</h4>
        <p>Bạn theo dõi từ 05/04/2024</p>
      </div>
      <button class="unfollow-btn">Hủy theo dõi</button>
    </div>
    
    <div class="follower-item">
      <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="" />
      <div class="follower-info">
        <h4>Phạm Văn E</h4>
        <p>Bạn theo dõi từ 20/04/2024</p>
      </div>
      <button class="unfollow-btn">Hủy theo dõi</button>
    </div>
    
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
    @endsection
