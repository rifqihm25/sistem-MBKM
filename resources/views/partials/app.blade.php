<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ url('css/styleberanda.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ url('assets/plugins/toastr/toastr.min.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    @yield('page_styles')
    @yield('meta_header')
</head>

<body>
    @include('partials.navbar')
    <main>
        @yield('content')
    </main>
    <footer class="footer" style="background: rgb(255, 255, 255)">

        <div class="footer-left">
            <h3>Universitas XYZ</h3>

            <p class="footer-links">
                <a href="#">Beranda</a>
                |
                <a href="#">Konversi</a>
            </p>

            <p class="footer-company-name">Copyright © 2023 <strong>KampusMerdeka</strong> All rights reserved</p>
        </div>

        <div class="footer-center">
            <div>
                <i class="fa-sharp fa-solid fa-location-dot"></i>
                <p><span>Lampung, Indonesia</span></p>
            </div>

            <div>
                <i class="fa-solid fa-phone"></i>
                <p>+62 74**9**258</p>
            </div>
            <div>
                <i class="fa-solid fa-envelope"></i>
                <p><a href="mailto:sagar00001.co@gmail.com">xyz@gmail.com</a></p>
            </div>
        </div>
        <div class="footer-right">
            <p class="footer-company-about">
                <span>About the University</span>
                <strong>Universitas XYZ</strong> adalah sebuah universitas terbaik se-ASEAN memiliki akreditasi baik
                sekali.
            </p>
            <div class="footer-icons">
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <!-- Toastr -->
    <script src="{{ url('assets/plugins/toastr/toastr.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    @yield('page_js')
    @yield('page_script')

</body>

</html>
