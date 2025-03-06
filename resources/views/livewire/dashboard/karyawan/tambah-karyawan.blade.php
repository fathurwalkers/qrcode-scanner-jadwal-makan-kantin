<div>
    @push('css')
    <style>
        /*  */
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

                <form action="{{ route('post-buat-user') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group" id="login_level">
                                <label for="exampleFormControlInput1" class="form-label">Nama Karyawan</label>
                                <input type="text" class="form-control" id="data_nama" placeholder="..." name="data_nama">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group" id="login_level">
                                <label for="exampleFormControlInput1" class="form-label">No. ID Card</label>
                                <input type="number" class="form-control" id="data_no_id_card" placeholder="..." name="data_no_id_card">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group" id="data_divisi">
                                <label for="data_divisi">Pilih Divisi</label>
                                <select name="data_divisi" id="data_divisi" class="form-control">
                                    <option value="">-- Pilih Divisi --</option>
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
                                <input type="text" class="form-control" id="data_jabatan" placeholder="..." name="data_jabatan">
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group" id="login_level">
                                <label for="data_dept" class="form-label">Dept.</label>
                                <input type="text" class="form-control" id="data_dept" placeholder="..." name="data_dept">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end mr-auto my-2">
                            <button type="submit" class="btn btn-md btn-primary">TAMBAH DATA KARYAWAN</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>

</div>
