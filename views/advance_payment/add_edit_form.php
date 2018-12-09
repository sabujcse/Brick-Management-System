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
				<form method="post" action="<?php echo base_url(); ?>advance_payments/<?php echo $action; ?>"
					  data-parsley-validate
					  novalidate>
					
                                    <div class="form-group">                     
                               <label for="sardar_id">Sardar Name<span class="text-danger">*</span></label>                      
                                 <select class="form-control select2" id="sardar_id" name="sardar_id" required> 
                               <option value="">-- Please Select --</option>
                               <?php
                               foreach ($sardars as $sardar) {
                               ?>
                              <option <?php if(isset($payment_info) && $payment_info[0]['sardar_id'] == $sardar['id']){ echo 'selected'; } ?> value="<?php echo $sardar['id']; ?>">
                                <?php echo $sardar['name'].' ('.$sardar['sardar_id'].')'; ?>
                                </option>
                               <?php
                               }
                                ?>
                                </select>
                             </div>
                                         
                                   
                                        <div class="form-group">
						<label for="date">Date<span class="text-danger">*</span></label>
						<input type="text" name="date" data-parsley-trigger="change" required
							   value="<?php if (isset($payment_info)) {
								   echo $payment_info[0]['date'];
							   } ?>" placeholder="Enter Date" class="form-control" id="date">
					</div>
                                        <div class="form-group">
						<label for="amount">Amount<span class="text-danger">*</span></label>
						<input type="text" name="amount" data-parsley-trigger="change" required
							   value="<?php if (isset($payment_info)) {
								   echo $payment_info[0]['amount'];
							   } ?>" placeholder="Enter Amount" class="form-control" id="amount">
					</div>
                                        

					<div class="form-group">
						<label>Remarks</label>
						<div>
							<textarea name="remarks" class="form-control"><?php if (isset($payment_info)) {
									echo $payment_info[0]['remarks'];
								} ?></textarea>
						</div>
					</div>

					<div class="form-group text-right m-b-0">
						<?php
						if ($action == 'edit') {
							?>
							<input value="<?php echo $payment_info[0]['id']; ?>" type="hidden" name="id">
							<input value="<?php echo $payment_info[0]['expense_voucher_id']; ?>" type="hidden" name="expense_voucher_id">
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
  


