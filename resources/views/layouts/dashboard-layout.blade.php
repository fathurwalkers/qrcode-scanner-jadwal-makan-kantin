<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('assets/ruangadmin/') }}/img/logo/logo.png" rel="icon">
    <title>{{ $title ?? 'Dashboard' }}</title>
    <link href="{{ asset('assets/ruangadmin/') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/ruangadmin/') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/ruangadmin/') }}/css/ruang-admin.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: black;
        }

        .table {
            font-size: 14px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between; /* Atur agar elemen di dalamnya tersebar dengan baik */
            height: 70px; /* Sesuaikan tinggi navbar jika perlu */
            padding: 10px 20px; /* Tambahkan padding agar lebih rapi */
            margin-bottom: 0.5rem !important;
        }
    </style>
    @stack('css')
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <livewire:dashboard.dashboard-sidebar />
        </ul>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3" style="display:none;">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-1 small"
                                            placeholder="What do you want to look for?" aria-label="Search"
                                            aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('assets/ruangadmin/') }}/img/boy.png" style="max-width: 60px">
                                <span class="ml-2 d-none d-lg-inline text-white small">Rich Brian</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-block">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Topbar -->

                <!-- Container Fluid-->
                {{ $slot }}
            </div>
            <!-- Footer -->
            {{-- <livewire:dashboard.dashboard-footer /> --}}
            <!-- Footer -->
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('assets/ruangadmin/') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets/ruangadmin/') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/ruangadmin/') }}/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="{{ asset('assets/ruangadmin/') }}/js/ruang-admin.min.js"></script>
    @stack('js')
    <script>
        console.log(`

        █▀▀ ▄▀█ ▀█▀ █░█ █░█ █▀█ █░█░█ ▄▀█ █░░ █▄▀ █▀▀ █▀█ █▀
        █▀░ █▀█ ░█░ █▀█ █▄█ █▀▄ ▀▄▀▄▀ █▀█ █▄▄ █░█ ██▄ █▀▄ ▄█
        `);
        console.log("%cCreated By  : Muh. Fathurrahman", "font-weight: bold; color: cyan; background: black;");
        console.log("%cAlias       : Fathur Walkers / Win32", "font-weight: bold; color: cyan; background: black;");
        console.log("%cTeam        : ex-Typical Idiot Security Est. 2016", "font-weight: bold; color: cyan; background: black;");
        console.log("%cCredits     : ChatGPT, Perplexity.io", "font-weight: bold; color: cyan; background: black;");
        console.log("%cWorking on  : INDOASPHALT (Buton, Sulawesi Tenggara)", "font-weight: bold; color: cyan; background: black;");
        console.log("%c\"There are no such thing as Simplicity\"", "font-style: italic; color: cyan;");
    </script>

</body>

</html>
