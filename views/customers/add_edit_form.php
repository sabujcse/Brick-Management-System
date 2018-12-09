<link href="<?php echo base_url(); ?>media/assets/css/custom.css" rel="stylesheet" type="text/css"/>
<script>
	$('#form').parsley();
</script>
<!-- END CSS for this page -->
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div class="card mb-3">
			<div class="card-header">
				<h3><i class="fa fa-hand-pointer-o"></i> <?php echo $second_title; ?></h3>
			</div>

			<div class="card-body">
				<form method="post" action="<?php echo base_url(); ?>customers/<?php echo $action; ?>"
					  data-parsley-validate
					  novalidate>
					<div class="form-group">
						<label for="name">Name<span class="text-danger">*</span></label>
						<input type="text" name="name" data-parsley-trigger="change" required
							   value="<?php if (isset($customer_info)) {
								   echo $customer_info[0]['name'];
							   } ?>" placeholder="Enter Customer name" class="form-control" id="name">
					</div>
                                        <div class="form-group">
						<label for="fathers_name">Fathers Name<span class="text-danger">*</span></label>
						<input type="text" name="fathers_name" data-parsley-trigger="change" required
							   value="<?php if (isset($customer_info)) {
								   echo $customer_info[0]['fathers_name'];
							   } ?>" placeholder="Enter Father name" class="form-control" id="fathers_name">
					</div>
                                        <div class="form-group">
						<label for="mothers_name">Mothers Name<span class="text-danger">*</span></label>
						<input type="text" name="mothers_name" data-parsley-trigger="change" required
							   value="<?php if (isset($customer_info)) {
								   echo $customer_info[0]['mothers_name'];
							   } ?>" placeholder="Enter Mother name" class="form-control" id="mothers_name">
					</div>
                                         <div class="form-group">
						<label for="nid_number">NID Number<span class="text-danger">*</span></label>
						<input type="text" name="nid_number" data-parsley-trigger="change" required
							   value="<?php if (isset($customer_info)) {
								   echo $customer_info[0]['nid_number'];
							   } ?>" placeholder="Enter NID  Number" class="form-control" id="nid_number">
					</div>
                                         <div class="form-group">
						<label for="mobile_number">Mobile Number<span class="text-danger">*</span></label>
						<input type="text" name="mobile_number" data-parsley-trigger="change" required
							   value="<?php if (isset($customer_info)) {
								   echo $customer_info[0]['mobile_number'];
							   } ?>" placeholder="Enter Mobile  Number" class="form-control" id="mobile_number">
					</div>
                                         <div class="form-group">
						<label for="address">Address<span class="text-danger">*</span></label>
						<input type="text" name="address" data-parsley-trigger="change" required
							   value="<?php if (isset($customer_info)) {
								   echo $customer_info[0]['address'];
							   } ?>" placeholder="Enter Address" class="form-control" id="address">
					</div>
                                        <div class="form-group">
						<label for="delivery_address">Delivery Address<span class="text-danger">*</span></label>
						<input type="text" name="delivery_address" data-parsley-trigger="change" required
							   value="<?php if (isset($customer_info)) {
								   echo $customer_info[0]['delivery_address'];
							   } ?>" placeholder="Enter Delivery Address" class="form-control" id="delivery_address">
					</div>

					

					<div class="form-group text-right m-b-0">
						<?php
						if ($action == 'edit') {
							?>
							<input value="<?php echo $customer_info[0]['id']; ?>" type="hidden" name="id">
						<?php } ?>
						<button class="btn btn-primary" type="submit">
							Submit
						</button>
						<button type="reset" class="btn btn-secondary m-l-5">
							Cancel
						</button>
					</div>
				</form>
			</div>
		</div><!-- end card-->
	</div>
</div>
