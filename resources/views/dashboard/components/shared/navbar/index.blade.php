<header class="header-top" header-theme="light">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <div class="top-menu d-flex align-items-center">
                <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                <div class="header-search">
                    <div class="input-group">
                        <span class="input-group-addon search-close"><i class="ik ik-x"></i></span>
                        <input type="text" class="form-control">
                        <span class="input-group-addon search-btn"><i class="ik ik-search"></i></span>
                    </div>
                </div>
                <button type="button" id="navbar-fullscreen" class="nav-link"><i class="ik ik-maximize"></i></button>
            </div>
            <div class="top-menu d-flex align-items-center">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-plus"></i></a>
                    <div class="dropdown-menu dropdown-menu-right menu-grid" aria-labelledby="menuDropdown">
                        <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top"
                            title="Dashboard"><i class="ik ik-bar-chart-2"></i></a>
                        <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top"
                            title="Message"><i class="ik ik-mail"></i></a>
                        <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top"
                            title="Accounts"><i class="ik ik-users"></i></a>
                        <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top"
                            title="Sales"><i class="ik ik-shopping-cart"></i></a>
                        <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top"
                            title="Purchase"><i class="ik ik-briefcase"></i></a>
                        <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top"
                            title="Pages"><i class="ik ik-clipboard"></i></a>
                        <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top"
                            title="Chats"><i class="ik ik-message-square"></i></a>
                        <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top"
                            title="Contacts"><i class="ik ik-map-pin"></i></a>
                        <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top"
                            title="Blocks"><i class="ik ik-inbox"></i></a>
                        <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top"
                            title="Events"><i class="ik ik-calendar"></i></a>
                        <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top"
                            title="Notifications"><i class="ik ik-bell"></i></a>
                        <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top"
                            title="More"><i class="ik ik-more-horizontal"></i></a>
                    </div>
                </div>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar"
                            src="/dashboard/img/user.jpg" alt=""></a>
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
