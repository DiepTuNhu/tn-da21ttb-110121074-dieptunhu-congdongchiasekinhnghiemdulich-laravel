@extends('user.master')
@section('content')
{{-- <link rel="stylesheet" href="{{ asset('style.css') }}"> --}}
<div class="submit-section" style="margin-top: 120px">
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