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
				<form method="post" action="<?php echo base_url(); ?>purchases/<?php echo $action; ?>"
					  data-parsley-validate
					  novalidate>

					  
					  <div class="form-group">					
						<label for="name">Product Type<span class="text-danger">*</span></label>
						<select class="form-control select2" data-parsley-trigger="change" required id="product_type_id" name="product_type_id">
							<option value="">-- Please Select --</option>
							<?php
							foreach ($products as $type) {
								?>
								<option <?php if (isset($purchase_info) && $purchase_info[0]['product_type_id'] == $type['id']) {
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
						<label for="name">Vendor<span class="text-danger">*</span></label>
						<select class="form-control select2" id="vendor_id" data-parsley-trigger="change" required name="vendor_id">
						    <option value="">-- Please Select --</option>
							<?php
							foreach ($vendors as $vendor) {
								?>
								<option <?php if (isset($purchase_info) && $purchase_info[0]['vendor_id'] == $vendor['id']) {
									echo 'selected';
								} ?> value="<?php echo $vendor['id']; ?>">
									<?php echo $vendor['name'].' ('.$vendor['vendor_id'].')'; ?>
								</option>
								<?php
							}
							?>
						</select>
					</div>


					<div class="form-group">					   
						<div class="form-row">
							<div class="form-group col-md-9">
								<label for="quantity">Quantity<span class="text-danger">*</span></label>
								<input type="text" onkeyup="getTotalPrice()" name="quantity" data-parsley-trigger="change" required
									   value="<?php
									   if (isset($purchase_info)) {
										   echo $purchase_info[0]['quantity'];
									   }
									   ?>" placeholder="Quantity" class="form-control" id="quantity">
							</div>
							<div class="form-group col-md-3">	
                                  <label for="quantity_unit_id">Unit<span class="text-danger">*</span></label>							
								  <select class="form-control select2" id="quantity_unit_id" data-parsley-trigger="change" required name="quantity_unit_id">
									<option value="">-- Please Select --</option>
									<?php
									foreach ($units as $unit) {
										?>
										<option <?php if (isset($purchase_info) && $purchase_info[0]['quantity_unit_id'] == $unit['id']) {
											echo 'selected';
										} ?> value="<?php echo $unit['id']; ?>">
											<?php echo $unit['name']; ?>
										</option>
										<?php
									}
									?>
								</select>
							</div>
					    </div>
					</div>

					<div class="form-group">				
						<label for="price_per_unit">Price Per Unit<span class="text-danger">*</span></label>
						<input type="text" onkeyup="getTotalPrice()" name="price_per_unit" data-parsley-trigger="change" required
							   value="<?php
							   if (isset($purchase_info)) {
								   echo $purchase_info[0]['price_per_unit'];
							   }
							   ?>" placeholder="Price Per Unit" class="form-control" id="price_per_unit">
					</div>
					
					<div class="form-group">				
						<label for="total_price">Total Price<span class="text-danger">*</span></label>
						<input type="text" readonly name="total_price" data-parsley-trigger="change" required
							   value="<?php
							   if (isset($purchase_info)) {
								   echo $purchase_info[0]['total_price'];
							   }
							   ?>" placeholder="Total Price" class="form-control" id="total_price">
					</div>
					
					
					<div class="form-group">				
						<label for="paid_amount">Paid Amount<span class="text-danger">*</span></label>
						<input type="text" onkeyup="getDueAmount()" name="paid_amount" data-parsley-trigger="change" required
							   value="<?php
							   if (isset($purchase_info)) {
								   echo $purchase_info[0]['paid_amount'];
							   }
							   ?>" placeholder="Paid Amount" class="form-control" id="paid_amount">
					</div>
					
					<div class="form-group">				
						<label for="due_amount">Due Amount<span class="text-danger">*</span></label>
						<input type="text" readonly name="due_amount" data-parsley-trigger="change" required
							   value="<?php
							   if (isset($purchase_info)) {
								   echo $purchase_info[0]['due_amount'];
							   }
							   ?>" placeholder="Due Amount" class="form-control" id="due_amount">
					</div>
					
					<div class="form-group">				
						<label for="buy_date">Date<span class="text-danger">*</span></label>
						<input type="text" name="buy_date" required
							   value="<?php
							   if (isset($purchase_info)) {
								   echo $purchase_info[0]['buy_date'];
							   }
							   ?>" placeholder="Date" class="form-control" id="buy_date">
					</div>
					
					<div class="form-group">
                        <label for="description">Description</label>                
                        <textarea name="description" id="description" class="form-control"><?php
                            if (isset($purchase_info)) {
                                echo $purchase_info[0]['description'];
                            }
                            ?></textarea>  
                    </div>


					<div class="form-group text-right m-b-0">
						<?php
						if ($action == 'edit') {
							?>
							<input value="<?php echo $purchase_info[0]['id']; ?>" type="hidden" name="id">
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
   function getTotalPrice(){
	   var quantity = Number($('#quantity').val());
	   var price_per_unit = Number($('#price_per_unit').val());
	   $('#total_price').val((quantity * price_per_unit));
	   getDueAmount();
   }
   
   function getDueAmount(){
	   var total_price = Number($('#total_price').val());
	   var paid_amount = Number($('#paid_amount').val());
	   $('#due_amount').val((total_price - paid_amount));
   }
</script>





