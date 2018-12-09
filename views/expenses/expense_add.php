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
				<form method="post" action="<?php echo base_url(); ?>expenses/<?php echo $action; ?>"
					  data-parsley-validate
					  novalidate>

					<div class="form-group">
						<label for="name">Date<span class="text-danger">*</span></label>
						<input type="text" name="date" data-parsley-trigger="change" required
							   value="" placeholder="Date" class="form-control" id="date">
					</div>

					<div class="form-group">
						<label for="name">Voucher Id<span class="text-danger">*</span></label>
						<input type="text" name="expense_voucher_id" data-parsley-trigger="change" required
							   value="" placeholder="Voucher Id" class="form-control" id="expense_voucher_id">
					</div>

					<div class="form-group">
						<label for="name">Total Amount<span class="text-danger">*</span></label>
						<input type="text" name="expense_total_amount" data-parsley-trigger="change" required
							   value="" placeholder="Total Amount" class="form-control" id="expense_total_amount">
					</div>

					<br>
					<table class="table table-responsive-xl table-striped">
						<tr>
							<th scope="col" colspan="5">
								Expense Details
							</th>
						</tr>
						<tr>
							<th scope="col">Expense Category</th>
							<th scope="col">Expense Description</th>
							<th scope="col">Deposit Method</th>
							<th scope="col">Amount</th>
							<th scope="col">Action</th>
						</tr>
					</table>

					<table class="table table-responsive-xl table-striped" id="my_data_table">
						<tr>
							<td scope="col">
								<select class="smallInput" name="expense_category_id_0" required="1">
									<option value="">-- Select --</option>
									<?php
									$i = 0;
									if (count($expense_category)) {
										foreach ($expense_category as $list) {
											$i++;
											?>
											<option
												value="<?php echo $list['id']; ?>"><?php echo $list['name']; ?></option>
											<?php
										}
									}
									?>
								</select>
							</td>
							<td><input type="text" class="smallInput" required id="expense_description_0"
									   name="expense_description_0">
							</td>
							<td>
								<select class="smallInput" name="deposit_method_id_0" required="1">
									<option value="">-- Select --</option>
									<?php
									$i = 0;
									if (count($deposit_method)) {
										foreach ($deposit_method as $list) {
											$i++;
											?>
											<option
												value="<?php echo $list['id']; ?>"><?php echo $list['name']; ?></option>
											<?php
										}
									}
									?>
								</select>
							</td>
							<td><input type="text" onkeyup="calculate_total_amount()" class="smallInput" required
									   name="amount_0"></td>
							<td><input type="button" class="add" onclick="add_row();" value="Add More"></td>
						</tr>
					</table>

					<input type="hidden" id="expense_category_json_data" value="">
					<input type="hidden" id="deposit_method_json_data" value="">
					<input type="hidden" id="num_of_row" name="num_of_row" value="1">

					<div class="form-group text-right m-b-0">
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






