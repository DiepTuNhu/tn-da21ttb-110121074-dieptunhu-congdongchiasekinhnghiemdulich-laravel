@extends('user.master')
@section('content')
<header class="mission-header">
      <h1>🎯 Nhiệm Vụ Của Bạn</h1>
      <p>Hoàn thành nhiệm vụ ngày và tháng để nhận điểm, huy hiệu và phần thưởng hấp dẫn!</p>
    </header>

    <section class="mission-section">
      <h2>📅 Nhiệm vụ ngày</h2>
      <div class="mission-grid">
        <div class="mission-card">
          <h3>🗓️ Check-in mỗi ngày</h3>
          <p>Đăng nhập mỗi ngày để nhận điểm thưởng.</p>
          <div class="reward">🎁 +5 điểm</div>
          <button class="action-btn">Check-in</button>
        </div>

        <div class="mission-card">
          <h3>💬 Viết 1 bình luận</h3>
          <p>Góp ý cho bài viết của người khác.</p>
          <div class="reward">🎁 +10 điểm</div>
          <button class="action-btn">Bình luận</button>
        </div>

        <div class="mission-card">
          <h3>💬 Viết 1 bình luận</h3>
          <p>Góp ý cho bài viết của người khác.</p>
          <div class="reward">🎁 +10 điểm</div>
          <button class="action-btn">Bình luận</button>
        </div>

        <div class="mission-card">
          <h3>💬 Viết 1 bình luận</h3>
          <p>Góp ý cho bài viết của người khác.</p>
          <div class="reward">🎁 +10 điểm</div>
          <button class="action-btn">Bình luận</button>
        </div>

      </div>
    </section>

    <section class="mission-section">
      <h2>📆 Nhiệm vụ tháng</h2>
      <div class="mission-grid">
        <div class="mission-card">
          <h3>📝 Đăng 5 bài viết</h3>
          <p>Chia sẻ những chuyến đi tuyệt vời của bạn.</p>
          <div class="reward">🎁 +100 điểm</div>
          <button class="action-btn">Xem bài</button>
        </div>

        <div class="mission-card">
          <h3>👍 Nhận 100 lượt thích</h3>
          <p>Thu hút sự quan tâm từ cộng đồng.</p>
          <div class="reward">🎁 +150 điểm</div>
          <button class="action-btn">Theo dõi</button>
        </div>
      </div>
    </section>
@endsection