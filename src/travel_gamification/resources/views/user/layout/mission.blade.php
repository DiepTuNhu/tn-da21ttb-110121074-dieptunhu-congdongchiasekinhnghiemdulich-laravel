@extends('user.master')
@section('content')
<header class="mission-header">
      <h1>🎯 Nhiệm Vụ Của Bạn</h1>
      <p>Hoàn thành nhiệm vụ ngày và tháng để nhận điểm, huy hiệu và phần thưởng hấp dẫn!</p>
    </header>

    @if(!Auth::check())
    <div style="text-align: center; margin: 20px 0;">
        Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để xem và thực hiện nhiệm vụ!
    </div>
    @else
    <section class="mission-section">
      <h2>📅 Nhiệm vụ ngày</h2>
      <div class="mission-grid">
        @foreach($dailyMissions as $mission)
          <div class="mission-card">
            <h3>{{ $mission->name }}</h3>
            <p>{{ $mission->description }}</p>
            <div class="reward">🎁 +{{ $mission->points_reward }} điểm</div>
          {{-- Thanh tiến độ --}}
            <div class="progress" style="height: 18px; background: #eee; border-radius: 8px; margin-bottom: 8px;">
                <div style="width: {{ min(100, round($mission->progress_done / $mission->progress_total * 100)) }}%; background: #4caf50; height: 100%; border-radius: 8px; text-align: center; color: #fff; font-size: 13px;">
                    {{ min($mission->progress_done, $mission->progress_total) }} / {{ $mission->progress_total }}
                </div>
            </div>
            @php
                // Kiểm tra đã hoàn thành và đã nhận thưởng chưa (giả sử có biến $claimedMissions là mảng id nhiệm vụ đã nhận thưởng)
                $isCompleted = $mission->progress_done >= $mission->progress_total;
                $isClaimed = in_array($mission->id, $claimedMissions ?? []);
            @endphp

            @if($isCompleted && !$isClaimed)
                <button class="action-btn claim-btn" data-id="{{ $mission->id }}">Nhận thưởng</button>
            @elseif($isClaimed)
                <button class="action-btn" disabled>Đã nhận thưởng</button>
            @else
                <a href="{{ route('page.community') }}" class="action-btn">Thực hiện</a>
            @endif
          </div>
        @endforeach
      </div>
    </section>

    <section class="mission-section">
      <h2>📆 Nhiệm vụ tuần</h2>
      <div class="mission-grid">
        @foreach($weeklyMissions as $mission)
          <div class="mission-card">
            <h3>{{ $mission->name }}</h3>
            <p>{{ $mission->description }}</p>
            <div class="reward">🎁 +{{ $mission->points_reward }} điểm</div>
            {{-- Thanh tiến độ --}}
            <div class="progress" style="height: 18px; background: #eee; border-radius: 8px; margin-bottom: 8px;">
                <div style="width: {{ min(100, round($mission->progress_done / $mission->progress_total * 100)) }}%; background: #4caf50; height: 100%; border-radius: 8px; text-align: center; color: #fff; font-size: 13px;">
                    {{ min($mission->progress_done, $mission->progress_total) }} / {{ $mission->progress_total }}
                </div>
            </div>
            @php
                // Kiểm tra đã hoàn thành và đã nhận thưởng chưa (giả sử có biến $claimedMissions là mảng id nhiệm vụ đã nhận thưởng)
                $isCompleted = $mission->progress_done >= $mission->progress_total;
                $isClaimed = in_array($mission->id, $claimedMissions ?? []);
            @endphp

            @if($isCompleted && !$isClaimed)
                <button class="action-btn claim-btn" data-id="{{ $mission->id }}">Nhận thưởng</button>
            @elseif($isClaimed)
                <button class="action-btn" disabled>Đã nhận thưởng</button>
            @else
                <a href="{{ route('page.community') }}" class="action-btn">Thực hiện</a>
            @endif
          </div>
        @endforeach
      </div>
    </section>

    <section class="mission-section">
      <h2>📆 Nhiệm vụ tháng</h2>
      <div class="mission-grid">
        @foreach($monthlyMissions as $mission)
          <div class="mission-card">
            <h3>{{ $mission->name }}</h3>
            <p>{{ $mission->description }}</p>
            <div class="reward">🎁 +{{ $mission->points_reward }} điểm</div>
            {{-- Thanh tiến độ --}}
            <div class="progress" style="height: 18px; background: #eee; border-radius: 8px; margin-bottom: 8px;">
                <div style="width: {{ min(100, round($mission->progress_done / $mission->progress_total * 100)) }}%; background: #4caf50; height: 100%; border-radius: 8px; text-align: center; color: #fff; font-size: 13px;">
                    {{ min($mission->progress_done, $mission->progress_total) }} / {{ $mission->progress_total }}
                </div>
            </div>
            @php
                // Kiểm tra đã hoàn thành và đã nhận thưởng chưa (giả sử có biến $claimedMissions là mảng id nhiệm vụ đã nhận thưởng)
                $isCompleted = $mission->progress_done >= $mission->progress_total;
                $isClaimed = in_array($mission->id, $claimedMissions ?? []);
            @endphp

            @if($isCompleted && !$isClaimed)
                <button class="action-btn claim-btn" data-id="{{ $mission->id }}">Nhận thưởng</button>
            @elseif($isClaimed)
                <button class="action-btn" disabled>Đã nhận thưởng</button>
            @else
                <a href="{{ route('page.community') }}" class="action-btn">Thực hiện</a>
            @endif
          </div>
        @endforeach
      </div>
    </section>

<section class="mission-section">
  <h2>🎯 Nhiệm vụ đặc biệt</h2>
  <div class="mission-grid">
    @foreach($specialMissions as $mission)
      <div class="mission-card">
        <h3>{{ $mission->name }}</h3>
        <p>{{ $mission->description }}</p>
        <div class="reward">🎁 +{{ $mission->points_reward }} điểm</div>
        <div style="font-size:13px;color:#888;margin-bottom:6px;">
            🗓️
            Bắt đầu: {{ \Carbon\Carbon::parse($mission->start_date)->format('d/m/Y') }}
            <br>
            🗓️
            Kết thúc: {{ \Carbon\Carbon::parse($mission->end_date)->format('d/m/Y') }}
        </div>
        {{-- Thanh tiến độ --}}
        <div class="progress" style="height: 18px; background: #eee; border-radius: 8px; margin-bottom: 8px;">
          <div style="width: {{ min(100, round($mission->progress_done / $mission->progress_total * 100)) }}%; background: #4caf50; height: 100%; border-radius: 8px; text-align: center; color: #fff; font-size: 13px;">
            {{ min($mission->progress_done, $mission->progress_total) }} / {{ $mission->progress_total }}
          </div>
        </div>
        @php
            $isCompleted = $mission->progress_done >= $mission->progress_total;
            $isClaimed = in_array($mission->id, $claimedMissions ?? []);
        @endphp

        @if($isCompleted && !$isClaimed)
            <button class="action-btn claim-btn" data-id="{{ $mission->id }}">Nhận thưởng</button>
        @elseif($isClaimed)
            <button class="action-btn" disabled>Đã nhận thưởng</button>
        @else
            <a href="{{ route('page.community') }}" class="action-btn">Thực hiện</a>
        @endif
      </div>
    @endforeach
  </div>
</section>
    @endif

    
    <script>
    document.querySelectorAll('.claim-btn').forEach(btn => {
        btn.onclick = function() {
            const missionId = this.getAttribute('data-id');
            fetch('/missions/claim/' + missionId, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    alert('Bạn đã nhận được ' + data.points + ' điểm!');
                    location.reload();
                } else {
                    alert(data.message || 'Có lỗi xảy ra!');
                }
            });
        }
    });
    </script>
@endsection