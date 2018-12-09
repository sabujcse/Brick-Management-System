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
				<form method="post" action="<?php echo base_url(); ?>advance_collections/<?php echo $action; ?>"
					  data-parsley-validate
					  novalidate>
                                       
                      <div class="form-group">                     
                         <label for="customer_id">Customer Name<span class="text-danger">*</span></label>                      
                        <select class="form-control select2" id="customer_id" name="customer_id" required> 
                          <option value="">-- Please Select --</option>
                            <?php
                            foreach ($customers as $customer) {
                            ?>
                            <option <?php if(isset($advance_collection_info) && $advance_collection_info[0]['customer_id'] == $customer['id']){ echo 'selected'; } ?> value="<?php echo $customer['id']; ?>">
                                <?php echo $customer['name']; ?>
                            </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                                          
					<div class="form-group">
						<label for="date">Date<span class="text-danger">*</span></label>
						<input type="text" name="date" data-parsley-trigger="change" required
							   value="<?php if (isset($advance_collection_info)) {
								   echo $advance_collection_info[0]['date'];
							   } ?>" placeholder="Enter Date" class="form-control" id="date">
					</div>
                                        <div class="form-group">
						<label for="amount">Amount<span class="text-danger">*</span></label>
						<input type="text" name="amount" data-parsley-trigger="change" required
							   value="<?php if (isset($advance_collection_info)) {
								   echo $advance_collection_info[0]['amount'];
							   } ?>" placeholder="Enter Amount" class="form-control" id="name">
					</div>
                                        <div class="form-group">
						<label for="quantity">Quantity<span class="text-danger">*</span></label>
						<input type="text" name="quantity" data-parsley-trigger="change" required
							   value="<?php if (isset($advance_collection_info)) {
								   echo $advance_collection_info[0]['quantity'];
							   } ?>" placeholder="Enter Quantity" class="form-control" id="name">
					</div>
                                        <div class="form-group">
						<label for="price_per_brick">Price Per Brick<span class="text-danger">*</span></label>
						<input type="text" name="price_per_brick" data-parsley-trigger="change" required
							   value="<?php if (isset($advance_collection_info)) {
								   echo $advance_collection_info[0]['price_per_brick'];
							   } ?>" placeholder="Enter Price Per Brick" class="form-control" id="name">
					</div>
                                       <div class="form-group">
						<label for="date">Tentavie Delivery Date<span class="text-danger">*</span></label>
                                                <input type="text" name="tentavie_delivery_date" data-parsley-trigger="change" required
							   value="<?php if (isset($advance_collection_info)) {
								   echo $advance_collection_info[0]['tentavie_delivery_date'];
							   } ?>" placeholder="Enter Tentavie Delivery Date" class="form-control" id="buy_date">
					</div>
                                     

	
					<div class="form-group text-right m-b-0">
						<?php
						if ($action == 'edit') {
							?>
							<input value="<?php echo $advance_collection_info[0]['id']; ?>" type="hidden" name="id">
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
  
