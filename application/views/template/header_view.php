<!doctype html>
<html lang="en">



<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--favicon-->
  <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon-32x32.png" type="image/png" />
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
  <script src="<?php echo base_url(); ?>assets/plugins/apexcharts-bundle/apexcharts.js"></script>
  <title>  <?php echo $title_web ?></title>
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
              <li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
                <a class="nav-link" href="avascript:;"><i class='bx bx-search'></i>
                </a>
              </li>


              <li class="nav-item dropdown dropdown-app">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown" href="javascript:;">
                  <div class="dropdown-menu dropdown-menu-end p-0">
                    <div class="app-container p-2 my-2">
                      <div class="row gx-0 gy-2 row-cols-3 justify-content-center p-2">


                      </div>

                    </div>
                  </div>
              </li>

              <li class="nav-item dropdown dropdown-large">

                <div class="dropdown-menu dropdown-menu-end">

                  <div class="header-notifications-list">

                  </div>
              </li>
              <li class="nav-item dropdown dropdown-large">

                <div class="dropdown-menu dropdown-menu-end">

                  <div class="header-message-list">

              </li>

              <li class="nav-item dark-mode d-none d-sm-flex">
                <a class="nav-link dark-mode-icon" href="javascript:;"><i class='bx bx-moon'></i>
                </a>
              </li>
            </ul>
          </div>

          <div class="user-box dropdown px-3">
            <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="<?php echo base_url(); ?>assets/images/avatars/avatar-2.png" class="user-img" alt="user avatar">
              <div class="user-info">
                <p class="user-name mb-0">Pauline Seitz</p>
                <p class="designattion mb-0">Web Designer</p>
              </div>
            </a>

            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-user fs-5"></i><span>Profile</span></a>
              </li>
              <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-cog fs-5"></i><span>Settings</span></a>
              </li>
              <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-home-circle fs-5"></i><span>Dashboard</span></a>
              </li>
              <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-dollar-circle fs-5"></i><span>Earnings</span></a>
              </li>
              <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-download fs-5"></i><span>Downloads</span></a>
              </li>
              <li>
                <div class="dropdown-divider mb-0"></div>
              </li>
              <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>



    