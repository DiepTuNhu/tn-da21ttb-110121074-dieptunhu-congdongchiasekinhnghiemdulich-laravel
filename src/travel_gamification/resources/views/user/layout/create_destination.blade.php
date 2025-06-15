@extends('user.master')
@section('content')
{{-- <link rel="stylesheet" href="{{ asset('style.css') }}"> --}}

<div style="padding-top: 75px">
    @if(isset($stepsType) && $stepsType === 'utility')
        {{-- 3 bước: Tạo địa điểm -> Tạo tiện ích -> Đăng bài --}}
        <div class="progress-steps-wrapper" style="margin: 0 auto; max-width: 600px; padding-top: 30px;">
            <div class="progress-steps">
                <div class="step {{ (isset($step) && $step == 1) ? 'active' : '' }}">
                    <div class="circle">1</div>
                    <div class="label">Tạo địa điểm</div>
                </div>
                <div class="line"></div>
                <div class="step">
                    <div class="circle">2</div>
                    <div class="label">Tạo tiện ích</div>
                </div>
                <div class="line"></div>
                <div class="step">
                    <div class="circle">3</div>
                    <div class="label">Đăng bài</div>
                </div>
            </div>
        </div>
    @else
        {{-- 2 bước: Tạo địa điểm -> Đăng bài --}}
        <div class="progress-steps-wrapper" style="margin: 0 auto; max-width: 500px; padding-top: 30px;">
            <div class="progress-steps">
                <div class="step {{ (isset($step) && $step == 1) ? 'active' : '' }}">
                    <div class="circle">1</div>
                    <div class="label">Tạo địa điểm</div>
                </div>
                <div class="line"></div>
                <div class="step {{ isset($step) && $step == 2 ? 'active' : '' }}">
                    <div class="circle">2</div>
                    <div class="label">Đăng bài</div>
                </div>
            </div>
        </div>
    @endif
    <style>
    .progress-steps-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .progress-steps {
        display: flex;
        align-items: center;
        gap: 32px;
    }
    .progress-steps .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 90px;
    }
    .progress-steps .circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #e0e0e0;
        color: #888;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 20px;
        margin-bottom: 6px;
        transition: background 0.3s, color 0.3s;
        border: 2px solid #e0e0e0;
    }
    .progress-steps .step.active .circle {
        background: #007bff;
        color: #fff;
        border: 2px solid #007bff;
        box-shadow: 0 0 8px #007bff55;
    }
    .progress-steps .label {
        font-size: 15px;
        color: #333;
        font-weight: 500;
        text-align: center;
    }
    .progress-steps .line {
        flex: 1;
        height: 3px;
        background: linear-gradient(90deg, #e0e0e0 0%, #007bff 100%);
        min-width: 40px;
        border-radius: 2px;
    }
    </style>
</div>
<div class="submit-section">
    
    <h2>Thêm Địa Điểm Mới</h2>
    <form id="createDestinationForm" class="submit-form" method="POST" action="{{ route('user.destination.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="form-label">Tên địa điểm</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Tỉnh/Thành phố</label>
            <select id="province" class="form-control" required></select>
        </div>
        <div class="form-group">
            <label class="form-label">Quận/Huyện</label>
            <select id="district" class="form-control" required disabled></select>
        </div>
        <div class="form-group">
            <label class="form-label">Xã/Phường</label>
            <select id="ward" class="form-control" required disabled></select>
        </div>
        <input type="hidden" name="address" id="address">
        <div class="form-group">
            <label class="form-label">Đặc điểm nổi bật</label>
            <textarea name="highlights" class="form-control" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Hình ảnh địa điểm</label>
            <input type="file" name="images[]" class="form-control" multiple accept="image/*" required>
            <small>Có thể chọn nhiều ảnh</small>
        </div>
        <button type="submit" class="btn-submit">Tạo địa điểm</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Lấy danh sách tỉnh/thành phố
    $.get('https://provinces.open-api.vn/api/p/', function(data) {
        $('#province').append('<option value="">Chọn tỉnh/thành phố</option>');
        data.forEach(function(item) {
            $('#province').append('<option value="'+item.code+'" data-name="'+item.name+'">'+item.name+'</option>');
        });
    });

    // Khi chọn tỉnh, lấy huyện
    $('#province').on('change', function() {
        let provinceCode = $(this).val();
        let provinceName = $('#province option:selected').data('name');
        $('#district').empty().prop('disabled', true);
        $('#ward').empty().prop('disabled', true);
        if(provinceCode) {
            $.get('https://provinces.open-api.vn/api/p/'+provinceCode+'?depth=2', function(data) {
                $('#district').append('<option value="">Chọn quận/huyện</option>');
                data.districts.forEach(function(item) {
                    $('#district').append('<option value="'+item.code+'" data-name="'+item.name+'">'+item.name+'</option>');
                });
                $('#district').prop('disabled', false);
            });
        }
    });

    // Khi chọn huyện, lấy xã
    $('#district').on('change', function() {
        let districtCode = $(this).val();
        $('#ward').empty().prop('disabled', true);
        if(districtCode) {
            $.get('https://provinces.open-api.vn/api/d/'+districtCode+'?depth=2', function(data) {
                $('#ward').append('<option value="">Chọn xã/phường</option>');
                data.wards.forEach(function(item) {
                    $('#ward').append('<option value="'+item.code+'" data-name="'+item.name+'">'+item.name+'</option>');
                });
                $('#ward').prop('disabled', false);
            });
        }
    });

    // Khi submit, nối địa chỉ
    $('#createDestinationForm').on('submit', function(e) {
        let ward = $('#ward option:selected').data('name') || '';
        let district = $('#district option:selected').data('name') || '';
        let province = $('#province option:selected').data('name') || '';
        let address = [ward, district, province].filter(Boolean).join(', ');
        $('#address').val(address);
    });
});
</script>
@endsection