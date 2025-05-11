@extends('user.master')
@section('content')
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
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
/>
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
      <div class="category-card">
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

  <div class="posts">
    <!-- Các post của người dùng -->
    <div class="post-card user-post">
      <img src="../1.png" alt="Post 1" />

      <h4>10 điểm check-in biển đẹp nhất Việt Nam</h4>

      <p class="post-excerpt">
        Đây là danh sách những bãi biển đẹp mê hồn mà bạn nhất định phải ghé qua khi đến Việt
        Nam. Từ nước biển trong xanh đến bãi cát trắng mịn màng, mỗi nơi đều có vẻ đẹp riêng
        biệt...
      </p>

      <div class="post-meta">
        <div class="meta-left"><i class="fas fa-user"></i> Ngọc Hii</div>
        <div class="meta-right"><i class="fas fa-calendar-alt"></i> 2 ngày trước</div>
      </div>

      <div class="post-stats">
        <div class="likes"><i class="fas fa-heart"></i> 128 lượt thích</div>
        <div class="comments"><i class="fas fa-comment-alt"></i> 24 bình luận</div>
      </div>
    </div>

    <div class="post-card user-post">
      <img src="../1.png" alt="Post 1" />

      <h4>10 điểm check-in biển đẹp nhất Việt Nam</h4>

      <p class="post-excerpt">
        Đây là danh sách những bãi biển đẹp mê hồn mà bạn nhất định phải ghé qua khi đến Việt
        Nam. Từ nước biển trong xanh đến bãi cát trắng mịn màng, mỗi nơi đều có vẻ đẹp riêng
        biệt...
      </p>

      <div class="post-meta">
        <div class="meta-left"><i class="fas fa-user"></i> Ngọc Hii</div>
        <div class="meta-right"><i class="fas fa-calendar-alt"></i> 2 ngày trước</div>
      </div>

      <div class="post-stats">
        <div class="likes"><i class="fas fa-heart"></i> 128 lượt thích</div>
        <div class="comments"><i class="fas fa-comment-alt"></i> 24 bình luận</div>
      </div>
    </div>

    <div class="post-card user-post">
      <img src="../1.png" alt="Post 1" />

      <h4>10 điểm check-in biển đẹp nhất Việt Nam</h4>

      <p class="post-excerpt">
        Đây là danh sách những bãi biển đẹp mê hồn mà bạn nhất định phải ghé qua khi đến Việt
        Nam. Từ nước biển trong xanh đến bãi cát trắng mịn màng, mỗi nơi đều có vẻ đẹp riêng
        biệt...
      </p>

      <div class="post-meta">
        <div class="meta-left"><i class="fas fa-user"></i> Ngọc Hii</div>
        <div class="meta-right"><i class="fas fa-calendar-alt"></i> 2 ngày trước</div>
      </div>

      <div class="post-stats">
        <div class="likes"><i class="fas fa-heart"></i> 128 lượt thích</div>
        <div class="comments"><i class="fas fa-comment-alt"></i> 24 bình luận</div>
      </div>
    </div>

    <div class="post-card user-post">
      <img src="../1.png" alt="Post 1" />

      <h4>10 điểm check-in biển đẹp nhất Việt Nam</h4>

      <p class="post-excerpt">
        Đây là danh sách những bãi biển đẹp mê hồn mà bạn nhất định phải ghé qua khi đến Việt
        Nam. Từ nước biển trong xanh đến bãi cát trắng mịn màng, mỗi nơi đều có vẻ đẹp riêng
        biệt...
      </p>

      <div class="post-meta">
        <div class="meta-left"><i class="fas fa-user"></i> Ngọc Hii</div>
        <div class="meta-right"><i class="fas fa-calendar-alt"></i> 2 ngày trước</div>
      </div>

      <div class="post-stats">
        <div class="likes"><i class="fas fa-heart"></i> 128 lượt thích</div>
        <div class="comments"><i class="fas fa-comment-alt"></i> 24 bình luận</div>
      </div>
    </div>

    <div class="post-card user-post">
      <img src="../1.png" alt="Post 1" />

      <h4>10 điểm check-in biển đẹp nhất Việt Nam</h4>

      <p class="post-excerpt">
        Đây là danh sách những bãi biển đẹp mê hồn mà bạn nhất định phải ghé qua khi đến Việt
        Nam. Từ nước biển trong xanh đến bãi cát trắng mịn màng, mỗi nơi đều có vẻ đẹp riêng
        biệt...
      </p>

      <div class="post-meta">
        <div class="meta-left"><i class="fas fa-user"></i> Ngọc Hii</div>
        <div class="meta-right"><i class="fas fa-calendar-alt"></i> 2 ngày trước</div>
      </div>

      <div class="post-stats">
        <div class="likes"><i class="fas fa-heart"></i> 128 lượt thích</div>
        <div class="comments"><i class="fas fa-comment-alt"></i> 24 bình luận</div>
      </div>
    </div>
    <!-- ... -->
  </div>

  <div class="section-heading">Thông tin địa điểm du lịch</div>

    <div class="posts">
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

    
    <!-- ... -->
  </div>
</section>