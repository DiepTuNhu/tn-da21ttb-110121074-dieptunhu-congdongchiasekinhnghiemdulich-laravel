@extends('admin.index')

@section('content')
<style>
.top-post-item {
    display: flex !important;
    align-items: center;
    padding-right: 8px !important;
    padding-left: 16px !important;
    width: 100%;
}
.post-title-ellipsis {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    flex: 1 1 0;
    min-width: 0;
    max-width: 100%;
}
.top-post-item .badge {
    margin-left: auto;
    flex-shrink: 0;
    white-space: nowrap;
    margin-right: 0 !important;
}
.chart-legend {
    text-align: center;
    margin-top: 10px;
}
.chart-legend li {
    font-size: 15px;
    vertical-align: middle;
}
.card-body > div[style*="width:240px"] {
    margin-left: auto !important;
    margin-right: auto !important;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
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
        {{-- <div class="col">
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
        </div> --}}
        <div class="col">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h6 class="card-title">Lượt chia sẻ</h6>
                    <h2 class="fw-bold">{{ $shareCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h6 class="card-title">Lượt báo cáo</h6>
                    <h2 class="fw-bold">{{ $reportCount }}</h2>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="grid row row-cols-1 row-cols-md-2 g-4 mb-5">
        <div class="col">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h6 class="card-title">Lượt chia sẻ</h6>
                    <h2 class="fw-bold">{{ $shareCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h6 class="card-title">Lượt báo cáo</h6>
                    <h2 class="fw-bold">{{ $reportCount }}</h2>
                </div>
            </div>
        </div>
    </div> --}}

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
                        <li class="list-group-item top-post-item">
                            <span class="post-title-ellipsis">{{ $post->title }}</span>
                            <span class="badge bg-success">{{ $post->likes_count }} lượt thích</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        {{-- Tỉ lệ loại bài viết --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex flex-column align-items-center">
                    <h5 class="card-title w-100 text-center">Tỉ lệ loại bài viết</h5>
                    <div style="width:240px;height:240px;">
                        <canvas id="typeChart" width="240" height="240"></canvas>
                    </div>
                    <ul class="chart-legend mt-3 mb-0 text-center" style="list-style:none;padding-left:0;">
                        @foreach($typeLabels as $i => $label)
                            <li style="display:inline-block;margin-right:16px;">
                                <span style="display:inline-block;width:14px;height:14px;background:{{ ['#36a2eb', '#ffcd56', '#ff6384', '#4bc0c0'][$i % 4] }};margin-right:6px;border-radius:2px;"></span>
                                {{ $label }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- Tỉ lệ bài viết theo trạng thái --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex flex-column align-items-center">
                    <h5 class="card-title w-100 text-center">Tỉ lệ bài viết theo trạng thái</h5>
                    <div style="width:240px;height:240px;">
                        <canvas id="statusChart" width="240" height="240"></canvas>
                    </div>
                    <ul class="chart-legend mt-3 mb-0 text-center" style="list-style:none;padding-left:0;">
                        @foreach($statusLabels as $i => $label)
                            <li style="display:inline-block;margin-right:16px;">
                                <span style="display:inline-block;width:14px;height:14px;background:{{ ['#4caf50', '#f44336', '#2196f3', '#ff9800'][$i % 4] }};margin-right:6px;border-radius:2px;"></span>
                                {{ $label }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- Tỉ lệ địa điểm theo loại hình --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex flex-column align-items-center">
                    <h5 class="card-title w-100 text-center">Tỉ lệ địa điểm theo loại hình</h5>
                    <div style="width:240px;height:240px;">
                        <canvas id="destinationTypeChart" width="240" height="240"></canvas>
                    </div>
                    <ul class="chart-legend mt-3 mb-0 text-center" style="list-style:none;padding-left:0;">
                        @foreach($destinationTypeLabels as $i => $label)
                            <li style="display:inline-block;margin-right:16px;">
                                <span style="display:inline-block;width:14px;height:14px;background:{{ ['#36a2eb', '#ffcd56', '#ff6384', '#4bc0c0', '#4caf50'][$i % 5] }};margin-right:6px;border-radius:2px;"></span>
                                {{ $label }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-0 shadow-sm mb-5">
        <div class="card-body">
            <h5 class="card-title">Biểu đồ số người dùng và bài viết theo tháng</h5>
            <canvas id="overviewChart" width="800" height="300"></canvas>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-5">
        <div class="card-body">
            <h5 class="card-title">Danh sách tài khoản mới theo tháng</h5>
            @foreach($recentUsers as $month => $users)
                <h6 class="mt-3 text-primary month-toggle" style="cursor:pointer;" data-month="{{ $month }}">
                    {{ $month }}
                </h6>
                <ul class="list-group mb-2 month-list" id="month-list-{{ $month }}" style="display:none;">
                    @foreach($users as $user)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $user->username }}
                            <span class="text-muted" style="font-size:13px;">
                                {{ $user->created_at->format('d/m/Y H:i') }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>

    {{-- Biểu đồ cột lượt tương tác theo tháng --}}
    <div class="card border-0 shadow-sm mb-5">
        <div class="card-body">
            <h5 class="card-title">Biểu đồ lượt tương tác (Like, Comment, Share) theo tháng</h5>
            <canvas id="interactionChart" width="800" height="300"></canvas>
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

    // Sự kiện click vào tiêu đề tháng
    document.querySelectorAll('.month-toggle').forEach(function(header) {
        header.addEventListener('click', function() {
            // Ẩn tất cả danh sách tháng
            document.querySelectorAll('.month-list').forEach(function(list) {
                list.style.display = 'none';
            });
            // Hiện danh sách tháng được click
            var month = this.getAttribute('data-month');
            var list = document.getElementById('month-list-' + month);
            if(list) list.style.display = 'block';
            list && list.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

    // Sự kiện click vào điểm trên biểu đồ
    document.getElementById('overviewChart').onclick = function(evt) {
        const points = chart.getElementsAtEventForMode(evt, 'nearest', { intersect: true }, true);
        if (points.length) {
            const idx = points[0].index;
            document.querySelectorAll('.month-list').forEach(function(list) {
                list.style.display = 'none';
            });
            var months = {!! json_encode($months) !!};
            var month = months[idx];
            var list = document.getElementById('month-list-' + month);
            if(list) list.style.display = 'block';
            list && list.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    };

    // Mặc định mở tháng đầu tiên
    document.addEventListener('DOMContentLoaded', function() {
        var firstMonth = document.querySelector('.month-list');
        if(firstMonth) firstMonth.style.display = 'block';
    });

    const typeCtx = document.getElementById('typeChart').getContext('2d');
    new Chart(typeCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($typeLabels) !!},
            datasets: [{
                data: {!! json_encode($typeCounts) !!},
                backgroundColor: ['#36a2eb', '#ffcd56', '#ff6384', '#4bc0c0'],
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($statusLabels) !!},
            datasets: [{
                data: {!! json_encode($statusCounts) !!},
                backgroundColor: ['#4caf50', '#f44336', '#2196f3', '#ff9800'],
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

    const destinationTypeCtx = document.getElementById('destinationTypeChart').getContext('2d');
    new Chart(destinationTypeCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($destinationTypeLabels) !!},
            datasets: [{
                data: {!! json_encode($destinationTypeCounts) !!},
                backgroundColor: ['#36a2eb', '#ffcd56', '#ff6384', '#4bc0c0', '#4caf50'],
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

    // Biểu đồ cột lượt tương tác theo tháng
    const interactionCtx = document.getElementById('interactionChart').getContext('2d');
    new Chart(interactionCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($months) !!},
            datasets: [
                {
                    label: 'Like',
                    backgroundColor: '#4e73df',
                    data: {!! json_encode($likeData ?? []) !!},
                },
                {
                    label: 'Comment',
                    backgroundColor: '#1cc88a',
                    data: {!! json_encode($commentData ?? []) !!},
                },
                {
                    label: 'Share',
                    backgroundColor: '#f6c23e',
                    data: {!! json_encode($shareData ?? []) !!},
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
                x: { stacked: true },
                y: { stacked: true, beginAtZero: true }
            }
        }
    });
</script>
{{-- @endpush --}}
@endsection
