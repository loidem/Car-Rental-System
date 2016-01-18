<?php 
$id_update = $this->uri->segment(3);

$sql = mysql_query("SELECT * FROM rate WHERE TYPEID= $id_update");
$count = mysql_num_rows($sql);

if ($count > 1) {
	echo "There is no vehicle with that id here.";
	exit();	
}
while($row = mysql_fetch_array($sql))
{
	$daily = $row["DAILY"];
	$typename = $row["TYPENAME"];
	$weekly = $row["WEEKLY"];
}

?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Update Rate Information</h1>
		</div>		
	</div>	
		<div class="row">
			<div class="col-lg-4">
				<?php
					if(validation_errors() != false) {
						echo "
						<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<strong>" . validation_errors() . "</strong>
						</div>";
					}
					
					echo form_open("admin/update_rate/$id_update", array('id' => 'edit', 'class' => 'form-signin', 'role' => 'form'));
					
					echo form_label('Vehicle Type', 'vehicletype');
					echo form_input(array('name' => 'vehicletype', 'class' => 'form-control', 'value' => $typename, 'placeholder' => 'Vehicle Type', 'required' => 'required', 'autofocus' => 'autofocus','readonly' => 'readonly'));
					echo '<br>';
					
					echo form_label('Daily', 'daily');
					echo form_input(array('name' => 'daily', 'class' => 'form-control', 'value' => $daily, 'placeholder' => 'Daily', 'required' => 'required', 'autofocus' => 'autofocus'));
					echo '<br>';

					echo form_label('Weekly', 'weekly');
					echo form_input(array('name' => 'weekly', 'class' => 'form-control', 'value' => $weekly, 'placeholder' => 'Weekly', 'required' => 'required'));
					echo '<br>';
					echo form_submit(array('name' => 'submit', 'class' => 'btn btn-primary', 'value' => 'Update'));
					echo form_close();
				?>
			</div>
        </div>
</div>