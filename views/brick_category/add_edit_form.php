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
				<form method="post" action="<?php echo base_url(); ?>brick_categorys/<?php echo $action; ?>"
					  data-parsley-validate
					  novalidate>
					<div class="form-group">
						<label for="name">Name<span class="text-danger">*</span></label>
						<input type="text" name="name" data-parsley-trigger="change" required
							   value="<?php if (isset($category_info)) {
								   echo $category_info[0]['name'];
							   } ?>" placeholder="Enter category name" class="form-control" id="name">
					</div>

					<div class="form-group">
						<label>Remarks</label>
						<div>
							<textarea name="remarks" class="form-control"><?php if (isset($category_info)) {
									echo $category_info[0]['remarks'];
								} ?></textarea>
						</div>
					</div>

					<div class="form-group text-right m-b-0">
						<?php
						if ($action == 'edit') {
							?>
							<input value="<?php echo $category_info[0]['id']; ?>" type="hidden" name="id">
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
  
