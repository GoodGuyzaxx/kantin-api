@extends('layouts.landing')


@section('content')
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
        <div class="container px-5">
            <a class="navbar-brand fw-bold" href="#page-top">Kantin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="bi-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">

                    <li class="nav-item"><a class="nav-link me-lg-3" href="{{route('download')}}">Download</a></li>
                </ul>
                <a href="{{route('login.index')}}" class="btn btn-primary rounded-pill px-3 mb-2 mb-lg-0 text-decoration-none">
                    <span class="d-flex align-items-center">
                        <span class="small">Dashboard</span>
                    </span>
                </a>
            </div>
        </div>
    </nav>
    <!-- Mashead header-->
    <header class="masthead">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6">
                    <!-- Mashead text and app badges-->
                    <div class="mb-5 mb-lg-0 text-center text-lg-start">
                        <h1 class="display-1 lh-1 mb-3">Pesan Menjadi Lebih Mudah.</h1>
                        <p class="lead fw-normal text-muted mb-5">Tingkatkan pengalaman makan di kantin Anda dengan
                            aplikasi inovatif kami! Nikmati kemudahan pemesanan, pembayaran, dan pengelolaan kantin
                            dalam genggaman tangan Anda.</p>
                        <div class="d-flex flex-column flex-lg-row align-items-center">
                            <a class="me-lg-3 mb-4 mb-lg-0" href="{{route('download')}}"><img class="app-badge"
                                                                           src="{{url("landing/assets/img/google-play-badge.svg")}}" alt="..." /></a>
                            <!-- <a href="#!"><img class="app-badge" src="assets/img/app-store-badge.svg" alt="..." /></a> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Masthead device mockup feature-->
                    <div class="masthead-device-mockup">
                        <svg class="circle" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="circleGradient" gradientTransform="rotate(45)">
                                    <stop class="gradient-start-color" offset="0%"></stop>
                                    <stop class="gradient-end-color" offset="100%"></stop>
                                </linearGradient>
                            </defs>
                            <circle cx="50" cy="50" r="50"></circle>
                        </svg><svg class="shape-1 d-none d-sm-block" viewBox="0 0 240.83 240.83"
                                   xmlns="http://www.w3.org/2000/svg">
                            <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03"
                                  transform="translate(120.42 -49.88) rotate(45)"></rect>
                            <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03"
                                  transform="translate(-49.88 120.42) rotate(-45)"></rect>
                        </svg><svg class="shape-2 d-none d-sm-block" viewBox="0 0 100 100"
                                   xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50"></circle>
                        </svg>
                        <div class="device-wrapper">
                            <div class="device" data-device="iPhone7" data-orientation="portrait" data-color="black">
                                <div class="screen">
                                    <!-- PUT CONTENTS HERE:-->
                                    <!-- * * This can be a video, image, or just about anything else.-->
                                    <!-- * * Set the max width of your media to 100% and the height to-->
                                    <!-- * * 100% like the demo example below.-->
                                    <video muted="muted" autoplay="" loop="" style="max-width: 100%; height: 100%">
                                        <source src="{{url("landing/assets/img/Base.mp4")}}" type="video/mp4" />
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Quote/testimonial aside-->
    <aside class="text-center bg-gradient-primary-to-secondary">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-xl-8">
                    <div class="h2 fs-1 text-white mb-4">"Solusi cerdas untuk antrean dan pembayaran di kantin, semuanya
                        dalam satu aplikasi yang praktis!"</div>

                </div>
            </div>
        </div>
    </aside>
    <!-- App features section-->
    <section id="features">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-8 order-lg-1 mb-5 mb-lg-0">
                    <div class="container-fluid px-5">
                        <div class="row gx-5">
                            <div class="col-md-6 mb-5">
                                <!-- Feature item-->
                                <div class="text-center">
                                    <i class="bi-cart icon-feature text-gradient d-block mb-3"></i>
                                    <h3 class="font-alt">Pemesanan Mudah</h3>
                                    <p class="text-muted mb-0">Pesan makanan favorit Anda dengan cepat dan mudah melalui
                                        antarmuka yang intuitif!</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <!-- Feature item-->
                                <div class="text-center">
                                    <i class="bi-credit-card icon-feature text-gradient d-block mb-3"></i>
                                    <h3 class="font-alt">Pembayaran Digital</h3>
                                    <p class="text-muted mb-0">Nikmati kemudahan pembayaran tanpa uang tunai dengan
                                        berbagai opsi pembayaran digital!</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-5 mb-md-0">
                                <!-- Feature item-->
                                <div class="text-center">
                                    <i class="bi-clock icon-feature text-gradient d-block mb-3"></i>
                                    <h3 class="font-alt">Hemat Waktu</h3>
                                    <p class="text-muted mb-0">Hindari antrean panjang dan maksimalkan waktu istirahat
                                        Anda dengan pemesanan pra-waktu!</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Feature item-->
                                <div class="text-center">
                                    <i class="bi-menu-button-wide icon-feature text-gradient d-block mb-3"></i>
                                    <h3 class="font-alt">Menu Beragam</h3>
                                    <p class="text-muted mb-0">Nikmati berbagai pilihan menu yang lezat dan sesuai
                                        dengan selera Anda setiap hari!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 order-lg-0">
                    <!-- Features section device mockup-->
                    <div class="features-device-mockup">
                        <svg class="circle" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="circleGradient" gradientTransform="rotate(45)">
                                    <stop class="gradient-start-color" offset="0%"></stop>
                                    <stop class="gradient-end-color" offset="100%"></stop>
                                </linearGradient>
                            </defs>
                            <circle cx="50" cy="50" r="50"></circle>
                        </svg><svg class="shape-1 d-none d-sm-block" viewBox="0 0 240.83 240.83"
                                   xmlns="http://www.w3.org/2000/svg">
                            <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03"
                                  transform="translate(120.42 -49.88) rotate(45)"></rect>
                            <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03"
                                  transform="translate(-49.88 120.42) rotate(-45)"></rect>
                        </svg><svg class="shape-2 d-none d-sm-block" viewBox="0 0 100 100"
                                   xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50"></circle>
                        </svg>
                        <div class="device-wrapper">
                            <div class="device" data-device="iPhone7" data-orientation="portrait" data-color="black">
                                <div class="screen">
                                    <!-- PUT CONTENTS HERE:-->
                                    <!-- * * This can be a video, image, or just about anything else.-->
                                    <!-- * * Set the max width of your media to 100% and the height to-->
                                    <!-- * * 100% like the demo example below.-->
                                    <video muted="muted" autoplay="" loop="" style="max-width: 100%; height: 100%">
                                        <source src="{{url("landing/assets/img/demo3.mp4")}}" type="video/mp4" />
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic features section-->
    <section class="bg-light">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center justify-content-lg-between">
                <div class="col-12">
                    <h2 class="display-4 lh-1 mb-4">Revolusi Pengalaman Makan di Kantin</h2>
                    <p class="lead fw-normal text-muted mb-5 mb-lg-0">Aplikasi kami hadir untuk mengubah cara Anda
                        menikmati makanan di kantin. Dirancang untuk mengatasi masalah antrean panjang dan kerumitan
                        pembayaran, aplikasi ini menawarkan solusi efisien yang menghemat waktu Anda. Dengan fitur
                        pemesanan cepat, pembayaran digital, dan informasi menu real-time, kami memastikan pengalaman
                        makan di kantin menjadi lebih menyenangkan dan praktis. Nikmati kemudahan memesan makanan
                        favorit Anda, tanpa harus meninggalkan meja atau mengantri lama. Mari bersama-sama menciptakan
                        budaya makan di kantin yang lebih modern dan efisien!</p>
                </div>

            </div>
        </div>
    </section>
    <!-- Call to action section-->

    <!-- App badge section-->
    <section class="bg-gradient-primary-to-secondary" id="download">
        <div class="container px-5">
            <h2 class="text-center text-white font-alt mb-4">Dapatkan Sekarang Juga!</h2>
            <div class="d-flex flex-column flex-lg-row align-items-center justify-content-center">
                <a class="me-lg-3 mb-4 mb-lg-0" href="{{route('download')}}"><img class="app-badge" src="{{url("landing/assets/img/google-play-badge.svg")}}"
                                                               alt="..." /></a>
                <!-- <a href="#!"><img class="app-badge" src="assets/img/app-store-badge.svg" alt="..." /></a> -->
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="bg-black text-center py-5">
        <div class="container px-5">
            <div class="text-white-50 small">
                <div class="mb-2">&copy; Viktoria 2024. All Rights Reserved.</div>

            </div>
        </div>
    </footer>
@endsection