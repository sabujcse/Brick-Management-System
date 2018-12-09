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
                                                <th scope="col">Customer Name</th>
						<th scope="col">Fathers Name</th>
						<th scope="col">Mothers Name</th>
                                                <th scope="col">NID Number</th>
                                                <th scope="col">Mobile Number</th>
						<th scope="col">Address</th>
                                                <th scope="col">Delivery Address</th>
                                                <th scope="col">Action</th>
						
					</tr>
					</thead>
					<tbody>
					<?php
					$i = 0;
					foreach ($customers as $row):
						$i++;
						?>
						<tr>
							<th scope="row"><?php echo $i; ?></th>
							
                                                        <td><?php echo $row['name']; ?></td>
							<td><?php echo $row['fathers_name']; ?></td>
                                                        <td><?php echo $row['mothers_name']; ?></td>
							<td><?php echo $row['nid_number']; ?></td>
                                                        <td><?php echo $row['mobile_number']; ?></td>
							<td><?php echo $row['address']; ?></td>
                                                        <td><?php echo $row['delivery_address']; ?></td>
							
							<td>
								<a href="<?php echo base_url(); ?>customers/edit/<?php echo $row['id']; ?>">
									<i class="fa fa-pencil-square-o bigfonts" aria-hidden="true"></i>&nbsp;
								</a>
								<a onclick="return deleteConfirm()"
								   href="<?php echo base_url(); ?>customers/delete/<?php echo $row['id']; ?>">
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




