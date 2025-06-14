@extends('user.master')
@section('content')
  <header class="explore-header">
    <h1>Đăng bài mới</h1>
    <p>Đăng những bài chia sẻ về địa điểm du lịch khác nhau trên khắp Việt Nam!</p>
  </header>
<div class="container-post-share" style="max-width: 600px; margin: 40px auto;">
    {{-- <h2>Đăng bài chia sẻ mới</h2> --}}
    <div class="form-group">
        <label>Bạn muốn chia sẻ về:</label>
        <select id="shareType" class="form-control" required>
            <option value="">-- Chọn --</option>
            <option value="location">📍 Một địa điểm du lịch</option>
            <option value="facility">🧭 Một tiện ích tại địa điểm</option>
        </select>
    </div>

    <!-- Thay thế các div .form-group chọn tỉnh/thành, địa điểm, loại tiện ích, tiện ích bằng đoạn này -->
<div class="post-share-select-group">
    {{-- Địa điểm --}}
    <div id="locationSection" style="display:none;">
        <div class="select-row">
            <div class="form-group">
                <label for="provinceSelect">Tỉnh/Thành</label>
                <select id="provinceSelect" class="form-control"></select>
            </div>
            <div class="form-group">
                <label for="destinationSelect">Địa điểm</label>
                <select id="destinationSelect" class="form-control">
                    <option value="" selected disabled>-- Chọn địa điểm --</option>
                    <option value="create_new">+ Tạo mới</option>
                    @foreach($destinations as $destination)
                        <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
{{-- <a href="{{ route('user.destination.create') }}" class="text-primary">+ Địa điểm bạn cần chưa có? Tạo mới</a> --}}
        <br>
        {{-- <button id="goToPostLocation" class="btn btn-primary mt-3" disabled>Tiếp tục</button> --}}
    </div>

    {{-- Tiện ích --}}
    <div id="facilitySection" style="display:none;">
        <div class="select-row">
            <div class="form-group">
                <label for="provinceSelect2">Tỉnh/Thành</label>
                <select id="provinceSelect2" class="form-control"></select>
            </div>
            <div class="form-group">
                <label for="destinationSelect2">Địa điểm</label>
                <select id="destinationSelect2" class="form-control"></select>
            </div>
<a href="{{ route('user.destination.create') }}" class="text-primary">+ Địa điểm bạn cần chưa có? Tạo mới</a>

        </div>
        <div class="select-row" id="utilityOptionsRow" style="margin-top: 10px; display: none;">
            <div class="form-group" style="min-width:180px;">
                <label for="utilityTypeSelect">Loại tiện ích</label>
                <select id="utilityTypeSelect" class="form-control">
                    <option value="">Chọn loại tiện ích</option>
                    @foreach($utilityTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" style="min-width:180px;">
                <label for="utilitySelect">Tiện ích</label>
                <select id="utilitySelect" class="form-control">
                    <option value="create_new">+ Tiện ích bạn muốn chia sẻ chưa có? Tạo mới</option>
                </select>
            </div>
        </div>
        <a href="{{ route('user.utility.create') }}" class="text-primary" id="createUtilityLink" style="display:none;">+ Tiện ích bạn muốn chia sẻ chưa có? Tạo mới</a>
        <br>
        {{-- <button id="goToPostFacility" class="btn btn-primary mt-3" disabled>Tiếp tục</button> --}}
    </div>
</div>
</div>
<div id="destinationCards" class="row mt-4" style="text-align: center"></div>
<div id="facilityDestinationCards" class="row mt-4" style="text-align: center"></div>
<div id="destinationPagination" class="mt-3"></div>
<div id="facilityDestinationPagination" class="mt-3"></div>
<div id="utilityCards" class="row mt-4"  style="text-align: center"></div>
<!-- ĐÚNG THỨ TỰ: jQuery trước, select2 sau -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    // Nếu có new_destination_id trong session (flash), tự động chuyển sang trang đăng bài
    @if(session('new_destination_id'))
        // Xóa tiến trình nếu có
        localStorage.removeItem('post_share_progress');
        // Chuyển sang trang đăng bài với id địa điểm vừa tạo
        window.location.href = '{{ route('post_articles', ['id' => session('new_destination_id')]) }}';
    @endif

    // Ẩn các phần khi mới vào
    $('#destinationCards').hide();
    $('#locationSection').hide();
    $('#facilitySection').hide();

    // Lấy danh sách tỉnh từ API
    $.get('https://provinces.open-api.vn/api/?depth=1', function(data) {
        let html = '<option value="">Chọn tỉnh/thành</option>';
        data.forEach(function(province) {
            html += `<option value="${province.name}">${province.name}</option>`;
        });
        $('#provinceSelect, #provinceSelect2').html(html);
    });

    // Khi chọn loại chia sẻ
    $('#shareType').on('change', function() {
        let type = $(this).val();
        $('#locationSection').toggle(type === 'location');
        $('#facilitySection').toggle(type === 'facility');
        if(type === 'location') {
            $('#destinationCards').show();
            $('#facilityDestinationCards').hide().html('');
            $('#destinationPagination').show();
            $('#facilityDestinationPagination').hide().html('');
            $('#utilityCards').hide().html(''); // <-- Thêm dòng này để ẩn thẻ tiện ích
            renderDestinationCards();
            loadAllDestinationsForDropdown($('#provinceSelect').val());
        } else if(type === 'facility') {
            $('#destinationCards').hide().html('');
            $('#facilityDestinationCards').show();
            $('#destinationPagination').hide().html('');
            $('#facilityDestinationPagination').show();
            renderFacilityDestinationCards();
            loadAllDestinationsForDropdown2($('#provinceSelect2').val());
            $('#utilityTypeSection').hide();
            $('#destinationSelect2').val('').trigger('change');
        } else {
            $('#destinationCards').hide().html('');
            $('#facilityDestinationCards').hide().html('');
            $('#destinationPagination').hide().html('');
            $('#facilityDestinationPagination').hide().html('');
            $('#utilityTypeSection').hide();
            $('#utilityCards').hide().html('');
        }
    });

    // Khi chọn tỉnh ở phần tiện ích
    $('#provinceSelect2').on('change', function() {
        let province = $(this).val();
        renderFacilityDestinationCards(province);
        loadAllDestinationsForDropdown2(province);
        $('#utilityTypeSection').hide();
        $('#utilityCards').hide().html('');
        $('#facilityDestinationCards').show();
        $('#destinationSelect2').val('').trigger('change');
        $('#facilityDestinationPagination').show();
        $('#destinationPagination').hide();
    });

    // Khi chọn tỉnh, lọc lại card và cập nhật dropdown
    $('#provinceSelect').on('change', function() {
        let province = $(this).val();
        renderDestinationCards(province);
        loadAllDestinationsForDropdown(province); // <-- luôn gọi hàm này
    });

    // Hàm render thẻ địa điểm
    let currentPage = 1;

    window.renderDestinationCards = function(province = '', page = 1, q = '', updateDropdown = true) {
        $.ajax({
            url: '{{ route('ajax.post_share_destinations') }}',
            data: { province: province, page: page, q: q },
            success: function(res) {
                let html = '';
                let results = res.results || [];
                let viewed = JSON.parse(localStorage.getItem('viewed_destinations') || '[]').map(Number);
                results.sort(function(a, b) {
                    let ia = viewed.indexOf(Number(a.id));
                    let ib = viewed.indexOf(Number(b.id));
                    if (ia === -1 && ib === -1) return 0;
                    if (ia === -1) return 1;
                    if (ib === -1) return -1;
                    return ia - ib;
                });
                if (results.length === 0) {
                    html = '<div class="destination-card"><p>Không có địa điểm nào.</p></div>';
                } else {
                    results.forEach(function(item) {
                        html += `
                        <div class="destination-card" data-id="${item.id}">
                            <div class="card shadow-sm h-100">
                                <img src="${item.image}" class="card-img-top" alt="${item.text}">
                                <div class="card-body">
                                    <h5 class="card-title">${item.text}</h5>
                                </div>
                            </div>
                        </div>`;
                    });
                }
                $('#destinationCards').html(html);
                renderPagination(res.current_page, res.last_page, province);

                // CHỈ cập nhật dropdown nếu không phải đang tìm kiếm
                if (updateDropdown) {
                    let selectHtml = '<option value="">Tìm kiếm địa điểm</option>';
                    results.forEach(function(item) {
                        selectHtml += `<option value="${item.id}">${item.text}</option>`;
                    });
                    $('#destinationSelect').html(selectHtml);
                    $('#destinationSelect').select2({
                        width: '100%',
                        placeholder: 'Tìm kiếm địa điểm'
                    });
                }
            }
        });
    }

    function renderPagination(current, last, province) {
        let html = '';
        if (last > 1) {
            html += `<nav class="pagination-nav"><ul class="pagination">`;
            for (let i = 1; i <= last; i++) {
                html += `<li class="page-item${i === current ? ' active' : ''}">
                            <a href="#" class="page-link" data-page="${i}" data-province="${province}">${i}</a>
                        </li>`;
            }
            html += `</ul></nav>`;
        }
        $('#destinationPagination').html(html);

        // Gán sự kiện click
        $('.page-link').off('click').on('click', function(e) {
            e.preventDefault();
            let page = $(this).data('page');
            let province = $(this).data('province');
            renderDestinationCards(province, page);
        });
    }

    // Khi người dùng xem chi tiết địa điểm, ví dụ id = 123
    window.markDestinationAsViewed = function(id) {
    id = Number(id);
    let viewed = JSON.parse(localStorage.getItem('viewed_destinations') || '[]').map(Number);
    if (!viewed.includes(id)) {
        viewed.unshift(id);
        if (viewed.length > 20) viewed = viewed.slice(0, 20);
        localStorage.setItem('viewed_destinations', JSON.stringify(viewed));
    }
}

$('#destinationSelect').select2({
    width: '100%',
    placeholder: 'Tìm kiếm địa điểm'
});

$('#destinationSelect').on('select2:open', function() {
    setTimeout(function() {
        document.querySelector('.select2-container--open .select2-search__field').focus();
    }, 0);

    // Lắng nghe sự kiện nhập từ khóa
    $('.select2-search__field').off('input').on('input', function() {
        let keyword = $(this).val();
        let province = $('#provinceSelect').val();
        // CHỈ render card, KHÔNG cập nhật lại dropdown!
        renderDestinationCards(province, 1, keyword, false);
    });
});

$('#destinationSelect2').select2({
    width: '100%',
    placeholder: 'Tìm kiếm địa điểm'
});

$('#destinationSelect2').on('select2:open', function() {
    setTimeout(function() {
        document.querySelector('.select2-container--open .select2-search__field').focus();
    }, 0);

    // Lắng nghe sự kiện nhập từ khóa
    $('.select2-search__field').off('input.facility').on('input.facility', function() {
        let keyword = $(this).val();
        let province = $('#provinceSelect2').val();
        // Chỉ render card, không cập nhật lại dropdown!
        renderFacilityDestinationCards(province, 1, keyword);
    });
});

$('#destinationSelect, #destinationSelect2, #utilitySelect').on('select2:open', function() {
    setTimeout(function() {
        document.querySelector('.select2-container--open .select2-search__field').focus();
    }, 0);
});

    // Hàm lấy toàn bộ địa điểm cho dropdown (không phân trang)
    function loadAllDestinationsForDropdown(province = '') {
        $.ajax({
            url: '{{ route('ajax.post_share_destinations') }}',
            data: { province: province, all: 1 },
            success: function(res) {
                // Luôn có option mặc định và option tạo mới ở đầu
                let selectHtml = '<option value="" selected disabled>-- Chọn địa điểm --</option>';
                selectHtml += '<option value="create_new">+ Tạo mới</option>';
                (res.all_results || []).forEach(function(item) {
                    selectHtml += `<option value="${item.id}">${item.text}</option>`;
                });
                $('#destinationSelect').html(selectHtml);
                $('#destinationSelect').select2({
                    width: '100%',
                    placeholder: 'Tìm kiếm địa điểm'
                });
            }
        });
    }

// Hàm lấy toàn bộ địa điểm cho dropdown ở phần tiện ích (không phân trang)
function loadAllDestinationsForDropdown2(province = '') {
    $.ajax({
        url: '{{ route('ajax.post_share_destinations') }}',
        data: { province: province, all: 1 },
        success: function(res) {
            let selectHtml = '<option value="">Tìm kiếm địa điểm</option>';
            (res.all_results || []).forEach(function(item) {
                selectHtml += `<option value="${item.id}">${item.text}</option>`;
            });
            $('#destinationSelect2').html(selectHtml);
            $('#destinationSelect2').select2({
                width: '100%',
                placeholder: 'Tìm kiếm địa điểm'
            });
        }
    });
}


$('#destinationSelect2').on('change', function() {
    let destinationId = $(this).val();
    if (destinationId) {
        $('#utilityOptionsRow').show();
        $('#createUtilityLink')
            .show()
            .attr('href', '{{ route('user.utility.create') }}' + '?destination_id=' + destinationId); // <-- Thêm dòng này
        $('#facilityDestinationCards').hide().html('');
        renderUtilityCards(destinationId, $('#utilityTypeSelect').val());
        loadAllUtilitiesForDropdown(destinationId, $('#utilityTypeSelect').val());
        $('#utilityCards').show();
        $('#facilityDestinationPagination').hide();
    } else {
        $('#utilityOptionsRow').hide();
        $('#createUtilityLink').hide(); // Ẩn link khi chưa chọn địa điểm
        $('#utilityCards').hide().html('');
        $('#facilityDestinationCards').show();
        $('#facilityDestinationPagination').show();
    }
    $('#destinationPagination').hide();
});

// Nếu bạn có route('page.post_articles', ['id' => 'ID'])
function goToPostArticles(id) {
    window.location.href = '{{ route('post_articles', ['id' => '___ID___']) }}'.replace('___ID___', id);
}

// Dropdown
$('#destinationSelect').on('change', function() {
    let val = $(this).val();
    if (val === 'create_new') {
        // Lưu tiến trình vào localStorage
        localStorage.setItem('post_share_progress', JSON.stringify({
            type: $('#shareType').val(),
            // Lưu thêm các trường khác nếu cần
        }));
        window.location.href = '{{ route('user.destination.create') }}';
        return;
    }
    if (val) goToPostArticles(val);
});

// Thẻ
$(document).on('click', '#destinationCards .destination-card', function() {
    let destinationId = $(this).data('id');
    if (destinationId) goToPostArticles(destinationId);
});

// Khi click vào thẻ địa điểm
$(document).on('click', '#facilityDestinationCards .destination-card', function() {
    let destinationId = $(this).data('id');
    $('#destinationSelect2').val(destinationId).trigger('change');
});

// Khi click vào thẻ địa điểm
$(document).on('click', '#destinationCards .destination-card', function() {
    let destinationId = $(this).data('id');
    $('#destinationSelect').val(destinationId).trigger('change');
});

$('#utilityTypeSelect').on('change', function() {
    let destinationId = $('#destinationSelect2').val();
    let utilityTypeId = $(this).val();
    renderUtilityCards(destinationId, utilityTypeId);
    // GỌI THÊM DÒNG NÀY:
    loadAllUtilitiesForDropdown(destinationId, utilityTypeId);
});

function loadAllUtilitiesForDropdown(destinationId = '', utilityTypeId = '') {
    $.ajax({
        url: '{{ route('ajax.post_share_utilities') }}',
        data: { destination_id: destinationId, utility_type_id: utilityTypeId, all: 1 },
        success: function(res) {
            let selectHtml = '<option value="create_new">+ Tiện ích bạn muốn chia sẻ chưa có? Tạo mới</option>';
            (res.all_results || []).forEach(function(item) {
                selectHtml += `<option value="${item.id}">${item.text}</option>`;
            });
            $('#utilitySelect').html(selectHtml);
            $('#utilitySelect').select2({
                width: '100%',
                placeholder: 'Tìm kiếm tiện ích'
            });
        }
    });
}

// Hàm render thẻ địa điểm cho phần tiện ích
window.renderFacilityDestinationCards = function(province = '', page = 1, q = '') {
    $.ajax({
        url: '{{ route('ajax.post_share_destinations') }}',
        data: { province: province, page: page, q: q },
        success: function(res) {
            let html = '';
            let results = res.results || [];
            if (results.length === 0) {
                html = '<div class="destination-card"><p>Không có địa điểm nào.</p></div>';
            } else {
                results.forEach(function(item) {
                    html += `
                    <div class="destination-card" data-id="${item.id}">
                        <div class="card shadow-sm h-100">
                            <img src="${item.image}" class="card-img-top" alt="${item.text}">
                            <div class="card-body">
                                <h5 class="card-title">${item.text}</h5>
                            </div>
                        </div>
                    </div>`;
                });
            }
            $('#facilityDestinationCards').html(html);
            renderFacilityPagination(res.current_page, res.last_page, province, q);
        }
    });
}

function renderFacilityPagination(current, last, province, q) {
    let html = '';
    if (last > 1) {
        html += `<nav class="pagination-nav"><ul class="pagination">`;
        for (let i = 1; i <= last; i++) {
            html += `<li class="page-item${i === current ? ' active' : ''}">
                        <a href="#" class="facility-page-link page-link" data-page="${i}" data-province="${province}" data-q="${q || ''}">${i}</a>
                    </li>`;
        }
        html += `</ul></nav>`;
        $('#facilityDestinationPagination').html(html).show();
    } else {
        $('#facilityDestinationPagination').html('').hide();
    }

    // Gán sự kiện click
    $('.facility-page-link').off('click').on('click', function(e) {
        e.preventDefault();
        let page = $(this).data('page');
        let province = $(this).data('province');
        let q = $(this).data('q');
        renderFacilityDestinationCards(province, page, q);
    });
}

// Hàm render thẻ tiện ích
function renderUtilityCards(destinationId = '', utilityTypeId = '', q = '') {
    $.ajax({
        url: '{{ route('ajax.post_share_utilities') }}',
        data: { destination_id: destinationId, utility_type_id: utilityTypeId, q: q },
        success: function(res) {
            let html = '';
            let results = res.results || [];
            if (results.length === 0) {
                html = '<div class="destination-card"><p>Không có tiện ích nào.</p></div>';
            } else {
                results.forEach(function(item) {
                    // Nếu item.image đã là link đầy đủ thì dùng luôn, nếu chỉ là tên file thì nối storage/utility_image/
                    let imgSrc = item.image
                        ? (item.image.startsWith('http') ? item.image : '/storage/utility_image/' + item.image)
                        : '/storage/utility_image/default_hotel.jpg';
                    html += `
                    <div class="destination-card" data-id="${item.id}" data-type="utility">
                        <div class="card shadow-sm h-100">
                            <img src="${imgSrc}" class="card-img-top" alt="${item.text}">
                            <div class="card-body">
                                <h5 class="card-title">${item.text}</h5>
                            </div>
                        </div>
                    </div>`;
                });
            }
            $('#utilityCards').html(html);
        }
    });
}
// Khi chọn tiện ích ở dropdown
$('#utilitySelect').on('change', function() {
    let val = $(this).val();
    if (val === 'create_new') {
        let destinationId = $('#destinationSelect2').val() || '';
        let url = '{{ route('user.utility.create') }}';
        if (destinationId) url += '?destination_id=' + destinationId;
        window.location.href = url;
        return;
    }
    if (val) {
        window.location.href = '{{ route('post_articles', ['id' => '___ID___', 'postType' => 'utility']) }}'.replace('___ID___', val);
    }
});

// Khi click vào thẻ tiện ích
$(document).on('click', '#utilityCards .destination-card[data-type="utility"]', function() {
    let utilityId = $(this).data('id');
    if (utilityId) {
        window.location.href = '{{ route('post_articles', ['id' => '___ID___', 'postType' => 'utility']) }}'.replace('___ID___', utilityId);
    }
});

    // Nếu có tiến trình trong localStorage, tự động chọn lại loại bài đăng
    let progress = localStorage.getItem('post_share_progress');
    if (progress) {
        progress = JSON.parse(progress);
        if (progress.type) {
            $('#shareType').val(progress.type).trigger('change');
        }
        // Xóa sau khi dùng
        localStorage.removeItem('post_share_progress');
    }
});
</script>
@endsection