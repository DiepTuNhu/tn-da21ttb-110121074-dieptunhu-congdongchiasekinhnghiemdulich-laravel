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
      <p>Chia sẻ niềm vui du lịch – tích điểm và đổi quà mỗi ngày cùng cộng đồng đam mê khám phá!</p>

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
          @foreach($topPosts as $index => $post)
            <p>
              <strong>
@if($index == 0)
  <span style="font-size:1.2em;font-weight:bold;color:#ffd700;">
    <i class="fas fa-crown"></i> 
  </span>
@elseif($index == 1)
  <span style="font-size:1.2em;font-weight:bold;color:#b0c4de;">
    <i class="fas fa-medal"></i> 
  </span>
@elseif($index == 2)
  <span style="font-size:1.2em;font-weight:bold;color:#cd7f32;">
    <i class="fas fa-award"></i> 
  </span>
@endif
                  {{ $post->user->username ?? 'Ẩn danh' }}:
              </strong>
              <a href="{{ route('post.detail', $post->id) }}" style="color:#a1ef48;">
                  {{ Str::limit($post->title, 60) }}
              </a>
            </p>
          @endforeach
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

{{-- <section class="intro-section">
  <h2>Chào mừng đến với Cộng Đồng Du Lịch Trải Nghiệm!</h2>
  <p>
    Viết về những nơi bạn đã đi qua - Gửi gắm cảm hứng đến hàng ngàn người đam mê du lịch - Tích lũy điểm thưởng và mở ra những trải nghiệm mới mỗi ngày!
  </p>
  <a href="{{ route('register') }}" class="join-btn">Tham Gia Ngay</a>
</section> --}}

{{-- <section class="category-section">
  <h3>Khám phá theo loại hình du lịch</h3>
  <div class="categories">
    @foreach ($travelTypes as $type)
      <div class="category-card travel-type-filter" data-id="{{ $type->id }}">
        {{ $type->name }}
      </div>
    @endforeach
  </div>
</section> --}}



<section class="latest-posts-section">
    <div class="section-heading">Thông tin địa điểm du lịch</div>
      <div id="admin-posts-wrapper">
          @include('user.layout.partials.admin_posts_list', ['posts' => $posts])
      </div>
    
      <div class="pagination-wrapper" id="destinations-pagination">
        {!! $destinations->appends(request()->except('destinations_page'))->links() !!}
      </div>

      <hr style="margin: 0 400px; border: 1px solid #ddd;">

      <div class="section-heading">Bài chia sẻ từ cộng đồng</div>

        <div id="user-posts-wrapper">
          @include('user.layout.partials.user_posts_list', ['posts' => $posts])
        </div>

        <div class="pagination-wrapper" id="posts-pagination">
        {!! $posts->appends(request()->except('posts_page'))->links() !!}
      </div>

      @if(isset($users) && count($users))
          <div class="section-heading">Người dùng liên quan</div>
          <div class="user-search-list" style="display:flex;gap:24px;flex-wrap:wrap;justify-content:center; margin: 20px;">
              {{-- Hiển thị danh sách người dùng --}}
              @foreach($users as $user)
                  <a href="{{ route('detail_user_follow', $user->id) }}" style="text-decoration:none;">
                      <div class="user-card" style="min-width:160px;text-align:center;">
                          <img src="{{ $user->avatar 
                              ? (Str::startsWith($user->avatar, ['http://', 'https://']) 
                                  ? $user->avatar 
                                  : asset('storage/avatars/' . $user->avatar)
                              ) 
                              : asset('storage/default.jpg') 
                          }}" alt="{{ $user->username }}" style="width:64px;height:64px;border-radius:50%;object-fit:cover;margin-bottom:8px;">
                          <div style="font-weight:bold;color:#48c6ef;">{{ $user->username ?? 'Ẩn danh' }}</div>
                      </div>
                  </a>
              @endforeach
          </div>
      @endif
    </div>
{{-- <input type="hidden" id="selected-travel-type" value=""> --}}
    <!-- ... -->
  </div>
</section>
    <hr style="margin: 0 600px; border: 1px solid #ddd;">

<section class="features-section" style="display:flex;justify-content:center;gap:32px;margin-bottom:32px;">
    <div class="feature-box" style="background:#fff;border-radius:16px;box-shadow:0 2px 12px #a1ef4840;padding:24px 18px;min-width:180px;text-align:center;">
        <i class="fas fa-gift" style="font-size:2rem;color:#a1ef48"></i>
        <h4 style="margin:12px 0 6px;">Tích điểm đổi quà</h4>
        <p style="font-size:0.98rem;">Đăng bài viết, nhận điểm thưởng và đổi lấy phần quà hấp dẫn.</p>
    </div>
    <div class="feature-box" style="background:#fff;border-radius:16px;box-shadow:0 2px 12px #48c6ef40;padding:24px 18px;min-width:180px;text-align:center;">
        <i class="fas fa-trophy" style="font-size:2rem;color:#48c6ef"></i>
        <h4 style="margin:12px 0 6px;">Thử thách du lịch</h4>
        <p style="font-size:0.98rem;">Tham gia các thử thách, sự kiện và nhận huy hiệu thành tích.</p>
    </div>
    <div class="feature-box" style="background:#fff;border-radius:16px;box-shadow:0 2px 12px #a1ef4840;padding:24px 18px;min-width:180px;text-align:center;">
        <i class="fas fa-users" style="font-size:2rem;color:#a1ef48"></i>
        <h4 style="margin:12px 0 6px;">Kết nối bạn bè</h4>
        <p style="font-size:0.98rem;">Giao lưu, kết bạn và chia sẻ hành trình cùng cộng đồng.</p>
    </div>
</section>
    <hr style="margin: 0 600px; border: 1px solid #ddd;">

<section class="top-user-section">
<h3>Top Thành Viên Tháng Này <i class="fas fa-fire" style="color:#ff5722"></i></h3>
  <div class="top-users">
    @foreach($topUsers as $index => $user)
    <a href="{{ route('detail_user_follow', $user->id) }}" style="text-decoration:none;">
      <div class="user-card">
          <img src="{{ 
            $user->avatar 
                ? (Str::startsWith($user->avatar, ['http://', 'https://']) 
                    ? $user->avatar 
                    : asset('storage/avatars/' . $user->avatar)
                ) 
                : asset('storage/default.jpg') 
          }}" alt="{{ $user->username }}" />
          <p>
            <strong>{{ $user->username ?? 'Ẩn danh' }}</strong><br />
            @if($index == 0)
              <span style="font-size:1.2em;font-weight:bold;color:#ffd700;">
                <i class="fas fa-crown"></i> 
              </span>
            @elseif($index == 1)
              <span style="font-size:1.2em;font-weight:bold;color:#b0c4de;">
                <i class="fas fa-medal"></i> 
              </span>
            @elseif($index == 2)
              <span style="font-size:1.2em;font-weight:bold;color:#cd7f32;">
                <i class="fas fa-award"></i> 
              </span>
            @endif
            {{ number_format($user->redeemable_points) }} điểm
          </p>
        </div>
      </a>
        @endforeach
  </div>
</section>

    <hr style="margin: 0 600px; border: 1px solid #ddd;">

<section class="stats-section">
    <div class="stat-box">
        <i class="fas fa-users icon blue"></i>
        <div class="number blue" data-count="{{ $userCount }}">0</div>
        <div class="label">Thành viên</div>
    </div>
    <div class="stat-box">
        <i class="fas fa-pen-nib icon green"></i>
        <div class="number green" data-count="{{ $postCount }}">0</div>
        <div class="label">Bài viết</div>
    </div>
    <div class="stat-box">
        <i class="fas fa-map-marker-alt icon blue"></i>
        <div class="number blue" data-count="{{ $destinationCount }}">0</div>
        <div class="label">Địa điểm</div>
    </div>
</section>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const easeOut = t => 1 - Math.pow(1 - t, 3); // Cubic easing for smoothness
    const duration = 1500; // 1.5s

    document.querySelectorAll('.number').forEach(el => {
        const target = parseInt(el.dataset.count);
        const start = 0;
        const startTime = performance.now();

        const animate = (now) => {
            const elapsed = now - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const eased = easeOut(progress);
            const current = Math.floor(start + (target - start) * eased);
            el.textContent = current.toLocaleString();

            if (progress < 1) requestAnimationFrame(animate);
            else el.textContent = target.toLocaleString(); // fix rounding
        };

        requestAnimationFrame(animate);
    });
});
</script>


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

<script>
    $(document).ready(function() {
        $('#travelTypeSelect').on('change', function() {
            var travelTypeId = $(this).val();

            $.ajax({
                url: '{{ route("filter.destinations.by.traveltype") }}', // Ensure this route exists in your web.php
                type: 'GET',
                data: {
                    travel_type_id: travelTypeId
                },
                success: function(data) {
                    // Update the destinations section with the filtered data
                    $('#admin-posts-wrapper').html(data);
                },
                error: function() {
                    alert('Lỗi khi lọc địa điểm.');
                }
            });
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
<script>
    document.getElementById('travelTypeSelect').addEventListener('change', function () {
        const travelTypeId = this.value;
        const searchKeyword = document.querySelector('input[name="keyword"]').value;

        fetch(`/ajax/filter-destinations?travel_type_id=${travelTypeId}&keyword=${encodeURIComponent(searchKeyword)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Cập nhật danh sách địa điểm
                if (data.destinationsHtml) {
                    document.getElementById('admin-posts-wrapper').innerHTML = data.destinationsHtml;
                }

                // Cập nhật danh sách bài viết
                if (data.postsHtml) {
                    document.getElementById('user-posts-wrapper').innerHTML = data.postsHtml;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Đã xảy ra lỗi khi lọc dữ liệu. Vui lòng thử lại.');
            });
    });
</script>
<script>
    $(document).ready(function() {
        // Bắt sự kiện change cho select loại hình du lịch
        $('#travelTypeSelect').on('change', function() {
            var selectedTravelTypeId = $(this).val();

            // Gọi AJAX để lọc địa điểm và bài viết
            $.ajax({
                url: '/ajax/filter-destinations',
                type: 'GET',
                data: { travel_type_id: selectedTravelTypeId },
                success: function(response) {
                    $('#admin-posts-wrapper').html(response.destinationsHtml);
                    $('#user-posts-wrapper').html(response.postsHtml);
                },
                error: function() {
                    console.error('Lỗi khi gọi AJAX');
                }
            });
        });
    });
</script>
@endsection