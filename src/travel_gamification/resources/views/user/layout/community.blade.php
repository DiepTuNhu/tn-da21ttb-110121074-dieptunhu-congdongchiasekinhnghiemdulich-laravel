@extends('user.master')
@section('content')
  <header class="explore-header">
    <h1>Góc chia sẻ</h1>
    <p>Khám phá những bài chia sẻ về địa điểm du lịch khác nhau trên khắp Việt Nam!</p>
  </header>

  <div class="filters">
    <select id="vungmien">
      <option value="">Chọn vùng miền</option>
    </select>

<select id="tinh" class="form-select">
    <option value="">Chọn tỉnh / thành</option>
    <!-- Sẽ đổ dữ liệu bằng JavaScript như bạn đang làm -->
</select>

    <select id="travelTypeDropdown" class="form-select">
        <option value="">Chọn loại hình du lịch</option>
        @foreach($travelTypes as $type)
            @if($type->status == 0)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endif
        @endforeach
    </select>

    <input type="text" class="search-input" placeholder="🔍 Tìm địa điểm, bài viết..." />
    <button id="toggle-form-btn" class="toggle-submit-btn">✍️ Đăng bài chia sẻ</button>
  </div>

  <section class="submit-section" id="submit-section" style="display: none">
    <h2>📝 Đăng bài chia sẻ của bạn</h2>
    <form class="submit-form">
      <input type="text" placeholder="Tiêu đề bài viết" required />
      <textarea placeholder="Nội dung bài viết ngắn gọn..." rows="4" required></textarea>
      <input type="text" placeholder="Địa điểm (ví dụ: TP. Đà Lạt)" required />
      <input type="text" placeholder="Chi phí (ví dụ: Miễn phí, 1-3 triệu...)" />
      <input type="date" placeholder="Ngày đi" />
      <input type="url" placeholder="Link ảnh (hoặc để trống nếu chưa có)" />
      <button type="submit">Đăng bài</button>
    </form>
  </section>

  <div class="explore-grid">
  @foreach ($destinations as $destination)
    <div class="post-card-explore">
      {{-- Kiểm tra nếu có hình ảnh --}}
      @if ($destination->destinationImages && $destination->destinationImages->isNotEmpty())
        <img src="{{ $destination->destinationImages->first()->image_url }}" alt="{{ $destination->name }}" />
      @else
        <img src="default-image.png" alt="Default Image" />
      @endif

      {{-- Hiển thị tên địa điểm --}}
      <div class="post-content-explore">
        <h3 style="text-align: center">{{ $destination->name }}</h3>

        {{-- Hiển thị đặc điểm nổi bật --}}
        <p class="post-excerpt">
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
    </div>
  @endforeach
</div>

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    const regions = {
        'Miền Bắc': ['Hà Nội', 'Hải Phòng', 'Quảng Ninh', 'Bắc Ninh', 'Bắc Giang', 'Hà Nam', 'Hải Dương', 'Hòa Bình', 'Hưng Yên', 'Lạng Sơn', 'Nam Định', 'Ninh Bình', 'Phú Thọ', 'Sơn La', 'Thái Bình', 'Thái Nguyên', 'Tuyên Quang', 'Vĩnh Phúc', 'Yên Bái', 'Cao Bằng', 'Bắc Kạn', 'Điện Biên', 'Hà Giang', 'Lai Châu', 'Lào Cai'],
        'Miền Trung': ['Thanh Hóa', 'Nghệ An', 'Hà Tĩnh', 'Quảng Bình', 'Quảng Trị', 'Thừa Thiên Huế', 'Đà Nẵng', 'Quảng Nam', 'Quảng Ngãi', 'Bình Định', 'Phú Yên', 'Khánh Hòa', 'Ninh Thuận', 'Bình Thuận', 'Kon Tum', 'Gia Lai', 'Đắk Lắk', 'Đắk Nông', 'Lâm Đồng'],
        'Miền Nam': ['TP Hồ Chí Minh', 'Bình Dương', 'Bình Phước', 'Tây Ninh', 'Đồng Nai', 'Bà Rịa - Vũng Tàu', 'Long An', 'Tiền Giang', 'Bến Tre', 'Trà Vinh', 'Vĩnh Long', 'Đồng Tháp', 'An Giang', 'Cần Thơ', 'Hậu Giang', 'Kiên Giang', 'Sóc Trăng', 'Bạc Liêu', 'Cà Mau']
    };

    let allTinh = []; // Lưu toàn bộ danh sách tỉnh

    $(document).ready(function () {
        // 1. Hiển thị vùng miền
        $.each(regions, function (region) {
            $('#vungmien').append(`<option value="${region}">${region}</option>`);
        });

        // 2. Lấy danh sách tỉnh từ API
        $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm', function (res) {
            if (res.error == 0) {
                allTinh = res.data;
            }
        });

        // 3. Khi chọn vùng miền → lọc tỉnh
        $('#vungmien').on('change', function () {
            const selectedRegion = $(this).val();
            const provinces = regions[selectedRegion] || [];

            $('#tinh').html('<option value="">Chọn tỉnh / thành</option>');
            $('#huyen').html('<option value="">Chọn quận / huyện</option>');

            allTinh.forEach(tinh => {
                if (provinces.includes(tinh.name) || provinces.includes(tinh.full_name)) {
                    $('#tinh').append(`<option value="${tinh.name}">${tinh.full_name}</option>`);
                }
            });
        });

        // 4. Khi chọn tỉnh → gửi AJAX để lọc địa điểm
        $('#tinh').on('change', function () {
            const selectedProvince = $(this).val();

            // Gửi AJAX request để lọc địa điểm theo tỉnh
            $.ajax({
                url: `{{ route('page.community') }}`,
                method: 'GET',
                data: { province: selectedProvince },
                success: function (response) {
                    // Cập nhật danh sách địa điểm
                    $('#destinationList').html(response);
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
        });
    });
    </script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
 // Gọi API tỉnh thành
$.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm', function (res) {
    if (res.error === 0) {
        res.data.forEach(tinh => {
            $('#tinh').append(`<option value="${tinh.name}">${tinh.full_name}</option>`);
        });
    }
});

// Khi người dùng chọn tỉnh thì chuyển trang có thêm ?province=...
$('#tinh').on('change', function () {
    const selectedProvince = $(this).val();

    // Kiểm tra nếu người dùng đã chọn tỉnh
    if (selectedProvince) {
        // Lấy type hiện tại từ URL (nếu có)
        const urlParams = new URLSearchParams(window.location.search);
        const typeParam = urlParams.get('type');

        // Ghép route + province + type nếu có
        let url = `{{ route('page.community') }}?province=${encodeURIComponent(selectedProvince)}`;
        
        // Nếu có type trong URL, thêm type vào URL
        if (typeParam) {
            url += `&type=${encodeURIComponent(typeParam)}`;
        }

        // Chuyển hướng đến URL đã tạo
        window.location.href = url;
    }
});

</script>
  {{-- Dropdown loại hình du lịch --}}
  <script>
      document.getElementById('travelTypeDropdown').addEventListener('change', function () {
          const selectedType = this.value;

          if (selectedType) {
              // Chuyển hướng đến route với tham số type
              window.location.href = `{{ route('page.community') }}?type=${selectedType}`;
          }
      });
  </script>

  {{-- <script>
    document.getElementById('provinceDropdown').addEventListener('change', function () {
        const selectedProvince = this.value;

        // Gửi AJAX request
        fetch(`{{ route('page.community') }}?province=${selectedProvince}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById('destinationList').innerHTML = html;
        })
        .catch(error => console.error('Error:', error));
    });
</script> --}}
</section>