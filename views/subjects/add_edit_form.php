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
				<form method="post" action="<?php echo base_url(); ?>subjects/<?php echo $action; ?>"
					  data-parsley-validate
					  novalidate>
					<div class="form-group">
						<label for="subject_code">Subject Code<span class="text-danger">*</span></label>
						<input type="text" name="subject_code" data-parsley-trigger="change" required
							   value="<?php if (isset($subject_info)) {
								   echo $subject_info[0]['subject_code'];
							   } ?>" placeholder="Enter Subject Code" class="form-control" id="name">
					</div>
                                        <div class="form-group">
						<label for="subject_name">Fathers Name<span class="text-danger">*</span></label>
						<input type="text" name="subject_name" data-parsley-trigger="change" required
							   value="<?php if (isset($subject_info)) {
								   echo $subject_info[0]['subject_name'];
							   } ?>" placeholder="Enter Subject Name" class="form-control" id="fathers_name">
					</div>
                                        
					

					<div class="form-group text-right m-b-0">
						<?php
						if ($action == 'edit') {
							?>
							<input value="<?php echo $subject_info[0]['id']; ?>" type="hidden" name="id">
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

