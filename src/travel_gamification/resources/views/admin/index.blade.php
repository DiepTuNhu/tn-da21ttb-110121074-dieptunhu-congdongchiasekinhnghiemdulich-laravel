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
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    

    <style>
      body {
        min-height: 100vh;
      }
      .sidebar {
        height: 100vh;
        position: fixed;
        width: 250px;
        background-color: #f8f9fa;
        padding-top: 20px;
      }
      .main-content {
        margin-left: 260px;
        padding: 20px;
      }
    </style>
  </head>
  <body>
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="text-center mb-4">
        <img src="./1.png" alt="Avatar" class="rounded-circle mb-2" width="80" height="80" />
        <h6 class="mb-0">Nguyễn Văn A</h6>
        <small class="text-muted">Quản trị viên</small>
      </div>

      <!-- <h5 class="text-center">Admin Panel</h5> -->
      <ul class="nav flex-column px-3">
        {{-- <li class="nav-item"><a class="nav-link" href="#">Tổng quan</a></li> --}}
        <li class="nav-item"><a class="nav-link" href="{{route('travel_types.index')}}">Loại hình du lịch</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('utility_types.index')}}">Loại tiện ích</a></li>
        {{-- <li class="nav-item"><a class="nav-link" href="#">Quản lý bài viết</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Quản lý địa điểm</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Quản lý tiện ích</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Quản lý nhiệm vụ</a></li> --}}
        <li class="nav-item"><a class="nav-link" href="{{route('roles.index')}}">Phân quyền</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('users.index')}}">Người dùng</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('slides.index')}}">Trình chiếu</a></li>
        {{-- <li class="nav-item"><a class="nav-link" href="#">Báo cáo & Đánh giá</a></li> --}}
        <li class="nav-item"><a class="nav-link text-danger" href="#">Đăng xuất</a></li>
      </ul>
    </div>
    <div class="main-content">
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
  
      <!-- /.content -->
    {{-- </div> --}}
    <!-- Main Content -->
    
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
  </body>
</html>
