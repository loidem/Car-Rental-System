<div id="page-wrapper">
<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Weekly Reports</h1>
				<?php
					if(validation_errors() != false) {
						echo "
						<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<strong>" . validation_errors() . "</strong>
						</div>";
					}
				
				?>
			<h4 class="">Current Weekly Report :
			<?php 
				$today = date("Y-m-d");
				$NewDate=Date('Y-m-d', strtotime("+7 days"));
				echo "<br>" ;
				echo "<br>Starting from " .$today . " to " . $NewDate ."<br>" ;
				
				
			
			?></h4>
		</div>		

	</div>		
	<?php
		$query = $this->db->query("select o.ownerid
											as OwnerID,t1.OwnerName as OwnerName,
											own.ownername as OwnerType,
											r.vehicle_id as VehicleID,
											c.License_Plate_No as License_Plate_No,
											c.carname as CAR_NAME,
											c.vehicle_type as VehicleType,
											sum(r.amtdue) as amtdue 
											FROM reservation r,owns o, car c,
											(select ownerID,PName
											as OwnerName from Person
											UNION ALL
											select ownerID,CName as OwnerName
											from company
											UNION ALL
											select ownerID,BName as OwnerName from Bank)
											t1,owner as own WHERE r.dropoff < DATE_ADD(NOW(), INTERVAL 1 WEEK)
											and r.vehicle_id=o.vehicleid and o.vehicleid=c.vehicleid
											and o.ownerid = t1.ownerID and o.ownerid=own.ownerid
											group by o.ownerid,c.vehicle_type,r.vehicle_id
											order by o.ownerid asc");

					
		if($query->num_rows() > 0) {
		foreach($query->result() as $row) {
				$reports[] = $row;
				//print_r($reports);
			}
			
		}	
	?>
	
	<div class="row">
		<div class="col-lg-12">
			<br>
			<div class="table-responsive">
				<table class="table table-striped table-bordered  table-hover">
					<thead>
						<th>#</th>
						<th>Owner Name</th>
						<th>Owner Type</th>
						<th>Vehicle ID</th>
						<th>License Plate No</th>
						<th>Car Name</th>
						<th>Vehicle Type</th>
						<th>Amount Due</th>
					</thead>
					
					<tbody>
						<?php foreach($reports as $row){ ?>
						<tr >						
							<td >
								<?php echo $row->OwnerID; ?>
							</td>
							<td >
								<?php echo $row->OwnerName; ?>
							</td>
							<td >
								<?php echo $row->OwnerType; ?>
							</td>
							<td >
								<?php echo $row->VehicleID; ?>
							</td>
							<td >
								<?php echo $row->License_Plate_No; ?>
							</td>
							<td >
								<?php echo $row->CAR_NAME; ?>
							</td>
							<td >
								<?php echo $row->VehicleType; ?>
							</td>
							<td >
								<?php echo $row->amtdue; ?>
							</td>
			
							
						</tr>
							
					</tbody>
					<?php } ?>		
				</table>
			
			</div>
		</div>
	</div>