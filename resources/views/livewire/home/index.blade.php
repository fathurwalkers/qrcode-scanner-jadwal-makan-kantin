<div>
    <div class="row mt-4">
        <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center">
            <img src="{{ asset('assets/img') }}/logo.png" width="180" alt="" class="logo-styled mr-auto mx-auto">
        </div>
    </div>
    <div class="row text-center mt-2 mb-3">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h3>
                <b>
                    APLIKASI QR SCANNER - INDOASPHALT
                </b>
            </h3>
            <h4>
                <b>
                    PT. KARTIKA PRIMA ABADI
                </b>
            </h4>
        </div>
    </div>
    <div class="row mt-2 mb-1">
        <div class="col-md-8">
            <form wire:submit="store" class="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Silahkan scan QR anda disini..." aria-label="Search" wire:model.lazy="qr_input" autofocus>
                    <div class="input-group-append">
                        <button class="btn btn-info" type="submit">
                            <i class="fas fa-search"></i>
                            Scan QR Anda
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search..." aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-success" type="button">
                        <i class="fas fa-search"></i>
                        Pencarian Nama
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-sm-12 col-md-12 col-lg-12">
            @if (session('ok'))
                <div class="alert alert-success">
                    {{ session('ok') }}
                </div>
            @endif
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Nama</th>
                        <th scope="col" class="text-center">Tanggal / Waktu</th>
                        <th scope="col" class="text-center">PAGI</th>
                        <th scope="col" class="text-center">SIANG</th>
                        <th scope="col" class="text-center">MALAM</th>
                        <th scope="col" class="text-center">SUBUH</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center text-middle" width="25%">
                            {{ $nama }} <br />
                            {{ $no_karyawan }} <br />
                        </td>
                        <td class="text-center text-middle" width="15%">
                            {{ $tanggalwaktu }}
                        </td>
                        <td class="text-center" width="15%">
                            @switch($pagi)
                                @case('YA')
                                    &#10004;
                                @break

                                @case('TIDAK')
                                    &#10006;
                                @break
                            @endswitch
                            <p class="waktu-scan">
                                Waktu Scan : {{ $waktu_scan_pagi }}
                            </p>
                        </td>
                        <td class="text-center" width="15%">
                            @switch($siang)
                                @case('YA')
                                    &#10004;
                                @break

                                @case('TIDAK')
                                    &#10006;
                                @break
                            @endswitch
                            <p class="waktu-scan">
                                Waktu Scan : {{ $waktu_scan_siang }}
                            </p>
                        </td>
                        <td class="text-center" width="15%">
                            @switch($malam)
                                @case('YA')
                                    &#10004;
                                @break

                                @case('TIDAK')
                                    &#10006;
                                @break
                            @endswitch
                            <p class="waktu-scan">
                                Waktu Scan : {{ $waktu_scan_malam }}
                            </p>
                        </td>
                        <td class="text-center" width="15%">
                            @switch($subuh)
                                @case('YA')
                                    &#10004;
                                @break

                                @case('TIDAK')
                                    &#10006;
                                @break
                            @endswitch
                            <p class="waktu-scan">
                                Waktu Scan : {{ $waktu_scan_subuh }}
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <hr class="mt-2" />

    <div class="row">
        <div class="card-group w-100">

            <div class="card shadow mx-2 mb-4" style="max-width: 18rem;">
                <div class="card-header bg-success text-white text-center">
                    <b>PAGI</b>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <h3 class="h3 mb-2 font-weight-bold text-gray-800 text-center">240</h3>
                            <p class="text-xs text-muted">

                            </p>
                            <div class="mt-2 mb-0 text-center text-xs">
                                <h5 class="countdown-pagi">00:00:00</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mx-2 mb-4" style="max-width: 18rem;">
                <div class="card-header bg-primary text-white text-center">
                    <b>SIANG</b>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <h3 class="h3 mb-2 font-weight-bold text-gray-800 text-center">240</h3>
                            <p class="text-xs text-muted">

                            </p>
                            <div class="mt-2 mb-0 text-center text-xs">
                                <h5 class="countdown-siang">00:00:00</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mx-2 mb-4" style="max-width: 18rem;">
                <div class="card-header bg-warning text-white text-center">
                    <b>MALAM</b>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <h3 class="h3 mb-2 font-weight-bold text-gray-800 text-center">240</h3>
                            <p class="text-xs text-muted">

                            </p>
                            <div class="mt-2 mb-0 text-center text-xs">
                                <h5 class="countdown-malam">00:00:00</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mx-2 mb-4" style="max-width: 18rem;">
                <div class="card-header bg-danger text-white text-center">
                    <b>SUBUH</b>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <h3 class="h3 mb-2 font-weight-bold text-gray-800 text-center">240</h3>
                            <p class="text-xs text-muted">

                            </p>
                            <div class="mt-2 mb-0 text-center text-xs">
                                <h5 class="countdown-subuh">00:00:00</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('js')
        <script>
            function runCountdown(element, startTime, endTime) {
                setInterval(() => {
                    const now = new Date();

                    // Sesuaikan dengan zona waktu WITA (UTC +8)
                    const timeZoneOffset = 8 * 60; // WITA = UTC +8
                    const nowInWita = new Date(now.getTime() + now.getTimezoneOffset() * 60000 + timeZoneOffset *
                    60000);

                    let remainingTime;

                    if (nowInWita >= startTime && nowInWita <= endTime) {
                        // Waktu berada di rentang
                        remainingTime = endTime - nowInWita;
                        element.classList.add('green');
                        element.classList.remove('red');
                    } else {
                        // Waktu di luar rentang, hitung mundur ke waktu berikutnya
                        if (nowInWita > endTime) {
                            startTime.setDate(startTime.getDate() + 1);
                            endTime.setDate(endTime.getDate() + 1);
                        }
                        remainingTime = startTime - nowInWita;
                        element.classList.add('red');
                        element.classList.remove('green');
                    }

                    const hours = Math.floor(remainingTime / (1000 * 60 * 60));
                    const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

                    element.textContent =
                        `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                }, 1000);
            }

            function countdown_pagi() {
                const countdownElement = document.querySelector('.countdown-pagi');
                const startTime = new Date();
                const endTime = new Date();

                // Rentang waktu PAGI: 06:00 AM - 08:00 AM WITA
                startTime.setHours(6, 0, 0); // Set ke 06:00 AM WITA
                endTime.setHours(8, 0, 0); // Set ke 08:00 AM WITA

                runCountdown(countdownElement, startTime, endTime);
            }

            function countdown_siang() {
                const countdownElement = document.querySelector('.countdown-siang');
                const startTime = new Date();
                const endTime = new Date();

                // Rentang waktu SIANG: 11:30 AM - 13:00 PM WITA
                startTime.setHours(11, 0, 0); // Set ke 11:30 AM WITA
                endTime.setHours(13, 0, 0); // Set ke 01:00 PM WITA

                runCountdown(countdownElement, startTime, endTime);
            }

            function countdown_malam() {
                const countdownElement = document.querySelector('.countdown-malam');
                const startTime = new Date();
                const endTime = new Date();

                // Rentang waktu MALAM: 16:30 PM - 19:00 PM WITA
                startTime.setHours(16, 30, 0); // Set ke 04:30 PM WITA
                endTime.setHours(19, 0, 0); // Set ke 07:00 PM WITA

                runCountdown(countdownElement, startTime, endTime);
            }

            function countdown_subuh() {
                const countdownElement = document.querySelector('.countdown-subuh');
                const startTime = new Date();
                const endTime = new Date();

                // Rentang waktu SUBUH: 04:00 AM - 05:30 AM WITA
                startTime.setHours(4, 0, 0); // Set ke 04:00 AM WITA
                endTime.setHours(5, 30, 0); // Set ke 05:30 AM WITA

                // Atur waktu ke hari berikutnya jika sudah lewat SUBUH
                if (new Date() > endTime) {
                    startTime.setDate(startTime.getDate() + 1);
                    endTime.setDate(endTime.getDate() + 1);
                }

                runCountdown(countdownElement, startTime, endTime);
            }

            // Panggil semua fungsi countdown
            countdown_pagi();
            countdown_siang();
            countdown_malam();
            countdown_subuh();
        </script>
    @endpush
</div>
