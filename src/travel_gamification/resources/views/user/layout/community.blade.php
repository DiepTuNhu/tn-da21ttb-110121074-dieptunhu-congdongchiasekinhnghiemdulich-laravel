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


    <input type="text" class="search-input" placeholder="🔍 Tìm địa điểm, bài viết..." />
    <button id="toggle-form-btn" class="toggle-submit-btn">✍️ Đăng bài chia sẻ</button>
  </div>

  <section class="submit-section" id="submit-section" style="display: none;">
    <h2>📝 Đăng bài chia sẻ của bạn</h2>
    <form class="submit-form" method="POST" action="{{ route('community.post') }}">
        @csrf
        <div class="form-group">
            <label for="title" class="form-label">Tiêu đề bài viết</label>
            <input type="text" id="title" name="title" class="form-control" placeholder="Tiêu đề bài viết" required />
        </div>

        <div class="form-group">
            <label for="content" class="form-label">Nội dung bài viết</label>
            <textarea id="content" name="content" class="form-control" rows="6" placeholder="Nội dung bài viết ngắn gọn..." ></textarea>
        </div>

        <div class="form-group">
            <label for="location" class="form-label">Địa điểm</label>
            <select id="id_location" name="id_location" class="form-control" required>
                <option value="">Chọn địa điểm</option>
                @foreach($destinations as $destination)
                    <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                @endforeach
            </select>

        </div>

        <div class="form-group">
            <label for="cost" class="form-label">Chi phí</label>
            <input type="text" id="cost" name="cost" class="form-control" placeholder="Chi phí (ví dụ: Miễn phí, 1-3 triệu...)" />
        </div>

        <button type="submit" class="btn-submit">Đăng bài</button>
    </form>
</section>


  <div class="explore-grid">
  @foreach ($posts as $post)
    <a href="{{ route('post.detail', $post->id) }}" style="text-decoration:none; color:inherit;">
        <div class="post-card-explore">
        {{-- Hình ảnh địa điểm --}}
        @if ($post->destination && $post->destination->destinationImages && $post->destination->destinationImages->isNotEmpty())
            <img src="{{ $post->destination->destinationImages->first()->image_url }}" alt="{{ $post->destination->name }}" style="height: 240px"/>
        @else
            <img src="default-image.png" alt="Default Image" />
        @endif

        <div class="post-content-explore">
            {{-- Tiêu đề bài viết --}}
            <h3 style="text-align: center">{{ $post->title }}</h3>
            {{-- Nội dung rút gọn --}}
            <p class="post-excerpt" style="text-align: justify">
                {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}
            </p>
            <div class="post-info-block">
                <div class="info-row" style="font-weight: bold; text-align: center; margin-bottom: 4px;">
                    <i class="fas fa-map-pin"></i>
                    <span>{{ $post->destination->name ?? 'Địa điểm không xác định' }}</span>
                </div>
                <div class="info-row">
                    <i class="fas fa-location-dot"></i>
                    <span>{{ $post->address }}</span>
                </div>
                <div class="info-row">
                    <i class="fas fa-dollar-sign"></i>
                    <span>{{ $post->price ?? 'Không rõ' }}</span>
                </div>
                <div class="info-row" style="align-items: center;">
                    @if(isset($post->user) && !empty($post->user->avatar))
                        <img src="{{ asset('storage/avatars/' . $post->user->avatar) }}" alt="avatar" style="width:28px;height:28px;border-radius:50%;object-fit:cover;margin-right:8px;">
                    @else
                        <img src="{{ asset('default-avatar.png') }}" alt="avatar" style="width:28px;height:28px;border-radius:50%;object-fit:cover;margin-right:8px;">
                    @endif
                    <span>{{ $post->user->username ?? 'Ẩn danh' }}</span>
                </div>
                <hr class="info-divider" />
                <div class="info-footer">
                    <span><i class="fas fa-calendar-alt"></i> {{ $post->created_at->format('d/m/Y') }}</span>
                    <span><i class="fas fa-heart" style="color: #e74c3c"></i> 135 lượt thích</span>
                </div>
            </div>
        </div>
        </div>
    </a>
  @endforeach
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const provincesByRegion = {
        'Bắc': ['Hà Nội', 'Hải Phòng', 'Quảng Ninh', 'Bắc Ninh', 'Bắc Giang', 'Hà Nam', 'Hải Dương', 'Hòa Bình', 'Hưng Yên', 'Lạng Sơn', 'Nam Định', 'Ninh Bình', 'Phú Thọ', 'Sơn La', 'Thái Bình', 'Thái Nguyên', 'Tuyên Quang', 'Vĩnh Phúc', 'Yên Bái', 'Cao Bằng', 'Bắc Kạn', 'Điện Biên', 'Hà Giang', 'Lai Châu', 'Lào Cai'],
        'Trung': ['Thanh Hóa', 'Nghệ An', 'Hà Tĩnh', 'Quảng Bình', 'Quảng Trị', 'Thừa Thiên Huế', 'Đà Nẵng', 'Quảng Nam', 'Quảng Ngãi', 'Bình Định', 'Phú Yên', 'Khánh Hòa', 'Ninh Thuận', 'Bình Thuận', 'Kon Tum', 'Gia Lai', 'Đắk Lắk', 'Đắk Nông', 'Lâm Đồng'],
        'Nam': ['TP Hồ Chí Minh', 'Bình Dương', 'Bình Phước', 'Tây Ninh', 'Đồng Nai', 'Bà Rịa - Vũng Tàu', 'Long An', 'Tiền Giang', 'Bến Tre', 'Trà Vinh', 'Vĩnh Long', 'Đồng Tháp', 'An Giang', 'Cần Thơ', 'Hậu Giang', 'Kiên Giang', 'Sóc Trăng', 'Bạc Liêu', 'Cà Mau']
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
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
  let editorInstance;

  ClassicEditor
      .create(document.querySelector('#content'), {
          ckfinder: {
              uploadUrl: '{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}'
          },
          toolbar: [
              'heading', '|', 'bold', 'italic', 'link',
              'bulletedList', 'numberedList', 'blockQuote', '|',
              'insertTable', 'uploadImage', 'undo', 'redo'
          ]
      })
      .then(editor => {
          editorInstance = editor;
      })
      .catch(error => {
          console.error('CKEditor error:', error);
      });

  document.querySelector("form").addEventListener("submit", function (e) {
      // Sử dụng instance của CKEditor 5
      const content = editorInstance.getData();
      if (content.trim() === "") {
          e.preventDefault();
          alert("Vui lòng nhập nội dung bài viết.");
      }
  });
</script>

  {{-- Đăng bài --}}
<script>
  const toggleBtn = document.getElementById("toggle-form-btn");
  const submitSection = document.getElementById("submit-section");
  const isLoggedIn = {{ $isLoggedIn ? 'true' : 'false' }};

  if (toggleBtn && submitSection) {
    toggleBtn.addEventListener("click", () => {
      if (!isLoggedIn) {
        alert("Vui lòng đăng nhập để đăng bài chia sẻ!");
        // Có thể chuyển hướng sang trang đăng nhập nếu muốn:
        // window.location.href = "{{ route('login') }}";
        return;
      }
      const isVisible = submitSection.style.display === "block";
      submitSection.style.display = isVisible ? "none" : "block";
      toggleBtn.textContent = isVisible ? "✍️ Đăng bài chia sẻ" : "✖️ Đóng lại";
    });
  }

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
    });
</script>
{{-- ...existing code... --}}
@endsection