<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <title>Trang Quản Trị</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome 6 CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        left: 0;
        top: 0;
        z-index: 1052;
        transition: transform 0.3s;
      }
      @media (max-width: 767.98px) {
        .sidebar {
          transform: translateX(-100%);
        }
        .sidebar.show {
          transform: translateX(0);
        }
        .main-content {
          margin-left: 0 !important;
        }
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

      .badge-pending {
        display: inline-block;
        min-width: 18px;
        padding: 2px 6px;
        font-size: 12px;
        font-weight: bold;
        color: #fff;
        background: #e74c3c;
        border-radius: 10px;
        margin-left: 6px;
        vertical-align: middle;
      }
    </style>
  </head>
  <body>
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="text-center mb-4">
        <img src="{{
    Auth::user()->avatar
        ? (Str::startsWith(Auth::user()->avatar, 'http')
            ? Auth::user()->avatar
            : asset('storage/avatars/' . Auth::user()->avatar))
        : asset('storage/default.jpg')
}}"
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
<li class="nav-item"><a class="nav-link" href="{{route('admin.overview')}}" onclick="loadPage(event, this)"><i class="bi bi-speedometer2"></i> Tổng quan</a></li>

<a class="nav-link" href="#" onclick="toggleDropdown(event, 'locationDropdown1')">
  <i class="bi bi-geo-alt"></i> Quản lý địa điểm
</a>
<ul class="nav flex-column px-3 collapse" id="locationDropdown1">
  <li class="nav-item"><a class="nav-link" href="{{route('travel_types.index')}}" onclick="loadPage(event, this)"><i class="bi bi-signpost"></i> Loại hình du lịch</a></li>
  <li class="nav-item"><a class="nav-link" href="{{route('destinations.index')}}" onclick="loadPage(event, this)"><i class="bi bi-building"></i> Địa điểm du lịch</a></li>
  <li class="nav-item"><a class="nav-link" href="{{route('utility_types.index')}}" onclick="loadPage(event, this)"><i class="bi bi-box"></i> Loại tiện ích</a></li>
  <li class="nav-item"><a class="nav-link" href="{{route('utilities.index')}}" onclick="loadPage(event, this)"><i class="bi bi-plug"></i> Tiện ích</a></li>
</ul>

<li class="nav-item"><a class="nav-link" href="{{route('badges.index')}}" onclick="loadPage(event, this)"><i class="bi bi-patch-check"></i> Huy hiệu</a></li>
<li class="nav-item"><a class="nav-link" href="{{route('missions.index')}}" onclick="loadPage(event, this)"><i class="bi bi-flag"></i> Nhiệm vụ</a></li>
<li class="nav-item"><a class="nav-link" href="{{route('rewards.index')}}" onclick="loadPage(event, this)"><i class="bi bi-gift"></i> Quà tặng</a></li>
<li class="nav-item"><a class="nav-link" href="{{route('admin.user_rewards.index')}}" onclick="loadPage(event, this)"><i class="bi bi-trophy"></i> Đổi thưởng</a></li>

<li class="nav-item"><a class="nav-link" href="{{route('posts.index')}}" onclick="loadPage(event, this)"><i class="bi bi-journal-text"></i> Bài viết</a></li>
<li class="nav-item">
  <a class="nav-link" href="{{route('admin.posts.pending') }}" onclick="loadPage(event, this)">
    <i class="bi bi-hourglass-split"></i> Duyệt bài viết
    @if(isset($pendingCount) && $pendingCount > 0)
      <span class="badge-pending">{{ $pendingCount }}</span>
    @endif
  </a>
</li>
<li class="nav-item"><a class="nav-link" href="{{route('comments.index')}}" onclick="loadPage(event, this)"><i class="bi bi-chat-dots"></i> Bình luận</a></li>
<li class="nav-item"><a class="nav-link" href="{{route('slides.index')}}" onclick="loadPage(event, this)"><i class="bi bi-images"></i> Trình chiếu</a></li>
<li class="nav-item"><a class="nav-link" href="{{route('roles.index')}}" onclick="loadPage(event, this)"><i class="bi bi-person-lock"></i> Phân quyền</a></li>
<li class="nav-item"><a class="nav-link" href="{{route('users.index')}}" onclick="loadPage(event, this)"><i class="bi bi-people"></i> Người dùng</a></li>
<li class="nav-item">
  <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="bi bi-box-arrow-right"></i> <b>Đăng xuất</b>
  </a>
</li>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
      </ul> 
    </div>

    <!-- Nút menu cho mobile: Đặt ở đây, ngoài main-content -->
    <div class="d-md-none w-100 px-2 py-2 bg-white" style="position:sticky;top:0;z-index:1051;">
      <button class="btn btn-outline-secondary" id="sidebarToggle">
        <i class="bi bi-list" style="font-size:1.8rem"></i>
      </button>
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
    <!-- Ví dụ đặt ở góc trên bên phải -->
<div class="dropdown" style="position: absolute; top: 20px; right: 30px;">
    <button class="btn btn-link p-0" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="box-shadow:none;">
        <i class="bi bi-bell" style="font-size: 1.7rem; position: relative;">
            @if(Auth::user()->unreadNotifications->count() > 0)
                <span class="badge-pending" style="position: absolute; top: -8px; right: -8px;">
                    {{ Auth::user()->unreadNotifications->count() }}
                </span>
            @endif
        </i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown" style="width: 350px; max-height: 400px; overflow-y: auto;">
        @forelse(Auth::user()->unreadNotifications as $notification)
            @php
                $type = $notification->data['type'] ?? '';
            @endphp
@if($type === 'post')
    <a class="dropdown-item"
       href="{{ route('posts.index', ['highlight' => $notification->data['object_id']]) }}"
       onclick="loadPage(event, this)">
        <b>Bài viết bị báo cáo</b><br>
        <small>Lý do: {{ $notification->data['reason'] ?? '' }}</small><br>
        <small>Người báo cáo: {{ $notification->data['user_name'] ?? '' }}</small><br>
        <small>Tiêu đề: {{ $notification->data['object_title'] ?? '' }}</small><br>
        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
    </a>
@elseif($type === 'comment')
    <a class="dropdown-item"
       href="{{ route('comments.index', ['highlight' => $notification->data['object_id']]) }}"
       onclick="loadPage(event, this)">
        <b>Bình luận bị báo cáo</b><br>
        <small>Lý do: {{ $notification->data['reason'] ?? '' }}</small><br>
        <small>Người báo cáo: {{ $notification->data['user_name'] ?? '' }}</small><br>
        <small>Nội dung: {{ $notification->data['object_title'] ?? '' }}</small><br>
        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
    </a>

            @else
                {{-- Thông báo khác (ví dụ: bài viết mới) --}}
                <a class="dropdown-item" href="{{ route('admin.notification.read', $notification->id) }}">
                    <b>{{ $notification->data['name'] ?? '[Không xác định]' }}</b> - 
                    {{ $type === 'utility' ? 'Tiện ích được tạo' : 'Địa điểm được tạo' }} mới<br>
                    <small class="text-muted">Bởi: {{ $notification->data['user_name'] ?? 'Người dùng' }}</small><br>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </a>
            @endif
        @empty
            <li><span class="dropdown-item text-muted">Không có thông báo mới</span></li>
        @endforelse
    </ul>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      document.getElementById('sidebarToggle').onclick = function() {
        document.querySelector('.sidebar').classList.toggle('show');
      };
      // Đóng sidebar khi click ngoài (mobile)
      document.addEventListener('click', function(e) {
        const sidebar = document.querySelector('.sidebar');
        const toggle = document.getElementById('sidebarToggle');
        if (window.innerWidth < 768 && sidebar.classList.contains('show')) {
          if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
            sidebar.classList.remove('show');
          }
        }
      });

      document.querySelectorAll('.sidebar .nav-link').forEach(function(link) {
        link.addEventListener('click', function() {
          if (window.innerWidth < 768) {
            document.querySelector('.sidebar').classList.remove('show');
          }
        });
      });
    </script>
  </body>
</html>
