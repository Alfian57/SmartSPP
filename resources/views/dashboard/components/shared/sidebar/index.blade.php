<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="index.html">
            <span class="text">{{ config('app.name') }}</span>
        </a>
        <button type="button" class="nav-toggle"><i data-toggle="expanded"
                class="ik ik-toggle-right toggle-icon"></i></button>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <x-dashboard::shared.sidebar.item href="{{ route('dashboard.index') }}">
                    <x-dashboard::icons.dashboard />
                    <span>Dashboard</span>
                </x-dashboard::shared.sidebar.item>

                @if (auth()->user()->role() === \App\Enums\Role::ADMIN->value)
                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Master Data</span></span>
                        </a>
                        <div class="submenu-content">
                            <x-dashboard::shared.sidebar.item href="{{ route('dashboard.students.index') }}"
                                class="menu-item">
                                <x-dashboard::icons.student />
                                <span>Data Siswa</span>
                            </x-dashboard::shared.sidebar.item>

                            <x-dashboard::shared.sidebar.item href="{{ route('dashboard.student-parents.index') }}"
                                class="menu-item">
                                <x-dashboard::icons.parent />
                                <span>Data Orang Tua</span>
                            </x-dashboard::shared.sidebar.item>

                            <x-dashboard::shared.sidebar.item href="{{ route('dashboard.admins.index') }}"
                                class="menu-item">
                                <x-dashboard::icons.admin />
                                <span>Data Admin</span>
                            </x-dashboard::shared.sidebar.item>
                        </div>
                    </div>


                    <x-dashboard::shared.sidebar.item href="{{ route('dashboard.payments.index') }}">
                        <x-dashboard::icons.payment />
                        <span>Data Pembayaran</span>
                    </x-dashboard::shared.sidebar.item>

                    <x-dashboard::shared.sidebar.item href="{{ route('dashboard.classrooms.index') }}">
                        <x-dashboard::icons.classroom />
                        <span>Data Kelas</span>
                    </x-dashboard::shared.sidebar.item>

                    <x-dashboard::shared.sidebar.item href="#" data-toggle="modal" data-target="#laporanModal">
                        <i class="ik ik-layers"></i>
                        <span>Laporan</span>
                    </x-dashboard::shared.sidebar.item>
                @endif

                @if (auth()->user()->role() === \App\Enums\Role::STUDENT_PARENT->value)
                    <x-dashboard::shared.sidebar.item href="{{ route('dashboard.bill-informations.index') }}">
                        <x-dashboard::icons.bill />
                        <span>Informasi Tagihan</span>
                    </x-dashboard::shared.sidebar.item>
                @endif

                @if (auth()->user()->role() === \App\Enums\Role::STUDENT->value)
                    <x-dashboard::shared.sidebar.item href="{{ route('dashboard.my-bills.index') }}">
                        <x-dashboard::icons.bill />
                        <span>Tagihan Saya</span>
                    </x-dashboard::shared.sidebar.item>
                @endif
            </nav>
        </div>
    </div>
</div>
