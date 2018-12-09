<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div class="card mb-3">
			<div class="card-header">
				<h3><i class="fa fa-table"></i> <?php echo $second_title; ?></h3>
			</div>
			<div class="card-body">
				<table class="table table-responsive-xl table-striped">
					<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Product</th>
						<th scope="col">Vendor</th>
						<th scope="col">Quantity</th>
						<th scope="col">Price Per Unit</th>
						<th scope="col">Total Price</th>
						<th scope="col">Due</th>
						<th scope="col">Action</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$i = 0;
					foreach ($purchases as $row):
						$i++;
						?>
						<tr>
							<th scope="row"><?php echo $i; ?></th>

							<td><?php echo $row['product_name']; ?></td>
							<td><?php echo $row['vendor_name'].' ('.$row['vendor_code'].')'; ?></td>
							<td><?php echo $row['quantity'].' '.$row['unit_name']; ?></td>
							<td><?php echo $row['price_per_unit'].'/'.$row['unit_name']; ?></td>
							<td><?php echo $row['total_price']; ?></td>
							<td><?php echo $row['due_amount']; ?></td>
							<td>								
								<a onclick="return deleteConfirm()"
								   href="<?php echo base_url(); ?>purchases/delete/<?php echo $row['id']; ?>">
									<i class="fa fa-times-rectangle-o bigfonts" aria-hidden="true"></i>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<ul class="pagination pull-right">
					<?php echo $this->pagination->create_links(); ?>
				</ul>
			</div>
		</div><!-- end card-->
	</div>
</div>


