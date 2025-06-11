{{-- filepath: resources/views/admin/user_rewards/index.blade.php --}}
@extends('admin.index')

@section('content')
<div class="container mt-4">
    <h3>Danh sách người dùng đổi thưởng</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    {{-- <table class="table table-bordered table-striped"> --}}
              <table id="logTable" class="table table-striped mt-3">

        <thead>
            <tr>
                <th>Người dùng</th>
                <th>Email</th>
                <th>Phần thưởng</th>
                <th>Thời gian đổi</th>
                <th>Người nhận</th>
                <th>SĐT</th>
                <th>Địa chỉ</th>
                <th>Ghi chú giao hàng</th>
                <th>Đã giao</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($userRewards as $ur)
                <tr>
                    <td>{{ $ur->username }}</td>
                    <td>{{ $ur->email }}</td>
                    <td>{{ $ur->reward_name }}</td>
                    <td>{{ $ur->redeemed_at }}</td>
                    <td>{{ $ur->receiver_name }}</td>
                    <td>{{ $ur->receiver_phone }}</td>
                    <td>{{ $ur->receiver_address }}</td>
                    <td>{{ $ur->shipping_note }}</td>
                    <td>
                        @if($ur->delivered)
                            <span class="badge bg-success">Đã giao</span>
                        @else
                            <span class="badge bg-warning text-dark">Chưa giao</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.user_rewards.updateDelivered', $ur->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="delivered" value="{{ $ur->delivered ? 0 : 1 }}">
                            <button class="btn btn-sm {{ $ur->delivered ? 'btn-secondary' : 'btn-success' }}">
                                {{ $ur->delivered ? 'Đánh dấu chưa giao' : 'Đánh dấu đã giao' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $userRewards->links() }}
</div>
@endsection