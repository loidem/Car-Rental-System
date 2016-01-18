<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
<div id="page-wrapper">
<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Current Drop-Off</h1>
				<?php
					if(validation_errors() != false) {
						echo "
						<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<strong>" . validation_errors() . "</strong>
						</div>";
					}
				
				?>
			
		</div>		

	</div>		
	<?php
	
		$user_id = $this->session->userdata('user_id');
		$query = $this->db->query("select c.initials,c.lastname, c.phone,c.email_address,r.res_id,ca.carname,ca.CMODEL,ca.CYEAR,ca.COLOR,ca.LICENSE_PLATE_NO,ca.VEHICLE_TYPE,r.location,r.pickup,r.pickuptime,r.dropoff,r.dropofftime,r.amtdue from reservation as r, customer as c,car as ca where r.user_id=c.idno and r.vehicle_id=ca.vehicleid ORDER BY r.dropoff");

					
		if($query->num_rows() > 0) {
		foreach($query->result() as $row) {
				$reports[] = $row;
				//print_r($reports);
			}
			
		}else{
			echo "
			<div class='alert alert-danger alert-dismissable'>
				<strong> You have no returns</strong>
			</div>";
		}	
	?>
	
	<div class="row">
		<div class="col-lg-12">
			<br>
			<div class="table-responsive">
				<table class="table table-striped table-bordered  table-hover">
					<thead>
						<th>Res ID</th>
						<th>Name</th>
						<th>Phone</th>
						<th>Email Address</th>
						<th>Car Name</th>
						<th>Car Model</th>
						<th>Car Year</th>
						<th>Car Color</th>
						<th>License Plate NO</th>
						<th>Location</th>
						<th>Pickup</th>
						<th>Drop Off</th>
						<th>Amount Due</th>
					</thead>
					
					<tbody>
						<?php foreach($reports as $row){ ?>
						<tr >						
							<td >
								<?php echo $row->res_id; ?>
							</td>
							<td >
								<?php echo $row->initials; ?>
								.
								<?php echo $row->lastname; ?>
							</td>
							<td >
								<?php echo $row->phone; ?>
							</td>
							<td >
								<?php echo $row->email_address; ?>
							</td>
							<td >
								<?php echo $row->carname; ?>
							</td>
							<td >
								<?php echo $row->CMODEL; ?>
							</td>
							<td >
								<?php echo $row->CYEAR; ?>
							</td>
							<td >
								<?php echo $row->COLOR; ?>
							</td>
							<td >
								<?php echo $row->LICENSE_PLATE_NO; ?>
							</td>
							<td >
								<?php echo $row->VEHICLE_TYPE; ?>
							</td>
							<td >
								<?php echo $row->pickup; ?>
								<?php echo $row->pickuptime; ?>
							</td>
							<td >
								<?php echo $row->dropoff; ?>
								<?php echo $row->dropofftime; ?>
							</td>
							<td >
								<?php echo $row->amtdue; ?>
							</td>
							<td >
								<button class="btn btn-danger" data-toggle="modal" data-target=<?php echo '".md-delete' . $row->res_id . '"'; ?>><i class="fa fa-trash-o"></i> </button>
							</td>
						</tr>
							
					</tbody>
					
					
					<div class=<?php echo '"modal fade md-delete' . $row->res_id . '"'; ?> tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle"></i> Delete Confirmation</h4>
								</div>
								      <div class="modal-body">
								        Are you sure you want to delete this item?
								      </div>
								      <div class="modal-footer">
								        <a href="<?php echo base_url() . "admin/delete_res/" .  $row->res_id ?>" class="btn btn-danger" role="button"> 
										Delete
										</a>
								        <button type="button" class="btn btn-default" data-dismiss="modal">Dismiss</button>
								      </div>
							</div>
						</div>
					</div>
					
					<?php } ?>		
				</table>
			
			</div>
		</div>
	</div>
</body>
</html>
