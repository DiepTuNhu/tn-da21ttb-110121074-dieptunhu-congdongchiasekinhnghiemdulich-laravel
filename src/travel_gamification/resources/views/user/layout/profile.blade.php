@extends('user.master')
@section('content')

    <div class="profile-container">
      <!-- Thông tin cá nhân -->
      <div class="profile-info">
        <img
          src="https://img.tripi.vn/cdn-cgi/image/width=700,height=700/https://gcs.tripi.vn/public-tripi/tripi-feed/img/482883xvq/anh-mo-ta.png"
          alt="avatar"
        />
        <div>
          <h2>Nguyễn Văn A <span class="profile-badge">🥇 Nhà chinh phục</span></h2>

          <div class="profile-meta">
            <p><i class="fas fa-map-marker-alt"></i> Quê quán: Hà Nội</p>
            <p><i class="fas fa-calendar-alt"></i> Tham gia từ: 12/03/2024</p>
            <p><i class="fas fa-star"></i> Điểm tích lũy: <strong>1.240</strong></p>
          </div>

          <div class="profile-stats">
            <span><i class="fas fa-file-alt"></i> 12 bài viết</span>
            <span><i class="fas fa-heart"></i> 856 lượt thích</span>
            <span><i class="fas fa-check-circle"></i> 6 nhiệm vụ</span>
          </div>
        </div>
      </div>

      <!-- Tabs -->
      <div class="profile-tabs">
        <div class="profile-tab active" data-tab="posts">📄 Bài viết</div>
        <div class="profile-tab" data-tab="missions">🎯 Nhiệm vụ</div>
        <div class="profile-tab" data-tab="likes">❤️ Đã thích</div>
        <div class="profile-tab" data-tab="shared">📢 Đã chia sẻ</div>
        <div class="profile-tab" data-tab="followers">👥 Người theo dõi</div>
        <div class="profile-tab" data-tab="following">🔍 Đang theo dõi</div>
      </div>

      <!-- Nội dung: Bài viết -->
      <div class="profile-tab-content active" id="posts">
        <div class="profile-card-grid">
          <div class="profile-card-item">
            <img class="profile-card-img" src="../1.png" alt="" />
            <div class="profile-card-content">
              <h4>Check-in Đà Lạt</h4>
              <p>❤️ 120 lượt thích · 12 bình luận</p>
            </div>
          </div>
          <div class="profile-card-item">
            <img class="profile-card-img" src="../1.png" alt="" />
            <div class="profile-card-content">
              <h4>Check-in Đà Lạt</h4>
              <p>❤️ 120 lượt thích · 12 bình luận</p>
            </div>
          </div>
          <div class="profile-card-item">
            <img class="profile-card-img" src="../1.png" alt="" />
            <div class="profile-card-content">
              <h4>Check-in Đà Lạt</h4>
              <p>❤️ 120 lượt thích · 12 bình luận</p>
            </div>
          </div>
          <div class="profile-card-item">
            <img class="profile-card-img" src="../2.png" alt="" />
            <div class="profile-card-content">
              <h4>Phú Quốc – Thiên đường biển</h4>
              <p>❤️ 90 lượt thích · 8 bình luận</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Nội dung: Nhiệm vụ -->
      <div class="profile-tab-content" id="missions">
        <div class="profile-card-grid">
          <div class="profile-card-item">
            <div class="profile-card-content">
              <h4>📝 Đăng bài đầu tiên</h4>
              <p class="profile-status">Đã hoàn thành</p>
            </div>
          </div>
          <div class="profile-card-item">
            <div class="profile-card-content">
              <h4>💬 Viết 3 bình luận</h4>
              <p class="profile-status">Đã hoàn thành</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Nội dung: Đã thích -->
      <div class="profile-tab-content" id="likes">
        <div class="profile-card-grid">
          <div class="profile-card-item">
            <img class="profile-card-img" src="../3.png" alt="" />
            <div class="profile-card-content">
              <h4>Hội An về đêm</h4>
              <p>❤️ 150 lượt thích · 30 bình luận</p>
            </div>
          </div>
          <div class="profile-card-item">
            <img class="profile-card-img" src="../4.png" alt="" />
            <div class="profile-card-content">
              <h4>Đà Nẵng - Cầu Rồng</h4>
              <p>❤️ 132 lượt thích · 20 bình luận</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Nội dung: Đã chia sẻ -->
      <div class="profile-tab-content" id="shared">
        <div class="profile-card-grid">
          <div class="profile-card-item">
            <img class="profile-card-img" src="../5.png" alt="" />
            <div class="profile-card-content">
              <h4>Cẩm nang du lịch miền Tây</h4>
              <p>📤 Đã chia sẻ từ TravelShare · ❤️ 80 lượt thích</p>
            </div>
          </div>
          <div class="profile-card-item">
            <img class="profile-card-img" src="../6.png" alt="" />
            <div class="profile-card-content">
              <h4>Top 5 địa điểm ngắm hoàng hôn</h4>
              <p>📤 Chia sẻ từ Hương Giang · ❤️ 92 lượt thích</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Nội dung: Người theo dõi -->
      <div class="profile-tab-content" id="followers">
        <div class="follower-list">
          <div class="follower-item">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="" />
            <div class="follower-info">
              <h4>Trần Thị B</h4>
              <p>Đã theo dõi bạn từ 15/03/2024</p>
            </div>
          </div>
          <div class="follower-item">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="" />
            <div class="follower-info">
              <h4>Lê Văn C</h4>
              <p>Đã theo dõi bạn từ 28/03/2024</p>
            </div>
          </div>
        </div>
      </div>
      

<!-- Nội dung: Đang theo dõi -->
<div class="profile-tab-content" id="following">
  <div class="follower-list">
    <div class="follower-item">
      <img src="https://randomuser.me/api/portraits/women/55.jpg" alt="" />
      <div class="follower-info">
        <h4>Nguyễn Thị D</h4>
        <p>Bạn theo dõi từ 05/04/2024</p>
      </div>
      <button class="unfollow-btn">Hủy theo dõi</button>
    </div>
    
    <div class="follower-item">
      <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="" />
      <div class="follower-info">
        <h4>Phạm Văn E</h4>
        <p>Bạn theo dõi từ 20/04/2024</p>
      </div>
      <button class="unfollow-btn">Hủy theo dõi</button>
    </div>
    
  </div>
</div>


    </div>
    <script>
      const tabs = document.querySelectorAll(".profile-tab");
      const contents = document.querySelectorAll(".profile-tab-content");

      tabs.forEach((tab) => {
        tab.addEventListener("click", () => {
          tabs.forEach((t) => t.classList.remove("active"));
          contents.forEach((c) => c.classList.remove("active"));
          tab.classList.add("active");
          document.getElementById(tab.dataset.tab).classList.add("active");
        });
      });
    </script>
    @endsection
