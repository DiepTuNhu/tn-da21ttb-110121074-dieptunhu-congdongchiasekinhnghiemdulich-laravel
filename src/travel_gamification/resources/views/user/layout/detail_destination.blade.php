@extends('user.master')
@section('content')
<div class="container-destination">
      <div class="location-header">
        <div class="gallery">
          {{-- Ảnh chính --}}
          <div class="main-image">
              @if ($mainImage)
                  <img id="mainDisplay" src="{{ $mainImage->image_url }}" alt="Ảnh chính">
              @else
                  <img id="mainDisplay" src="default-image.png" alt="Ảnh mặc định">
              @endif
          </div>

          {{-- Ảnh phụ --}}
          <div class="thumb-container">
              <button class="nav-btn left" onclick="scrollThumbs(-1)">❮</button>
              <div class="thumbnails" id="thumbnailList">
                  @foreach ($subImages as $image)
                      <img style="height: 80px; width: 105px" src="{{ $image->image_url }}" onclick="showImage(this)">
                  @endforeach
              </div>
              <button class="nav-btn right" onclick="scrollThumbs(1)">❯</button>
          </div>
        </div>

        <div class="map-preview">
            <div class="location-info">
              <h2>{{ $destination->name }}</h2>
              <div class="mb-3" style="display: flex; gap: 10px;">
                <a href="{{ route('post_articles', ['type' => 'destination', 'destination_id' => $destination->id]) }}" class="btn btn-primary">
                    <i class="fa fa-pen"></i>Thêm bài viết
                </a>
                <a href="{{ route('page.community', ['destination_id' => $destination->id]) }}" class="btn btn-outline-secondary">
                    <i class="fa fa-book-open"></i>Xem bài viết
                </a>
            </div>
              <p><strong>Địa chỉ:</strong> {{ $destination->address }}</p>
              <p><strong>Giá:</strong> {{ $destination->price }}</p>
              <p><strong>Bản đồ:</strong></p>
          </div>
          <iframe
              src="{{ $mapUrl }}"
              width="600"
              height="450"
              style="border:0;"
              allowfullscreen=""
              loading="lazy"
          ></iframe>
        </div>
      </div>

      <!-- Thông tin mô tả -->
      <div>
        <h3 class="section-title">Thông tin mô tả</h3>
        <div class="info-grid">
              <div class="info-card">
    <strong class="toggle-desc" style="cursor:pointer;">
        Đặc điểm nổi bật
        <span class="arrow-icon" style="margin-left:8px;"><i class="fa-solid fa-angle-down"></i></span>
    </strong>
    <div class="desc-content" style="display:none;">
        {!! $destination->highlights ?? 'Thông tin đang được cập nhật.' !!}
    </div>
</div>
<div class="info-card">
    <strong class="toggle-desc" style="cursor:pointer;">
        Ẩm thực địa phương
        <span class="arrow-icon" style="margin-left:8px;"><i class="fa-solid fa-angle-down"></i></span>
    </strong>
    <div class="desc-content" style="display:none;">
        {!! $destination->local_cuisine ?? 'Thông tin đang được cập nhật.' !!}
    </div>
</div>
<div class="info-card">
    <strong class="toggle-desc" style="cursor:pointer;">
        Thời điểm lý tưởng
        <span class="arrow-icon" style="margin-left:8px;"><i class="fa-solid fa-angle-down"></i></span>
    </strong>
    <div class="desc-content" style="display:none;">
        {!! $destination->best_time ?? 'Thông tin đang được cập nhật.' !!}
    </div>
</div>
<div class="info-card">
    <strong class="toggle-desc" style="cursor:pointer;">
        Di chuyển
        <span class="arrow-icon" style="margin-left:8px;"><i class="fa-solid fa-angle-down"></i></span>
    </strong>
    <div class="desc-content" style="display:none;">
        {!! $destination->transportation ?? 'Thông tin đang được cập nhật.' !!}
    </div>
</div>
        </div>
      </div>

      <!-- Tiện ích xung quanh -->
      <div>
        <h3 class="section-title">Tiện ích xung quanh</h3>

        <div class="utility-tabs">
            <button class="tab-btn active" data-tab="food">🍽 Ẩm thực</button>
            <button class="tab-btn" data-tab="stay">🛏 Lưu trú</button>
        </div>

        <div class="utility-content active" id="food">
            <div class="utility-grid">
                @forelse ($foodUtilities as $utility)
                    <div class="utility-card">
                        <a href="{{ route('utility.detail', $utility->utility->id) }}">
                            <img src="{{ $utility->utility->image ? asset('storage/utility_image/' . $utility->utility->image) : asset('default-image.png') }}" 
                                alt="{{ $utility->utility->name }}" />
                            <div class="content">
                                <h4>{{ $utility->utility->name }}</h4>
                                <p><strong>Khoảng cách:</strong> {{ number_format($utility->distance, 2) }} km</p>
                            </div>
                        </a>
                    </div>
@empty
    <p>Không có tiện ích nào thuộc loại Ẩm thực.</p>
@endforelse
            </div>
            {{-- <div class="d-flex justify-content-center mt-3">
        {{ $foodUtilities->links('pagination::bootstrap-4') }}
    </div> --}}
        <div class="pagination">
      {{ $foodUtilities->links() }}
    </div>
        </div>

        <div class="utility-content" id="stay">
            <div class="utility-grid">
                @forelse ($stayUtilities as $utility)
    <div class="utility-card">
        <a href="{{ route('utility.detail', $utility->utility->id) }}">
            <img src="{{ $utility->utility->image ? asset('storage/utility_image/' . $utility->utility->image) : asset('default-image.png') }}" 
                 alt="{{ $utility->utility->name }}" />
            <div class="content">
                <h4>{{ $utility->utility->name }}</h4>
                <p><strong>Khoảng cách:</strong> {{ number_format($utility->distance, 2) }} km</p>
            </div>
        </a>
    </div>
@empty
    <p>Không có tiện ích nào thuộc loại Lưu trú.</p>
@endforelse
            </div>
            <div class="pagination">
                {{ $stayUtilities->links() }}
            </div>
        </div>
      </div>
    </div>

    <script>
    function showImage(img) {
        const mainDisplay = document.getElementById('mainDisplay');
        mainDisplay.src = img.src; // Thay đổi ảnh chính bằng ảnh được click
    }

    function scrollThumbs(direction) {
        const thumbnailList = document.getElementById('thumbnailList');
        thumbnailList.scrollBy({
            left: direction * 100, // Cuộn 100px theo hướng
            behavior: 'smooth'
        });
    }
</script>
<!-- tab nội dung tiện ích -->
<script>
    const tabButtons = document.querySelectorAll(".tab-btn");
    const tabContents = document.querySelectorAll(".utility-content");

    tabButtons.forEach((button) => {
        button.addEventListener("click", () => {
            // Xóa class "active" khỏi tất cả các nút và nội dung
            tabButtons.forEach((btn) => btn.classList.remove("active"));
            tabContents.forEach((content) => content.classList.remove("active"));

            // Thêm class "active" vào nút và nội dung được chọn
            button.classList.add("active");
            document.getElementById(button.dataset.tab).classList.add("active");
        });
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.info-card').forEach(function(card) {
        card.addEventListener('click', function() {
            const content = this.querySelector('.desc-content');
            const arrow = this.querySelector('.arrow-icon');
            // Ẩn tất cả nội dung khác và reset icon
            document.querySelectorAll('.desc-content').forEach(function(desc) {
                if (desc !== content) desc.style.display = 'none';
            });
            document.querySelectorAll('.arrow-icon').forEach(function(icon) {
                if (icon !== arrow) icon.innerHTML = '<i class="fa-solid fa-angle-down"></i>'; // mũi tên xuống
            });
            // Toggle nội dung hiện tại và đổi icon
            if (content.style.display === 'block') {
                content.style.display = 'none';
                if (arrow) arrow.innerHTML = '<i class="fa-solid fa-angle-down"></i>'; // mũi tên xuống
            } else {
                content.style.display = 'block';
                if (arrow) arrow.innerHTML = '<i class="fa-solid fa-angle-up"></i>'; // mũi tên lên
            }
        });
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gọi hàm này khi vào trang chi tiết địa điểm
    if (window.markDestinationAsViewed) {
        markDestinationAsViewed({{ $destination->id }});
    } else {
        // Nếu chưa có hàm, tự tạo luôn cho chắc
        let id = {{ $destination->id }};
        let viewed = JSON.parse(localStorage.getItem('viewed_destinations') || '[]');
        if (!viewed.includes(id)) {
            viewed.unshift(id);
            if (viewed.length > 20) viewed = viewed.slice(0, 20);
            localStorage.setItem('viewed_destinations', JSON.stringify(viewed));
        }
    }
});
</script>
@endsection