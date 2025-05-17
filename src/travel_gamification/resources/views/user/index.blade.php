@extends('user.master')
@section('content')
<div class="container-index">
<div class="slider">
  <!-- Lớp ảnh nền -->
  <div class="slider-images">
    <img
      src="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2024/04/anh-bien-4.jpg"
      class="slide active"
    />
    <img
      src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQC7nDAgdISBszyj7r743tbGBZJenmQorkFMg&s"
      class="slide"
    />
    <img
      src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIGCekEF9R6QeLMdA7UH6UdxthAnuRNHqcEGqGku3lD8jzQynTX9jzlYJ86GpYIvCazCI&usqp=CAU"
      class="slide"
    />
  </div>
  <div class="overlay">
    <div class="content">
      <h1>Chia Sẻ Trải Nghiệm Du Lịch, Rinh Quà Cực Chất!</h1>
      <p>Viết bài, chia sẻ địa điểm yêu thích, nhận điểm thưởng & quà tặng mỗi ngày!</p>

      <div class="search-form">
        <div class="form-group">
          <i class="fas fa-map-marker-alt"></i>
          <input type="text" placeholder="Bạn muốn khám phá địa điểm nào?" />
        </div>
        <div class="form-group">
          <i class="fas fa-tags"></i>
          <select>
            <option>Chủ đề yêu thích</option>
            <option>Ẩm thực</option>
            <option>Check-in</option>
            <option>Phượt</option>
            <option>Family Trip</option>
          </select>
        </div>
        <div class="form-group">
          <i class="fas fa-search"></i>
          <input type="text" placeholder="Tìm kiếm bài chia sẻ, địa điểm..." />
        </div>
        <button class="search-btn"><i class="fas fa-compass"></i> Khám Phá Ngay</button>
      </div>

      <div class="highlight-box">
        <h4>Top Chia Sẻ Nổi Bật</h4>
        <p><strong>🏆 Ngọc Hii:</strong> Hành trình khám phá Đà Lạt cực chill 🌸</p>
        <p><strong>🥈 Anh Khoa:</strong> Ăn gì ở Phú Quốc? Trọn bộ list!</p>
        <p><strong>🥉 Minh Trang:</strong> Chinh phục Fansipan 2 ngày 1 đêm ⛰️</p>
      </div>
    </div>
  </div>
  <div class="slider-dots">
    <span class="dot active"></span>
    <span class="dot"></span>
    <span class="dot"></span>
  </div>
</div>

<!-- Font Awesome Icon -->

<!-- Font Awesome 6 CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<section class="intro-section">
  <h2>Chào mừng đến với Cộng Đồng Du Lịch Trải Nghiệm!</h2>
  <p>
    Chia sẻ chuyến đi, ghi dấu những hành trình, kết nối cùng hàng ngàn tín đồ xê dịch. Đăng bài
    nhận điểm thưởng và quà tặng hấp dẫn mỗi ngày!
  </p>
  <a href="#thamgia" class="join-btn">Tham Gia Ngay</a>
</section>

<section class="category-section">
  <h3>Khám phá theo loại hình du lịch</h3>
  <div class="categories">
    @foreach ($travelTypes as $type)
      <div class="category-card travel-type-filter" data-id="{{ $type->id }}">
        {{ $type->name }}
      </div>
    @endforeach
  </div>
</section>

<section class="top-user-section">
  <h3>Top Thành Viên Tháng Này 🔥</h3>
  <div class="top-users">
    <div class="user-card">
      <img src="https://i.pravatar.cc/100?img=1" alt="User 1" />
      <p><strong>Ngọc Hii</strong><br />🏆 5200 điểm</p>
    </div>
    <div class="user-card">
      <img src="https://i.pravatar.cc/100?img=2" alt="User 2" />
      <p><strong>Minh Trang</strong><br />🥈 4300 điểm</p>
    </div>
    <div class="user-card">
      <img src="https://i.pravatar.cc/100?img=3" alt="User 3" />
      <p><strong>Hải Đăng</strong><br />🥉 3900 điểm</p>
    </div>
  </div>
</section>

<section class="latest-posts-section">
  <div class="section-heading">Bài chia sẻ từ cộng đồng</div>

  <div class="posts" id="posts-list">
    <!-- Các post của người dùng -->
    @foreach ($posts as $post)
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
            <img src="default-image.png" alt="Default Image" />
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
          <div class="likes"><i class="fas fa-heart"></i> {{ $post->likes_count ?? 0 }} lượt thích</div>
          <div class="comments"><i class="fas fa-comment-alt"></i> {{ $post->comments_count ?? 0 }} bình luận</div>
        </div>
      </div>
    @endforeach
  </div>
  <div class="pagination-wrapper" id="posts-pagination">
    {!! $posts->appends(request()->except('posts_page'))->links() !!}
  </div>

  <div class="section-heading">Thông tin địa điểm du lịch</div>

    <div class="posts" id="destinations-list">
      @foreach ($destinations as $destination)
        <div class="post-card admin-post">
          {{-- Kiểm tra nếu có hình ảnh --}}
          @if ($destination->destinationImages && $destination->destinationImages->isNotEmpty())
            <img src="{{ $destination->destinationImages->first()->image_url }}" alt="{{ $destination->name }}" />
          @else
            <img src="default-image.png" alt="Default Image" />
          @endif

          {{-- Hiển thị tên địa điểm --}}
          <h3 style="text-align: center">{{ $destination->name }}</h3>

          {{-- Hiển thị đặc điểm nổi bật --}}
          <p class="post-excerpt" style="text-align: justify">
            {{ strip_tags($destination->highlights) }}
          </p>

          {{-- Hiển thị địa chỉ và giá --}}
          <div class="post-info-block">
            <div class="info-row">
              <i class="fas fa-location-dot"></i>
              <span>{{ $destination->address }}</span>
            </div>
            <div class="info-row">
              <i class="fas fa-dollar-sign"></i>
              <span>{{ $destination->price }}</span>
            </div>

            <hr class="info-divider" />

            {{-- Footer thông tin --}}
            <div class="info-footer">
              <span><i class="fas fa-calendar-alt"></i> {{ $destination->updated_at->format('d/m/Y') }}</span>
              <span><i class="fas fa-heart" style="color: #e74c3c"></i> 135 lượt thích</span>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class="pagination-wrapper" id="destinations-pagination">
      {!! $destinations->appends(request()->except('destinations_page'))->links() !!}
    </div>
</div>
{{-- <input type="hidden" id="selected-travel-type" value=""> --}}
    <!-- ... -->
  </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
$(document).on('click', '#posts-pagination a', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $.get(url, function(data) {
        $('#posts-list').html($(data).find('#posts-list').html());
        $('#posts-pagination').html($(data).find('#posts-pagination').html());
        window.history.pushState({}, '', url);
        // Đợi DOM cập nhật xong rồi mới cuộn
        setTimeout(function() {
            var offset = $('#posts-list').offset();
            if(offset) {
                $('html, body').animate({
                    scrollTop: offset.top - 80
                }, 400);
            }
        }, 50);
    });
});

$(document).on('click', '#destinations-pagination a', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $.get(url, function(data) {
        $('#destinations-list').html($(data).find('#destinations-list').html());
        $('#destinations-pagination').html($(data).find('#destinations-pagination').html());
        window.history.pushState({}, '', url);
        setTimeout(function() {
            var offset = $('#destinations-list').offset();
            if(offset) {
                $('html, body').animate({
                    scrollTop: offset.top - 80
                }, 400);
            }
        }, 50);
    });
});
</script>
@endsection