@extends('user.master')
@section('content')
<div class="container-content">
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
                      <img src="{{ $image->image_url }}" onclick="showImage(this)">
                  @endforeach
              </div>
              <button class="nav-btn right" onclick="scrollThumbs(1)">❯</button>
          </div>
        </div>

        <div class="map-preview">
          <div class="location-info">
              <h2>{{ $destination->name }}</h2>
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
        <strong>Đặc điểm nổi bật</strong>
        <p>
            {!! $destination->highlights ?? 'Thông tin đang được cập nhật.' !!}
        </p>
    </div>
    <div class="info-card">
        <strong>Hoạt động du lịch</strong>
        <p>
            {!! $destination->activities ?? 'Thông tin đang được cập nhật.' !!}
        </p>
    </div>
    <div class="info-card">
        <strong>Thời điểm lý tưởng</strong>
        <p>
            {!! $destination->ideal_time ?? 'Thông tin đang được cập nhật.' !!}
        </p>
    </div>
    <div class="info-card">
        <strong>Phương tiện di chuyển</strong>
        <p>
            {!! $destination->transportation ?? 'Thông tin đang được cập nhật.' !!}
        </p>
    </div>
        </div>
      </div>

      <!-- Tiện ích xung quanh -->
      <div>
        <h3 class="section-title">Tiện ích xung quanh</h3>

        <div class="utility-tabs">
          <button class="tab-btn active" data-tab="food">🍽 Ẩm thực</button>
          <button class="tab-btn" data-tab="stay">🛏 Lưu trú</button>
          <button class="tab-btn" data-tab="shop">🛍 Mua sắm</button>
          <button class="tab-btn" data-tab="activity">🧭 Hoạt động</button>
        </div>

        <div class="utility-content active" id="food">
          <div class="utility-grid">
            <div class="utility-card">
              <img src="../food1.jpg" alt="" />
              <div class="content">
                <h4>Bánh căn</h4>
                <p>Món đặc sản Đà Lạt</p>
              </div>
            </div>
            <div class="utility-card">
              <img src="../food2.jpg" alt="" />
              <div class="content">
                <h4>Lẩu gà lá é</h4>
                <p>Món ăn nóng hổi cho thời tiết lạnh</p>
              </div>
            </div>
            <div class="utility-card">
              <img src="../food1.jpg" alt="" />
              <div class="content">
                <h4>Bánh căn</h4>
                <p>Món đặc sản Đà Lạt</p>
              </div>
            </div>
            <div class="utility-card">
              <img src="../food2.jpg" alt="" />
              <div class="content">
                <h4>Lẩu gà lá é</h4>
                <p>Món ăn nóng hổi cho thời tiết lạnh</p>
              </div>
            </div>
            <div class="utility-card">
              <img src="../food1.jpg" alt="" />
              <div class="content">
                <h4>Bánh căn</h4>
                <p>Món đặc sản Đà Lạt</p>
              </div>
            </div>
            <div class="utility-card">
              <img src="../food2.jpg" alt="" />
              <div class="content">
                <h4>Lẩu gà lá é</h4>
                <p>Món ăn nóng hổi cho thời tiết lạnh</p>
              </div>
            </div>
          </div>
        </div>

        <div class="utility-content" id="stay">
          <div class="utility-grid">
            <div class="utility-card">
              <img src="../homestay.jpg" alt="" />
              <div class="content">
                <h4>Sunny Homestay</h4>
                <p>Gần trung tâm, view đồi</p>
              </div>
            </div>
            <div class="utility-card">
              <img src="../homestay.jpg" alt="" />
              <div class="content">
                <h4>Sunny Homestay</h4>
                <p>Gần trung tâm, view đồi</p>
              </div>
            </div>
            <div class="utility-card">
              <img src="../homestay.jpg" alt="" />
              <div class="content">
                <h4>Sunny Homestay</h4>
                <p>Gần trung tâm, view đồi</p>
              </div>
            </div>
            <div class="utility-card">
              <img src="../homestay.jpg" alt="" />
              <div class="content">
                <h4>Sunny Homestay</h4>
                <p>Gần trung tâm, view đồi</p>
              </div>
            </div>
            <div class="utility-card">
              <img src="../homestay.jpg" alt="" />
              <div class="content">
                <h4>Sunny Homestay</h4>
                <p>Gần trung tâm, view đồi</p>
              </div>
            </div>
          </div>
        </div>

        <div class="utility-content" id="shop">
          <div class="utility-grid">
            <div class="utility-card">
              <img src="../cho.jpg" alt="" />
              <div class="content">
                <h4>Chợ Đà Lạt</h4>
                <p>Đặc sản, rau củ, đồ lưu niệm</p>
              </div>
            </div>
            <div class="utility-card">
              <img src="../cho.jpg" alt="" />
              <div class="content">
                <h4>Chợ Đà Lạt</h4>
                <p>Đặc sản, rau củ, đồ lưu niệm</p>
              </div>
            </div>
            <div class="utility-card">
              <img src="../cho.jpg" alt="" />
              <div class="content">
                <h4>Chợ Đà Lạt</h4>
                <p>Đặc sản, rau củ, đồ lưu niệm</p>
              </div>
            </div>
            <div class="utility-card">
              <img src="../cho.jpg" alt="" />
              <div class="content">
                <h4>Chợ Đà Lạt</h4>
                <p>Đặc sản, rau củ, đồ lưu niệm</p>
              </div>
            </div>
            <div class="utility-card">
              <img src="../cho.jpg" alt="" />
              <div class="content">
                <h4>Chợ Đà Lạt</h4>
                <p>Đặc sản, rau củ, đồ lưu niệm</p>
              </div>
            </div>
          </div>
        </div>

        <div class="utility-content" id="activity">
          <div class="utility-grid">
            <div class="utility-card">
              <img src="../zipline.jpg" alt="" />
              <div class="content">
                <h4>Trượt zipline</h4>
                <p>Trải nghiệm mạo hiểm tại thác</p>
              </div>
            </div>
            <div class="utility-card">
              <img src="../zipline.jpg" alt="" />
              <div class="content">
                <h4>Trượt zipline</h4>
                <p>Trải nghiệm mạo hiểm tại thác</p>
              </div>
            </div>
            <div class="utility-card">
              <img src="../zipline.jpg" alt="" />
              <div class="content">
                <h4>Trượt zipline</h4>
                <p>Trải nghiệm mạo hiểm tại thác</p>
              </div>
            </div>
            <div class="utility-card">
              <img src="../zipline.jpg" alt="" />
              <div class="content">
                <h4>Trượt zipline</h4>
                <p>Trải nghiệm mạo hiểm tại thác</p>
              </div>
            </div>
            <div class="utility-card">
              <img src="../zipline.jpg" alt="" />
              <div class="content">
                <h4>Trượt zipline</h4>
                <p>Trải nghiệm mạo hiểm tại thác</p>
              </div>
            </div>
            <div class="utility-card">
              <img src="../zipline.jpg" alt="" />
              <div class="content">
                <h4>Trượt zipline</h4>
                <p>Trải nghiệm mạo hiểm tại thác</p>
              </div>
            </div>
            <div class="utility-card">
              <img src="../zipline.jpg" alt="" />
              <div class="content">
                <h4>Trượt zipline</h4>
                <p>Trải nghiệm mạo hiểm tại thác</p>
              </div>
            </div>
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
      // Xóa active cũ
      tabButtons.forEach((btn) => btn.classList.remove("active"));
      tabContents.forEach((content) => content.classList.remove("active"));

      // Thêm active mới
      button.classList.add("active");
      document.getElementById(button.dataset.tab).classList.add("active");
    });
  });
</script>
@endsection