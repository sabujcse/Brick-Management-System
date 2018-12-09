<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Forgot Password for School360°</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>/core_media/css/login_css/style.css">
  <link rel="icon" href="<?php echo base_url(); ?>/core_media/css/login_css/school360-favicon.png" type="image/png">

  <style>
  .isa_info, .isa_success, .isa_warning, .isa_error {  
    padding:12px;
   }
.isa_success {
    color: #4F8A10;
    background-color: #DFF2BF;
}
.isa_error {
    color: #D8000C;
    background-color: #FFBABA;
}
  </style>
</head>
<body>
  <section class="container">
    <div class="login">
        <h1> <?php echo $school_name; ?></h1>
      <form method="post" action="<?php echo base_url(); ?>login/forgot_password">
	     <p>
		 
		    <?php
                    $message = $this->session->userdata('message');
                    if ($message != '') {
                        ?>
						<div class="isa_success">
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
						<div class="isa_error">
						        <?php 
								echo $exception;
                                $this->session->unset_userdata('exception');
								?>
						</div>                      
                        <?php
		       }
		   ?>
		</p>
		
        <p>		
		<input type="text" name="user_name" value="" placeholder="Username" required="1" >
		</p>

        <p class="submit"><input type="submit" name="submit" value="Send Password"></p>
      </form>

        <table width="100%">
            <tr>
                <td style="vertical-align: middle; text-align: center; font-weight: bold;">
                    <br>
                    Forgot Password for <span style="color:#0059b3;">School</span><span style="color:#ff8080;">360°</span>
                </td>
            </tr>
        </table>
    </div>

    <div class="login-help">
      <p>Back to Login Page? <a href="<?php echo base_url(); ?>login/index">Click here to login page</a>.</p>
    </div>
  </section>

  <section class="about">  
      <img src="<?php echo base_url(); ?>/core_media/css/login_css/school360-logo.png">
	  <p class="about-author">
	  &copy; 2015&ndash;2017 <a href="https://crimsonstec.com/" target="_blank">CrimsonsTec</a>
	 </p>	  
  </section>
</body>
</html>
