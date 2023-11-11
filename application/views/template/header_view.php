<!doctype html>
<html lang="en">



<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--favicon-->
  <link rel="icon" href="<?php echo base_url(); ?>assets/images/logo.png" type="image/png" />
  <!--plugins-->
  <link href="<?php echo base_url(); ?>assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <!-- loader-->
  <link href="<?php echo base_url(); ?>assets/css/pace.min.css" rel="stylesheet" />
  <script src="<?php echo base_url(); ?>assets/js/pace.min.js"></script>
  <!-- Bootstrap CSS -->

  <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/bootstrap-extended.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/app.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet">
  <!-- Theme Style CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dark-theme.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/semi-dark.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/header-colors.css" />
  <!-- new pop up -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/jquery-circle-progress-1.2.2/dist/circle-progress.js"></script>
  <!-- <script src="<?php echo base_url(); ?>assets/plugins/apexcharts-bundle/apexcharts.js"></script> -->
  <title>
    <?php echo $title_web ?>
  </title>
</head>

<body>
  <!--wrapper-->
  <div class="wrapper">
    <!--sidebar wrapper -->

    <!--end sidebar wrapper -->
    <!--start header -->
    <header>
      <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand gap-3">
          <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
          </div>

          <!-- <div class="position-relative search-bar d-lg-block d-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
            <input class="form-control px-5" disabled type="search" placeholder="Search">
            <span class="position-absolute top-50 search-show ms-3 translate-middle-y start-0 top-50 fs-5"><i class='bx bx-search'></i></span>
            </div> -->


          <div class="top-menu ms-auto">
            <ul class="navbar-nav align-items-center gap-1">


              <li class="nav-item dark-mode d-none d-sm-flex" onClick="handleClickDarkMode()">
                <a class="nav-link dark-mode-icon" href="javascript:;"><i class='bx bx-moon'></i>
                </a>
              </li>
            </ul>
          </div>

          <div class="user-box dropdown px-3">

            <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#"
              role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php
              $d = $this->db->query("SELECT * FROM tbl_login WHERE id_login=" . $this->session->userdata('ses_id'))->row();
              
              if (isset($d->foto)) {
                ?>
                <img src="<?php echo base_url(); ?>assets/images/pengguna/<?php echo $d->foto; ?>" class="user-img"
                  alt="user avatar">
              <?php } else { ?>
                <!--<img src="" alt="#" class="user-image" style="border:2px solid #fff;"/>-->
                <i class="fa fa-user fa-4x" style="color:#fff;"></i>
              <?php } ?>
              <div class="user-info">
                <p class="user-name mb-0">
                  <?php echo $d->user; ?>
                </p>
                <p class="designattion mb-0">
                  <?= $d->level; ?>
                </p>
              </div>
            </a>

            <ul class="dropdown-menu dropdown-menu-end">
              <li>
              <li>
                <a class="dropdown-item d-flex align-items-center"
                  href="<?php echo base_url('pengguna/edit/' . $this->session->userdata('ses_id')); ?>">

                  <div class="menu-title">Edit Profil</div>
                </a>
              </li>
              </li>
              <li>
                <div class="dropdown-divider mb-0"></div>
              </li>
              <li><a class="dropdown-item d-flex align-items-center" href="<?php echo base_url("login/logout"); ?>"><i
                    class="bx bx-log-out-circle"></i><span>Logout</span></a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
    <script>
      const handleClickDarkMode = () => {
        console.log("runnning");
      }
    </script>