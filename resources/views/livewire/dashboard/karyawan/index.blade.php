<div>
    @push('css')
    <style>
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #000000;
            text-align: center;
        }

        .table-bordered td, .table-bordered th {
            border: 1px solid #000000;
            vertical-align: middle !important;
        }

        .table-compact {
            font-size: 12px;
        }

        .table-compact th, .table-compact td {
            padding: 8px;
            margin: 0;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            gap: 5px;
        }
    </style>
    @endpush
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
                <!-- FORM SEARCH -->
                <div class="mb-3 d-flex justify-content-end">
                    <input type="text" class="form-control w-25" placeholder="Cari karyawan..." wire:model.debounce.500ms="search">
                </div>
                <div class="row mt-1">
                    <div class="col-12">
                        <div wire:poll.5s>
                            <div class="table-responsive">
                                <table class="table table-bordered border-primary table-compact">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">#</th>
                                            <th scope="col" class="text-center">Nama</th>
                                            <th scope="col" class="text-center">No ID Card</th>
                                            <th scope="col" class="text-center">Divisi</th>
                                            <th scope="col" class="text-center">Departemen</th>
                                            <th scope="col" class="text-center">Jabatan</th>
                                            <th scope="col" class="text-center">Kategori</th>
                                            <th scope="col" class="text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $x = ($karyawan->currentPage() - 1) * $karyawan->perPage() + 1; @endphp
                                        @foreach($karyawan as $data)
                                            <tr>
                                                <th class="text-center">{{ $x++ }}</th>
                                                <td class="text-center">{{ $data->data_nama }}</td>
                                                <td class="text-center">{{ $data->data_no_id_card }}</td>
                                                <td class="text-center">{{ $data->data_divisi }}</td>
                                                <td class="text-center">{{ $data->data_dept }}</td>
                                                <td class="text-center">{{ $data->data_jabatan }}</td>
                                                <td class="text-center">{{ $data->data_kategori }}</td>
                                                @php
                                                $qrname = strtoupper($data->data_nama) . " - " . "(" . $data->data_no_id_card . ")";
                                                @endphp
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm btn-info" wire:click="lihat({{ $data->id }})">Lihat</button>
                                                        <button class="btn btn-sm btn-warning" wire:click="ubah({{ $data->id }})">Ubah</button>
                                                        <button class="btn btn-sm btn-danger" wire:click="hapus({{ $data->id }})" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                                    </div>
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
                <div class="col-12 d-flex justify-content-center" wire:ignore>
                    {{ $karyawan->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

</div>
