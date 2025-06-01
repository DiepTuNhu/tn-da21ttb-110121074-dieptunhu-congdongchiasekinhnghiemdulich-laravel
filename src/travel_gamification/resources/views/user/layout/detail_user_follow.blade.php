@extends('user.master')
@section('content')
<div class="profile-container">
    <!-- Thông tin người dùng -->
    <div class="profile-info-follow">
        <div class="profile-details">
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
                    <span
                        style="
                            font-size: 14px;
                            background: #ffeb3b;
                            color: #333;
                            padding: 2px 8px;
                            border-radius: 6px;
                        "
                    >🥇 Nhà khám phá</span>
                </h2>
                <div class="profile-stats">
                    <span><i class="fas fa-file-alt"></i> {{ $user->posts_count ?? 0 }} bài viết</span>
                    <span><i class="fas fa-heart"></i> {{ number_format($user->likes_count ?? 0, 0, ',', '.') }} lượt thích</span>
                    <span><i class="fas fa-star"></i> {{ number_format($user->score ?? 0, 0, ',', '.') }} điểm</span>
                </div>
            </div>
        </div>
        <button 
            class="follow-btn {{ auth()->user()->followings->contains($user->id) ? 'following' : '' }}" 
            id="followBtn"
            data-user="{{ $user->id }}">
            {{ auth()->user()->followings->contains($user->id) ? 'Đang theo dõi' : 'Theo dõi' }}
        </button>
    </div>

    <!-- Tabs -->
    <div class="profile-tabs">
        <div class="profile-tab active" data-tab="posts">📄 Bài viết</div>
        <div class="profile-tab" data-tab="shared">📢 Đã chia sẻ</div>
    </div>

    <!-- Nội dung: Bài viết -->
    <div class="profile-tab-content active" id="posts">
        <div class="profile-card-grid">
            @forelse($posts as $post)
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
                        @elseif ($post->destination && $post->destination->destinationImages && $post->destination->destinationImages->isNotEmpty())
                            <img class="profile-card-img" src="{{ $post->destination->destinationImages->first()->image_url }}" alt="{{ $post->destination->name }}" />
                        @else
                            <img class="profile-card-img" src="{{ asset('canh.png') }}" alt="Default Image" />
                        @endif
                        <div class="profile-card-content">
                            <h4>{{ $post->title }}</h4>
                            <p>❤️ {{ $post->likes_count ?? 0 }} lượt thích · {{ $post->comments_count ?? 0 }} bình luận</p>
                        </div>
                    </a>
                </div>
            @empty
                <p>Chưa có bài viết nào.</p>
            @endforelse
        </div>
    </div>

    <!-- Nội dung: Đã chia sẻ -->
<div class="profile-tab-content" id="shared">
    <div class="profile-card-grid">
        @php
            // Lọc các bài chia sẻ công khai (is_public = 1, status = 0)
            $publicShares = $sharedPosts->where('pivot.is_public', 1)->where('pivot.status', 0);
        @endphp
        @forelse($publicShares as $post)
            @php
                // Lấy ảnh đầu tiên trong content
                $firstImage = null;
                if ($post->content) {
                    preg_match('/<img[^>]+src="([^">]+)"/i', $post->content, $matches);
                    $firstImage = $matches[1] ?? null;
                }
            @endphp
            <div class="profile-card-item">
                <a href="{{ route('post.detail', $post->id) }}">
                    @if ($firstImage)
                        <img class="profile-card-img" src="{{ $firstImage }}" alt="{{ $post->title }}" />
                    @else
                        <img class="profile-card-img" src="{{ asset('canh.png') }}" alt="Default Image" />
                    @endif
                    <div class="profile-card-content">
                        <h4>{{ $post->title }}</h4>
                        <p>📤 Đã chia sẻ · ❤️ {{ $post->likes_count ?? $post->likes->count() }} lượt thích</p>
                    </div>
                </a>
            </div>
        @empty
            <p>Chưa có bài viết chia sẻ công khai nào.</p>
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
document.getElementById('followBtn').addEventListener('click', function() {
    const btn = this;
    const userId = btn.dataset.user;
    const isFollowing = btn.classList.contains('following');
    fetch(`/user/${userId}/${isFollowing ? 'unfollow' : 'follow'}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        btn.classList.toggle('following');
        btn.textContent = btn.classList.contains('following') ? 'Đang theo dõi' : 'Theo dõi';
    });
});
</script>
@endsection