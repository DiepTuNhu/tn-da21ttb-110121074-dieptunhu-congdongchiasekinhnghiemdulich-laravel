<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('style.css') }}" />
    <!-- Font Awesome 6 CDN -->
    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- Thêm vào <head> của layout hoặc file blade chi tiết bài viết -->
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/styles.css">
    {{-- <link rel="icon" type="image/png" href="{{ asset('logo/logo_trang_full.png') }}" /> --}}
    <title>Cộng đồng chia sẻ kinh nghiệm du lịch</title>
    <style>
      body .container-index{
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
  
  function toggleDropdown() {
      const dropdown = document.getElementById('user-dropdown');
      dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
  }

document.addEventListener('click', function (event) {
    const dropdown = document.getElementById('user-dropdown');
    const toggle = document.querySelector('.user-dropdown-toggle');

    if (
        (toggle && !toggle.contains(event.target)) &&
        (dropdown && !dropdown.contains(event.target))
    ) {
        if (dropdown) {
            dropdown.style.display = 'none';
        }
    }
});

</script>