<div>

    @push('css')
    <style>

    </style>
    @endpush
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

    <div class="row mt-2 mb-2">
        <div class="col-md-8">
            <form wire:submit="store" class="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Silahkan scan QR anda disini..." aria-label="Search" wire:model.lazy="qr_input" id="scanner_input" autocomplete="off" autofocus>
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

    <div class="row mt-3">
        <div class="col-sm-12 col-md-12 col-lg-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Nama</th>
                        <th scope="col" class="text-center">Tanggal / Waktu</th>
                        <th scope="col" class="text-center">PAGI</th>
                        <th scope="col" class="text-center">SIANG</th>
                        <th scope="col" class="text-center">SORE</th>
                        <th scope="col" class="text-center">MALAM</th>
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
                                @case(null)
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
                                @case(null)
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
                                @case(null)
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
                                @case(null)
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
                            <h3 class="h3 mb-2 font-weight-bold text-gray-800 text-center">{{ $counts->pagi }}</h3>
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
                            <h3 class="h3 mb-2 font-weight-bold text-gray-800 text-center">{{ $counts->siang }}</h3>
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
                    <b>SORE</b>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <h3 class="h3 mb-2 font-weight-bold text-gray-800 text-center">{{ $counts->malam }}</h3>
                            <p class="text-xs text-muted">

                            </p>
                            <div class="mt-2 mb-0 text-center text-xs">
                                <h5 class="countdown-sore">00:00:00</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mx-2 mb-4" style="max-width: 18rem;">
                <div class="card-header bg-danger text-white text-center">
                    <b>MALAM</b>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <h3 class="h3 mb-2 font-weight-bold text-gray-800 text-center">{{ $counts->subuh }}</h3>
                            <p class="text-xs text-muted">

                            </p>
                            <div class="mt-2 mb-0 text-center text-xs">
                                <h5 class="countdown-malam">00:00:00</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center mt-3">
            <small style="font-size: 10px">Created by IT Departement - PT. KARTIKA PRIMA ABADI</small>
        </div>
    </div>

    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let scannerInput = document.getElementById('scanner_input');

                // Fungsi untuk fokus kembali ke input
                function setFocus() {
                    setTimeout(() => {
                        scannerInput.focus();
                    }, 100); // Delay sedikit untuk menghindari konflik dengan event lainnya
                }

                // Fokus awal saat halaman dimuat
                setFocus();

                // Jika pengguna mengklik di mana saja pada halaman, tetap fokus ke input
                document.addEventListener('click', function (event) {
                    if (event.target !== scannerInput) {
                        setFocus();
                    }
                });

                // Jika pengguna menekan tombol TAB, tetap fokus ke input
                scannerInput.addEventListener('blur', function () {
                    setFocus();
                });
            });

            (function () {
                let timeout;
                const idleTime = 300;
                const inputId = "scanner_input";

                function resetTimer() {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => {
                        location.reload();
                    }, idleTime * 1000);
                }

                function setupIdleTimer() {
                    const inputElement = document.getElementById(inputId);
                    if (!inputElement) return;
                    inputElement.addEventListener("keydown", resetTimer);
                    inputElement.addEventListener("mousemove", resetTimer);
                    inputElement.addEventListener("mousedown", resetTimer);
                    inputElement.addEventListener("touchstart", resetTimer);
                    inputElement.addEventListener("click", resetTimer);
                    inputElement.addEventListener("scroll", resetTimer);
                    inputElement.addEventListener("keypress", resetTimer);

                    resetTimer();
                }
                document.addEventListener("DOMContentLoaded", setupIdleTimer);
            })();

            function runCountdown(element, startTime, endTime) {
                setInterval(() => {
                    const now = new Date();
                    const timeZoneOffset = 8 * 60;
                    const nowInWita = new Date(now.getTime() + now.getTimezoneOffset() * 60000 + timeZoneOffset *
                    60000);
                    let remainingTime;
                    if (nowInWita >= startTime && nowInWita <= endTime) {
                        remainingTime = endTime - nowInWita;
                        element.classList.add('green');
                        element.classList.remove('red');
                    } else {
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
                startTime.setHours(6, 0, 0);
                endTime.setHours(8, 30, 0);
                runCountdown(countdownElement, startTime, endTime);
            }

            function countdown_siang() {
                const countdownElement = document.querySelector('.countdown-siang');
                const startTime = new Date();
                const endTime = new Date();
                startTime.setHours(11, 0, 0);
                endTime.setHours(13, 0, 0);
                runCountdown(countdownElement, startTime, endTime);
            }

            function countdown_sore() {
                const countdownElement = document.querySelector('.countdown-sore');
                const startTime = new Date();
                const endTime = new Date();
                startTime.setHours(16, 30, 0);
                endTime.setHours(19, 30, 0);
                runCountdown(countdownElement, startTime, endTime);
            }

            function countdown_malam() {
                const countdownElement = document.querySelector('.countdown-malam');
                const startTime = new Date();
                const endTime = new Date();

                startTime.setHours(22, 0, 0);
                endTime.setHours(2, 10, 0); // Ubah hingga 02:59 sesuai dengan PHP

                // Jika waktu saat ini sudah melewati endTime, sesuaikan tanggal
                const now = new Date();
                if (now.getHours() < 22) {
                    startTime.setDate(startTime.getDate() - 1);
                } else if (now.getHours() >= 22 || now.getHours() < 3) {
                    endTime.setDate(endTime.getDate() + 1);
                }

                runCountdown(countdownElement, startTime, endTime);
            }

            countdown_pagi();
            countdown_siang();
            countdown_sore();
            countdown_malam();
        </script>
    @endpush
</div>
