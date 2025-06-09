@extends('admin.index')
@section('title_name', 'Thống kê tổng quan')
@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Thống kê tổng quan</h3>

    <div class="grid row row-cols-1 row-cols-md-4 g-4 mb-4">
        <div class="col">
            <div class="card border-0 shadow-sm rounded text-bg-primary">
                <div class="card-body">
                    <h6 class="card-title">Người dùng</h6>
                    <h2 class="fw-bold">{{ $userCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm rounded text-bg-success">
                <div class="card-body">
                    <h6 class="card-title">Bài viết</h6>
                    <h2 class="fw-bold">{{ $postCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm rounded text-bg-warning">
                <div class="card-body">
                    <h6 class="card-title">Địa điểm</h6>
                    <h2 class="fw-bold">{{ $destinationCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm rounded text-bg-danger">
                <div class="card-body">
                    <h6 class="card-title">Tiện ích</h6>
                    <h2 class="fw-bold">{{ $utilityCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="grid row row-cols-1 row-cols-md-4 g-4 mb-5">
        <div class="col">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h6 class="card-title">Bình luận</h6>
                    <h2 class="fw-bold">{{ $commentCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h6 class="card-title">Lượt thích</h6>
                    <h2 class="fw-bold">{{ $likeCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h6 class="card-title">Nhiệm vụ hoàn thành</h6>
                    <h2 class="fw-bold">{{ $missionCompleted }}</h2>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h6 class="card-title">Huy hiệu đã trao</h6>
                    <h2 class="fw-bold">{{ $badgeAwarded }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">Top 5 người dùng tích cực</div>
                <ul class="list-group list-group-flush">
                    @foreach($topUsers as $user)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $user->username }}
                            <span class="badge bg-primary">{{ $user->posts_count }} bài viết</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">Top 5 bài viết nhiều lượt thích</div>
                <ul class="list-group list-group-flush">
                    @foreach($topPosts as $post)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $post->title }}
                            <span class="badge bg-success">{{ $post->likes_count }} lượt thích</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-5">
        <div class="card-body">
            <h5 class="card-title">Biểu đồ số người dùng và bài viết theo tháng</h5>
            <canvas id="overviewChart" width="800" height="300"></canvas>
        </div>
    </div>
</div>

{{-- Debug dữ liệu --}}
{{-- <pre>
{!! json_encode($months) !!}
{!! json_encode($monthlyUsers) !!}
{!! json_encode($monthlyPosts) !!}
</pre> --}}

{{-- @push('scripts') --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('overviewChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($months) !!},
            datasets: [
                {
                    label: 'Người dùng mới',
                    data: {!! json_encode($monthlyUsers) !!},
                    borderColor: 'rgb(54, 162, 235)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    tension: 0.3,
                    fill: true
                },
                {
                    label: 'Bài viết mới',
                    data: {!! json_encode($monthlyPosts) !!},
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    tension: 0.3,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
{{-- @endpush --}}
@endsection
