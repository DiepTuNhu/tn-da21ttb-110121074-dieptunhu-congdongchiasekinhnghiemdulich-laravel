@extends('user.master')
@section('content')
<style>
    .reward-section {
        max-width: 800px;
        margin: 100px auto 20px;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.5);
        padding: 32px 28px 24px 28px;
    }
    .reward-section h3 {
        font-weight: 700;
        color: #e67e22;
        margin-bottom: 18px;
    }
    .reward-section .current-point {
        font-size: 1.1rem;
        margin-bottom: 24px;
        color: #333;
    }
    .reward-list {
        margin-bottom: 32px;
    }
    .reward-item {
        display: flex;
        align-items: center;
        border: 1px solid #f0f0f0;
        border-radius: 10px;
        padding: 16px 18px;
        margin-bottom: 18px;
        background: #faf9f6;
        transition: box-shadow 0.2s;
    }
    .reward-item:hover {
        box-shadow: 0 2px 8px rgba(230,126,34,1);
        border-color: #e67e22;
    }
    .reward-item img {
        width: 72px;
        height: 72px;
        object-fit: cover;
        border-radius: 10px;
        margin-right: 22px;
        border: 2px solid #fff;
        box-shadow: 0 1px 4px rgba(0,0,0,0.04);
    }
    .reward-info h4 {
        margin: 0 0 6px 0;
        font-size: 1.15rem;
        font-weight: 600;
        color: #e67e22;
    }
    .reward-info p {
        margin: 0 0 8px 0;
        color: #555;
        font-size: 0.98rem;
    }
    .reward-info .reward-meta {
        font-size: 0.97rem;
        color: #888;
    }
    .reward-action {
        margin-left: 18px;
    }
    .reward-action .btn-success {
        background: linear-gradient(90deg,#e67e22 60%,#f6c177 100%);
        border: none;
        color: #fff;
        font-weight: 600;
        padding: 8px 18px;
        border-radius: 6px;
        transition: background 0.2s;
    }
    .reward-action .btn-success:disabled {
        background: #ccc;
        color: #fff;
        cursor: not-allowed;
    }
    .history-title {
        margin-top: 32px;
        font-weight: 600;
        color: #e67e22;
        font-size: 1.1rem;
    }
.table-reward-history {
    width: 100%;
    min-width: 700px;
    max-width: 100%;
    margin: 0 auto;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 1px 6px rgba(0,0,0,0.04);
}
@media (max-width: 900px) {
    .table-reward-history {
        min-width: 500px;
        font-size: 0.95rem;
    }
}
    .table-reward-history th, .table-reward-history td {
        vertical-align: middle !important;
        text-align: center;
    }
    .table-reward-history th {
        background: #f7f7f7;
        color: #e67e22;
        font-weight: 600;
    }
    .table-reward-history td {
        color: #444;
    }
    .text-success { color: #27ae60 !important; }
    .text-warning { color: #e67e22 !important; }
</style>
<div class="reward-section">
    <h3>🎁 Đổi thưởng bằng điểm</h3>
    <div class="current-point">
        Điểm hiện tại: <strong style="color:#e67e22">{{ number_format($user->redeemable_points) }}</strong>
    </div>
    <div class="reward-list">
        @foreach($rewards as $reward)
        <div class="reward-item">
            <img src="{{ asset('storage/rewards/' . $reward->image) }}" alt="{{ $reward->name }}">
            <div class="reward-info" style="flex:1;">
                <h4>{{ $reward->name }}</h4>
                <p>{{ $reward->description }}</p>
                <div class="reward-meta">
                    <span style="color:#e67e22; font-weight:600;">{{ number_format($reward->cost_points) }} điểm</span>
                    <span class="ml-2">| Tồn kho: {{ $reward->stock }}</span>
                </div>
            </div>
            <div class="reward-action">
                @if($reward->type == 'physical')
                    <button type="button" class="btn btn-success" onclick="showRedeemModal({{ $reward->id }}, '{{ $reward->name }}')" 
                        @if($user->redeemable_points < $reward->cost_points || $reward->stock <= 0 || !$reward->active) disabled @endif>
                        Đổi thưởng
                    </button>
                @else
                    <form action="{{ route('user.redeem_reward', $reward->id) }}" method="POST" class="redeem-form">
                        @csrf
                        <button type="submit" class="btn btn-success"
                            @if($user->redeemable_points < $reward->cost_points || $reward->stock <= 0 || !$reward->active) disabled @endif>
                            Đổi thưởng
                        </button>
                    </form>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    <div class="history-title">Lịch sử đổi thưởng</div>
    <table class="table table-bordered table-reward-history">
        <thead>
            <tr>
                <th>Tên phần thưởng</th>
                <th>Thời gian đổi</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach($history as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->pivot->redeemed_at }}</td>
                <td>
                    @if($item->pivot->delivered)
                        <span class="text-success">Đã nhận</span>
                    @else
                        <span class="text-warning">Chờ xử lý</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{-- Modal nhập thông tin nhận hàng --}}
<div class="modal" id="redeemModal" tabindex="-1" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.3);">
    <div style="background:#fff; max-width:420px; margin:100px auto; border-radius:10px; padding:24px 28px; position:relative; box-shadow:0 2px 12px rgba(0,0,0,0.15);">
        <h4 id="modalRewardName" style="color:#e67e22; font-weight:600; margin-bottom:18px;"></h4>
        <form id="redeemPhysicalForm" method="POST" autocomplete="off">
            @csrf
            <div class="form-group" style="margin-bottom:14px;">
                <label for="receiver_name" style="font-weight:500;">Họ tên người nhận <span style="color:red">*</span></label>
                <input type="text" name="receiver_name" id="receiver_name" class="form-control" required maxlength="255" placeholder="Nhập họ tên người nhận">
            </div>
            <div class="form-group" style="margin-bottom:14px;">
                <label for="receiver_phone" style="font-weight:500;">Số điện thoại <span style="color:red">*</span></label>
                <input type="text" name="receiver_phone" id="receiver_phone" class="form-control" required maxlength="20" placeholder="Nhập số điện thoại">
            </div>
            <div class="form-group" style="margin-bottom:14px;">
                <label for="receiver_address" style="font-weight:500;">Địa chỉ nhận hàng <span style="color:red">*</span></label>
                <textarea name="receiver_address" id="receiver_address" class="form-control" required maxlength="500" rows="2" placeholder="Nhập địa chỉ nhận hàng"></textarea>
            </div>
            <div class="form-group" style="margin-bottom:18px;">
                <label for="shipping_note" style="font-weight:500;">Ghi chú giao hàng</label>
                <input type="text" name="shipping_note" id="shipping_note" class="form-control" maxlength="255" placeholder="Ghi chú thêm (nếu có)">
            </div>
            <div style="text-align:right;">
                <button type="button" onclick="closeRedeemModal()" class="btn btn-secondary" style="margin-right:8px;">Hủy</button>
                <button type="submit" class="btn btn-success">Xác nhận đổi</button>
            </div>
        </form>
    </div>
</div>
<script>
function showRedeemModal(rewardId, rewardName) {
    document.getElementById('redeemModal').style.display = 'block';
    document.getElementById('modalRewardName').innerText = 'Đổi thưởng: ' + rewardName;
    document.getElementById('redeemPhysicalForm').action = '/rewards/redeem/' + rewardId;
    // Reset form fields
    document.getElementById('receiver_name').value = '';
    document.getElementById('receiver_phone').value = '';
    document.getElementById('receiver_address').value = '';
    document.getElementById('shipping_note').value = '';
}
function closeRedeemModal() {
    document.getElementById('redeemModal').style.display = 'none';
}
</script>
@push('scripts')
<script>
    document.querySelectorAll('.redeem-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            if(!confirm('Bạn có chắc chắn muốn đổi thưởng này không?')) {
                e.preventDefault();
            }
        });
    });
</script>
@endpush
@endsection