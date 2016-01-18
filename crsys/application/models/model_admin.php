<?php
class Model_admin extends CI_Model {
	
	function selected($limit, $offset, $sort_by, $sort_order) {
		
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('idno','initials','lastname','gender','username','email_address','signupdate','accounttype','phone');
		
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'idno';
		
		// results query
		$q = $this->db->select('idno,initials,lastname,gender,username,email_address,signupdate,accounttype,phone,')
			->from('customer')
			->limit($limit, $offset)
			->order_by($sort_by, $sort_order);
		
		$ret['rows'] = $q->get()->result();
		
		// count query
		$q = $this->db->select('COUNT(*) as count', FALSE)
			->from('customer');
		
		$tmp = $q->get()->result();
		
		$ret['num_rows'] = $tmp[0]->count;
		
		return $ret;
	}
	
	function getALL()
	{
		
		$query = $this->db->query("SELECT C.VEHICLEID,C.VEHICLE_TYPE,C.carname,C.CMODEL,C.CYEAR,C.COLOR,C.LICENSE_PLATE_NO,R.WEEKLY,R.DAILY FROM car as C,rate as R WHERE C.TYPE_ID = R.TYPEID ORDER BY C.VEHICLE_TYPE");
		if($query->num_rows() > 0) {
			
			//print_r($data);
			return $query->result();
		}	
		//$query = $this->db->get('car');
		//return $query->result();
		
	}
	
	function update_vehicle() 
	{
		$id_update = $this->uri->segment(3);
		
		$getquerys = $this->db->query("SELECT * FROM rate WHERE TYPENAME='".$this->input->post('type')."'");
		$row = $getquerys->row(0);
		
		$type = $this->input->post('type');
		$name = $this->input->post('name');
		$model = $this->input->post('model');
		$year = $this->input->post('year');
		$color = $this->input->post('color');
		$lpno = $this->input->post('lpno');
		$TYPE_ID = $row->TYPEID;
		
		$sql_update =  $this->db->query("UPDATE car 
										SET VEHICLE_TYPE = '$type',
										carname = '$name',
										CMODEL = '$model',
										CYEAR = '$year',
										COLOR = '$color',
										LICENSE_PLATE_NO = '$lpno',
										TYPE_ID = '$TYPE_ID'
										WHERE VEHICLEID = $id_update ");
		return $sql_update;
	}
	
	function delete_vehicle()
	{
		$this->db->where('VEHICLEID', $this->uri->segment(3));
		$this->db->delete('car');
		redirect('admin/getAll_vehicle');
	}
	
	function count_vehicle()
	{
		$q = $this->db->select('COUNT(*) as count', FALSE)
			->from('car');
		
		$tmp = $q->get()->result();
		
		$ret['num_rows'] = $tmp[0]->count;
		
		return $ret;
	}
	
	function add_vehicle($user_id)
	{	
	
		$getquerys = $this->db->query("SELECT * FROM rate WHERE TYPENAME='".$this->input->post('type')."'");
		$row = $getquerys->row(0);
		
		
		
		$new_vehicle = array(
			'VEHICLE_TYPE' => $this->input->post('type'),
			'carname' => $this->input->post('name'),
			'CMODEL' => $this->input->post('model'),
			'CYEAR' => $this->input->post('year'),			
			'COLOR' => $this->input->post('color'),			
			'LICENSE_PLATE_NO' => $this->input->post('lpno'),		
			'TYPE_ID' => $row->TYPEID		
		);
		
		/*
		
		$type = $this->input->post('type');
		$name = $this->input->post('name');
		$model = $this->input->post('model');
		$year = $this->input->post('year');
		$color = $this->input->post('color');
		$lpno = $this->input->post('lpno');
		$TYPE_ID = $row->TYPEID;
		
		$sql_update =  $this->db->query("UPDATE car 
										SET VEHICLE_TYPE = '$type',
										carname = '$name',
										CMODEL = '$model',
										CYEAR = '$year',
										COLOR = '$color',
										LICENSE_PLATE_NO = '$lpno',
										VEHICLE_TYPE = '$lpno',
										TYPE_ID = '$type'
										WHERE VEHICLEID = $user_id ");
		return $sql_update;
		*/
		
		$add = $this->db->insert('car', $new_vehicle);
		
		$getquery = $this->db->query("SELECT VEHICLEID FROM car ORDER BY VEHICLEID DESC LIMIT 1;");
		$row = $getquery->row(0);
		$vehicleid = $row->VEHICLEID;
		
		$tmpquery = $this->db->query("SELECT OWNERID FROM owner ORDER BY OWNERID DESC LIMIT 1;");
		$tmprow = $tmpquery->row(0);
		$ownerid = $tmprow->OWNERID;
		
		$new_owns = array(
			'OWNERID' => $ownerid,
			'VEHICLEID' => $vehicleid,
			'PURCHASE_DATE' => '2014-04-20'
		
		);
		
		$sub = $this->db->insert('owns', $new_owns);
		
		return $add;

	}
	
	function get_charges()
	{
		$query = $this->db->get('charge');
		return $query->result();
	}

	
	function get_rates()
	{
		$query = $this->db->get('rate');
		return $query->result();
	}

	function add_charges() 
	{
		$new_charge = array(
			'name' => $this->input->post('name'),
			'cost' => $this->input->post('cost')
		);

		$add = $this->db->insert('charge', $new_charge);
		return $add;
	}

	function getOwnerID($ownername){
		$new_owner = array(
			'OWNERID' => $this->input->post(''),
			'OWNERNAME' => $ownername
		
		);
		$query = $this->db->insert('owner',$new_owner);
		$getquerys = $this->db->query("SELECT * FROM owner ORDER BY ownerid DESC LIMIT 1;");
		$row = $getquerys->row(0);
		return $row;
	}
	
	function add_persons()
	{	


		
//die;
		$row = $this->getOwnerID($this->input->post('ownername'));
		$new_owner = array(
			'ssn' => $this->input->post('ssn'),
			'pname' => $this->input->post('name'),
			'dl_no' => $this->input->post('dlno'),
			'address' => $this->input->post('addr'),
			'ownerid' => $row->OWNERID			
		);
		

		$add = $this->db->insert('person', $new_owner);
		return $add;
	}

	
	function add_companys()
	{	
		$row = $this->getOwnerID($this->input->post('ownername'));
		$new_owner = array(
			'cname' => $this->input->post('name'),
			'caddress' => $this->input->post('address'),
			'ownerid' => $row->OWNERID
		);
		

		$add = $this->db->insert('company', $new_owner);
		return $add;
	}
	
	function add_banks()
	{	
		$row = $this->getOwnerID($this->input->post('ownername'));
		$new_owner = array(
			'bname' => $this->input->post('name'),
			'baddress' => $this->input->post('address'),
			'ownerid' => $row->OWNERID
		);
		

		$add = $this->db->insert('bank', $new_owner);
		return $add;
	}
	
	function update_charges()
	{
		$id_update = $this->uri->segment(3);
		
		$name = $this->input->post('name');
		$cost = $this->input->post('cost');
	
		
		$sql_update =  $this->db->query("UPDATE charge 
										SET name = '$name',
										name = '$name',
										cost = '$cost'
										WHERE charge_id = $id_update ");
		return $sql_update;
	}

	function update_rates()
	{
		$id_update = $this->uri->segment(3);
		
		$daily = $this->input->post('daily');
		$weekly = $this->input->post('weekly');
	
		
		$sql_update =  $this->db->query("UPDATE rate 
										SET DAILY = '$daily',
										WEEKLY = '$weekly'
										
										WHERE TYPEID = $id_update ");
		return $sql_update;
	}
	function delete_charges() 
	{
		$this->db->where('charge_id', $this->uri->segment(3));
		$this->db->delete('charge');
		redirect('admin/package');
	}

	function delete_resv() 
	{
		$this->db->where('res_id', $this->uri->segment(3));
		$this->db->delete('reservation');
		redirect('admin/returns');
	}
	
	function schedule_details(){
		$pickup =  $this->uri->segment(3);
		$dropoff =  $this->uri->segment(4);
		$vehicle_id =  $this->uri->segment(5);
		$query = $this->db->query("SELECT * FROM reservation WHERE (vehicle_id = '$vehicle_id' AND pickup = '$pickup' AND dropoff = '$dropoff')");
		if($query->num_rows() > 0) {
			foreach($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}	
	}
}
