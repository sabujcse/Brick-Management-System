<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<title>Login to <?php echo $company_name; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>media/login/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>media/login/css/my-login.css">
</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="<?php echo base_url(); ?>media/login/img/logo.jpg">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Login</h4>
							
							 <?php
								$message = $this->session->userdata('message');
								if ($message != '') {
									?>
									<div class="alert alert-info">									       
												<?php 
												echo $message;
												$this->session->unset_userdata('message');
												?>	
									</div>     												
									<?php
							    }
							 ?>
					   
							   <?php
										$exception = $this->session->userdata('exception');
										if ($exception != '') {
											?>
											<div class="alert alert-danger">													
														<?php 
														echo $exception;
														$this->session->unset_userdata('exception');
														?>												
											</div>                      
											<?php
								   }
							   ?>

							<form method="post" action="<?php echo base_url(); ?>login/authentication">
							 
								<div class="form-group">
									<label for="email">Username</label>

									<input id="user_name" type="text" class="form-control" name="user_name" value="" required autofocus>
								</div>
								

								<div class="form-group">
									<label for="password">Password
										<a href="<?php echo base_url(); ?>login/forgot_password" class="float-right">
											Forgot Password?
										</a>
									</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
								</div>

								<div class="form-group">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>

								<div class="form-group no-margin">
									<button type="submit" class="btn btn-primary btn-block">
										Login
									</button>
								</div>								
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; SAN Bricks 2018
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src="<?php echo base_url(); ?>media/login/js/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>media/login/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>media/login/js/my-login.js"></script>
</body>
</html>