<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        .text p {
            margin: 0;
            font-weight: bold;
            font-size: 14px;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #000000;
        }

        .table-bordered td, .table-bordered th, .table-bordered tr {
            border: 1px solid #000000;
        }

        .table-compact {
            font-size: 12px;
        }

        .table-compact th,
        .table-compact td {
            padding: 4px;
            margin: 0;
        }

        .table-compact p {
            margin: 0;
            font-size: 10px;
        }
        .waktu-scan {
            font-size: 10px;
        }

        table .tanggal {
            font-size: 16px;
            font-weight: bold;
        }

        .tanggal td {
            padding: 0 2px;
        }

        table tr.tanggal td:nth-child(1),
        table tr.tanggal td:nth-child(8),
        table tr.tanggal td:nth-child(15),
        table tr.tanggal td:nth-child(16),
        table tr.tanggal td:nth-child(22),
        table tr.tanggal td:nth-child(29) {
            background-color: rgb(239, 117, 117);
        }

        table tbody tr.baris td {
            font-size: 12px;
            /* font-weight: bold; */
        }

        table tr.row-1 td:nth-child(n + 3):nth-child(-n + 12),
        table tr.row-1 th:nth-child(n + 3):nth-child(-n + 12) {
            background-color: #3b3b3b; /* Ganti dengan warna yang diinginkan */
        }

        table tr.row-2 td:nth-child(n + 3):nth-child(-n + 33) {
            background-color: #3b3b3b;
        }

        table tr.row-3 td:nth-child(4),
        table tr.row-3 td:nth-child(5),
        table tr.row-3 td:nth-child(6),
        table tr.row-3 td:nth-child(7),
        table tr.row-3 td:nth-child(8),
        table tr.row-3 td:nth-child(11),
        table tr.row-3 td:nth-child(12),
        table tr.row-3 td:nth-child(13),
        table tr.row-3 td:nth-child(14),
        table tr.row-3 td:nth-child(15),
        table tr.row-3 td:nth-child(19),
        table tr.row-3 td:nth-child(20),
        table tr.row-3 td:nth-child(21),
        table tr.row-3 td:nth-child(22),
        table tr.row-3 td:nth-child(25),
        table tr.row-3 td:nth-child(26),
        table tr.row-3 td:nth-child(27),
        table tr.row-3 td:nth-child(28),
        table tr.row-3 td:nth-child(29),
        table tr.row-3 td:nth-child(32),
        table tr.row-3 td:nth-child(33) {
            background-color: #3b3b3b;
        }

        table tr.row-5 td:nth-child(n + 4):nth-child(-n + 13) {
            background-color: #3b3b3b; /* Ganti dengan warna yang diinginkan */
        }

        table tr.row-6 td:nth-child(n + 4):nth-child(-n + 8) {
            background-color: #3b3b3b; /* Ganti dengan warna yang diinginkan */
        }

        table tr.row-7 td:nth-child(n + 4):nth-child(-n + 13) {
            background-color: #3b3b3b; /* Ganti dengan warna yang diinginkan */
        }

        table tr.row-8 td:nth-child(n + 4):nth-child(-n + 5) {
            background-color: #3b3b3b; /* Ganti dengan warna yang diinginkan */
        }

        table tr.row-9 td:nth-child(n + 6):nth-child(-n + 20) {
            background-color: #3b3b3b; /* Ganti dengan warna yang diinginkan */
        }
        table tr.row-10 td:nth-child(n + 6):nth-child(-n + 7) {
            background-color: #3b3b3b; /* Ganti dengan warna yang diinginkan */
        }
        table tr.row-11 td:nth-child(n + 6):nth-child(-n + 13) {
            background-color: #3b3b3b; /* Ganti dengan warna yang diinginkan */
        }

        table tr.row-12 td:nth-child(n + 6):nth-child(-n + 9) {
            background-color: #3b3b3b; /* Ganti dengan warna yang diinginkan */
        }

        table tr.row-13 td:nth-child(6),
        table tr.row-13 td:nth-child(32),
        table tr.row-14 td:nth-child(6),
        table tr.row-14 td:nth-child(32),
        table tr.row-15 td:nth-child(32),
        table tr.row-15 td:nth-child(6) {
            background-color: #3b3b3b; /* Ganti dengan warna yang diinginkan */
        }

        table tr.row-17 td:nth-child(n + 20):nth-child(-n + 28) {
            background-color: #3b3b3b; /* Ganti dengan warna yang diinginkan */
        }

        table tr.row-18 td:nth-child(n + 10):nth-child(-n + 17) {
            background-color: #3b3b3b; /* Ganti dengan warna yang diinginkan */
        }

        table tr.row-20 td:nth-child(n + 14):nth-child(-n + 33),
        table tr.row-21 td:nth-child(n + 14):nth-child(-n + 33) {
            background-color: #3b3b3b; /* Ganti dengan warna yang diinginkan */
        }

        table tr.row-22 td:nth-child(n + 15):nth-child(-n + 15) {
            background-color: #3b3b3b; /* Ganti dengan warna yang diinginkan */
        }

        table tr.row-24 td:nth-child(n + 19):nth-child(-n + 26),
        table tr.row-25 td:nth-child(n + 19):nth-child(-n + 26),
        table tr.row-26 td:nth-child(n + 19):nth-child(-n + 26) {
            background-color: #3b3b3b; /* Ganti dengan warna yang diinginkan */
        }
    </style>
    <title>Tabel Laporan</title>
  </head>
  <body>
    <div class="container mb-5">
      <div class="row">
        <div class="col-12">
          <div class="data">
            <div class="text text-center mt-4 mb-4">
              <p>REPORT JADWAL MAKAN KANTIN</p>
              <p>PT. KARTIKA PRIMA ABADI</p>
              <p>{{ $tanggal }}</p>
            </div>

            <table class="table table-bordered border-primary table-compact">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Nama</th>
                        <th scope="col" class="text-center">Divisi</th>
                        <th scope="col" class="text-center">Jabatan</th>
                        <th scope="col" class="text-center">PAGI</th>
                        <th scope="col" class="text-center">SIANG</th>
                        <th scope="col" class="text-center">MALAM</th>
                        <th scope="col" class="text-center">SUBUH</th>
                    </tr>
                </thead>
                <tbody>
                    @php $x = 1; @endphp
                    @foreach($result as $item)
                        <tr>
                            <th class="text-center text-middle" width="4%">
                                {{ $x++ }}
                            </th>
                            <td class="text-center text-middle" width="10%">
                                {{ $item['data_nama'] }} <br />
                            </td>
                            <td class="text-center text-middle" width="10%">
                                {{ $item['data_divisi'] }} <br />
                            </td>
                            <td class="text-center text-middle" width="10%">
                                {{ $item['data_jabatan'] }} <br />
                            </td>
                            <td class="text-center" width="15%">
                                {!! $item['pagi'] === 'YA' ? '&#10004;' : '&#10006;' !!}
                                @if($item['pagi'] === 'YA' && isset($item['pagi_scan']))
                                    <p class="waktu-scan">
                                        Waktu Scan: {{ $item['pagi_scan'] }}
                                    </p>
                                @endif
                            </td>
                            <td class="text-center" width="15%">
                                {!! $item['siang'] === 'YA' ? '&#10004;' : '&#10006;' !!}
                                @if($item['siang'] === 'YA' && isset($item['siang_scan']))
                                    <p class="waktu-scan">
                                        Waktu Scan: {{ $item['siang_scan'] }}
                                    </p>
                                @endif
                            </td>
                            <td class="text-center" width="15%">
                                {!! $item['malam'] === 'YA' ? '&#10004;' : '&#10006;' !!}
                                @if($item['malam'] === 'YA' && isset($item['malam_scan']))
                                    <p class="waktu-scan">
                                        Waktu Scan: {{ $item['malam_scan'] }}
                                    </p>
                                @endif
                            </td>
                            <td class="text-center" width="15%">
                                {!! $item['subuh'] === 'YA' ? '&#10004;' : '&#10006;' !!}
                                @if($item['subuh'] === 'YA' && isset($item['subuh_scan']))
                                    <p class="waktu-scan">
                                        Waktu Scan: {{ $item['subuh_scan'] }}
                                    </p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
