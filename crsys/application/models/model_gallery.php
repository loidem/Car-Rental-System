<?php
class Model_gallery extends CI_Model {
	
	function getAll(){
		$query = $this->db->query("SELECT C.VEHICLEID,C.VEHICLE_TYPE,C.carname,R.WEEKLY,R.DAILY FROM car as C,rate as R WHERE C.TYPE_ID = R.TYPEID ORDER BY C.VEHICLE_TYPE");
		if($query->num_rows() > 0) {
			foreach($query->result() as $row) {
				$data[] = $row;
			}
			//print_r($data);
			return $data;
		}	
		
		
	}

	function search() {
		$size = $this->input->post('size');
		$pickup = date('Y-m-d', strtotime($this->input->post('pickup')));
		$dropoff = date('Y-m-d', strtotime($this->input->post('dropoff')));
		
		$query = $this->db->query("select C.VEHICLEID,C.VEHICLE_TYPE,C.carname,R.WEEKLY,R.DAILY from car as C,rate as R 
									where C.TYPE_ID = R.TYPEID AND vehicle_type='$size' and vehicleid not in 
									(select vehicle_id from reservation where ((pickup <= '$pickup' AND dropoff >= '$pickup') OR
									(pickup < '$dropoff' AND dropoff >= '$dropoff') OR
									(pickup >= '$pickup' AND dropoff < '$dropoff'))) GROUP BY C.VEHICLEID");
		//$query = $this->db->query("SELECT C.VEHICLEID,C.VEHICLE_TYPE,C.carname,R.WEEKLY,R.DAILY FROM car as C,rate as R WHERE C.TYPE_ID = R.TYPEID AND //C.VEHICLE_TYPE ='$size' GROUP BY C.VEHICLEID");
		if($query->num_rows() > 0) {
			foreach($query->result() as $row) {
				$data[] = $row;
			}
			
			return $data;
		}
	}
	
	function booking() {
		$vehicle_id =  $this->uri->segment(3);
		$query = $this->db->get_where('car', array('vehicleid' => $vehicle_id));	
		if($query->num_rows() > 0) {
			foreach($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		
	}
	
	function reserve_vehicle()
	{	
		
		$pickup = date('Y-m-d', strtotime($this->input->post('pickup')));
		$dropoff = date('Y-m-d', strtotime($this->input->post('dropoff')));
		$vehicle_id =  $this->uri->segment(3);
		
		$sql_check_availability = mysql_query(
			"SELECT * 
			FROM reservation 
			WHERE (pickup <= '$pickup' AND dropoff >= '$dropoff')
			AND (vehicle_id = '$vehicle_id')
			LIMIT 1"
		);
		$res_check = mysql_num_rows($sql_check_availability);
		
		$sql_check_availability2 = mysql_query(
			"SELECT * 
			FROM reservation 
			WHERE (pickup <= '$pickup' AND dropoff >= '$pickup'  AND dropoff <= '$dropoff')
			AND (vehicle_id = '$vehicle_id')
			LIMIT 1"
		);
		$res_check2 = mysql_num_rows($sql_check_availability2);
		
		
		if ($res_check > 0 || $res_check2>0){ 
			return false;
		}
		else 
		{
			$insert_reservation_data = array(
				'vehicle_id' => $vehicle_id,
				'status' => $this->input->post('status'),
				'phone' => $this->input->post('phone'),
				'user_id' => $this->input->post('user_id'),
				'location' => $this->input->post('location'),
				'pickup' => $pickup,
				'pickuptime' => $this->input->post('pickuptime'),
				'dropoff' => $dropoff,
				'dropofftime' => $this->input->post('dropofftime'),
				'amtdue' => $this->input->post('amtdue')
				
			);
			$insert = $this->db->insert('reservation', $insert_reservation_data);
			return $insert;
		}
	}
}
