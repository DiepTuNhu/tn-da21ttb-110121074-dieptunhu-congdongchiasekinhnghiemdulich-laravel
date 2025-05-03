<h3>Thống kê tổng quan</h3>

      <div class="row my-4">
        <div class="col-md-3">
          <div class="card text-bg-primary">
            <div class="card-body">
              <h5 class="card-title">Người dùng</h5>
              <p class="card-text fs-4">1,240</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-bg-success">
            <div class="card-body">
              <h5 class="card-title">Bài viết</h5>
              <p class="card-text fs-4">2,345</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-bg-warning">
            <div class="card-body">
              <h5 class="card-title">Địa điểm</h5>
              <p class="card-text fs-4">134</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-bg-danger">
            <div class="card-body">
              <h5 class="card-title">Tiện ích</h5>
              <p class="card-text fs-4">89</p>
            </div>
          </div>
        </div>
      </div>

      <h4 class="mt-5">Hoạt động gần đây</h4>
      <table id="logTable" class="table table-striped mt-3">
        <thead>
          <tr>
            <th>#</th>
            <th>Người dùng</th>
            <th>Hành động</th>
            <th>Thời gian</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Nguyễn Văn A</td>
            <td>Thêm bài viết mới</td>
            <td>15/04/2025 10:30</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Trần Thị B</td>
            <td>Đăng ký tài khoản</td>
            <td>15/04/2025 09:10</td>
          </tr>
          <tr>
            <td>3</td>
            <td>Lê Minh C</td>
            <td>Bình luận bài viết</td>
            <td>14/04/2025 22:45</td>
          </tr>
        </tbody>
      </table>
    </div>

    $regionMapping = [
            // Miền Bắc
            'Tỉnh Lào Cai' => 'Miền Bắc', 'Tỉnh Yên Bái' => 'Miền Bắc', 'Tỉnh Điện Biên' => 'Miền Bắc',
            'Tỉnh Lai Châu' => 'Miền Bắc', 'Tỉnh Sơn La' => 'Miền Bắc', 'Tỉnh Hòa Bình' => 'Miền Bắc',
            'Tỉnh Hà Giang' => 'Miền Bắc', 'Tỉnh Cao Bằng' => 'Miền Bắc', 'Tỉnh Bắc Kạn' => 'Miền Bắc',
            'Tỉnh Lạng Sơn' => 'Miền Bắc', 'Tỉnh Tuyên Quang' => 'Miền Bắc', 'Tỉnh Thái Nguyên' => 'Miền Bắc',
            'Tỉnh Phú Thọ' => 'Miền Bắc', 'Tỉnh Bắc Giang' => 'Miền Bắc', 'Tỉnh Quảng Ninh' => 'Miền Bắc',
            'Tỉnh Bắc Ninh' => 'Miền Bắc', 'Tỉnh Hà Nam' => 'Miền Bắc', 'Thành phố Hà Nội' => 'Miền Bắc',
            'Tỉnh Nam Định' => 'Miền Bắc', 'Tỉnh Ninh Bình' => 'Miền Bắc', 'Tỉnh Thái Bình' => 'Miền Bắc',
            'Tỉnh Vĩnh Phúc' => 'Miền Bắc', 'Tỉnh Hải Dương' => 'Miền Bắc', 'Tỉnh Hưng Yên' => 'Miền Bắc',
            'Thành phố Hải Phòng' => 'Miền Bắc',

            // Miền Trung
            'Tỉnh Thanh Hóa' => 'Miền Trung', 'Tỉnh Nghệ An' => 'Miền Trung', 'Tỉnh Hà Tĩnh' => 'Miền Trung',
            'Tỉnh Quảng Bình' => 'Miền Trung', 'Tỉnh Quảng Trị' => 'Miền Trung', 'Tỉnh Thừa Thiên - Huế' => 'Miền Trung',
            'Thành phố Đà Nẵng' => 'Miền Trung', 'Tỉnh Quảng Nam' => 'Miền Trung', 'Tỉnh Quảng Ngãi' => 'Miền Trung',
            'Tỉnh Bình Định' => 'Miền Trung', 'Tỉnh Phú Yên' => 'Miền Trung', 'Tỉnh Khánh Hòa' => 'Miền Trung',
            'Tỉnh Ninh Thuận' => 'Miền Trung', 'Tỉnh Bình Thuận' => 'Miền Trung', 'Tỉnh Kon Tum' => 'Miền Trung',
            'Tỉnh Gia Lai' => 'Miền Trung', 'Tỉnh Đắk Lắk' => 'Miền Trung', 'Tỉnh Đắk Nông' => 'Miền Trung',
            'Tỉnh Lâm Đồng' => 'Miền Trung',

            // Miền Nam
            'Tỉnh Bình Phước' => 'Miền Nam', 'Tỉnh Bình Dương' => 'Miền Nam', 'Tỉnh Đồng Nai' => 'Miền Nam',
            'Tỉnh Tây Ninh' => 'Miền Nam', 'Tỉnh Bà Rịa - Vũng Tàu' => 'Miền Nam', 'Thành phố Hồ Chí Minh' => 'Miền Nam',
            'Tỉnh Long An' => 'Miền Nam', 'Tỉnh Đồng Tháp' => 'Miền Nam', 'Tỉnh Tiền Giang' => 'Miền Nam',
            'Tỉnh An Giang' => 'Miền Nam', 'Tỉnh Bến Tre' => 'Miền Nam', 'Tỉnh Vĩnh Long' => 'Miền Nam',
            'Tỉnh Trà Vinh' => 'Miền Nam', 'Tỉnh Hậu Giang' => 'Miền Nam', 'Tỉnh Kiên Giang' => 'Miền Nam',
            'Tỉnh Sóc Trăng' => 'Miền Nam', 'Tỉnh Bạc Liêu' => 'Miền Nam', 'Tỉnh Cà Mau' => 'Miền Nam', 'Thành phố Cần Thơ' => 'Miền Nam',
        ];