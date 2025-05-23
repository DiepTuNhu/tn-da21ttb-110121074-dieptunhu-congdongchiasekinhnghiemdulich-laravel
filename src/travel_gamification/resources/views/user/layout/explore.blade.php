@extends('user.master')
@section('content')
  <header class="explore-header">
    <h1>Khám phá địa điểm</h1>
    <p>Khám phá những bài chia sẻ về địa điểm du lịch khác nhau trên khắp Việt Nam!</p>
  </header>

  <div class="filters">
    {{-- Dropdown vùng miền --}}
    <select id="vungmien" class="form-select">
      <option value="">Chọn vùng miền</option>
      <option value="Bắc" {{ isset($region) && $region == 'Bắc' ? 'selected' : '' }}>Miền Bắc</option>
      <option value="Trung" {{ isset($region) && $region == 'Trung' ? 'selected' : '' }}>Miền Trung</option>
      <option value="Nam" {{ isset($region) && $region == 'Nam' ? 'selected' : '' }}>Miền Nam</option>
    </select>

  <select id="tinh" class="form-select">
    <option value="">Chọn tỉnh / thành</option>
    @if(isset($province))
        <option value="{{ $province }}" selected>{{ $province }}</option>
    @endif
  </select>

  <select id="travelTypeDropdown" class="form-select">
    <option value="">Chọn loại hình du lịch</option>
    @foreach($travelTypes as $type)
        @if($type->status == 0)
            <option value="{{ $type->id }}" {{ isset($travelTypeId) && $travelTypeId == $type->id ? 'selected' : '' }}>
                {{ $type->name }}
            </option>
        @endif
    @endforeach
  </select>

  <select id="destinationDropdown" class="form-select" style="width: 400px !important;">
    <option value="">🔍 Tìm địa điểm du lịch...</option>
    @foreach($destinations as $destination)
      <option value="{{ route('destination.detail', ['id' => $destination->id]) }}">
        {{ $destination->name }}
      </option>
    @endforeach
  </select>

    {{-- <input type="text" class="search-input" placeholder="🔍 Tìm địa điểm, bài viết..." /> --}}

  </div>


  <div class="posts" id="admin-posts">
    @if($destinations->count())
      @foreach ($destinations as $destination)
        <a href="{{ route('destination.detail', ['id' => $destination->id]) }}" style="text-decoration:none; color:inherit;" >
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
              {{-- <div class="info-row">
                <i class="fas fa-dollar-sign"></i>
                <span>{{ $destination->price }}</span>
              </div> --}}

              <hr class="info-divider" style="margin: 0;"/>

              {{-- Footer thông tin --}}
              <div class="info-footer">
                <span><i class="fas fa-calendar-alt"></i> {{ $destination->updated_at->format('d/m/Y') }}</span>
                {{-- <span><i class="fas fa-heart" style="color: #e74c3c"></i> 135 lượt thích</span> --}}
              </div>
            </div>
          </div>
        </a>
      @endforeach
    @else
      <div class="alert alert-warning" style="margin-top: 30px;">
          Không tìm thấy địa điểm phù hợp.
      </div>
    @endif
  </div>  

    <div class="pagination">
      {{ $destinations->links() }}
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    const provincesByRegion = {
        'Bắc': ['Hà Nội', 'Hải Phòng', 'Quảng Ninh', 'Bắc Ninh', 'Bắc Giang', 'Hà Nam', 'Hải Dương', 'Hoà Bình', 'Hưng Yên', 'Lạng Sơn', 'Nam Định', 'Ninh Bình', 'Phú Thọ', 'Sơn La', 'Thái Bình', 'Thái Nguyên', 'Tuyên Quang', 'Vĩnh Phúc', 'Yên Bái', 'Cao Bằng', 'Bắc Kạn', 'Điện Biên', 'Hà Giang', 'Lai Châu', 'Lào Cai'],
        'Trung': ['Thanh Hóa', 'Nghệ An', 'Hà Tĩnh', 'Quảng Bình', 'Quảng Trị', 'Thừa Thiên Huế', 'Đà Nẵng', 'Quảng Nam', 'Quảng Ngãi', 'Bình Định', 'Phú Yên', 'Khánh Hòa', 'Ninh Thuận', 'Bình Thuận', 'Kon Tum', 'Gia Lai', 'Đắk Lắk', 'Đắk Nông', 'Lâm Đồng'],
        'Nam': ['Hồ Chí Minh', 'Bình Dương', 'Bình Phước', 'Tây Ninh', 'Đồng Nai', 'Bà Rịa - Vũng Tàu', 'Long An', 'Tiền Giang', 'Bến Tre', 'Trà Vinh', 'Vĩnh Long', 'Đồng Tháp', 'An Giang', 'Cần Thơ', 'Hậu Giang', 'Kiên Giang', 'Sóc Trăng', 'Bạc Liêu', 'Cà Mau']
    };

    let allProvinces = [];

    function loadProvinceOptions(region) {
        const provinceDropdown = $('#tinh');
        provinceDropdown.empty().append('<option value="">Chọn tỉnh / thành</option>');

        let filteredList = [];

        if (region && provincesByRegion[region]) {
            filteredList = provincesByRegion[region];
        } else {
            filteredList = allProvinces.map(p => p.name); // nếu không có miền, hiện toàn bộ
        }

        allProvinces.forEach(p => {
            if (filteredList.includes(p.name)) {
                const selected = (new URLSearchParams(window.location.search).get('province') === p.name) ? 'selected' : '';
                provinceDropdown.append(`<option value="${p.name}" ${selected}>${p.full_name}</option>`);
            }
        });
    }

    $(document).ready(function () {
        // Gọi API để lấy danh sách tỉnh
        $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm', function (res) {
            if (res.error === 0) {
                allProvinces = res.data;

                const urlParams = new URLSearchParams(window.location.search);
                const currentRegion = urlParams.get('region');
                loadProvinceOptions(currentRegion); // Gọi sau khi có dữ liệu
            }
        });

        // Sự kiện chọn vùng miền
        $('#vungmien').on('change', function () {
            const region = $(this).val();
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('region', region);
            urlParams.delete('province'); // reset tỉnh
            window.location.href = `{{ route('page.explore') }}?${urlParams.toString()}`;
        });

        // Sự kiện chọn tỉnh
        $('#tinh').on('change', function () {
            const province = $(this).val();
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('province', province);
            window.location.href = `{{ route('page.explore') }}?${urlParams.toString()}`;
        });

        // Sự kiện chọn loại hình du lịch
        document.getElementById('travelTypeDropdown').addEventListener('change', function () {
            const type = this.value;
            const urlParams = new URLSearchParams(window.location.search);

            if (type) urlParams.set('type', type);
            else urlParams.delete('type');

            window.location.href = `{{ route('page.explore') }}?${urlParams.toString()}`;
        });

        // Khởi tạo Select2 cho dropdown địa điểm
        $('#destinationDropdown').select2({
            placeholder: "🔍 Tìm địa điểm du lịch...",
            allowClear: true
        });

        // Khi chọn địa điểm sẽ chuyển trang
        $('#destinationDropdown').on('change', function () {
            const url = $(this).val();
            if (url) {
                window.location.href = url;
            }
        });
    });
</script>

@endsection