<div>
    @push('css')
        <style>
            .table {
                width: 100%;
                margin-bottom: 1rem;
                color: #000000;
                text-align: center;
            }

            .table-bordered td,
            .table-bordered th {
                border: 1px solid #000000;
                vertical-align: middle !important;
            }

            .table-compact {
                font-size: 12px;
            }

            .table-compact th,
            .table-compact td {
                padding: 8px;
                margin: 0;
            }

            .btn-group {
                display: flex;
                justify-content: center;
                gap: 5px;
            }

            .modal-backdrop {
                display: none !important;
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
                <div class="mb-3 d-flex justify-content-end">
                    <input type="text" class="form-control w-25" placeholder="Cari karyawan..."
                        wire:model.debounce.500ms="search">
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
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
                                        @foreach ($karyawan as $data)
                                            <tr>
                                                <th class="text-center">{{ $x++ }}</th>
                                                <td class="text-center">{{ $data->data_nama }}</td>
                                                <td class="text-center">{{ $data->data_no_id_card }}</td>
                                                <td class="text-center">{{ $data->data_divisi }}</td>
                                                <td class="text-center">{{ $data->data_dept }}</td>
                                                <td class="text-center">{{ $data->data_jabatan }}</td>
                                                <td class="text-center">{{ $data->data_kategori }}</td>
                                                @php
                                                    $qrname =
                                                        strtoupper($data->data_nama) .
                                                        ' - ' .
                                                        '(' .
                                                        $data->data_no_id_card .
                                                        ')';
                                                @endphp
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        @if (file_exists(public_path('qr/' . $data->data_nama . ' - (' . $data->data_no_id_card . ').png')))
                                                            <a href="{{ asset('qr/' . $data->data_nama . ' - (' . $data->data_no_id_card . ').png') }}"
                                                                class="btn btn-sm btn-info" download>Download</a>
                                                        @else
                                                            <button class="btn btn-sm btn-secondary" disabled>Tidak
                                                                Ada</button>
                                                        @endif
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-toggle="modal" data-target="#editModal">
                                                            Ubah
                                                        </button>
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="showDeleteModal({{ $data->id }}, '{{ $data->data_nama }}')">
                                                            Hapus
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Modal -->
                                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Modal title
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('edit-user') }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="container">
                                                                    <input type="hidden" name="user_id" value="{{ $data->id }}">
                                                                    <div class="row mt-2">
                                                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                                                            <div class="form-group" id="login_level">
                                                                                <label for="exampleFormControlInput1" class="form-label">Nama Karyawan</label>
                                                                                <input type="text" class="form-control" id="data_nama" name="data_nama" value="{{ $data->data_nama }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                                                            <div class="form-group" id="login_level">
                                                                                <label for="exampleFormControlInput1" class="form-label">No. ID Card</label>
                                                                                <input type="number" class="form-control" id="data_no_id_card" value="{{ $data->data_no_id_card }}" name="data_no_id_card">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                                                            <div class="form-group" id="data_divisi">
                                                                                <label for="data_divisi">Pilih Divisi</label>
                                                                                <select name="data_divisi" id="data_divisi" class="form-control">
                                                                                    <option selected value="{{ $data->data_divisi }}">
                                                                                        {{ $data->data_divisi }}
                                                                                    </option>
                                                                                    <option value="HUMAN CAPITAL & GA">HUMAN CAPITAL & GA</option>
                                                                                    <option value="PRODUKSI">PRODUKSI</option>
                                                                                    <option value="WAREHOUSE & ADMIN">WAREHOUSE & ADMIN</option>
                                                                                    <option value="TANPA KETERANGAN">TANPA KETERANGAN</option>
                                                                                    <option value="PHL">PHL</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                                                            <div class="form-group" id="login_level">
                                                                                <label for="data_jabatan" class="form-label">Jabatan</label>
                                                                                <input type="text" class="form-control" id="data_jabatan" value="{{ $data->data_jabatan }}" name="data_jabatan">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                                                            <div class="form-group" id="login_level">
                                                                                <label for="data_dept" class="form-label">Dept.</label>
                                                                                <input type="text" class="form-control" id="data_dept" value="{{ $data->data_dept }}" name="data_dept">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                    Batal
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">
                                                                    Ubah Data
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Konfirmasi Hapus -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('hapus-user') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="" id="id_user">
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus karyawan <strong
                                                id="employeeName"></strong>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger"
                                            id="confirmDelete">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row mt-0 mb-0">
                <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center mx-auto" wire:ignore>
                    {{ $karyawan->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            function showDeleteModal(id, name) {
                // Set nama karyawan di modal
                document.getElementById("employeeName").textContent = name;
                document.getElementById("id_user").value = id;

                // Simpan ID karyawan di tombol hapus
                document.getElementById("confirmDelete").setAttribute("onclick", `deleteEmployee(${id})`);

                // Tampilkan modal
                $('#deleteModal').modal('show');
            }

            function deleteEmployee(id) {
                // Contoh: Kirim AJAX atau form delete
                console.log("Menghapus karyawan dengan ID:", id);

                // Tutup modal setelah hapus
                $('#deleteModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            }

            function showEditModal(id, name) {
                // Set nama karyawan di modal
                document.getElementById("employeeName").textContent = name;
                document.getElementById("id_user").value = id;

                // Simpan ID karyawan di tombol hapus
                document.getElementById("confirmEdit").setAttribute("onclick", `editEmployee(${id})`);

                // Tampilkan modal
                $('#editModal').modal('show');
            }

            function editEmployee(id) {
                // Contoh: Kirim AJAX atau form edit
                console.log("Menghapus karyawan dengan ID:", id);

                // Tutup modal setelah hapus
                $('#editModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            }
        </script>
    @endpush
</div>
