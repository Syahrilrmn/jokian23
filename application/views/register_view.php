<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title_web; ?></title>
  <link id='favicon' rel="shortcut icon" href="<?php echo base_url('assets_style/image/logo-mts.png'); ?>" type="image/x-png">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets_style/assets/css/login.css'); ?>">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('assets_style/assets/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets_style/assets/bower_components/font-awesome/css/font-awesome.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets_style/assets/bower_components/Ionicons/css/ionicons.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets_style/assets/dist/css/AdminLTE.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets_style/assets/dist/css/responsivelogin.css'); ?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading" style="position: relative; flex-wrap: wrap;">
              <div style="position: relative; flex-wrap: wrap; margin-top: 5px; margin-bottom: 10px;">
                <img src="<?php echo base_url('assets_style/image/logo-mts.png'); ?>" alt="logo" class="logo" width="80px">
              </div>
              <div style="position: relative; flex-wrap: wrap; margin:auto; justify-content: center; align-items:center; display:flex; margin-top: -90px; font-size: 130%;height:80px;">
                A P L I K A S I &nbsp; P E R P U S T A K A A N &nbsp;
                <br> M T S &nbsp; S Y E K H &nbsp; K H A L I D
              </div>
              <div style="margin-left: 150px; font-size: 200%;">
                <!-- <strong>FORM LOGIN</strong> -->
              </div>
            </div>
            <div class="panel-body">
              <div class="col-md-12">
                <form action="<?= base_url('login/do_register'); ?>" method="POST" enctype="multipart/form-data">
                  <div class="form-group has-feedback">
                    <br>
                    <label>USERNAME</label>
                    <input type="text" class="form-control" placeholder="Username" id="user" name="user" required="required" autocomplete="off">
                    <span class="glyphicon glyphicon-user form-control-feedback" style="padding-top: 20px;"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <label>PASSWORD</label>
                    <input type="password" class="form-control" placeholder="Password" id="pass" name="pass" required="required" autocomplete="off">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <label>EMAIL</label>
                    <input type="email" class="form-control" placeholder="Email" id="email" name="email" required="required" autocomplete="off">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <label>NAME</label>
                    <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama" required="required" autocomplete="off">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <label>PHOTO</label>
                    <input type="file" class="form-control" accept="image/*" name="gambar" required="required">
                  </div>
                  <button type="submit" id="loding" class="btn btn-primary btn-block btn-flat" style="border-radius: 5%;">REGISTER</button>
                  <div id="loadingcuy"></div>
                </form>
              </div>
            </div>
            <a href="<?php echo base_url('login'); ?>" class="btn btn-primary btn-block btn-flat" style="border-radius: 5%; width:100px; margin-left:auto; margin-right:30px;">Login</a>
            <br>
            <div class="panel-footer">
              <strong style="margin-left: 20px;">&copy;2023 Perpustakaan Mts Syekh Khalid <br>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>