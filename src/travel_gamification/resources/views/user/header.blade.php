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
        <li><a class="{{request() -> is('/') ? 'active' : ''}}" href="{{ route('page.index') }}">Trang Chủ</a></li>
        <li><a class="{{request() -> is('explore') ? 'active' : ''}}" href="{{ route('page.explore') }}">Khám phá</a></li>
        <li><a class="{{request() -> is('community') ? 'active' : ''}}" href="{{ route('page.community') }}">Cộng đồng</a></li>
        
        <li><a href="./nhiemvu.html">Nhiệm vụ</a></li>
        <li><a href="./xephang.html">Xếp hạng</a></li>
        <li><a href="./hoso.html">Hồ sơ</a></li>
      </ul>
    </div>
    <div class="navbar-search" id="navbarSearch">
      <input type="text" placeholder="🔍 Tìm bài viết, địa điểm..." />
    </div>
    {{-- <div class="right-group">
      <a href="{{ route('login') }}" class="login-btn">Đăng nhập</a>
      <a href="{{ route('register') }}" class="signup-btn">Đăng ký</a>
    </div> --}}
    {{-- filepath: d:\laragon\www\travel_gamification\resources\views\user\header.blade.php --}}
<div class="right-group">
  @guest
      <!-- Hiển thị khi chưa đăng nhập -->
      <a href="{{ route('login') }}" class="login-btn">Đăng nhập</a>
      <a href="{{ route('register') }}" class="signup-btn">Đăng ký</a>
  @endguest

  @auth
      <!-- Hiển thị khi đã đăng nhập -->
      <div class="user-info" style="display: flex; align-items: center;">
          <img src="{{ Auth::user()->avatar ? asset('storage/avatars/' . Auth::user()->avatar) : asset('default-avatar.png') }}" 
               alt="Avatar" 
               class="user-avatar" 
               style="border-radius: 50%; width: 40px; height: 40px; margin-right: 10px;">
          <div>
              <div style="font-weight: bold; font-size: 14px;">{{ Auth::user()->username }}</div>
              <div style="font-size: 12px; color: #555;">{{ Auth::user()->email }}</div>
          </div>
          <a href="#" style="margin-left: 15px; font-size: 14px; color: #007bff; text-decoration: none;" 
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
      </div>
  @endauth
</div>
  </div>
</nav>