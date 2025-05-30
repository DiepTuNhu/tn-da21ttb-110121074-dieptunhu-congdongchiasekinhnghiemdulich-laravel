@extends('user.master')
@section('content')
<div class="container-index">
<div class="slider">
  <!-- Lớp ảnh nền -->
  <div class="slider-images">
    @foreach($slides as $key => $slide)
        <img
            src="{{ asset('storage/slide_image/' . $slide->image) }}"
            class="slide{{ $key === 0 ? ' active' : '' }}"
            alt="{{ $slide->title ?? 'Slide' }}"
        />
    @endforeach
  </div>
  <div class="overlay">
    <div class="content">
      <h1>Du lịch không chỉ đi, mà còn chơi và chia sẻ!</h1>
      <p>Chia sẻ niềm vui du lịch – tích điểm mỗi ngày cùng cộng đồng mê khám phá!</p>

      <form action="{{ route('user.search') }}" method="GET">
          <div class="search-form">
              <div class="form-group" style="display: flex; align-items: center;">
                  {{-- Dropdown loại hình du lịch --}}
                  <select name="travel_type_id" id="travelTypeSelect" class="form-control" style="width:180px; margin-right:10px; height: 60px;">
                      <option value="">Tất cả loại hình</option>
                      @foreach($travelTypes as $type)
                          <option value="{{ $type->id }}" {{ request('travel_type_id') == $type->id ? 'selected' : '' }}>
                              {{ $type->name }}
                          </option>
                      @endforeach
                  </select>
                  <i class="fas fa-map-marker-alt"></i>
                  <input type="text" name="keyword" placeholder="Bạn muốn khám phá địa điểm nào?" value="{{ request('keyword') }}" style="width: 500px; height: 60px" />
              </div>
              <button type="submit" class="search-btn"><i class="fas fa-compass"></i> Khám Phá Ngay</button>
          </div>
      </form>

      <div class="highlight-box">
        <h4>Top Chia Sẻ Nổi Bật</h4>
        <p><strong>🏆 Ngọc Hii:</strong> Hành trình khám phá Đà Lạt cực chill 🌸</p>
        <p><strong>🥈 Anh Khoa:</strong> Ăn gì ở Phú Quốc? Trọn bộ list!</p>
        <p><strong>🥉 Minh Trang:</strong> Chinh phục Fansipan 2 ngày 1 đêm ⛰️</p>
      </div>
    </div>
  </div>
  <div class="slider-dots">
    @foreach($slides as $key => $slide)
        <span class="dot{{ $key === 0 ? ' active' : '' }}"></span>
    @endforeach
  </div>
</div>

<!-- Font Awesome Icon -->

<!-- Font Awesome 6 CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<section class="intro-section">
  <h2>Chào mừng đến với Cộng Đồng Du Lịch Trải Nghiệm!</h2>
  <p>
    Viết về những nơi bạn đã đi qua - Gửi gắm cảm hứng đến hàng ngàn người đam mê du lịch - Tích lũy điểm thưởng và mở ra những trải nghiệm mới mỗi ngày!
  </p>
  <a href="{{ route('register') }}" class="join-btn">Tham Gia Ngay</a>
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
    <div class="section-heading">Thông tin địa điểm du lịch</div>
    <div id="admin-posts-wrapper">
        @include('user.layout.partials.admin_posts_list', ['posts' => $posts])
    </div>
    
    <div class="pagination-wrapper" id="destinations-pagination">
      {!! $destinations->appends(request()->except('destinations_page'))->links() !!}
    </div>
  <div class="section-heading">Bài chia sẻ từ cộng đồng</div>

    <div id="user-posts-wrapper">
      @include('user.layout.partials.user_posts_list', ['posts' => $posts])
    </div>

    <div class="pagination-wrapper" id="posts-pagination">
      {!! $posts->appends(request()->except('posts_page'))->links() !!}
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
        $('#user-posts-wrapper').html($(data).find('#user-posts-wrapper').html());
        $('#posts-pagination').html($(data).find('#posts-pagination').html());
        window.history.pushState({}, '', url);
        // Đợi DOM cập nhật xong rồi mới cuộn
        setTimeout(function() {
            var offset = $('#user-posts-wrapper').offset();
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
        $('#admin-posts-wrapper').html($(data).find('#admin-posts-wrapper').html());
        $('#destinations-pagination').html($(data).find('#destinations-pagination').html());
        window.history.pushState({}, '', url);
        setTimeout(function() {
            var offset = $('#admin-posts-wrapper').offset();
            if(offset) {
                $('html, body').animate({
                    scrollTop: offset.top - 80
                }, 400);
            }
        }, 50);
    });
});
</script>

<script>
$(document).on('click', '.travel-type-filter', function() {
    var travelTypeId = $(this).data('id');

    $.ajax({
        url: '{{ route("filter.posts.by.traveltype") }}',
        type: 'GET',
        data: {
            type_id: travelTypeId
        },
        success: function(data) {
            $('#user-posts-wrapper').html(data.userHtml);
            $('#admin-posts-wrapper').html(data.adminHtml);

            // ✅ Thêm đoạn này để cuộn xuống
            $('html, body').animate({
                scrollTop: $('#admin-posts-wrapper').offset().top
            }, 600); // 600ms để cuộn mượt
        },
        error: function() {
            alert('Lỗi khi lọc bài viết');
        }
      });
    });
</script>

@if(request('keyword'))
<script>
    window.onload = function() {
        var el = document.getElementById('admin-posts-wrapper');
        if(el) el.scrollIntoView({ behavior: 'smooth' });
    }
</script>
@endif
@endsection