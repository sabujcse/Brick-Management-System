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
				<form method="post" action="<?php echo base_url(); ?>vendors/<?php echo $action; ?>"
					  data-parsley-validate
					  novalidate>

					<div class="form-group">
						<label for="name">Name<span class="text-danger">*</span></label>
						<input type="text" name="name" data-parsley-trigger="change" required
							   value="<?php
							   if (isset($vendor_info)) {
								   echo $vendor_info[0]['name'];
							   }
							   ?>" placeholder="Vendor Name" class="form-control" id="name">
					</div>
					
					 <div class="form-group">
                        <label for="vendor_id">Vendor ID<span class="text-danger">*</span></label>
                        <input type="text" name="vendor_id" data-parsley-trigger="change" required
                               value="<?php
                               if (isset($vendor_info)) {
                                   echo $vendor_info[0]['vendor_id'];
                               }
                               ?>" placeholder="Vendor ID" class="form-control" id="vendor_id">
                    </div> 

					<div class="form-group">
						<label for="example1">
							<label for="name">Type<span class="text-danger">*</span></label>
						</label>
						<select class="form-control select2" id="vendor_type_id" name="vendor_type_id">
							<?php
							foreach ($vendor_types as $type) {
								?>
								<option <?php if (isset($vendor_info) && $vendor_info[0]['vendor_type_id'] == $type['id']) {
									echo 'selected';
								} ?> value="<?php echo $type['id']; ?>">
									<?php echo $type['name']; ?>
								</option>
								<?php
							}
							?>
						</select>
					</div>


					<div class="form-group">
						<label for="name">Mobile<span class="text-danger">*</span></label>
						<input type="text" name="mobile" data-parsley-trigger="change" required
							   value="<?php
							   if (isset($vendor_info)) {
								   echo $vendor_info[0]['mobile'];
							   }
							   ?>" placeholder="Sardar Modile Number" class="form-control" id="mobile">
					</div>

					<div class="form-group">
						<label for="name">Address<span class="text-danger">*</span></label>
						<textarea name="address" required id="address" class="form-control"><?php
							if (isset($vendor_info)) {
								echo $vendor_info[0]['address'];
							}
							?></textarea>
					</div>


					<div class="form-group text-right m-b-0">
						<?php
						if ($action == 'edit') {
							?>
							<input value="<?php echo $vendor_info[0]['id']; ?>" type="hidden" name="id">
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






