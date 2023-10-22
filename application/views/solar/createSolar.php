<?php if (!defined('BASEPATH')) exit('No direct script acess allowed'); ?>
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
                        <form form action="<?php echo base_url('solar/store'); ?>" method="POST" enctype="multipart/form-data">
                            <div class="row g-3">
                                <div class="col-12 col-lg-6">
                                    <label for="jumlahSolar" class="form-label">Jumlah Solar</label>
                                    <input type="number" class="form-control" id="jumlahSolar" placeholder="Jumlah Solar" name="jumlahSolar">
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