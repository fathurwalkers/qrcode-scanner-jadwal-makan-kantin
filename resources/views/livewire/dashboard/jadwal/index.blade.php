<div>
    @push('css')
    <style>
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #000000;
        }

        .table-bordered td, .table-bordered th, .table-bordered tr {
            border: 1px solid #000000;
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
                <div class="row mt-3">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered border-primary">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">Nama</th>
                                        <th scope="col" class="text-center">Divsi</th>
                                        <th scope="col" class="text-center">Jabatan</th>
                                        <th scope="col" class="text-center">Tanggal / Waktu</th>
                                        <th scope="col" class="text-center">PAGI</th>
                                        <th scope="col" class="text-center">SIANG</th>
                                        <th scope="col" class="text-center">MALAM</th>
                                        <th scope="col" class="text-center">SUBUH</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jadwal as $jd)
                                        <tr>
                                            <td class="text-center text-middle" width="10%">
                                                {{ $jd->data->data_nama }} <br />
                                                {{ $jd->data->data_no_id_card }} <br />
                                            </td>
                                            <td class="text-center text-middle" width="10%">
                                                {{ $jd->data->data_divisi }} <br />
                                            </td>
                                            <td class="text-center text-middle" width="10%">
                                                {{ $jd->data->data_jabatan }} <br />
                                            </td>
                                            <td class="text-center text-middle" width="10%">
                                                {{ $jd->jadwal_tanggal }}
                                            </td>
                                            <td class="text-center" width="15%">
                                                @switch($jd->jadwal_cek_pagi)
                                                    @case('YA')
                                                        &#10004;
                                                    @break

                                                    @case('TIDAK')
                                                        &#10006;
                                                    @break
                                                @endswitch
                                                <p class="waktu-scan">
                                                    Waktu Scan : {{ $jd->jadwal_jam_pagi }}
                                                </p>
                                            </td>
                                            <td class="text-center" width="15%">
                                                @switch($jd->jadwal_cek_siang)
                                                    @case('YA')
                                                        &#10004;
                                                    @break

                                                    @case('TIDAK')
                                                        &#10006;
                                                    @break
                                                @endswitch
                                                <p class="waktu-scan">
                                                    Waktu Scan : {{ $jd->jadwal_jam_siang }}
                                                </p>
                                            </td>
                                            <td class="text-center" width="15%">
                                                @switch($jd->jadwal_cek_malam)
                                                    @case('YA')
                                                        &#10004;
                                                    @break

                                                    @case('TIDAK')
                                                        &#10006;
                                                    @break
                                                @endswitch
                                                <p class="waktu-scan">
                                                    Waktu Scan : {{ $jd->jadwal_jam_malam }}
                                                </p>
                                            </td>
                                            <td class="text-center" width="15%">
                                                @switch($jd->jadwal_cek_subuh)
                                                    @case('YA')
                                                        &#10004;
                                                    @break

                                                    @case('TIDAK')
                                                        &#10006;
                                                    @break
                                                @endswitch
                                                <p class="waktu-scan">
                                                    Waktu Scan : {{ $jd->jadwal_jam_subuh }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center mx-auto">
                        {{ $jadwal->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
