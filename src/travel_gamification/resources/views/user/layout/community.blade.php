@extends('user.master')
@section('content')
  <header class="explore-header">
    <h1>Góc chia sẻ</h1>
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
    <select id="destinationDropdown" class="form-select destination-dropdown-select2">
        <option value="">🔍 Tìm địa điểm du lịch...</option>
        @foreach($destinations as $destination)
            <option value="{{ $destination->id }}" data-id="{{ $destination->id }}"
                {{ (isset($destinationId) && $destinationId == $destination->id) ? 'selected' : '' }}>
                {{ $destination->name }}
            </option>
        @endforeach
    </select>
    @if($isLoggedIn)
        <button id="toggle-form-btn" class="toggle-submit-btn">✍️ Đăng bài chia sẻ</button>
    @else
        <button type="button" class="toggle-submit-btn" onclick="alert('Bạn cần đăng nhập để đăng bài!')">✍️ Đăng bài chia sẻ</button>
    @endif
    <!-- Modal chọn loại đăng bài -->
<div id="choose-type-modal" style="
    display: none;
    position: fixed;
    z-index: 1000;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(2px);
">
    <div class="choose-modal-outer">
        <div class="choose-modal-inner" style="
            background: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            width: 700px;
            max-width: 90vw;
            height: 80vh;
            margin-top: 120px;
            margin-bottom: 80px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
            position: relative;
            animation: fadeIn 0.3s ease-in-out;
            overflow: auto;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        ">
            <h3 style="margin-bottom: 20px; font-size: 20px;">📝 Bạn muốn đăng bài về?</h3>
            
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <button class="choose-type-btn" data-type="destination"
                    style="padding: 10px; background-color: #1e90ff; color: white; border: none; border-radius: 6px; cursor: pointer;">
                    🗺️ Địa điểm du lịch
                </button>
                <button class="choose-type-btn" data-type="utility"
                    style="padding: 10px; background-color: #32cd32; color: white; border: none; border-radius: 6px; cursor: pointer;">
                    🧰 Tiện ích
                </button>
            </div>

            <button id="close-type-modal"
                style="position: absolute; top: 12px; right: 12px; background: none; border: none; font-size: 20px; cursor: pointer;">✖️</button>

            <div id="choose-list-container" style="margin-top: 20px;"></div>
        </div>
    </div>
</div>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
  </div>

<div class="posts" id="user-posts">
  @if($posts->count())
    <!-- Các post của người dùng -->
    @foreach ($posts as $post)
      <a href="{{ route('post.detail', $post->id) }}" style="text-decoration:none; color:inherit;">

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
              <img src="canh.png" alt="Default Image" />
          @endif

          <h4 style="text-align: center">{{ $post->title }}</h4>

          <div class="post-excerpt" style="text-align: justify">
            {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}
          
        </div>
        <div class="post-info-block">
            <div style="display: flex; align-items: center; justify-content: left; gap: 6px; font-weight: bold;">
                <i class="fas fa-map-pin" style="color: #e74c3c; font-size: 16px;"></i>
                <span style="font-size: 14px;">
                    {{ $post->destination->name ?? 'Địa điểm không xác định' }}
                </span> 
            </div>
        </div>

          
                <hr class="info-divider" />
                <div class="info-footer">
                    <div class="footer-row">
                        <div class="footer-col left">
                            <i class="fas fa-user"></i>
                            {{ $post->user->username ?? 'Ẩn danh' }}
                        </div>
                        <div class="footer-col right">
                            <i class="fas fa-calendar-alt"></i>
                            @if ($post->updated_at->diffInHours() < 24)
                                {{ $post->updated_at->diffForHumans() }}
                            @else
                                {{ $post->updated_at->format('d/m/Y') }}
                            @endif
                        </div>
                    </div>
                    <div class="footer-row">
                        <div class="footer-col left">
                            <i class="fas fa-heart" style="color: #e74c3c"></i>
                            {{ $post->likes->count() }} lượt thích
                        </div>
                        <div class="footer-col right">
                            <i class="fas fa-comment-alt"></i>
                            {{ $post->comments->count() }} bình luận
                        </div>
                    </div>
                </div>
        </div>
      </a>
    @endforeach
  @else
      <div class="alert alert-warning" style="margin-top: 30px;">
          Không tìm thấy bài chia sẻ phù hợp.
      </div>
  @endif
  </div>  
    @if($posts->hasPages())
    <div class="pagination">
        {{ $posts->links() }}
    </div>
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            window.location.href = `{{ route('page.community') }}?${urlParams.toString()}`;
        });

        // Sự kiện chọn tỉnh
        $('#tinh').on('change', function () {
            const province = $(this).val();
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('province', province);
            window.location.href = `{{ route('page.community') }}?${urlParams.toString()}`;
        });

        // Sự kiện chọn loại hình du lịch
        document.getElementById('travelTypeDropdown').addEventListener('change', function () {
            const type = this.value;
            const urlParams = new URLSearchParams(window.location.search);

            if (type) urlParams.set('type', type);
            else urlParams.delete('type');

            window.location.href = `{{ route('page.community') }}?${urlParams.toString()}`;
        });
    });
</script>

{{-- ...existing code... --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#location').select2({
            placeholder: "Chọn địa điểm",
            allowClear: true
        });
        $('#destinationDropdown').select2({
            placeholder: "🔍 Tìm địa điểm du lịch...",
            allowClear: true,
            width: '100%',
            dropdownCssClass: 'destination-dropdown-select2',
            selectionCssClass: 'destination-dropdown-select2'
        });
        $('#destinationDropdown').on('change', function () {
            const destinationId = $(this).find('option:selected').data('id');
            const urlParams = new URLSearchParams(window.location.search);

            if (destinationId) {
                urlParams.set('destination_id', destinationId);
            } else {
                urlParams.delete('destination_id');
            }
            window.location.href = `{{ route('page.community') }}?${urlParams.toString()}`;
        });
    });
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("choose-type-modal");
    const openBtn = document.getElementById("toggle-form-btn");
    const closeBtn = document.getElementById("close-type-modal");
    const chooseListContainer = document.getElementById("choose-list-container");
    const submitSection = document.getElementById("submit-section");

    const allDestinations = @json($allDestinations); // dùng biến này cho popup
    const utilityTypes = @json($utilityTypes ?? []);
    const utilities = @json($utilities ?? []);

    openBtn.addEventListener("click", function () {
        modal.style.display = "flex";
        chooseListContainer.innerHTML = "";
    });

    closeBtn.addEventListener("click", function () {
        modal.style.display = "none";
        chooseListContainer.innerHTML = "";
    });

    document.querySelectorAll(".choose-type-btn").forEach(function (btn) {
        btn.addEventListener("click", function () {
            const type = btn.getAttribute("data-type");
            if (type === "destination") {
                chooseListContainer.innerHTML = `
                    <div style="margin-bottom:12px; display: flex; gap: 12px; flex-wrap: wrap; justify-content: center;">
                        <select id="modal-type" class="form-select" style="width: 180px;">
                            <option value="">Tất cả loại hình du lịch</option>
                            @foreach($travelTypes as $t)
                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                        <select id="modal-province" class="form-select" style="width: 180px;">
                            <option value="">Tất cả tỉnh/thành</option>
                        </select>
                    </div>
                    <div id="modal-destination-list" style="margin-top:16px;"></div>
                `;

                // Lấy danh sách tỉnh từ API
                $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm', function(res) {
                    if (res.error === 0) {
                        let html = '<option value="">Tất cả tỉnh/thành</option>';
                        res.data.forEach(function(p) {
                            html += `<option value="${p.name}">${p.full_name}</option>`;
                        });
                        document.getElementById('modal-province').innerHTML = html;
                    }
                });

                function renderDestinations() {
                    const typeId = document.getElementById('modal-type').value;
                    const province = document.getElementById('modal-province').value;
                    let filtered = allDestinations; // <-- dùng danh sách đầy đủ
                    if (typeId) filtered = filtered.filter(d => d.travel_type_id == typeId);
                    if (province) {
                        filtered = filtered.filter(d => {
                            if (!d.address) return false;
                            // Lấy tên tỉnh/thành ở cuối address (sau "tỉnh ", "thành phố ", "TP ")
                            let match = d.address.match(/(?:tỉnh|thành phố|TP)\s*([^\-,]+)$/i);
                            if (match && match[1]) {
                                return match[1].trim() === province;
                            }
                            // Nếu không match, fallback lấy phần cuối sau dấu phẩy
                            let parts = d.address.split(/,| - |–/);
                            let last = parts[parts.length - 1].replace(/^(tỉnh|thành phố|TP)\s*/i, '').trim();
                            return last === province;
                        });
                    }
                    let html = '';
                    filtered.forEach(d => {
                        html += `
            <div class="select-card" data-type="destination" data-id="${d.id}">
                <img src="${d.main_image ? d.main_image.image_url : 'canh.png'}" alt="${d.name}" />
                <div class="select-card-title">${d.name}</div>
                <div class="select-card-desc">${d.short_description ? d.short_description : ''}</div>
            </div>`;
                    });
                    document.getElementById('modal-destination-list').innerHTML = html || '<div style="margin:16px; text-align:center;">Không có địa điểm phù hợp.</div>';
                }
                document.getElementById('modal-type').onchange = renderDestinations;
                document.getElementById('modal-province').onchange = renderDestinations;
                // Đảm bảo gọi lại mỗi lần popup mở
                setTimeout(renderDestinations, 500);
            }

            if (type === "utility") {
    chooseListContainer.innerHTML = `
        <div style="margin-bottom:12px; display: flex; gap: 12px; flex-wrap: wrap; justify-content: center;">
            <select id="modal-utility-type" class="form-select" style="width: 180px;">
                <option value="">Chọn loại tiện ích</option>
                @foreach($utilityTypes as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>
            <select id="modal-utility-province" class="form-select" style="width: 180px;">
                <option value="">Tất cả tỉnh/thành</option>
            </select>
        </div>
        <div id="modal-utility-list" style="margin-top:16px;"></div>
    `;

    // Lấy danh sách tỉnh từ API
    $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm', function(res) {
        if (res.error === 0) {
            let html = '<option value="">Tất cả tỉnh/thành</option>';
            res.data.forEach(function(p) {
                html += `<option value="${p.name}">${p.full_name}</option>`;
            });
            document.getElementById('modal-utility-province').innerHTML = html;
        }
    });

    function renderUtilities() {
        const typeId = document.getElementById('modal-utility-type').value;
        const province = document.getElementById('modal-utility-province').value;
        let filtered = utilities;
        if (typeId) filtered = filtered.filter(u => u.utility_type_id == typeId);
        if (province) {
            filtered = filtered.filter(u => {
                if (!u.address) return false;
                // Lấy tên tỉnh/thành ở cuối address (sau "tỉnh ", "thành phố ", "TP ")
                let match = u.address.match(/(?:tỉnh|thành phố|TP)\s*([^\-,]+)$/i);
                if (match && match[1]) {
                    return match[1].trim() === province;
                }
                // Nếu không match, fallback lấy phần cuối sau dấu phẩy
                let parts = u.address.split(/,| - |–/);
                let last = parts[parts.length - 1].replace(/^(tỉnh|thành phố|TP)\s*/i, '').trim();
                return last === province;
            });
        }
        let html = '';
        filtered.forEach(u => {
            html += `
            <div class="select-card" data-type="utility" data-id="${u.id}">
                <img src="${u.image_url || 'canh.png'}" alt="${u.name}" />
                <div class="select-card-title">${u.name}</div>
            </div>`;
        });
        document.getElementById('modal-utility-list').innerHTML = html || '<div style="margin:16px; text-align:center;">Không có tiện ích phù hợp.</div>';
    }
    document.getElementById('modal-utility-type').onchange = renderUtilities;
    document.getElementById('modal-utility-province').onchange = renderUtilities;
    renderUtilities();
}
        });
    });

chooseListContainer.addEventListener('click', function(e) {
    const card = e.target.closest('.select-card');
    if (card) {
        const type = card.getAttribute('data-type');
        const id = card.getAttribute('data-id');
        modal.style.display = "none";
        chooseListContainer.innerHTML = "";
        // XÓA hoặc kiểm tra submitSection trước khi dùng
        // if (submitSection) submitSection.style.display = "block";
        if (type === "destination") {
            window.location.href = "{{ route('post_articles') }}?type=destination&destination_id=" + id;
            return;
        }
        if (type === "utility") {
            window.location.href = "{{ route('post_articles') }}?type=utility&utility_id=" + id;
            return;
        }
    }
});
});

</script>

@endsection