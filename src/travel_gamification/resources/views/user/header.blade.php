<nav class="navbar">
  <div class="navbar-container">
    <div class="left-group">
      <div class="menu-toggle" id="menu-toggle">
        <i class="fas fa-bars"></i>
      </div>

      <div class="logo">
        <img src="logo/logo_mau_full.png" alt="" />
        <!-- <a href="./logo.png">TravelShare 🌍</a> -->
      </div>

      <ul class="nav-links" id="nav-links">
        <li><a href="./index.blade.php">Trang Chủ</a></li>
        <li><a href="./khampha.html">Khám phá</a></li>
        <li><a href="./congdong.html">Cộng đồng</a></li>
        <li><a href="./nhiemvu.html">Nhiệm vụ</a></li>
        <li><a href="./xephang.html">Xếp hạng</a></li>
        <li><a href="./hoso.html">Hồ sơ</a></li>
      </ul>
    </div>
    <div class="navbar-search" id="navbarSearch">
      <input type="text" placeholder="🔍 Tìm bài viết, địa điểm..." />
    </div>
    <div class="right-group">
      <a href="{{ route('login') }}" class="login-btn">Đăng nhập</a>
      <a href="{{ route('register') }}" class="signup-btn">Đăng ký</a>
    </div>
  </div>
</nav>