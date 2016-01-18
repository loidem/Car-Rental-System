		<div class="row">
            <div class="col-lg-12">
                <h2>Vehicle Gallery</h2>
	              <?php 
					if($msg != NULL) {
						echo "
							<div class='alert alert-danger alert-dismissable'>
				  				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				  				<strong>" . $msg . "</strong>
							</div>";
					}
				?>
            </div>
        </div>

		<div class="row">
			<div class="col-xs-12 col-md-3">
				<div class="panel panel-primary" style="height:474px;">
					<div class="panel-heading"><i class="fa fa-search"></i> Search Filter</div>
					<div class="panel-body">
					<?php
						echo form_open('/gallery/search', array('id' => 'search', 'class' => 'form', 'method' => 'post' , 'role' => 'form'));
						//echo form_label('Location', 'location');
						//echo form_input(array('name' => 'location', 'class' => 'form-control', 'value' => set_value('location'), 'placeholder' => 'Location name or Address, E.g. Kuala Lumpur', 'required' => 'required', 'autofocus' => 'autofocus'));
						//echo form_checkbox(array('name' => 'return', 'value' => true));
						//echo form_label('&nbsp;Return at different location');
						//echo '<br>';
						//echo '<br>';
					?>

					<div class="row">
						<div class="col-xs-6">
						<?php
							echo form_label('Pick-Up Date', 'pickup');					
							echo form_input(array('id' => 'pickup','name' => 'pickup', 'class' => 'form-control', 'data-provide' => 'datepicker', 'value' => set_value('pickup'), 'placeholder' => 'MM/DD/YYYY', 'required' => 'required'));
							
						?>
						</div>
						
						<div class="col-xs-6">
						<?php
							echo form_label('Time', 'pickuptime');
							echo form_dropdown('pickuptime', array('8 a.m' => '8 a.m', '12 p.m' => '12 p.m', '4 p.m' => '4 p.m', '8 p.m' => '8 p.m', '12 a.m' => '12 a.m'), set_value('pickuptime'), 'class="form-control"');
						?>
						</div>
					</div>
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
					
					<div class="row">
						<div class="col-xs-6">
						<?php
							echo form_label('Drop-Off Date', 'dropoff');
							echo form_input(array('id'=>'dropoff','name' => 'dropoff', 'class' => 'form-control', 'data-provide' => 'datepicker', 'value' => set_value('dropoff'), 'placeholder' => 'MM/DD/YYYY', 'required' => 'required'));
						?>
						</div>
						<div class="col-xs-6">
						<?php
							echo form_label('Time', 'dropofftime');
							echo form_dropdown('dropofftime', array('8 a.m' => '8 a.m', '12 p.m' => '12 p.m', '4 p.m' => '4 p.m', '8 p.m' => '8 p.m', '12 a.m' => '12 a.m'), set_value('dropofftime'), 'class="form-control"');
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
						<div class="col-xs-12">
						<?php
							echo form_label('Car Size', 'size');
							echo form_dropdown('size', array('compact' => 'Compact', 'medium' => 'Medium', 'large' => 'Large','suv' => 'SUV','truck' => 'TRUCK', 'van' => 'Van'), set_value('size'), 'class="form-control"');
							echo '<br>';
							echo form_submit('submit', 'Search Now', 'class="btn btn-primary pull-right"');
							echo form_close();
						?>
						</div>
					</div>
					</div>
				</div>
			</div>

			<?php foreach($rows as $row) { ?>
            <div class="col-xs-12 col-md-3">
                <div class="thumbnail">
                    <img src="http://localhost/crsys/public/car/<?php echo $row->VEHICLEID;?>.jpg" alt="">
					
                    <div class="caption">
                        <h3><?php echo $row->carname; ?><small> - <?php echo $row->VEHICLE_TYPE; ?></small></h3>
                        <p>
                        	<ul class="list-unstyled">
						  		<li><small><i class="fa fa-road"></i> Unlimited Mileage</small></li>
						  		<li><small><i class="fa fa-user"></i> 5 Adults</small></li>
						  		<li><small><i class="fa fa-briefcase"></i> 6 bags</small></li>
						  		<li><small><i class="fa fa-cog"></i> 12000 Transmission</small></li>
						  		<li><small><i class="fa fa-leaf"></i> 
								Air Conditioning
								</small></li>
								<li><i class="fa fa-usd"></i> 
								Price starting from <br/>
								Daily : <b><?php echo $row->DAILY; ?> </b><br/>
								Weekly : <b><?php echo $row->WEEKLY; ?> </b><br/>														 
								</li>

								<?php
									echo form_open(base_url() . 'gallery/booking/' . $row->VEHICLEID, array('id' => 'book', 'class' => 'form', 'method' => 'post' , 'role' => 'form'));
									echo form_input(array('name' => 'pickup', 'class' => 'hidden', 'value' => set_value('pickup')));
									echo form_input(array('name' => 'pickuptime', 'class' => 'hidden', 'value' => set_value('pickuptime')));
									echo form_input(array('name' => 'dropoff', 'class' => 'hidden', 'value' => set_value('dropoff')));
									echo form_input(array('name' => 'dropofftime', 'class' => 'hidden', 'value' => set_value('dropofftime')));
									echo '<center>';
									echo '<div class="btn-group btn-group-justified">';
									echo '<div class="btn-group">';
									if($msg != NULL || $toggle == false) {
										echo form_submit('submit', 'Select', 'class="btn btn-success" disabled="disabled"');
									} else {
										echo form_submit('submit', 'Select', 'class="btn btn-success"');
									}
									echo '</div>';
									echo '</div>';
									echo '</center>';
									echo form_close();
								?>
							</ul>
						</p>
                    </div>
					
                </div>
            </div>
			<?php } ?>
        </div>