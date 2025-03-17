<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('assets/bootstrap4/css') }}/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/fontawesome5/css') }}/all.min.css" rel="stylesheet">
    <title>@yield('title')</title>

    <style>
        .logo-styled {
            /* Stroke putih menggunakan outline */
            filter: drop-shadow(0 0 1px rgb(255, 255, 255)) drop-shadow(0 0 1px rgb(255, 255, 255));

            /* Pastikan transparansi background di gambar tidak mengganggu */
            background-color: transparent;
        }

        .card {
            border-radius: 10px;
            overflow: hidden;
        }

        .card-header {
            font-size: 1.2rem;
        }

        .card-body .text-gray-800 {
            color: #4e73df; /* Warna yang lebih sesuai */
        }

        .card-body .fa-clock {
            color: #1cc88a; /* Warna hijau yang lembut */
        }

        .countdown {
            font-size: 15px;
            font-weight: bold;
        }
        .red {
            color: red;
        }
        .green {
            color: green;
        }

        .waktu-scan {
            font-size: 12px;
        }

        .text-middle {
            vertical-align: middle !important;
        }
    </style>
    @livewireStyles
    @push('css')
</head>

<body>
    {{-- <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                    aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('assets/img') }}/logo.png" height="30" alt="" class="logo-styled mr-auto">
                    </a>
                    <div class="my-2 ml-auto">
                        <button class="btn btn-success my-2 my-sm-0" type="submit">Laporan</button>
                    </div>
                </div>
            </div>
        </nav>
    </header> --}}

    <main>
        <div class="container">
            {{ $slot }}
        </div>
    </main>

    <script src="{{ asset('assets/jquery') }}/jquery.min.js"></script>
    <script src="{{ asset('assets/bootstrap4/js') }}/bootstrap.min.js"></script>
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
    @livewireScripts
</body>

</html>
