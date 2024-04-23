<header class="header-top" header-theme="light">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <div class="top-menu d-flex">
                <button type="button"
                    class="btn-icon bg-transparent mobile-nav-toggle pb-3 d-lg-none"><span></span></button>
                <button type="button" id="navbar-fullscreen" class="nav-link bg-transparent"><i
                        class="ik ik-maximize"></i></button>
            </div>
            <div class="top-menu d-flex align-items-center">
                <div class="dropdown">
                    @if (auth()->user()->profile_pic)
                        <a class="dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar"
                                src="{{ asset('storage/' . auth()->user()->profile_pic) }}" alt=""></a>
                    @else
                        <a class="dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar"
                                src="/dashboard/img/avatar.png" alt=""></a>
                    @endif

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('dashboard.profile') }}"><i
                                class="ik ik-user dropdown-icon"></i>
                            Profil</a>
                        <form action="{{ route('dashboard.logout') }}" method="post" style="display: none"
                            id="logout-form">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="ik ik-power dropdown-icon"></i>
                            Logout</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>
