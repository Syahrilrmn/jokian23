<!doctype html>
<html lang="en">


<!-- Mirrored from codervent.com/syndron/demo/vertical/auth-basic-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 29 Jul 2023 03:58:38 GMT -->

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="<?php echo base_url(); ?>assets/images/logo.png" type="image/png" />
	<!--plugins-->
	<link href="<?php echo base_url(); ?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="<?php echo base_url(); ?>assets/css/pace.min.css" rel="stylesheet" />
	<script src="<?php echo base_url(); ?>assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/app.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
	<title>Sistem Informasi Menajemen United Tractors</title>
</head>

<body class="">
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="card mb-0">
							<div class="card-body">
								<div class="p-4">
									<div class="mb-3 text-center">
										<img src="<?php echo base_url(); ?>assets/images/logo.png" width="60" alt="" />
									</div>
									<div class="text-center mb-4">
										<h5 class="">Sistem Informasi Menjamen United Tractors</h5>
										
									</div>
									<div class="form-body">
										<form action="<?= base_url('login/auth'); ?>" method="POST" class="row g-3" id="loginForm">
											<div class="col-12">
												<label for="inputEmailAddress" class="form-label">Email</label>
												<input type="email" class="form-control" name="email" id="inputEmailAddress" placeholder="Masukan Gmail Anda.......">
											</div>
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Password</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" class="form-control border-end-0" name="pass" id="inputChoosePassword" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div>
											
											<div class="col-md-6 text-end"> </a>
											</div>
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary" id="loginButton">Login</button>
												</div>
											</div>
											<div class="col-12">
												<div class="text-center ">
													<p class="mb-0">Don't have an account yet? <a href="<?= base_url('login/register'); ?>">Register</a>
													</p>
												</div>
											</div>
										</form>
									</div>
									

								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!-- ... Bagian HTML lainnya ... -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
	<script>
		document.getElementById('loginForm').addEventListener('submit', function(event) {
			event.preventDefault();
			var formData = new FormData(this);
			console.log(formData)

			// Kirim data formulir menggunakan Ajax
			fetch('<?= base_url('login/auth'); ?>', {
					method: 'POST',
					body: formData
				})
				.then(response => response.json())
				.then(data => {
					console.log(data)
					if (data.status === 'success') {
						Swal.fire({
							title: 'Login Berhasil!',
							text: 'Selamat Datang, ' + data.user + '!', // Menampilkan nama pengguna
							icon: 'success',
							confirmButtonText: 'OK'
						}).then(function() {
							window.location.href = '<?= base_url('dashboard'); ?>';
						});
					} else {
						Swal.fire({
							title: 'Login Gagal!',
							text: data.message,
							icon: 'error',
							confirmButtonText: 'OK'
						});
					}
				})
				.catch(error => {
					console.error('Error:', error);
				});
		});
	</script>

	<!-- ... Bagian HTML lainnya ... -->

	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function() {
			$("#show_hide_password a").on('click', function(event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
</body>


<!-- Mirrored from codervent.com/syndron/demo/vertical/auth-basic-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 29 Jul 2023 03:58:38 GMT -->

</html>