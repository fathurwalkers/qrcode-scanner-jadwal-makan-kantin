<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('assets/bootstrap4/css') }}/bootstrap.min.css" rel="stylesheet">
    <title>{{ $title ?? 'Title' }}</title>

    <style>
        .logo-styled {
            /* Stroke putih menggunakan outline */
            filter: drop-shadow(0 0 1px rgb(255, 255, 255)) drop-shadow(0 0 1px rgb(255, 255, 255));

            /* Pastikan transparansi background di gambar tidak mengganggu */
            background-color: transparent;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                    aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('assets/img') }}/logo.png" height="30" alt="" class="logo-styled">
                    </a>
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 ml-4">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            {{ $slot }}
        </div>
    </main>

    <script src="{{ asset('assets/jquery') }}/jquery.min.js"></script>
    <script src="{{ asset('assets/bootstrap4/js') }}/bootstrap.min.js"></script>
</body>

</html>
