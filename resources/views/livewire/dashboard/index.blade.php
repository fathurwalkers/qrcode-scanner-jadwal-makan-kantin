<div>

    @push('css')
        <style>
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
    @endpush

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h3 mb-0 text-gray-800">{{ $title ?? 'Dashboard' }}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                <li class="breadcrumb-item">Pages</li>
                <li class="breadcrumb-item active" aria-current="page">{{ $title ?? 'Dashboard' }}</li>
            </ol>
        </div>

        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="card-group w-100">

                        <div class="card shadow mx-2 mb-4" style="max-width: 18rem;">
                            <div class="card-header bg-success text-white text-center">
                                <b>PAGI</b>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col mr-2">
                                        <h3 class="h3 mb-2 font-weight-bold text-gray-800 text-center">
                                            @if($counts->pagi == null)
                                                0
                                            @else
                                                {{ $counts->pagi }}
                                            @endif
                                        </h3>
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
                                        <h3 class="h3 mb-2 font-weight-bold text-gray-800 text-center">
                                            @if($counts->siang == null)
                                                0
                                            @else
                                                {{ $counts->siang }}
                                            @endif
                                        </h3>
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
                                        <h3 class="h3 mb-2 font-weight-bold text-gray-800 text-center">
                                            @if($counts->malam == null)
                                                0
                                            @else
                                                {{ $counts->malam }}
                                            @endif
                                        </h3>
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
                                        <h3 class="h3 mb-2 font-weight-bold text-gray-800 text-center">
                                            @if($counts->subuh == null)
                                                0
                                            @else
                                                {{ $counts->subuh }}
                                            @endif
                                        </h3>
                                        <div class="mt-2 mb-0 text-center text-xs">
                                            <h5 class="countdown-subuh">00:00:00</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- Modal Logout -->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to logout?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary"
                            data-dismiss="modal">Cancel</button>
                        <a href="login.html" class="btn btn-primary">Logout</a>
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
