<?php 
	$status = $this->session->userdata('loggedIn');
	$user_id = $this->session->userdata('user_id');
	$username = $this->session->userdata('username');
	

	if($status) {
		$sql = mysql_query("SELECT * FROM customer WHERE idno=".$user_id." LIMIT 1");
		$count = mysql_num_rows($sql);
		
		if ($count > 1) {
			echo "There is no user with that id here.";
			exit();	
		}
		while($row = mysql_fetch_array($sql))
		{
			$first_name = $row["initials"];
			$last_name = $row["lastname"];
			$username = $row["username"];
			$gender = $row["gender"];
			$email_address = $row["email_address"];
			$phone = $row["phone"];
			$address = $row["street"]+'</br>'+$row["city"]+'</br>'+$row["state"]+'</br>'+$row["zipcode"];
			$signupdate = strftime("%d %b %Y", strtotime($row['signupdate']));
			$accounttype = $row["accounttype"];
			
		}
	} 
?>
	
	<?php
		//Set default display picture
        $user_id = $this->session->userdata("user_id");
        $path = "http://localhost/crsys/public/upload/profile/" . $user_id . "/pic1.jpg";
		
		if(!file_exists($path)) 
		{
			$display = "http://localhost/crsys/public/upload/profile/default.jpg";
        } else {
			$display = $path;
        }
    ?>

	<div class="row">
		<div class="col-xs-12 col-md-3">
			<img src="<?php echo $display; ?>" class="img-thumbnail" alt ="Upload Picture" width="250"/>
				<h3><strong><?php echo $first_name . " " . $last_name ?></strong></h3>
				<h4><i><?php echo "'" . $username . "'"; ?></i></h4>
				<hr>
				<ul class="list-group">
			  		<li class="list-group-item"><i class="fa fa-envelope-o"></i><?php echo " " . $email_address ?>  <br></li>
			  		<li class="list-group-item"><i class="fa"></i><?php echo " " . $address ?>  <br></li>
			  		<li class="list-group-item"><i class="fa"></i><?php echo " " . $phone ?>  <br></li>
			  		<li class="list-group-item"><i class="fa fa-clock-o"></i><?php echo " Joined on  " . $signupdate ?></li>
			 	</ul>
		</div>
		<div class="col-xs-12 col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-search"></i> <strong>Search for a car rental</strong></h3>
				</div>
			
			<div class="panel-body">
				<?php
					echo form_open('/gallery', array('id' => 'search', 'class' => 'form', 'method' => 'post' , 'role' => 'form'));
					// echo form_label('Location', 'location');
					// echo form_input(array('name' => 'location', 'class' => 'form-control', 'placeholder' => 'Location name or Address, E.g. Kuala Lumpur', 'required' => 'required', 'autofocus' => 'autofocus'));
					// echo form_checkbox(array('name' => 'return', 'value' => true));
					// echo form_label('&nbsp;Return at different location');
					// echo '<br>';
					// echo '<br>';
				?>

				<div class="row">
				  <div class="col-xs-3">
				  	<?php
				  		echo form_label('Pick-Up Date', 'pickup');
				  		echo '<div class="input-group">';
				  		echo '<span class="input-group-addon"><i class="fa fa-calendar"></i></span>';
				  		echo form_input(array('id'=>'pickup','name' => 'pickup', 'class' => 'form-control', 'data-provide' => 'datepicker', 'placeholder' => 'MM/DD/YYYY', 'required' => 'required'));
				  		echo '</div>';
				  	?>
				  </div>
				  <div class="col-xs-3">
				  	<?php
				  		echo form_label('Time', 'pickuptime');
				  		echo form_dropdown('pickuptime', array('8 a.m' => '8 a.m', '12 p.m' => '12 p.m', '4 p.m' => '4 p.m', '8 p.m' => '8 p.m', '12 a.m' => '12 a.m'), '8 a.m', 'class="form-control"');
				  	?>
				  </div>
				  <div class="col-xs-3">
					<?php
				  		echo form_label('Drop-Off Date', 'dropoff');
				  		echo '<div class="input-group">';
				  		echo '<span class="input-group-addon"><i class="fa fa-calendar"></i></span>';
				  		echo form_input(array('id'=>'dropoff','name' => 'dropoff', 'class' => 'form-control', 'data-provide' => 'datepicker', 'placeholder' => 'MM/DD/YYYY', 'required' => 'required'));
				  		echo '</div>';
				  	?>
				  </div>
				   <div class="col-xs-3">
				  	<?php
				  		echo form_label('Time', 'dropofftime');
				  		echo form_dropdown('dropofftime', array('8 a.m' => '8 a.m', '12 p.m' => '12 p.m', '4 p.m' => '4 p.m', '8 p.m' => '8 p.m', '12 a.m' => '12 a.m'), '8 a.m', 'class="form-control"');
				  	?>
				  </div>
				</div>
					<br/>
					
					<div class="row">
						<div class="col-xs-6">
							<?php
								echo form_label('Plans', 'plans');
								$options = array(
									'0' => 'Select an option',
									'Weekly'=>'Weekly',
									'Daily'=>'Daily'
								);
								$js = 'id="plans" class="form-control" onchange="myFunction(this.value)"';
								echo form_dropdown('plans', $options,'0',$js);
								echo '<br>';
								echo '<div id="content"></div>';
								?>	
						</div>
					</div>
					
					<script src="http://momentjs.com/downloads/moment.js"></script>
					<script type="text/javascript">
						
					 function myFunction(val) {
							
								if(val == 'Weekly'){
								document.getElementById('content').innerHTML = "";
								//if(val != '0'){}
								var div = document.createElement('div');

								div.innerHTML = '<input onchange="myDays(this.value)" type="text" autofocus="autofocus" required="required" placeholder="No. of Weeks" class="form-control" value="" name="weeks">';
									
								
								 document.getElementById('content').appendChild(div);
							}else{
								document.getElementById('content').innerHTML = "";
								document.getElementById("dropoff").value="";
							}
					}
	
					function myDays(weeks){
							
						var strtdate = document.getElementById('pickup').value;	
						
						var days = weeks*7;
						var new_date = moment(strtdate, "MM-DD-YYYY").add('days',days);
						var enddate = moment(new_date).format('MM/DD/YYYY');
						var element = document.getElementById("dropoff");
						element.value = enddate;
						//alert(enddate);
						//var date 
					}			
				
					</script>
					<br/>

					<div class="row">
						<div class="col-xs-4">
						  	<?php
						  		echo form_label('Car Size', 'size');
						  		echo form_dropdown('size', array('compact' => 'Compact', 'medium' => 'Medium', 'large' => 'Large','suv' => 'SUV','truck' => 'TRUCK', 'van' => 'Van'), 'compact', 'class="form-control"');
						  	?>
						</div>
					</div>
					<br/>
					<button class="btn btn-success"><i class="fa fa-search"></i> Search Now</button>
				</form>
			</div>
			</div>
		</div>
	</div>
