@extends('user.master')
@section('content')
<header class="mission-header">
      <h1>🎯 Nhiệm Vụ Của Bạn</h1>
      <p>Hoàn thành nhiệm vụ ngày và tháng để nhận điểm, huy hiệu và phần thưởng hấp dẫn!</p>
    </header>

    <section class="mission-section">
      <h2>📅 Nhiệm vụ ngày</h2>
      <div class="mission-grid">
        @foreach($dailyMissions as $mission)
          <div class="mission-card">
            <h3>{{ $mission->name }}</h3>
            <p>{{ $mission->description }}</p>
            <div class="reward">🎁 +{{ $mission->points_reward }} điểm</div>
            <a href="{{ route('page.community') }}" class="action-btn">Thực hiện</a>
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
            <a href="{{ route('page.community') }}" class="action-btn">Thực hiện</a>
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
            <a href="{{ route('page.community') }}" class="action-btn">Thực hiện</a>
          </div>
        @endforeach
      </div>
    </section>

    {{-- <section class="mission-section">
      <h2>🎯 Nhiệm vụ đặc biệt</h2>
      <div class="mission-grid">
        @foreach($onceMissions as $mission)
          <div class="mission-card">
            <h3>{{ $mission->name }}</h3>
            <p>{{ $mission->description }}</p>
            <div class="reward">🎁 +{{ $mission->points_reward }} điểm</div>
            <a href="{{ route('page.community') }}" class="action-btn">Thực hiện</a>
          </div>
        @endforeach
      </div>
    </section> --}}

@endsection