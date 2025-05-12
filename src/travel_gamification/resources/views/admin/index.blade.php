<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <title>Trang Quản Trị</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables JS -->
    {{-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> --}}
    

    <style>
      body {
        min-height: 100vh;
      }
      .sidebar {
        height: 100vh;
        position: fixed;
        width: 250px;
        background-color: oklch(92.3% 0.003 48.717);
        padding-top: 20px;
      }
      .nav-link {
        color: #000
      }
      .main-content {
        margin-left: 260px;
        padding: 20px;
      }

      .nav .collapse {
        display: none; /* Ẩn danh sách con mặc định */
      }

      .nav .collapse.show {
        display: block; /* Hiển thị danh sách con khi được kích hoạt */
      }

      .nav .nav-item {
        margin-bottom: 5px; /* Khoảng cách giữa các mục */
      }

    </style>
  </head>
  <body>
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="text-center mb-4">
        <img src="{{ Auth::user()->avatar ? asset('storage/avatars/' . Auth::user()->avatar) : asset('default-avatar.png') }}" 
             alt="Avatar" 
             class="rounded-circle mb-2" 
             width="80" 
             height="80" />
        <h6 class="mb-0">{{ Auth::user()->username }}</h6>
        <small class="text-muted">{{ Auth::user()->role->name ?? 'Quản trị viên' }}</small>
      </div>

      <!-- <h5 class="text-center">Admin Panel</h5> -->
      <ul class="nav flex-column px-3">
        {{-- <li class="nav-item"><a class="nav-link" href="#">Tổng quan</a></li> --}}
        
        

        <li class="nav-item">
          <a class="nav-link" href="#" onclick="toggleDropdown(event, 'locationDropdown1')">
            Quản lý địa điểm
          </a>
          <ul class="nav flex-column px-3 collapse" id="locationDropdown1">
            <li class="nav-item"><a class="nav-link" href="{{route('travel_types.index')}}" onclick="loadPage(event, this)">Loại hình du lịch</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('destinations.index')}}" onclick="loadPage(event, this)">Địa điểm du lịch</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('utility_types.index')}}" onclick="loadPage(event, this)">Loại tiện ích</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('utilities.index')}}" onclick="loadPage(event, this)">Tiện ích</a></li>
          </ul>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" href="#" onclick="toggleDropdown(event, 'locationDropdown2')">
            Đơn vị hành chính
          </a>
          <ul class="nav flex-column px-3 collapse" id="locationDropdown2">
            <li class="nav-item"><a class="nav-link" href="{{ route('provinces.index') }}" onclick="loadPage(event, this)">Tỉnh</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('districts.index') }}" onclick="loadPage(event, this)">Huyện</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('wards.index') }}" onclick="loadPage(event, this)">Xã</a></li>
          </ul>
        </li> --}}
        
        <li class="nav-item"><a class="nav-link" href="{{route('badges.index')}}" onclick="loadPage(event, this)">Huy hiệu</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('missions.index')}}" onclick="loadPage(event, this)">Nhiệm vụ</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('roles.index')}}" onclick="loadPage(event, this)">Phân quyền</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('users.index')}}" onclick="loadPage(event, this)">Người dùng</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('slides.index')}}" onclick="loadPage(event, this)">Trình chiếu</a></li>
        {{-- <li class="nav-item"><a class="nav-link" href="#">Báo cáo & Đánh giá</a></li> --}}
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        <li class="nav-item">
          <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Đăng xuất
          </a>
        </li>
      </ul>
    </div>
    <div class="main-content" id="main-content">
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h2 class="mx-3">@yield('title_name')</h2>
              </div>
              {{-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item">Trang chủ</li>
                  <li class="breadcrumb-item active">@yield('path')</li>
                </ol>
              </div> --}}
            </div>
          </div><!-- /.container-fluid -->
        </section>
  
      <!-- Main content -->
      
        @yield('content')
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <!-- /.content -->
      </div>
      <!-- Main Content -->
      {{-- <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script> --}}
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <script>
        $(document).ready(function () {
          $("#logTable").DataTable({
            order: [[0, "desc"]],
            responsive: true,
            language: {
              url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/vi.json",
            },
          });
        });    
      </script>

      {{-- Drop tỉnh/ huyện/ xã --}}
      <script>
        function toggleDropdown(event, dropdownId) {
          event.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết
          const dropdown = document.getElementById(dropdownId);
          dropdown.classList.toggle('show'); // Thêm hoặc xóa lớp 'show' để hiển thị/ẩn danh sách con
        }
      </script>
      {{-- Xem trước ảnh --}}
      <script>
        function previewImage(inputId) {
          const fileInput = document.getElementById(`image${inputId}`);
          const previewContainer = document.getElementById(`imagePreview${inputId}`);
          previewContainer.innerHTML = ''; // Xóa nội dung cũ

          if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
              const img = document.createElement('img');
              img.src = e.target.result;
              img.alt = 'Ảnh xem trước';
              img.style.maxWidth = '200px';
              img.style.maxHeight = '200px';
              previewContainer.appendChild(img);
            };
            reader.readAsDataURL(fileInput.files[0]);
          }
        }
      </script>

  <script>
    function loadPage(event, link) {
        event.preventDefault();
        const url = link.getAttribute('href');
    
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(data => {
            // Cắt phần nội dung chính nếu server trả về toàn bộ HTML
            const parser = new DOMParser();
            const htmlDoc = parser.parseFromString(data, 'text/html');
            const newContent = htmlDoc.querySelector('#main-content');
            if (newContent) {
                document.getElementById('main-content').innerHTML = newContent.innerHTML;
            } else {
                document.getElementById('main-content').innerHTML = data;
            }
    
            window.history.pushState(null, '', url); // Thay đổi URL trên trình duyệt

            // Khởi tạo lại DataTables sau khi nội dung mới được tải
            if ($.fn.DataTable) {
                $('#logTable').DataTable({
                    order: [[0, "desc"]],
                    responsive: true,
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/vi.json",
                    },
                });
            }
        })
        .catch(err => console.error('Lỗi khi tải trang:', err));
    }
    </script>
    </div>
  
  </body>
</html>
