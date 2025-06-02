<nav class="navbar">
  <div class="navbar-container">
    <div class="left-group">
      <div class="menu-toggle" id="menu-toggle">
        <i class="fas fa-bars"></i>
      </div>

      <div class="logo">
        <img src="{{ asset('logo/logo_mau_full.png') }}" alt="" />
        <!-- <a href="./logo.png">TravelShare 🌍</a> -->
      </div>

      <ul class="nav-links" id="nav-links">
        <li><a class="{{request() -> is('/') ? 'active' : ''}}" href="{{ route('page.index') }}">Trang Chủ</a></li>
        <li><a class="{{request() -> is('explore') ? 'active' : ''}}" href="{{ route('page.explore') }}">Khám phá</a></li>
        <li class="nav-item community-dropdown" style="position: relative;">
            <a href="#" class="{{ request()->is('community') ? 'active' : '' }}" 
               onmouseover="showCommunityDropdown()" onmouseout="hideCommunityDropdown()">
                Cộng đồng <i class="fa fa-caret-down" style="font-size: 12px;"></i>
            </a>
            <ul class="community-submenu" id="communitySubmenu"
                onmouseover="showCommunityDropdown()" onmouseout="hideCommunityDropdown()"
                style="display: none; position: absolute; left: 0; top: 100%; min-width: 180px; background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.12); border-radius: 8px; z-index: 100;">
                <li><a href="{{ route('page.community') }}">Đọc bài viết</a></li>
                {{-- <li><a href="{{ route( 'page.post_share') }}">Đăng bài mới</a></li> --}}
                @auth
                    <li><a href="{{ route('page.post_share') }}">Đăng bài mới</a></li>
                @else
                    <li><a href="#" onclick="alert('Bạn cần đăng nhập để đăng bài!'); return false;">Đăng bài mới</a></li>
                @endauth
            </ul>
        </li>
        
        @auth
            <li><a class="{{request() -> is('mission') ? 'active' : ''}}" href="{{ route('page.mission') }}">Nhiệm vụ</a></li>
            <li><a class="{{request() -> is('ranking') ? 'active' : ''}}" href="{{ route('page.ranking') }}">Xếp hạng</a></li>
            <li><a class="{{request() -> is('profile') ? 'active' : ''}}" href="{{ route('page.profile') }}">Hồ sơ</a></li>
            {{-- <li><a class="{{request() -> is('rewards') ? 'active' : ''}}" href="{{ route('user.rewards') }}">Đổi thưởng</a></li> --}}

        @else
            <li><a class="{{request() -> is('ranking') ? 'active' : ''}}" href="{{ route('page.ranking') }}">Xếp hạng</a></li>
            {{-- <li><a class="{{request() -> is('rewards') ? 'active' : ''}}" href="{{ route('user.rewards') }}">Đổi thưởng</a></li> --}}
        @endauth
      </ul>
    </div>
    {{-- <div class="right-group">
      <a href="{{ route('login') }}" class="login-btn">Đăng nhập</a>
      <a href="{{ route('register') }}" class="signup-btn">Đăng ký</a>
    </div> --}}
    {{-- filepath: resources/views/user/header.blade.php --}}
<div class="right-group" style="display: flex; align-items: center;">
    @guest
        <!-- Hiển thị khi chưa đăng nhập -->
        <a href="{{ route('login') }}" class="login-btn">Đăng nhập</a>
        <a href="{{ route('register') }}" class="signup-btn">Đăng ký</a>
    @endguest

    @auth
    {{-- Ví dụ: resources/views/user/layout/header.blade.php --}}
<div class="nav-item" style="position: relative;">
    <a class="nav-link" href="#" id="notificationDropdown" onclick="toggleNotificationDropdown(event)">
        <i class="fa fa-bell"></i>
        @if(auth()->user()->unreadNotifications->count() > 0)
            <span class="badge badge-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
        @endif
    </a>
    <div id="notificationMenu" class="notification-dropdown-menu">
        <div class="notification-header">
            <span>Thông báo mới</span>
            <form action="{{ route('notifications.markAsRead') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-mark-read">Đánh dấu tất cả đã đọc</button>
            </form>
        </div>
        <hr class="my-1">
        <div class="notification-list">
            @php
                $allNotifications = auth()->user()->notifications()->orderBy('created_at', 'desc')->get();
            @endphp
            @forelse($allNotifications as $notification)
                @php
                    // Nếu là thông báo liên quan đến bài viết thì có post_id
                    $link = isset($notification->data['post_id'])
                        ? route('post.detail', $notification->data['post_id'])
                        : '#';
                @endphp
                <a class="notification-item {{ $notification->read_at ? 'read' : 'unread' }}"
                   href="{{ $link }}"
                   @if($link !== '#') onclick="markNotificationRead('{{ $notification->id }}', this)" @endif
                   style="{{ $link === '#' ? 'pointer-events:none;opacity:0.7;' : '' }}">
                    <div>
                        <span>{{ $notification->data['message'] }}</span>
                        <small class="text-muted d-block">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                </a>
            @empty
                <span class="notification-empty">Không có thông báo</span>
            @endforelse
        </div>
    </div>
</div>

<style>

</style>

<script>
function toggleNotificationDropdown(e) {
    e.preventDefault();
    let menu = document.getElementById('notificationMenu');
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    // Đóng khi click ra ngoài
    document.addEventListener('click', function handler(event) {
        if (!menu.contains(event.target) && event.target.id !== 'notificationDropdown') {
            menu.style.display = 'none';
            document.removeEventListener('click', handler);
        }
    });
}
function markNotificationRead(id, el) {
    fetch('/notifications/mark-as-read/' + id, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    }).then(() => {
        el.classList.remove('unread');
        el.classList.add('read');
    });
}
</script>
      <!-- Hiển thị khi đã đăng nhập -->
      <div class="user-info" style="display: flex; align-items: center; margin-left: 20px;">
          <img 
              src="{{
                  Auth::user()->avatar
                      ? (Str::startsWith(Auth::user()->avatar, 'http')
                          ? Auth::user()->avatar
                          : asset('storage/avatars/' . Auth::user()->avatar))
                      : asset('storage/default.jpg')
              }}"
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

