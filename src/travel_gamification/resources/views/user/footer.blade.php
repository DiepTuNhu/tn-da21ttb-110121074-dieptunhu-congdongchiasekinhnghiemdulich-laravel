    <!-- Footer -->
    <footer class="footer">
      <div class="footer-container">
        <div class="footer-grid">
          <!-- Logo & mô tả -->
          <div class="footer-column">
            <!-- <h5 class="footer-title">TravelViet</h5> -->
            <img
              src="{{ asset('logo/logo_footer.png') }}"
              alt=""
              width="300px"
              height="150px"
            />
            <p class="footer-text">
              VietNamTravel - Cùng bạn khám phá vẻ đẹp Việt Nam, lưu giữ hành trình và chia sẻ cảm hứng du lịch.
            </p>
            {{-- <div class="social-icons">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
              <a href="#"><i class="fab fa-youtube"></i></a>
            </div> --}}
          </div>

          <!-- Liên kết -->
          <div class="footer-column">
            <h6 class="footer-title">Liên kết</h6>
            <ul class="footer-links">
              <li><a href="{{ route('page.index') }}">Trang chủ</a></li>
              <li><a href="{{ route('page.explore') }}">Cộng đồng</a></li>
              <li><a href="{{ route('page.community') }}">Khám phá</a></li>
              <li><a href="{{ route('page.ranking') }}">Xếp hạng</a></li>
            </ul>
          </div>

          <!-- Liên hệ -->
          <div class="footer-column">
            <h6 class="footer-title">Liên hệ</h6>
            <ul class="footer-contact">
              <li><i class="fas fa-map-marker-alt"></i> Trà Vinh, Việt Nam</li>
              <li><i class="fas fa-envelope"></i> contact@travelviet.vn</li>
              <li><i class="fas fa-phone"></i> +84 123 456 789</li>
            </ul>
          </div>
        </div>

        <!-- Bản quyền -->
        <div class="footer-bottom">© 2025 VietNamTravel. All rights reserved.</div>
      </div>
    </footer>

    <!-- Font Awesome Icon -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
  </body>
