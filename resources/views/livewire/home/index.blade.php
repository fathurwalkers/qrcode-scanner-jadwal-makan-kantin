<div>
    <div class="row text-center mt-3 mb-3 my-3">
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
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search..." aria-label="Search" autofocus>
                <div class="input-group-append">
                    <button class="btn btn-info" type="button">
                        <i class="fas fa-search"></i>
                        Scan QR Anda
                    </button>
                </div>
            </div>
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
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Tanggal / Waktu</th>
                        <th scope="col">SUBUH</th>
                        <th scope="col">PAGI</th>
                        <th scope="col">SIANG</th>
                        <th scope="col">MALAM</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            {{ $nama }}
                        </td>
                        <td>
                            {{ $tanggalwaktu }}
                        </td>
                        <td>
                            {{ $malam }}
                        </td>
                        <td>
                            {{ $malam }}
                        </td>
                        <td>
                            {{ $malam }}
                        </td>
                        <td>
                            {{ $malam }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <hr class="mt-2" />

    <div class="row">
        <div class="card-group">

            <div class="card shadow mx-2 mb-3" style="max-width: 18rem;">
                <div class="card-header bg-info text-white text-center">
                    <b>PAGI</b>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <h3 class="h3 mb-2 font-weight-bold text-gray-800 text-center">240</h3>
                            <p class="text-xs text-muted">
                                Some quick example text to build on the card title and make up the bulk of the card's
                                content.
                            </p>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 5%</span>
                                <span>Since last check</span>
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
                                Some quick example text to build on the card title and make up the bulk of the card's
                                content.
                            </p>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 5%</span>
                                <span>Since last check</span>
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
                                Some quick example text to build on the card title and make up the bulk of the card's
                                content.
                            </p>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 5%</span>
                                <span>Since last check</span>
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
                                Some quick example text to build on the card title and make up the bulk of the card's
                                content.
                            </p>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 5%</span>
                                <span>Since last check</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
