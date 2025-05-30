@extends('user.master')
@section('content')
<div class="submit-section" style="max-width: 700px; margin-top: 100px;">
    <h2>Thêm tiện ích mới</h2>
    <form action="{{ route('user.utility.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mt-3">
            <label for="name">Tên tiện ích</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>
        <div class="form-group mt-3">
            <label for="province">Tỉnh/Thành</label>
            <select id="province" class="form-control" required></select>
        </div>
        <div class="form-group mt-3">
            <label for="district">Quận/Huyện</label>
            <select id="district" class="form-control" required></select>
        </div>
        <div class="form-group mt-3">
            <label for="ward">Xã/Phường</label>
            <select id="ward" class="form-control" required></select>
        </div>
        <input type="hidden" name="address" id="address">
        <div class="form-group mt-3">
            <label for="image">Hình ảnh</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group mt-3">
            <label for="destination_id">Chọn địa điểm gần đó</label>
            <select name="destination_id" class="form-control" required id="destinationSelect">
                <option value="">-- Chọn địa điểm --</option>
                @foreach($destinations as $destination)
                    <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mt-3">
          <label for="utility_type_id">Loại tiện ích</label>
          <select name="utility_type_id" class="form-control" required>
              <option value="">-- Chọn loại tiện ích --</option>
              @foreach($utilityTypes as $type)
                  <option value="{{ $type->id }}" {{ old('utility_type_id') == $type->id ? 'selected' : '' }}>
                      {{ $type->name }}
                  </option>
              @endforeach
          </select>
        </div>
        <div class="form-group mt-3">
            <label for="price">Giá</label>
            <input type="text" name="price" class="form-control" value="{{ old('price') }}" placeholder="Nhập giá (ví dụ: 100.000VNĐ, Miễn phí...)">
        </div>
        <div class="form-group mt-3">
            <label for="time">Giờ phục vụ</label>
            <input type="text" name="time" class="form-control" value="{{ old('time') }}" placeholder="Nhập giờ phục vụ (ví dụ: 8:00 - 22:00)">
        </div>
        <div class="form-group mt-3">
            <label for="description">Mô tả</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Mô tả tiện ích...">{{ old('description') }}</textarea>
        </div>
<div class="form-group mt-3">
    <label for="distance">Khoảng cách đến địa điểm (km)</label>
    <input type="number" step="0.01" min="0" name="distance" class="form-control" value="{{ old('distance') }}" placeholder="Nhập khoảng cách (ví dụ: 0.5)">
</div>
        <button type="submit" class="btn-submit">Tạo tiện ích</button>
    </form>
</div>

<style>
  h2 {
    text-align: center;
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 28px;
    /* color: #007bff; */
    letter-spacing: 1px;
}

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    font-weight: 500;
    margin-bottom: 6px;
    display: block;
    color: #333;
}

.form-control {
    width: 100%;
    padding: 10px 12px;
    /* border: 1px solid #d4d8dd; */
    border-radius: 6px;
    font-size: 15px;
    /* background: #f9fafb; */
    transition: border 0.2s;
}

.form-control:focus {
    border-color: #007bff;
    background: #fff;
    outline: none;
}

.btn-submit {
    width: 100%;
    /* background: linear-gradient(90deg, #007bff 60%, #0056b3 100%); */
    color: #fff;
    border: none;
    padding: 13px 0;
    border-radius: 7px;
    font-size: 17px;
    font-weight: 600;
    margin-top: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    cursor: pointer;
    transition: background 0.18s, color 0.18s;
}

.btn-submit:hover {
    background: linear-gradient(90deg, #0056b3 60%, #007bff 100%);
    color: #fff;
}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function() {
    // Lấy tỉnh
    $.get('https://provinces.open-api.vn/api/?depth=1', function(data) {
        let html = '<option value="">Chọn tỉnh/thành</option>';
        data.forEach(function(item) {
            html += `<option value="${item.code}" data-name="${item.name}">${item.name}</option>`;
        });
        $('#province').html(html);
    });

    // Khi chọn tỉnh, lấy huyện
    $('#province').on('change', function() {
        let code = $(this).val();
        $('#district').html('<option value="">Chọn quận/huyện</option>');
        $('#ward').html('<option value="">Chọn xã/phường</option>');
        if (code) {
            $.get(`https://provinces.open-api.vn/api/p/${code}?depth=2`, function(data) {
                let html = '<option value="">Chọn quận/huyện</option>';
                data.districts.forEach(function(item) {
                    html += `<option value="${item.code}" data-name="${item.name}">${item.name}</option>`;
                });
                $('#district').html(html);
            });
        }
        updateAddress();
    });

    // Khi chọn huyện, lấy xã
    $('#district').on('change', function() {
        let code = $(this).val();
        $('#ward').html('<option value="">Chọn xã/phường</option>');
        if (code) {
            $.get(`https://provinces.open-api.vn/api/d/${code}?depth=2`, function(data) {
                let html = '<option value="">Chọn xã/phường</option>';
                data.wards.forEach(function(item) {
                    html += `<option value="${item.name}">${item.name}</option>`;
                });
                $('#ward').html(html);
            });
        }
        updateAddress();
    });

    // Khi chọn xã
    $('#ward').on('change', function() {
        updateAddress();
    });

    function updateAddress() {
        let ward = $('#ward').val();
        let district = $('#district option:selected').data('name');
        let province = $('#province option:selected').data('name');
        let address = '';
        if (ward) address += ward;
        if (district) address += (address ? ', ' : '') + district;
        if (province) address += (address ? ', ' : '') + province;
        $('#address').val(address);
    }

    // Tự động chọn địa điểm nếu có destination_id trên URL (chắc chắn hoạt động)
    const urlParams = new URLSearchParams(window.location.search);
    const destinationId = urlParams.get('destination_id');
    if (destinationId) {
        function trySetDestination() {
            // Nếu option đã render thì set value, nếu chưa thì thử lại sau 100ms
            if ($('#destinationSelect option[value="' + destinationId + '"]').length) {
                $('#destinationSelect').val(destinationId);
            } else {
                setTimeout(trySetDestination, 100);
            }
        }
        trySetDestination();
    }
});
</script>
@endsection