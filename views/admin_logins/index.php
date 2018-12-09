<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php echo $title; ?></title>
	<meta name="description" content="SAN Bricks">
	<meta name="author" content="SAN Bricks - https://www.inventiontec.com">

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo base_url(); ?>media/assets/images/favicon.ico">

	<!-- Bootstrap CSS -->
	<link href="<?php echo base_url(); ?>media/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

	<!-- Font Awesome CSS -->
	<link href="<?php echo base_url(); ?>media/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet"
		  type="text/css"/>

	<!-- Custom CSS -->
	<link href="<?php echo base_url(); ?>media/assets/css/style.css" rel="stylesheet" type="text/css"/>

	<!-- BEGIN CSS for select2 -->
	<link href="<?php echo base_url(); ?>media/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
	<!-- END CSS for select2 -->
   <link href="<?php echo base_url(); ?>media/assets/plugins/datetimepicker/css/daterangepicker.css" rel="stylesheet" /> 
</head>

<body class="adminbody">
<?php
$session_user = $this->session->userdata('user_info');
?>
<div id="main">
	<!-- top bar navigation -->
	<div class="headerbar">

		<!-- LOGO -->
		<div class="headerbar-left">
			<a href="<?php echo base_url(); ?>dashboard/index" class="logo">
				<img alt="Logo" src="<?php echo base_url(); ?>media/assets/images/logo.png"/>
			</a>
		</div>

		<nav class="navbar-custom">

			<ul class="list-inline float-right mb-0">

				<li class="list-inline-item dropdown notif">
					<a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button"
					   aria-haspopup="false" aria-expanded="false">
						<i class="fa fa-fw fa-bell-o"></i><span class="notif-bullet"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg">
						<!-- item-->
						<div class="dropdown-item noti-title">
							<h5>
								<small><span class="label label-danger pull-xs-right">5</span>Allerts</small>
							</h5>
						</div>

						<!-- item-->
						<a href="#" class="dropdown-item notify-item">
							<div class="notify-icon bg-faded">
								<img src="<?php echo base_url(); ?>media/assets/images/avatars/avatar2.png" alt="img"
									 class="rounded-circle img-fluid">
							</div>
							<p class="notify-details">
								<b>John Doe</b>
								<span>User registration</span>
								<small class="text-muted">3 minutes ago</small>
							</p>
						</a>

						<!-- item-->
						<a href="#" class="dropdown-item notify-item">
							<div class="notify-icon bg-faded">
								<img src="<?php echo base_url(); ?>media/assets/images/avatars/avatar3.png" alt="img"
									 class="rounded-circle img-fluid">
							</div>
							<p class="notify-details">
								<b>Michael Cox</b>
								<span>Task 2 completed</span>
								<small class="text-muted">12 minutes ago</small>
							</p>
						</a>

						<!-- item-->
						<a href="#" class="dropdown-item notify-item">
							<div class="notify-icon bg-faded">
								<img src="<?php echo base_url(); ?>media/assets/images/avatars/avatar4.png" alt="img"
									 class="rounded-circle img-fluid">
							</div>
							<p class="notify-details">
								<b>Michelle Dolores</b>
								<span>New job completed</span>
								<small class="text-muted">35 minutes ago</small>
							</p>
						</a>

						<!-- All-->
						<a href="#" class="dropdown-item notify-item notify-all">
							View All Allerts
						</a>

					</div>
				</li>

				<li class="list-inline-item dropdown notif">
					<a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button"
					   aria-haspopup="false" aria-expanded="false">
						<img src="<?php echo base_url(); ?>media/assets/images/avatars/admin.png" alt="Profile image"
							 class="avatar-rounded">
					</a>
					<div class="dropdown-menu dropdown-menu-right profile-dropdown ">
						<!-- item-->
						<div class="dropdown-item noti-title">
							<h5 class="text-overflow">
								<small>Hello, <?php echo $session_user[0]->name; ?></small>
							</h5>
						</div>

						<!-- item-->
						<a href="#" class="dropdown-item notify-item">
							<i class="fa fa-user"></i> <span>Profile</span>
						</a>

						<!-- item-->
						<a href="<?php echo base_url(); ?>login/change_password/<?php echo $session_user[0]->id; ?>"
						   class="dropdown-item notify-item">
							<i class="fa fa-external-link"></i> <span>Change Password</span>
						</a>

						<!-- item-->
						<a href="<?php echo base_url(); ?>login/logout" class="dropdown-item notify-item">
							<i class="fa fa-power-off"></i> <span>Logout</span>
						</a>
					</div>
				</li>

			</ul>

			<ul class="list-inline menu-left mb-0">
				<li class="float-left">
					<button class="button-menu-mobile open-left">
						<i class="fa fa-fw fa-bars"></i>
					</button>
				</li>
			</ul>

		</nav>

	</div>
	<!-- End Navigation -->


	<!-- Left Sidebar -->
	<div class="left main-sidebar">
		<div class="sidebar-inner leftscroll">

			<div id="sidebar-menu">

				<?php echo $main_menu; ?>

				<div class="clearfix"></div>

			</div>

			<div class="clearfix"></div>

		</div>

	</div>
	<!-- End Sidebar -->


	<div class="content-page">

		<!-- Start content -->
		<div class="content">
			<div class="container-fluid">
				<!-- body top row -->
				<div class="row">
					<div class="col-xl-12">
						<div class="breadcrumb-holder">
							<h1 class="main-title float-left"><?php echo $heading_messgae; ?></h1>
							<ol class="breadcrumb float-right">
								<li class="breadcrumb-item"><?php echo strtoupper($title); ?></li>
								<li class="breadcrumb-item active"><?php echo strtoupper($second_title); ?></li>
							</ol>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
				<!-- end body top row -->

				<?php
				$message = $this->session->userdata('message');
				if ($message != '') {
					?>
					<div class="alert alert-success" role="alert">
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
					<div class="alert alert-danger" role="alert">
						<?php
						echo $exception;
						$this->session->unset_userdata('exception');
						?>
					</div>
					<?php
				}
				?>


				<?php if ($this->is_add_back_btn_show == 1) { ?>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<div class="card-header">
								<a role="button" href="<?php echo base_url() . $this->uri->segment(1); ?>/add"
								   class="btn btn-primary">
								<span class="btn-label">
									<i class="fa fa-check"></i>
								</span>Add New
								</a>
							</div>
						</div>
					</div>
				<?php } ?>

				<?php if ($this->is_add_back_btn_show == 2) { ?>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<div class="card-header">
								<a role="button" href="<?php echo base_url() . $this->uri->segment(1); ?>/index"
								   class="btn btn-primary">
								<span class="btn-label">
									<i class="fa fa-arrow-left"></i>
								</span>Back To List
								</a>
							</div>
						</div>
					</div>
				<?php } ?>

				<?php echo $maincontent; ?>

			</div>
			<!-- END container-fluid -->

		</div>
		<!-- END content -->

	</div>
	<!-- END content-page -->

	<footer class="footer">
		<span class="text-right">
		Copyright &copy;<a target="_blank" href="#">SAN Bricks</a>
		</span>
		<span class="float-right">
		Powered by <a target="_blank" href="https://www.inventiontec.com"><b>InventionTec</b></a>
		</span>
	</footer>

</div>
<!-- END main -->

<script src="<?php echo base_url(); ?>media/assets/js/modernizr.min.js"></script>
<script src="<?php echo base_url(); ?>media/assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>media/assets/js/moment.min.js"></script>

<script src="<?php echo base_url(); ?>media/assets/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>media/assets/js/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>media/assets/js/detect.js"></script>
<script src="<?php echo base_url(); ?>media/assets/js/fastclick.js"></script>
<script src="<?php echo base_url(); ?>media/assets/js/jquery.blockUI.js"></script>
<script src="<?php echo base_url(); ?>media/assets/js/jquery.nicescroll.js"></script>

<!-- App js -->
<script src="<?php echo base_url(); ?>media/assets/js/pikeadmin.js"></script>
<!-- BEGIN Java Script for this page -->
<script src="<?php echo base_url(); ?>media/assets/plugins/parsleyjs/parsley.min.js"></script>

<!-- END Java Script for this page -->
<script src="<?php echo base_url(); ?>media/assets/js/custom.js"></script>

<script src="<?php echo base_url(); ?>media/assets/plugins/datetimepicker/js/daterangepicker.js"></script>


<!-- BEGIN Java Script for select2 -->
<script src="<?php echo base_url(); ?>media/assets/plugins/select2/js/select2.min.js"></script>
<!-- END Java Script for select2 -->
<!-- BEGIN Java Script for this page -->
<script>
	$(document).ready(function () {
		$('.select2').select2();
	});
</script>
<!-- END Java Script for this page -->
<script>
	$(function() {
		debugger;
		$('#buy_date,#date').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
			locale: {
             format: 'YYYY-MM-DD'
            }
		});
	});

	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	}
	else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

			var obj = JSON.parse(xmlhttp.responseText);
			var option_html = "";
			option_html += '<option value="">-- Select --</option>'
			var i = 0;
			while (i < obj.length) {
				option_html += '<option value="' + obj[i].id + '">' + obj[i].name + '</option>'
				i++;
			}
			document.getElementById("expense_category_json_data").value = option_html;

			//get deposit_method data
			xmlhttp.onreadystatechange = function () {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					var obj2 = JSON.parse(xmlhttp.responseText);
					var option_html_2 = "";
					option_html_2 += '<option value="">-- Select --</option>'
					var i = 0;
					while (i < obj2.length) {
						option_html_2 += '<option value="' + obj2[i].id + '">' + obj2[i].name + '</option>'
						i++;
					}

					document.getElementById("deposit_method_json_data").value = option_html_2;
				}
			}
			xmlhttp.open("GET", "<?php echo base_url(); ?>expenses/get_deposit_method_for_list", true);
			xmlhttp.send();
			//end deposit_method data

		}
	}
	xmlhttp.open("GET", "<?php echo base_url(); ?>expenses/get_expense_category_for_list", true);
	xmlhttp.send();


	function delete_row(row_no) {
		var no = Number(row_no);
		document.getElementById("row_" + no + "").outerHTML = "";
		if (no != 1) {
			document.getElementById("delete_section_" + (no - 1)).innerHTML = "<input type='button' value='Delete' class='delete' onclick='delete_row(" + (no - 1) + ")'>";
		}
		document.getElementById('num_of_row').value = no;
	}

	function add_row() {
		var getUrl = window.location;
		var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
		///alert(baseUrl);

		var table = document.getElementById("my_data_table");
		var table_len = Number(document.getElementById('num_of_row').value);
		var row = table.insertRow(table_len).outerHTML = "<tr id='row_" + table_len + "'><td><select required class='smallInput'  id='expense_category_id_" + table_len + "' name='expense_category_id_" + table_len + "' ></select></td><td><input type='text' required class='smallInput'  name='expense_description_" + table_len + "'></td><td><select required class='smallInput'  id='deposit_method_id_" + table_len + "' name='deposit_method_id_" + table_len + "' ></select></td><td><input type='text' required class='smallInput'  name='amount_" + table_len + "'></td><td id='delete_section_" + table_len + "'><input type='button' value='Delete' class='delete' onclick='delete_row(" + table_len + ")'></td></tr>";
		if (table_len > 1) {
			document.getElementById("delete_section_" + (table_len - 1)).innerHTML = "";
		}

		var expense_category_json_data = document.getElementById("expense_category_json_data").value;
		document.getElementById('expense_category_id_' + table_len).innerHTML = expense_category_json_data;

		var deposit_method_json_data = document.getElementById("deposit_method_json_data").value;
		document.getElementById('deposit_method_id_' + table_len).innerHTML = deposit_method_json_data;

		document.getElementById('num_of_row').value = table_len + 1;
	}
</script>
</body>
</html>
