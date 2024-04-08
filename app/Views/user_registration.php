<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>User App </title>
	<!--favicon-->
	<link rel="icon" href="<?php echo base_url('assets/images/favicon-32x32.png'); ?>" type="image/png" />
	<!-- loader-->
	<link href="<?php echo base_url('assets/css/pace.min.css'); ?>" rel="stylesheet" />
	<script src="<?php echo base_url('assets/js/pace.min.js'); ?>"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&family=Roboto&display=swap" />
	<!-- Icons CSS -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/icons.css'); ?>" />
	<!-- App CSS -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>" />
	<style>
        .error_msg {
            color: red;
            font-size: 12px;
        }
    </style>
</head>

<body class="bg-login">
	<!-- wrapper -->
	<div class="wrapper">
		<div class="section-authentication-login d-flex align-items-center justify-content-center mt-4">
			<div class="row">
				<div class="col-12 col-lg-6 mx-auto">
					<div class="card radius-15 overflow-hidden">
						<div class="row g-0">
							<div class="col-xl-12">
								<div class="card-body p-5">
									<div class="text-center">
										<!-- <img src="<?php echo base_url('assets/images/logo-icon.png'); ?>" width="80" alt=""> -->
										<h3 class="mt-4 font-weight-bold">Welcome </h3>
										<h6 class="mt-4 font-weight-bold" style="margin-bottom: 35px;">Create your account</h6>
									</div>
									<div class="">
									<?php if(session()->getFlashdata('msg')): ?>
										<p class="error_msg" style="text-align: center;"><?php echo session()->getFlashdata('msg') ?></p>
									<?php endif;?>
									</div>
										<div class="form-body">
											<form class="row g-3" action="<?php echo base_url('user_registration_form'); ?>" method="post" enctype="multipart/form-data">
												<div class="col-12">
													<div class="input-group"> 
														<span class="input-group-text bg-transparent"><i class="bx bxs-user"></i></span>
												        <input type="text" class="form-control border-start-0" id="username" name="username" placeholder="Username">
											        </div>
													<p class="error_msg" id="username_error"></p>
												</div>
												<div class="col-12">
													<div class="input-group"> 
														<span class="input-group-text bg-transparent"><i class=""></i></span>
													    <input type="password" class="form-control border-start-0" id="password" name="password" placeholder="Password">
												    </div>
													<p class="error_msg" id="password_error"></p>
												</div>
												
												<div class="col-12">
													<div class="input-group"> 
														<span class="input-group-text bg-transparent"><i class=""></i></span>
													    <input type="text" class="form-control border-start-0" id="phone_number" name="phone_number" placeholder="Phone Number">
												    </div>
													<p class="error_msg" id="phone_number_error"></p>
												</div>

												<div class="col-12">
													<div class="input-group"> 
														<div class="form-check col"> 
															<input class="form-check-input" type="radio" name="gender" id="gender" value="male">
															<label class="form-check-label" for="gender">
																Male
															</label>
														<div>
														<div class="form-check col">
															<input class="form-check-input" type="radio" name="gender" id="gender" value="female">
															<label class="form-check-label" for="gender">
																Female
															</label>
														
														</div>
														</div>
													<p class="error_msg" id="address_error"></p>
												</div>

												<div class="col-12">
													<div class="input-group"> 
														<span class="input-group-text bg-transparent"><i class=""></i></span>
													    <input type="text" class="form-control border-start-0" id="address" name="address" placeholder="address">
												    </div>
													<p class="error_msg" id="address_error"></p>
												</div>
												<div class="col-12">
													<div class="input-group"> 
														<span class="input-group-text bg-transparent"><i class=""></i></span>
													    <input type="file" class="form-control border-start-0" id="file" name="file" >
												    </div>
													<p class="error_msg" id="file_error"></p>
												</div>
												<div class="col-md-12 text-end">	<a href="<?php echo base_url(); ?>">Login</a>
												</div>
												<div class="col-12">
													<div class="d-grid">
														<button type="submit" class="btn btn-primary" ><i class="bx bxs-lock-open"></i>&nbsp;SignUp</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							 </div>
							<!-- <div class="col-xl-6 bg-login-color d-flex align-items-center justify-content-center">
								<img src="<?php echo base_url('assets/images/login-images/login-frent-img.jpg'); ?>" class="img-fluid" alt="...">
							</div> -->
						</div>
						<!--end row-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
</body>

<!--plugins-->
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/validation_function/validation.js'); ?>"></script>
<!--Password show & hide js -->

</html>