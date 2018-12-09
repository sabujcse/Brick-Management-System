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
						<th scope="col">Voucher No.</th>
						<th scope="col">Total Amount</th>
						<th scope="col">Date</th>
						<th scope="col">Is Auto?</th>
						<th scope="col">Action</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$i = 0;
					foreach ($expenses as $row):
						$i++;
						?>
						<tr>
							<th scope="row"><?php echo $i; ?></th>
							<td><?php echo $row['expense_voucher_id']; ?></td>
							<td><?php echo $row['expense_total_amount']; ?></td>
							<td><?php echo $row['date']; ?></td>
							<td><?php echo ($row['is_auto_created_expense'] == 1)?'Yes':'No';?></td>
							<td>
								<a href="<?php echo base_url(); ?>expenses/view_details/<?php echo $row['id']; ?>">
									<i class="fa fa-eye bigfonts" aria-hidden="true"></i>&nbsp;
								</a>
								<a onclick="return deleteConfirm()"
								   href="<?php echo base_url(); ?>expenses/delete/<?php echo $row['id']; ?>">
									<i class="fa fa-times-rectangle-o bigfonts" aria-hidden="true"></i>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div><!-- end card-->
	</div>
</div>
