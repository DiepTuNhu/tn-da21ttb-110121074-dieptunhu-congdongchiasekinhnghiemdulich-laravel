@extends('user.master')
@section('content')
<header class="ranking-header">
  <h1 class="ranking-title">🏆 Bảng Xếp Hạng</h1>
  <p class="ranking-description">Khám phá người dùng và bài viết nổi bật nhất trong cộng đồng!</p>
</header>

<section class="ranking-section">
  <h2 class="ranking-subtitle">📋 Top Người Dùng</h2>
  <table class="ranking-table">
    <thead class="ranking-table-head">
      <tr>
        <th>Hạng</th>
        <th>Người dùng</th>
        <th>Điểm</th>
        <th>Bài viết</th>
        <th>Lượt thích</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><i class="fas fa-crown ranking-icon rank-1"></i> 1</td>
        <td><img src="https://i.pravatar.cc/36?img=1" class="ranking-avatar" /> Hưng Phạm</td>
        <td>1250</td>
        <td>25</td>
        <td>980</td>
      </tr>
      <tr>
        <td><i class="fas fa-crown ranking-icon rank-2"></i> 2</td>
        <td><img src="https://i.pravatar.cc/36?img=2" class="ranking-avatar" /> Linh Lê</td>
        <td>1120</td>
        <td>22</td>
        <td>870</td>
      </tr>
      <tr>
        <td><i class="fas fa-crown ranking-icon rank-3"></i> 3</td>
        <td><img src="https://i.pravatar.cc/36?img=3" class="ranking-avatar" /> Trường Vũ</td>
        <td>1050</td>
        <td>20</td>
        <td>820</td>
      </tr>
    </tbody>
  </table>
</section>

<section class="ranking-section">
  <h2 class="ranking-subtitle">📝 Top Bài Viết</h2>
  <table class="ranking-table">
    <thead class="ranking-table-head">
      <tr>
        <th>Hạng</th>
        <th>Bài viết</th>
        <th>Tác giả</th>
        <th>Lượt thích</th>
        <th>Bình luận</th>
        <th>Ngày</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>🥇 1</td>
        <td><img src="../1.png" class="ranking-thumb" /> 10 bãi biển đẹp nhất VN</td>
        <td><img src="https://i.pravatar.cc/36?img=1" class="ranking-avatar" /> Hưng Phạm</td>
        <td>135</td>
        <td>24</td>
        <td>10/04/2025</td>
      </tr>
      <tr>
        <td>🥈 2</td>
        <td><img src="../2.png" class="ranking-thumb" /> Du lịch Hội An cổ kính</td>
        <td><img src="https://i.pravatar.cc/36?img=2" class="ranking-avatar" /> Linh Lê</td>
        <td>120</td>
        <td>18</td>
        <td>09/04/2025</td>
      </tr>
      <tr>
        <td>🥉 3</td>
        <td><img src="../3.png" class="ranking-thumb" /> Trekking Tà Năng – Phan Dũng</td>
        <td><img src="https://i.pravatar.cc/36?img=3" class="ranking-avatar" /> Vũ Trường</td>
        <td>110</td>
        <td>15</td>
        <td>08/04/2025</td>
      </tr>
    </tbody>
  </table>
</section>
@endsection
