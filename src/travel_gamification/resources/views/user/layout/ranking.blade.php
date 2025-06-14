@extends('user.master')
@section('content')
<style>
    .ranking-table a {
        color: #222 !important;
        text-decoration: none;
    }
    .ranking-table a:hover {
        text-decoration: underline;
    }
</style>
<div class="ranking-page">
<header class="ranking-header">
  <h1 class="ranking-title">🏆 Bảng Xếp Hạng</h1>
  <p class="ranking-description">Khám phá người dùng và bài viết nổi bật nhất trong cộng đồng!</p>
  {{-- <div class="ranking-criteria" style="background: rgba(248, 249, 250, 0.5); border-radius: 8px; padding: 14px 18px; margin: 16px 0 24px 0; color:#333; font-size:15px;">
      <strong>🔎 Cách tính điểm xếp hạng bài viết:</strong>
      <ul style="margin: 8px 0 0 22px; padding: 0; font-size:14px; list-style: none;">
          <li>
              <b>Điểm tổng hợp</b> = Sự kết hợp giữa:
              <ul style="margin: 4px 0 0 18px; list-style: none;">
                  <li><b>Điểm sao trung bình</b> do cộng đồng đánh giá</li>
                  <li><b>Số lượt đánh giá</b> (nhiều đánh giá sẽ công bằng hơn)</li>
                  <li><b>Lượt thích</b> và <b>bình luận</b></li>
              </ul>
          </li>
          <li>
              <b>Công thức công bằng:</b>
              <code>score = (v/(v+m)) × R + (m/(v+m)) × C</code>
              <br>
              <span style="font-size:13px; color:#888;">
                  <b>v</b>: số lượt đánh giá của bài viết, <b>R</b>: điểm trung bình bài viết, <b>m</b>: ngưỡng tin cậy, <b>C</b>: điểm trung bình toàn hệ thống.
              </span>
          </li>
          <li>
              Nếu điểm tổng hợp bằng nhau, ưu tiên bài nhiều like, nhiều bình luận và mới hơn.
          </li>
      </ul>
  </div> --}}
</header>

<section class="ranking-section">
  <h2 class="ranking-subtitle">📝 Top 10 Bài Viết Tháng</h2>
  <table class="ranking-table">
    <thead class="ranking-table-head">
      <tr>
        <th>Hạng</th>
        <th>Bài viết</th>
        <th>Tác giả</th>
        <th>Lượt thích</th>
        <th>Bình luận</th>
        <th>Ngày</th>
        <th>Điểm tổng hợp</th>
      </tr>
    </thead>
    <tbody>
      @foreach($topPosts as $i => $post)
      <tr>
        <td>
          @if($i == 0) 🥇 @elseif($i == 1) 🥈 @elseif($i == 2) 🥉 @else {{ $i+1 }} @endif
        </td>
        <td style="text-align:left;">
          <a href="{{ route('post.detail', $post->id) }}">
            {{ $post->title }}
          </a>
        </td>
        <td style="text-align:left;">
          <img
            src="{{
                $post->user && $post->user->avatar
                    ? (Str::startsWith($post->user->avatar, 'http')
                        ? $post->user->avatar
                        : (file_exists(public_path('storage/avatars/' . $post->user->avatar))
                            ? asset('storage/avatars/' . $post->user->avatar)
                            : asset('storage/default.jpg')))
                    : asset('storage/default.jpg')
            }}"
            class="ranking-avatar"
          />
          <a href="{{ route('detail_user_follow', ['id' => $post->user->id]) }}">
            {{ $post->user->username ?? 'Ẩn danh' }}
          </a>
        </td>
        <td>{{ $post->like_count }}</td>
        <td>{{ $post->comment_count }}</td>
        <td>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}</td>
        <td>{{ round($post->score, 2) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</section>

<section class="ranking-section">
  <h2 class="ranking-subtitle">📋 Top 10 Người Dùng</h2>
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
      @foreach($topUsers as $i => $user)
      <tr>
        <td>
          @if($i == 0)
              <i class="fas fa-crown ranking-icon rank-1"></i> 1
          @elseif($i == 1)
              <i class="fas fa-crown ranking-icon rank-2"></i> 2
          @elseif($i == 2)
              <i class="fas fa-crown ranking-icon rank-3"></i> 3
          @else
              {{ $i+1 }}
          @endif
        </td>
        <td style="text-align:left;">
          <img
            src="{{
                $user->avatar
                    ? (Str::startsWith($user->avatar, 'http')
                        ? $user->avatar
                        : (file_exists(public_path('storage/avatars/' . $user->avatar))
                            ? asset('storage/avatars/' . $user->avatar)
                            : asset('storage/default.jpg')))
                    : asset('storage/default.jpg')
            }}"
            class="ranking-avatar"
          />
          <a href="{{ route('detail_user_follow', ['id' => $user->id]) }}">
            {{ $user->username }}
          </a>
        </td>
        <td>{{ $user->total_points }}</td>
        <td>{{ $user->posts()->count() }}</td>
        <td>
            {{
                $user->posts->reduce(function($carry, $post) {
                    return $carry + $post->likes->count();
                }, 0)
            }}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</section>
</div>
@endsection
