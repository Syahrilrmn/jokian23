<?php if (!defined('BASEPATH'))
    exit('No direct script acess allowed'); ?>
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
                        <form form action="<?php echo base_url('Notifikasi/store'); ?>" method="POST"
                            enctype="multipart/form-data">
                            <div class="row g-3">
                                <div class="col-12 ">
                                    <label for="namaPegawai" class="form-label">Nama Pengawai</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="namaPegawai"><?= $data->Pegawai_Tujuan ?></textarea>
                                </div>
                                <div class="col-12">
                                    <label for="exampleFormControlTextarea1" class="form-label">Isi Pengumuman</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="isiPengumuman"><?= $data->Isi_Pengumuman ?></textarea>
                                </div>
                                <div class="col-12 ">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal"
                                         name="tanggal" value="<?= $data->Tanggal ?>">
                                </div>
                                <div class="col-12">
                                    <br>
                                    <div class="d-flex align-items-center gap-3">
                                        <button class="btn btn-success px-4">Submit</button>
                                    </div>
                                </div>
                                <!-- <button class="btn btn-primary px-4" onclick="stepper1.previous()"><i class='bx bx-left-arrow-alt me-2'></i>Previous</button> -->
                            </div><!---end row-->

                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>