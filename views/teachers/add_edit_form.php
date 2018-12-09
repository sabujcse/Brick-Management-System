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
				<form method="post" action="<?php echo base_url(); ?>teachers/<?php echo $action; ?>"
					  data-parsley-validate
					  novalidate>
                                       
                      <div class="form-group">                     
                         <label for="subject_id">Subject Name<span class="text-danger">*</span></label>                      
                        <select class="form-control select2" id="customer_id" name="subject_id" required> 
                          <option value="">-- Please Select --</option>
                            <?php
                            foreach ($subjects as $subject) {
                            ?>
                            <option <?php if(isset($teacher_info) && $teacher_info[0]['subject_id'] == $subject['id']){ echo 'selected'; } ?> value="<?php echo $subject['id']; ?>">
                                <?php echo $subject['subject_name']; ?>
                            </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                                          
					<div class="form-group">
						<label for="teacher_name">Teacher Name<span class="text-danger">*</span></label>
						<input type="text" name="teacher_name" data-parsley-trigger="change" required
							   value="<?php if (isset($teacher_info)) {
								   echo $teacher_info[0]['teacher_name'];
							   } ?>" placeholder="Enter Teacher" class="form-control" id="teacher_name">
					</div>
                                        <div class="form-group">
						<label for="section">Section<span class="text-danger">*</span></label>
						<input type="text" name="section" data-parsley-trigger="change" required
							   value="<?php if (isset($teacher_info)) {
								   echo $teacher_info[0]['section'];
							   } ?>" placeholder="Enter Section" class="form-control" id="section">
					</div>
                                        
					<div class="form-group text-right m-b-0">
						<?php
						if ($action == 'edit') {
							?>
							<input value="<?php echo $teacher_info[0]['id']; ?>" type="hidden" name="id">
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
  

