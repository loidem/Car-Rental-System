<?php

class Model_user extends CI_Model {
	public function validate() {
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$query = $this->db->get_where('customer', array('username' => $username, 'password' => $password));

		//print_r($query->num_rows());
		if($query->num_rows() > 0) {
			$row = $query->row();
			$data = array(
					'user_id' => $row->idno,
					'username' => $row->username,
					'accounttype' => $row->accounttype,
					'password' => $row->password,
					'loggedIn' => true
					);
			$this->session->set_userdata($data);
			return true;
		}
		return false;
	}
	
	function create_user()
	{
		$username = $this->input->post('username');
		$sql_username_check = mysql_query("SELECT idno FROM customer WHERE username= '$username' LIMIT 1");
		$username_check = mysql_num_rows($sql_username_check);
		
		if ($username_check > 0 ){ 
			return false;
		}
		else 
		{
			$new_member_insert_data = array(
				'initials' => $this->input->post('first_name'),
				'lastname' => $this->input->post('last_name'),
				'street' => $this->input->post('street'),
				'city' => $this->input->post('city'),
				'state' => $this->input->post('state'),
				'zipcode' => $this->input->post('zip'),
				'phone' => $this->input->post('phone'),
				
				'gender' => $this->input->post('gender'),
				'email_address' => $this->input->post('email_address'),			
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),						
				'password2' => md5($this->input->post('password2')),						
				'accounttype' => $this->input->post('accounttype'),	
				
				'signupdate' => date("Y-m-d")					
			);
			

			$insert = $this->db->insert('customer', $new_member_insert_data);
			return $insert;
		}
	}
	
	function edit_user()
	{
		$user_id = $this->session->userdata('idno');
	
		$new_first_name = $this->input->post('intials');
		$new_last_name = $this->input->post('lastname');
		$new_email_address = $this->input->post('email_address');
		
		$sql_update =  $this->db->query("UPDATE customer 
										SET intials = '$new_first_name',
										lastname = '$new_last_name' ,
										email_address = '$new_email_address'
										WHERE idno = $user_id ");
		return $sql_update;
	}
	
	function verify_user()
	{
		$user_id = $this->session->userdata('id_no');
		
		$ic_no = $this->input->post('ic_no');
		$li_no = $this->input->post('li_no');
		
		$sql_add =  $this->db->query("UPDATE users 
									  SET ic_no = '$ic_no',
									      li_no = '$li_no',
										  verified = '1'
									  WHERE user_id = $user_id ");
		
		
		return $sql_add;
		
	}
}