<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid p-0">
                <div class="row align-items-center no-gutters">
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo-img">
                            <a href="#">
                                <img src="/logo.png" alt="" class="img-fluid w-25 d-none d-lg-block">
                                <h5 class="d-block d-lg-none text-white">{{ config('app.name') }}</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7">
                        <div class="main-menu  d-none d-lg-block">
                            <nav>
                                <ul id="navigation">
                                    <li><a href="#hero">Beranda</a></li>
                                    <li><a href="#about-us">Tentang Kami</a></li>
                                    <li><a href="#testimonial">Testimoni</a></li>
                                    <li><a href="#our-advantages">Keunggulan Kami</a></li>
                                    <li><a href="#contact">Kontak</a></li>
                                    <li class="d-block d-lg-none"><a href="{{ route('login') }}">Login</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                        <div class="log_chat_area d-flex align-items-center">
                            @auth
                                <a href="{{ route('dashboard.index') }}" class="login">
                                    <i class="flaticon-user"></i>
                                    <span>{{ auth()->user()->email }}</span>
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="login">
                                    <i class="flaticon-user"></i>
                                    <span>log in</span>
                                </a>

                            @endauth
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
