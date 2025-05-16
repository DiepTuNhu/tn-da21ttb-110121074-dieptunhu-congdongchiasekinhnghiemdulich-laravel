@extends('user.master')
@section('content')
<div class="container-dtp">
  <div class="main">
    <h1>{{ $post->title }}</h1>
    <div class="meta user-meta">
      <img class="author-avatar" src="{{ $post->user && $post->user->avatar ? asset('storage/avatars/' . $post->user->avatar) : asset('default-avatar.png') }}" alt="avatar" />
      <div class="user-info">
        <span class="author-name">{{ $post->user->username ?? 'Ẩn danh' }}</span>
        <span class="meta-details">
          {{-- <i class="fas fa-calendar-alt"></i> 12/04/2025 <i class="fas fa-chart-bar"></i> 1234
          lượt xem <i class="fas fa-heart"></i> 256 lượt thích --}}
          <span class="badge">Địa điểm</span>
          <i class="fas fa-calendar-alt"></i> {{ $post->updated_at->format('d/m/Y') }}
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
        <button class="btn like"><i class="fas fa-heart"></i> Thích</button>
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

      <div class="comment">
        <img src="https://i.pravatar.cc/36?img=2" alt="avatar" />
        <div class="comment-body">
          <strong>Bình Minh</strong>
          Chuyến đi quá đẹp, mình cũng muốn thử!
          <div class="comment-actions">👍 Thích · 💬 Trả lời</div>
        </div>
      </div>

      <form class="comment-form">
        <textarea rows="3" placeholder="Viết bình luận..."></textarea>
        <button type="submit">Gửi bình luận</button>
      </form>
    </div>
  </div>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="author-box">
      <p>
        <img src="{{ $post->user && $post->user->avatar ? asset('storage/avatars/' . $post->user->avatar) : asset('default-avatar.png') }}" alt="" />
        <strong>{{ $post->user->username ?? 'Ẩn danh' }}</strong>
      </p>
      <a href="#">Xem hồ sơ</a>
    </div>

    <div class="related-box">
      <strong>Bài viết liên quan</strong>
      <a href="#">Khám phá Huế mộng mơ</a>
      <a href="#">Ẩm thực Hội An</a>
      <a href="#">Trekking ở Sapa</a>
    </div>
  </div>
  </div>
@endsection