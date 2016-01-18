<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add New Vehicle</h1>
            </div>
        </div>
		
		<?php 			
			if(validation_errors() != false) {
				echo "
					<div class='alert alert-danger alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<strong>" . validation_errors() . "</strong>
					</div>";
			}

			if($msg != NULL) {
				echo "
					<div class='alert alert-danger alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<strong>" . $msg . "</strong>
					</div>";
			}
		?>
		
		<div class="row">
			<div class="col-lg-4">
				<?php
					echo '<br>';
					echo form_open_multipart('admin/add_vehicle', array('id' => 'edit', 'class' => 'form-signin', 'role' => 'form'));
					// picture
					$next = $this->db->query("SHOW TABLE STATUS LIKE 'car'");
					$next = $next->row(0);
					$vehicle_id = $next->Auto_increment;
					$path = "http://localhost/crsys/public/car/" . $vehicle_id . ".jpg";
					
					if(!file_exists($path)) {
						$display = "http://localhost/crsys/public/car/default.jpg";
					} else {
						$display = $path;
					}
					echo "<img src='" . $display . "' class='img-thumbnail' alt ='Car Picture' width='250'/>";
					echo '<br>';
					echo form_input(array('name' => 'userfile', 'type' => 'file')); 
					echo '<br>';
					// picture
					echo form_label('Owner Type', 'ownertype');
					$options = array(
						'0' => 'Select an option',
						'Person'=>'Person',
						'Bank'=>'Bank',
						'Self'=>'Self',
					);
					$js = 'id="ownertype" class="form-control" onchange="myFunction(this.value)"';
					echo form_dropdown('ownertype', $options,'0',$js);
					echo '<br>';
					echo '<div id="content"></div>';
					?>
					<script type="text/javascript">
					 function myFunction(val) {
						 
					document.getElementById('content').innerHTML = "";
					//if(val != '0'){}
					var div = document.createElement('div');

					div.innerHTML = '<a href="#" class="btn btn-default pull-right" data-toggle="modal" data-target=".md-add'+val+'" role="button"><i class="fa fa-plus"></i> Add Owner</a>';

					 document.getElementById('content').appendChild(div);
					 //}
						}
					 </script>
					<?php
					
					
					echo '';
					//echo '<a href="#" class="btn btn-default pull-right" data-toggle="modal" data-target=".md-add" role="button"><i class="fa fa-plus"></i> Add Owner</a>';
					echo '<br>';
					echo '<br>';
					echo form_label('Type', 'type');
					$options = array(
						'Compact'=>'Compact',
						'Medium'=>'Medium',
						'Large'=>'Large',
						'SUV'=>'SUV',
						'Truck'=>'Truck',
						'VAN'=>'VAN'
					);
					echo form_dropdown('type', $options,'','class="form-control"');
					echo '<br>';
					echo form_label('Name', 'name');
					echo form_input(array('name' => 'name', 'class' => 'form-control', 'value' => set_value('name'), 'placeholder' => 'Eg: Perodua Viva', 'required' => 'required', 'autofocus' => 'autofocus'));
					echo '<br>';
				
					echo form_label('Model', 'model');
					echo form_input(array('name' => 'model', 'class' => 'form-control', 'value' => set_value('model'), 'placeholder' => 'Car Model', 'required' => 'required', 'autofocus' => 'autofocus'));
					echo '<br>';
					echo form_label('Year', 'year');
					echo form_input(array('name' => 'year', 'class' => 'form-control', 'value' => set_value('year'), 'placeholder' => 'Car Year', 'required' => 'required', 'autofocus' => 'autofocus'));
					echo '<br>';
					echo form_label('Color', 'color');
					echo form_input(array('name' => 'color', 'class' => 'form-control', 'value' => set_value('color'), 'placeholder' => 'Car Color', 'required' => 'required', 'autofocus' => 'autofocus'));
					echo '<br>';
					echo form_label('License Plate No', 'lpno');
					echo form_input(array('name' => 'lpno', 'class' => 'form-control', 'value' => set_value('lpno'), 'placeholder' => 'License Plate No', 'required' => 'required', 'autofocus' => 'autofocus'));
					echo '<br>';
					echo form_submit(array('name' => 'submit', 'class' => 'btn btn-primary', 'value' => 'Add'));
					echo form_close();
				?>
			</div>
			
			
			<div class="modal fade md-addPerson" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i>Additional Details</h4>
							</div>

							<div class="modal-body">

								<?php
									echo form_open('admin/add_person', array('class' => 'form-signin', 'role' => 'form'));
									echo form_label('Owner Type', 'ownername');
									echo form_input(array('name' => 'ownername', 'class' => 'form-control', 'placeholder' => 'Person', 'required' => 'required', 'autofocus' => 'autofocus'));
									echo '<br>';
									echo form_label('SSN', 'ssn');
									echo form_input(array('name' => 'ssn', 'class' => 'form-control', 'placeholder' => 'SSN Number', 'required' => 'required', 'autofocus' => 'autofocus'));
									echo '<br>';
									echo form_label('Name', 'name');
									echo form_input(array('name' => 'name', 'class' => 'form-control', 'placeholder' => 'Name', 'required' => 'required'));
									echo '<br>';
									echo form_label('Driving License Number', 'dlno');
									echo form_input(array('name' => 'dlno', 'class' => 'form-control', 'placeholder' => 'Driving License Number', 'required' => 'required'));
									echo '<br>';
									echo form_label('Address', 'addr');
									echo form_input(array('name' => 'addr', 'class' => 'form-control', 'placeholder' => 'Address', 'required' => 'required'));
									echo '<br>';
								?>
							</div>

							<div class="modal-footer">
								<?php
									echo form_submit(array('name' => 'submit', 'class' => 'btn btn-primary', 'value' => 'Add'));
									echo form_close();
									echo '<button type="button" class="btn btn-default" data-dismiss="modal">Dismiss</button>';
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade md-addSelf" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i>Additional Details</h4>
							</div>

							<div class="modal-body">

								<?php
									echo form_open('admin/add_company', array('class' => 'form-signin', 'role' => 'form'));
									echo form_label('Owner Type', 'ownername');
									echo form_input(array('name' => 'ownername', 'class' => 'form-control', 'placeholder' => 'Company', 'required' => 'required', 'autofocus' => 'autofocus'));
									echo '<br>';
									echo form_label('Company Name', 'name');
									echo form_input(array('name' => 'name', 'class' => 'form-control', 'placeholder' => 'Company Name', 'required' => 'required'));
									echo '<br>';
									echo form_label('Company Address', 'address');
									echo form_input(array('name' => 'address', 'class' => 'form-control', 'placeholder' => 'Company Address', 'required' => 'required'));
									echo '<br>';									
								?>
							</div>

							<div class="modal-footer">
								<?php
									echo form_submit(array('name' => 'submit', 'class' => 'btn btn-primary', 'value' => 'Add'));
									echo form_close();
									echo '<button type="button" class="btn btn-default" data-dismiss="modal">Dismiss</button>';
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade md-addBank" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i>Additional Details</h4>
							</div>

							<div class="modal-body">

								<?php
									echo form_open('admin/add_bank', array('class' => 'form-signin', 'role' => 'form'));
									echo form_label('Owner Type', 'ownername');
									echo form_input(array('name' => 'ownername', 'class' => 'form-control', 'placeholder' => 'Bank', 'required' => 'required', 'autofocus' => 'autofocus'));
									echo '<br>';
									echo form_label('Bank Name', 'name');
									echo form_input(array('name' => 'name', 'class' => 'form-control', 'placeholder' => 'Bank Name', 'required' => 'required'));
									echo '<br>';
									echo form_label('Bank Address', 'address');
									echo form_input(array('name' => 'address', 'class' => 'form-control', 'placeholder' => 'Bank Address', 'required' => 'required'));
									echo '<br>';
								?>
							</div>

							<div class="modal-footer">
								<?php
									echo form_submit(array('name' => 'submit', 'class' => 'btn btn-primary', 'value' => 'Add'));
									echo form_close();
									echo '<button type="button" class="btn btn-default" data-dismiss="modal">Dismiss</button>';
								?>
							</div>
						</div>
					</div>
				</div>
        </div>
</div>