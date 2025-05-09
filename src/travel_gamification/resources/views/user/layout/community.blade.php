@extends('user.master')
@section('content')
<header class="explore-header">
  <h1>Góc chia sẻ</h1>
  <p>Khám phá những bài chia sẻ về địa điểm du lịch khác nhau trên khắp Việt Nam!</p>
</header>

<div class="filters">
  <select>
    <option>Vùng miền</option>
    <option>Hà Nội</option>
    <option>Đà Nẵng</option>
    <option>TP. HCM</option>
  </select>
  <select>
    <option>Tỉnh / Thành</option>
    <option>Quận 1</option>
    <option>Quận 2</option>
  </select>
  <select>
    <option>Loại hình du lịch</option>
    <option>Phường A</option>
    <option>Phường B</option>
  </select>
  <input type="text" class="search-input" placeholder="🔍 Tìm địa điểm, bài viết..." />
  <button id="toggle-form-btn" class="toggle-submit-btn">✍️ Đăng bài chia sẻ</button>
</div>

<section class="submit-section" id="submit-section" style="display: none">
  <h2>📝 Đăng bài chia sẻ của bạn</h2>
  <form class="submit-form">
    <input type="text" placeholder="Tiêu đề bài viết" required />
    <textarea placeholder="Nội dung bài viết ngắn gọn..." rows="4" required></textarea>
    <input type="text" placeholder="Địa điểm (ví dụ: TP. Đà Lạt)" required />
    <input type="text" placeholder="Chi phí (ví dụ: Miễn phí, 1-3 triệu...)" />
    <input type="date" placeholder="Ngày đi" />
    <input type="url" placeholder="Link ảnh (hoặc để trống nếu chưa có)" />
    <button type="submit">Đăng bài</button>
  </form>
</section>

<div class="explore-grid">
  <div class="post-card-explore">
    <img src="../1.png" alt="Nui" />
    <div class="post-content-explore">
      <h4>10 điểm check-in biển đẹp nhất Việt Nam</h4>
      <p class="post-excerpt">
        Đây là danh sách những bãi biển đẹp mê hồn mà bạn nhất định phải ghé qua khi đến Việt
        Nam. Từ nước biển trong xanh đến bãi cát trắng mịn màng, mỗi nơi đều có vẻ đẹp riêng
        biệt...
      </p>

      <div class="post-info-block">
        <div class="info-row">
          <i class="fas fa-location-dot"></i>
          <span>Xã Xuân Trường, TP. Đà Lạt</span>
        </div>
        <div class="info-row">
          <i class="fas fa-dollar-sign"></i>
          <span>Miễn phí</span>
        </div>

        <hr class="info-divider" />

        <div class="info-footer">
          <span><i class="fas fa-calendar-alt"></i> 10/04/2025</span>
          <span><i class="fas fa-heart" style="color: #e74c3c"></i> 135 lượt thích</span>
        </div>
      </div>
    </div>
  </div>

  <div class="post-card-explore">
    <img src="../1.png" alt="Nui" />
    <div class="post-content-explore">
      <h4>10 điểm check-in biển đẹp nhất Việt Nam</h4>
      <p class="post-excerpt">
        Đây là danh sách những bãi biển đẹp mê hồn mà bạn nhất định phải ghé qua khi đến Việt
        Nam. Từ nước biển trong xanh đến bãi cát trắng mịn màng, mỗi nơi đều có vẻ đẹp riêng
        biệt...
      </p>

      <div class="post-info-block">
        <div class="info-row">
          <i class="fas fa-location-dot"></i>
          <span>Xã Xuân Trường, TP. Đà Lạt</span>
        </div>
        <div class="info-row">
          <i class="fas fa-dollar-sign"></i>
          <span>Miễn phí</span>
        </div>

        <hr class="info-divider" />

        <div class="info-footer">
          <span><i class="fas fa-calendar-alt"></i> 10/04/2025</span>
          <span><i class="fas fa-heart" style="color: #e74c3c"></i> 135 lượt thích</span>
        </div>
      </div>
    </div>
  </div>
  <div class="post-card-explore">
    <img src="../1.png" alt="Nui" />
    <div class="post-content-explore">
      <h4>10 điểm check-in biển đẹp nhất Việt Nam</h4>
      <p class="post-excerpt">
        Đây là danh sách những bãi biển đẹp mê hồn mà bạn nhất định phải ghé qua khi đến Việt
        Nam. Từ nước biển trong xanh đến bãi cát trắng mịn màng, mỗi nơi đều có vẻ đẹp riêng
        biệt...
      </p>

      <div class="post-info-block">
        <div class="info-row">
          <i class="fas fa-location-dot"></i>
          <span>Xã Xuân Trường, TP. Đà Lạt</span>
        </div>
        <div class="info-row">
          <i class="fas fa-dollar-sign"></i>
          <span>Miễn phí</span>
        </div>

        <hr class="info-divider" />

        <div class="info-footer">
          <span><i class="fas fa-calendar-alt"></i> 10/04/2025</span>
          <span><i class="fas fa-heart" style="color: #e74c3c"></i> 135 lượt thích</span>
        </div>
      </div>
    </div>
  </div>
  <div class="post-card-explore">
    <img src="../1.png" alt="Nui" />
    <div class="post-content-explore">
      <h4>10 điểm check-in biển đẹp nhất Việt Nam</h4>
      <p class="post-excerpt">
        Đây là danh sách những bãi biển đẹp mê hồn mà bạn nhất định phải ghé qua khi đến Việt
        Nam. Từ nước biển trong xanh đến bãi cát trắng mịn màng, mỗi nơi đều có vẻ đẹp riêng
        biệt...
      </p>

      <div class="post-info-block">
        <div class="info-row">
          <i class="fas fa-location-dot"></i>
          <span>Xã Xuân Trường, TP. Đà Lạt</span>
        </div>
        <div class="info-row">
          <i class="fas fa-dollar-sign"></i>
          <span>Miễn phí</span>
        </div>

        <hr class="info-divider" />

        <div class="info-footer">
          <span><i class="fas fa-calendar-alt"></i> 10/04/2025</span>
          <span><i class="fas fa-heart" style="color: #e74c3c"></i> 135 lượt thích</span>
        </div>
      </div>
    </div>
  </div>
  <div class="post-card-explore">
    <img src="../1.png" alt="Nui" />
    <div class="post-content-explore">
      <h4>10 điểm check-in biển đẹp nhất Việt Nam</h4>
      <p class="post-excerpt">
        Đây là danh sách những bãi biển đẹp mê hồn mà bạn nhất định phải ghé qua khi đến Việt
        Nam. Từ nước biển trong xanh đến bãi cát trắng mịn màng, mỗi nơi đều có vẻ đẹp riêng
        biệt...
      </p>

      <div class="post-info-block">
        <div class="info-row">
          <i class="fas fa-location-dot"></i>
          <span>Xã Xuân Trường, TP. Đà Lạt</span>
        </div>
        <div class="info-row">
          <i class="fas fa-dollar-sign"></i>
          <span>Miễn phí</span>
        </div>

        <hr class="info-divider" />

        <div class="info-footer">
          <span><i class="fas fa-calendar-alt"></i> 10/04/2025</span>
          <span><i class="fas fa-heart" style="color: #e74c3c"></i> 135 lượt thích</span>
        </div>
      </div>
    </div>
  </div>
  <div class="post-card-explore">
    <img src="../1.png" alt="Nui" />
    <div class="post-content-explore">
      <h4>10 điểm check-in biển đẹp nhất Việt Nam</h4>
      <p class="post-excerpt">
        Đây là danh sách những bãi biển đẹp mê hồn mà bạn nhất định phải ghé qua khi đến Việt
        Nam. Từ nước biển trong xanh đến bãi cát trắng mịn màng, mỗi nơi đều có vẻ đẹp riêng
        biệt...
      </p>

      <div class="post-info-block">
        <div class="info-row">
          <i class="fas fa-location-dot"></i>
          <span>Xã Xuân Trường, TP. Đà Lạt</span>
        </div>
        <div class="info-row">
          <i class="fas fa-dollar-sign"></i>
          <span>Miễn phí</span>
        </div>

        <hr class="info-divider" />

        <div class="info-footer">
          <span><i class="fas fa-calendar-alt"></i> 10/04/2025</span>
          <span><i class="fas fa-heart" style="color: #e74c3c"></i> 135 lượt thích</span>
        </div>
      </div>
    </div>
  </div>
  <div class="post-card-explore">
    <img src="../1.png" alt="Nui" />
    <div class="post-content-explore">
      <h4>10 điểm check-in biển đẹp nhất Việt Nam</h4>
      <p class="post-excerpt">
        Đây là danh sách những bãi biển đẹp mê hồn mà bạn nhất định phải ghé qua khi đến Việt
        Nam. Từ nước biển trong xanh đến bãi cát trắng mịn màng, mỗi nơi đều có vẻ đẹp riêng
        biệt...
      </p>

      <div class="post-info-block">
        <div class="info-row">
          <i class="fas fa-location-dot"></i>
          <span>Xã Xuân Trường, TP. Đà Lạt</span>
        </div>
        <div class="info-row">
          <i class="fas fa-dollar-sign"></i>
          <span>Miễn phí</span>
        </div>

        <hr class="info-divider" />

        <div class="info-footer">
          <span><i class="fas fa-calendar-alt"></i> 10/04/2025</span>
          <span><i class="fas fa-heart" style="color: #e74c3c"></i> 135 lượt thích</span>
        </div>
      </div>
    </div>
  </div>

  <div class="post-card-explore">
    <img src="https://source.unsplash.com/400x300/?mountain" alt="Nui" />
    <div class="post-content-explore">
      <h3>Fansipan Hùng Vị</h3>
      <p>Chinh phục nóc nhà Đông Dương - trải nghiệm đợi tuyết và săn mây!</p>
    </div>
  </div>
  <div class="post-card-explore">
    <img src="https://source.unsplash.com/400x300/?mountain" alt="Nui" />
    <div class="post-content-explore">
      <h3>Fansipan Hùng Vị</h3>
      <p>Chinh phục nóc nhà Đông Dương - trải nghiệm đợi tuyết và săn mây!</p>
    </div>
  </div>
  <div class="post-card-explore">
    <img src="https://source.unsplash.com/400x300/?mountain" alt="Nui" />
    <div class="post-content-explore">
      <h3>Fansipan Hùng Vị</h3>
      <p>Chinh phục nóc nhà Đông Dương - trải nghiệm đợi tuyết và săn mây!</p>
    </div>
  </div>
  <div class="post-card-explore">
    <img src="https://source.unsplash.com/400x300/?mountain" alt="Nui" />
    <div class="post-content-explore">
      <h3>Fansipan Hùng Vị</h3>
      <p>Chinh phục nóc nhà Đông Dương - trải nghiệm đợi tuyết và săn mây!</p>
    </div>
  </div>
  <!-- Thêm nhiều post-card tự động hoặc từ server -->
</div>

<footer class="footer">
  <div class="footer-container">
    <div class="footer-grid">
      <!-- Logo & mô tả -->
      <div class="footer-column">
        <!-- <h5 class="footer-title">TravelViet</h5> -->
        <img src="./vietnam_travel_logo_white_transparent.png" alt="" width="300px" height="150px">
        <p class="footer-text">
          TravelViet giúp bạn khám phá những điểm đến tuyệt đẹp trên khắp Việt Nam. Chia sẻ trải
          nghiệm, lưu giữ hành trình.
        </p>
        <div class="social-icons">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>

      <!-- Liên kết -->
      <div class="footer-column">
        <h6 class="footer-title">Liên kết</h6>
        <ul class="footer-links">
          <li><a href="#">Trang chủ</a></li>
          <li><a href="#">Địa điểm nổi bật</a></li>
          <li><a href="#">Bài viết</a></li>
          <li><a href="#">Liên hệ</a></li>
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
</section>
<script>
const toggleBtn = document.getElementById("toggle-form-btn");
const submitSection = document.getElementById("submit-section");

toggleBtn.addEventListener("click", () => {
const isVisible = submitSection.style.display === "block";
submitSection.style.display = isVisible ? "none" : "block";
toggleBtn.textContent = isVisible ? "✍️ Đăng bài chia sẻ" : "✖️ Đóng lại";
});
</script>