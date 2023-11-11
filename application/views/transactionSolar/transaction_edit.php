<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Forms</div>
        </div>
        <!--end breadcrumb-->
        <!--start stepper one-->
        <div id="stepper1" class="bs-stepper">
            <div class="card">
                <div class="card-body">
                    <div class="bs-stepper-content">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row g-3">
                                <div class="col-12 col-lg-6">
                                    <label for="jumlahSolar" class="form-label">Tanggal Pengambilan</label>
                                    <input type="date" class="form-control" id="jumlahSolar" placeholder="Jumlah Solar"
                                        name="tanggalPengambilan" value="<?= $data->tanggal_pengambilan?>" required>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="jumlahSolar" class="form-label">Jumlah Liter</label>
                                    <input type="number" itemtype="number" class="form-control" id="jumlahSolar"
                                        placeholder="Jumlah Liter" name="jumlahLiter" max="<?= $count_solar->jumlah_stok ?>" min="0" required value="<?= $data->jumlah_liter?>">
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="noPlat" class="form-label">No Plat</label>
                                    <input type="text" class="form-control" id="noPlat" placeholder="No Plat"
                                        name="noPlat" value="<?= $data->no_plat?>" required>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="kendaraan" class="form-label">Kendaraan</label>
                                    <input type="text" class="form-control" id="kendaraan" placeholder="Kendaraan"
                                        name="kendaraan" value="<?= $data->kendaraan?>"  required>
                                </div>
                                <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>