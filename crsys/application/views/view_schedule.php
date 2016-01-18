<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
<div id="page-wrapper">
<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">View Schedule</h1>
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
		$query = $this->db->query("select c.initials,c.lastname, c.phone,c.email_address,r.res_id,ca.carname,ca.CMODEL,ca.CYEAR,ca.COLOR,ca.LICENSE_PLATE_NO,ca.VEHICLE_TYPE,r.location,r.pickup,r.pickuptime,r.dropoff,r.dropofftime,r.amtdue from reservation as r, customer as c,car as ca where r.user_id=c.idno and r.vehicle_id=ca.vehicleid and c.idno=$user_id");

					
		if($query->num_rows() > 0) {
		foreach($query->result() as $row) {
				$reports[] = $row;
				//print_r($reports);
			}
			
		}else{
			echo "
			<div class='alert alert-danger alert-dismissable'>
				<strong> You have no schedule</strong>
			</div>";
			$reports =array();
			//$reports[] = '';
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
						<?php
						
						if($reports){
						foreach($reports as $row){ ?>
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
						</tr>
							
					</tbody>
						<?php } }?>		
				</table>
			
			</div>
		</div>
	</div>
</body>
</html>
