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
                                                <th scope="col">Subject Code</th>
						<th scope="col">Subject Name</th>		
                                                <th scope="col">Action</th>
						
					</tr>
					</thead>
					<tbody>
					<?php
					$i = 0;
					foreach ($subjects as $row):
						$i++;
						?>
						<tr>
							<th scope="row"><?php echo $i; ?></th>
							
                                                        <td><?php echo $row['subject_code']; ?></td>
							<td><?php echo $row['subject_name']; ?></td>
                                                        
							
							<td>
								<a href="<?php echo base_url(); ?>subjects/edit/<?php echo $row['id']; ?>">
									<i class="fa fa-pencil-square-o bigfonts" aria-hidden="true"></i>&nbsp;
								</a>
								<a onclick="return deleteConfirm()"
								   href="<?php echo base_url(); ?>subjects/delete/<?php echo $row['id']; ?>">
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




