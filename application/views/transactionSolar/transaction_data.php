<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">


        <!--end breadcrumb-->

        <h6 class="mb-0 text-uppercase">DataTable Import</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <form method="post" class="row gap-2 mb-2">

                    <div class="col-auto">
                        <input type="date" class="form-control" name="start_date" required>
                    </div>
                    <div class="col-auto">
                        <input type="date" name="end_date" class="form-control" required>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id Transaksi</th>
                                <th>Nama</th>
                                <th>No Plat</th>
                                <th>Kendaraan</th>
                                <th>Tanggal Pengambilan</th>
                                <th>Jumlah Liter</th>
                                <th>Di Input Pada</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data as $isi): ?>

                                <tr>
                                    <td>
                                        <?= $no; ?>
                                    </td>
                                    <td>
                                        <?= $isi->id_transaksi_solar; ?>
                                    </td>
                                    <td>
                                        <?= $isi->user; ?>
                                    </td>
                                    <td>
                                        <?= $isi->no_plat; ?>
                                    </td>
                                    <td>
                                        <?= $isi->kendaraan; ?>
                                    </td>
                                    <td>
                                    <?= date('d-m-Y', strtotime($isi->tanggal_pengambilan)); ?>

                                    </td>
                                    <td>
                                        <?= $isi->jumlah_liter; ?>
                                    </td>
                                    <td>
                                        <?= $isi->created_at; ?>
                                    </td>

                                </tr>
                                <?php $no++; endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>