<?php
	$ajax=$_POST['type'];
	$query = $this->db->query("SELECT * FROM vehicle WHERE type = '$ajax'");
	$records = $query->result; 
	return 	$records;		
?>