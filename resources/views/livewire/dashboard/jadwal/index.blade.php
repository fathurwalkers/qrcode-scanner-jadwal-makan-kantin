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
    </style>
    @endpush
    {{-- @dd($jadwal) --}}
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-0">
            <h1 class="h3 mb-0 text-gray-800">{{ $title ?? 'Dashboard' }}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                <li class="breadcrumb-item">Pages</li>
                <li class="breadcrumb-item active" aria-current="page">{{ $title ?? 'Dashboard' }}</li>
            </ol>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-between">
                    <input type="date" class="form-control w-25" wire:model="tanggalFilter">
                    <button class="btn btn-primary" wire:click="$refresh">Refresh</button>
                </div>
                <div class="row mt-1">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div wire:poll.keep-alive>
                            <div class="table-responsive">
                                <table class="table table-bordered border-primary table-compact">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">#</th>
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
                                        @php
                                        $x = 1;
                                        @endphp
                                        @foreach($jadwal as $jd)
                                            <tr>
                                                <th>
                                                    {{ $x++ }}
                                                </th>
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
                                                    @if($jd->jadwal_cek_pagi == "YA")
                                                        <p class="waktu-scan">
                                                            Waktu Scan : {{ $jd->jadwal_jam_pagi }}
                                                        </p>
                                                    @endif
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
                                                    @if($jd->jadwal_cek_siang == "YA")
                                                        <p class="waktu-scan">
                                                            Waktu Scan : {{ $jd->jadwal_jam_siang }}
                                                        </p>
                                                    @endif
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
                                                    @if($jd->jadwal_cek_malam == "YA")
                                                        <p class="waktu-scan">
                                                            Waktu Scan : {{ $jd->jadwal_jam_malam }}
                                                        </p>
                                                    @endif
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
                                                    @if($jd->jadwal_cek_subuh == "YA")
                                                        <p class="waktu-scan">
                                                            Waktu Scan : {{ $jd->jadwal_jam_subuh }}
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
            </div>
            <div class="row mt-0 mb-0">
                <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center mx-auto" wire:ignore>
                    {{ $jadwal->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

</div>
