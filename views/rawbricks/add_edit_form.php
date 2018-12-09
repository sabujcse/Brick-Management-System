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
				<form method="post" action="<?php echo base_url(); ?>rawbricks/<?php echo $action; ?>"
					  data-parsley-validate
					  novalidate>

					  
					 <div class="form-group">
					     <div class="form-row">
					         
					         <div class="form-group col-md-6">
					             	<label for="name">Sardar Name<span class="text-danger">*</span></label>
            						<select class="form-control select2" data-parsley-trigger="change" required id="sardar_id" name="sardar_id">
            							<option value="">-- Please Select --</option>
            							<?php
            							foreach ($sardars as $sardar) {
            								?>
            								<option <?php if (isset($rawbricks_info) && $rawbricks_info[0]['sardar_id'] == $sardar['id']) {
            									echo 'selected';
            								} ?> value="<?php echo $sardar['id']; ?>">
            									<?php echo $sardar['name'].' ('. $sardar['sardar_id'] .')'; ?>
            								</option>
            								<?php
            							}
            							?>
            						</select>
					         </div>
					         
					          <div class="form-group col-md-6">
					               <label for="name">Machine/Line<span class="text-danger">*</span></label>
            						<select class="form-control select2" data-parsley-trigger="change" required id="machine_id" name="machine_id">
            							<option value="">-- Please Select --</option>
            					    	<?php
                                        foreach ($machine_list as $machine) {
                                        ?>
                                        <option <?php if(isset($rawbricks_info) && $rawbricks_info[0]['machine_id'] == $machine['id']){ echo 'selected'; } ?> value="<?php echo $machine['id']; ?>">
                                            <?php echo $machine['name']; ?>
                                        </option>
                                        <?php
                                        }
                                        ?>
            						</select>
					         </div>
					         
					     </div>					
					</div>
					

					<div class="form-group">					   
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="quantity">Quantity<span class="text-danger">*</span></label>
								<input type="text" onkeyup="get_paidable_amount()" name="quantity" data-parsley-trigger="change" required
									   value="<?php
									   if (isset($rawbricks_info)) {
										   echo $rawbricks_info[0]['quantity'];
									   }
									   ?>" placeholder="Quantity" class="form-control" id="quantity">
							</div>
	
							<div class="form-group col-md-4">	
                                  <label for="unit_id">Unit<span class="text-danger">*</span></label>							
								  <select class="form-control select2" id="unit_id" data-parsley-trigger="change" required name="unit_id">
									<option value="">-- Please Select --</option>
									<?php
									foreach ($units as $unit) {
										?>
										<option <?php if (isset($rawbricks_info) && $rawbricks_info[0]['unit_id'] == $unit['id']) {
											echo 'selected';
										} ?> value="<?php echo $unit['id']; ?>">
											<?php echo $unit['name']; ?>
										</option>
										<?php
									}
									?>
								</select>
							</div>
							
							<div class="form-group col-md-4">
								<label for="deducted_quantity">5% Deducted Quantity<span class="text-danger">*</span></label>
								<input type="text" name="deducted_quantity" data-parsley-trigger="change" required
									   value="<?php
            							   if (isset($rawbricks_info)) {
            								   echo $rawbricks_info[0]['deducted_quantity'];
            							   }
            							   ?>" placeholder="Deducted Quantity" readonly class="form-control" id="deducted_quantity">&nbsp;
							</div>
							
					    </div>
					</div>
					
					
					<div class="form-group">					   
						<div class="form-row">
							<div class="form-group col-md-6">
									<label for="price_per_unit">Price Per Unit<span class="text-danger">*</span></label>
            						<input type="text" onkeyup="get_paidable_amount()" name="price_per_unit" required
            							   value="<?php
            							   if (isset($rawbricks_info)) {
            								   echo $rawbricks_info[0]['price_per_unit'];
            							   }
            							   ?>" placeholder="Price Per Unit" class="form-control" id="price_per_unit">
							</div>
							<div class="form-group col-md-6">	
                                  	<label for="paidable_amount">Paidable Amount<span class="text-danger">*</span></label>
            						<input type="text" readonly name="paidable_amount" required
            							   value="<?php
            							   if (isset($rawbricks_info)) {
            								   echo $rawbricks_info[0]['paidable_amount'];
            							   }
            							   ?>" placeholder="Paidable Amount" class="form-control" id="paidable_amount">
							</div>
					    </div>
					</div>

                 
				
					<div class="form-group">				
						<label for="date">Date<span class="text-danger">*</span></label>
						<input type="text" name="date" required
							   value="<?php
							   if (isset($rawbricks_info)) {
								   echo $rawbricks_info[0]['date'];
							   }
							   ?>" placeholder="Date" class="form-control" id="date">
					</div>
					
					<div class="form-group">
                        <label for="remarks">Remarks</label>                
                        <textarea name="remarks" id="remarks" class="form-control"><?php
                            if (isset($rawbricks_info)) {
                                echo $rawbricks_info[0]['remarks'];
                            }
                            ?></textarea>  
                    </div>


					<div class="form-group text-right m-b-0">
						<?php
						if ($action == 'edit') {
							?>
							<input value="<?php echo $rawbricks_info[0]['id']; ?>" type="hidden" name="id">
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

<script>
    function get_paidable_amount(){
        var price_per_unit = Number(document.getElementById("price_per_unit").value);
        var deducted_quantity_percentage = Number(5);
        var quantity = Number(document.getElementById("quantity").value);
        if(quantity > 0){
            var deducted_quantity = (quantity * deducted_quantity_percentage) / 100;
            document.getElementById("deducted_quantity").value = deducted_quantity;
            quantity = (quantity - deducted_quantity);
            var paidable_amount = quantity * price_per_unit;
            document.getElementById("paidable_amount").value = paidable_amount;
        }
    }
</script>



