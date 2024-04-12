<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="index.html">
            <span class="text">ThemeKit</span>
        </a>
        <button type="button" class="nav-toggle"><i data-toggle="expanded"
                class="ik ik-toggle-right toggle-icon"></i></button>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <x-dashboard::shared.sidebar.item href="{{ route('dashboard.index') }}">
                    <i class="ik ik-bar-chart-2"></i><span>Dashboard</span>
                </x-dashboard::shared.sidebar.item>

                <div class="nav-lavel">Manajemen Data</div>
                <x-dashboard::shared.sidebar.item href="{{ route('dashboard.students.index') }}">
                    <i class="ik ik-bar-chart-2"></i><span>Data Kelas</span>
                </x-dashboard::shared.sidebar.item>
                <x-dashboard::shared.sidebar.item href="{{ route('dashboard.students.index') }}">
                    <i class="ik ik-bar-chart-2"></i><span>Data Siswa</span>
                </x-dashboard::shared.sidebar.item>
                <x-dashboard::shared.sidebar.item href="{{ route('dashboard.students.index') }}">
                    <i class="ik ik-bar-chart-2"></i><span>Data Orang Tua</span>
                </x-dashboard::shared.sidebar.item>
                <x-dashboard::shared.sidebar.item href="{{ route('dashboard.students.index') }}">
                    <i class="ik ik-bar-chart-2"></i><span>Data Admin</span>
                </x-dashboard::shared.sidebar.item>
            </nav>
        </div>
    </div>
</div>
