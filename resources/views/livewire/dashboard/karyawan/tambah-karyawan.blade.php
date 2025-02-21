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

                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group" id="login_level">
                            <label for="exampleFormControlInput1" class="form-label">Nama Karyawan</label>
                            <input type="text" class="form-control" id="data_nama" placeholder="...">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group" id="login_level">
                            <label for="exampleFormControlInput1" class="form-label">No. ID Card</label>
                            <input type="number" class="form-control" id="data_no_id_card" placeholder="...">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="form-group" id="login_level">
                            <label for="login_level">Pilih Divisi</label>
                            <select name="login_level" id="login_level" class="form-control">
                                <option value="">-- Pilih Divisi --</option>
                                <option value="HUMAN CAPITAL & GA">HUMAN CAPITAL & GA</option>
                                <option value="PRODUKSI">PRODUKSI</option>
                                <option value="WAREHOUSE & ADMIN">WAREHOUSE & ADMIN</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="form-group" id="login_level">
                            <label for="exampleFormControlInput1" class="form-label">Jabatan</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="form-group" id="login_level">
                            <label for="exampleFormControlInput1" class="form-label">Jabatan</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
