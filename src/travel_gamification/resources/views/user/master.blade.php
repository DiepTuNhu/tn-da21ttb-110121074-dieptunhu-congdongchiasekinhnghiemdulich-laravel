<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style.css" />
    <title>Document</title>
    <style>
      body {
        background-image: url("https://external-preview.redd.it/TSpXTYLRJTPeS9xy468Jj20MVf0EC0mke38TcJDKoEY.jpg?auto=webp&s=cec93075daae2c45d033833c88d5bcbeffb5252d");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        margin: 0;
        padding: 0;
        font-family: "Segoe UI", sans-serif;
      }
    </style>
  </head>
  <body>
    
    @include('user.header')
    @yield('content')
    @include('user.footer')
    
  </body>
</html>
<script>
  const menuToggle = document.getElementById("menu-toggle");
  const navLinks = document.getElementById("nav-links");

  menuToggle.addEventListener("click", () => {
    navLinks.classList.toggle("active");
  });
</script>

<script>
  const slides = document.querySelectorAll(".slide");
  const dots = document.querySelectorAll(".dot");
  let index = 0;

  function showSlide(i) {
    slides.forEach((slide, idx) => {
      slide.classList.toggle("active", idx === i);
      dots[idx].classList.toggle("active", idx === i);
    });
  }

  function nextSlide() {
    index = (index + 1) % slides.length;
    showSlide(index);
  }

  setInterval(nextSlide, 5000);

  dots.forEach((dot, i) => {
    dot.addEventListener("click", () => {
      index = i;
      showSlide(index);
    });
  });
</script>
<!-- Ẩn thanh tìm kiếm khi đang ở trang chủ -->

<script>
  // Kiểm tra nếu đang ở trang chủ
  const isHomepage = window.location.pathname.endsWith("trangchu.html") || window.location.pathname === "/";
  const navbarSearch = document.getElementById("navbarSearch");

  if (isHomepage && navbarSearch) {
    navbarSearch.classList.add("hidden");
  }
</script>
<script>
  function toggleDropdown() {
      const dropdown = document.getElementById('user-dropdown');
      dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
  }

  // Đóng dropdown khi nhấp ra ngoài
  document.addEventListener('click', function (event) {
      const dropdown = document.getElementById('user-dropdown');
      const toggle = document.querySelector('.user-dropdown-toggle');
      if (!toggle.contains(event.target) && !dropdown.contains(event.target)) {
          dropdown.style.display = 'none';
      }
  });
</script>