<div>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('assets/ruangadmin/') }}/img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3">INDOASPHALT</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Jadwal
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable"
            aria-expanded="true" aria-controls="collapseTable">
            <i class="fas fa-fw fa-table"></i>
            <span>Manajemen Jadwal</span>
        </a>
        <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manajemen Jadwal</h6>
                <a class="collapse-item" href="{{ route('dashboard-jadwal') }}">Jadwal</a>
                {{-- <a class="collapse-item" href="{{ route('dashboard') }}">Input Data Jadwal</a> --}}
            </div>
        </div>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard-data-karyawan') }}">
            <i class="fas fa-fw fa-palette"></i>
            <span>Karyawan</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard-tambah-data-karyawan') }}">
            <i class="fas fa-fw fa-palette"></i>
            <span>Tambah Data Karyawan</span>
        </a> --}}
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Manajemen Karyawan
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage"
            aria-expanded="true" aria-controls="collapsePage">
            <i class="fas fa-fw fa-columns"></i>
            <span>Data Karyawan</span>
        </a>
        <div id="collapsePage" class="collapse" aria-labelledby="headingPage"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Karyawan</h6>
                <a class="collapse-item" href="{{ route('dashboard-data-karyawan') }}">Daftar Karyawan</a>
                <a class="collapse-item" href="{{ route('dashboard-tambah-data-karyawan') }}">Tambah Data Karyawan</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    {{-- <div class="version" id="version-ruangadmin"></div> --}}
</div>
