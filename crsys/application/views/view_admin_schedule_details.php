<div id="page-wrapper">
	<div class="col-lg-12">
			<h1 class="page-header">Schedule Details</h1>	
	</div>		

	<div class="row">
		<?php foreach($rows as $row) { ?>
		<div class="col-xs-12 ">
			<div class="thumbnail">
				<h1><?php echo "<strong>Vehicle with id (" . $row->vehicle_id . ") </strong><br>"; ?></h1>
				<img src="http://localhost/crsys/public/car/<?php echo $row->vehicle_id;?>.jpg" alt="">
				
				<div class="caption">
                        <?php 
							$vehicle_id = $row->vehicle_id;
							$sql = mysql_query("SELECT * FROM car WHERE VEHICLEID ='$vehicle_id'");
							$row_vehicle = mysql_fetch_array($sql);
							echo "<h3><strong>Vehicle Details: </strong></h3>";
							echo "<strong><li>Type: </strong>" . $row_vehicle['VEHICLE_TYPE'] . "</li>";
							echo "<strong><li>Name: </strong>" . $row_vehicle['carname'] . "</li>";
							echo "<strong><li>Model: </strong>" . $row_vehicle['CMODEL'] . "</li>";
							echo "<strong><li>YEAR: </strong>RM " . $row_vehicle['CYEAR'] . "</li>";
						?>
						
						<?php 
							echo "<h3><strong>Reservation Details: </strong></h3>";
							echo "<strong><li>Location: </strong>" . $row->location . "</li>";
							echo "<strong><li>Phone Number: </strong>" . $row->phone . "</li>";
							echo "<strong><li>User ID: </strong>" . $row->user_id . "</li>";
						?>
						
						<?php 
							$user_id = $row->user_id;
							
							$sql = mysql_query("SELECT * FROM customer WHERE idno = '$user_id'");
							$row_user = mysql_fetch_array($sql);
							echo "<h3><strong>User Details: </strong></h3>";
							echo "<strong><li>Name: </strong>" . $row_user['initials'] . " " . $row_user['lastname'] . "</li>";
							echo "<strong><li>Gender: </strong>" . $row_user['gender'] . "</li>";
							echo "<strong><li>Email Address: </strong>" . $row_user['email_address'] . "</li>";
							echo "<strong><li>Phone: </strong>" . $row_user['phone'] . "</li>";
						?>
		
                    </div>
				
			</div>
			
			<?php 
			echo anchor('/admin/schedule', 'Back');
			?>
		</div>
		<?php } ?>
	</div>
</div>