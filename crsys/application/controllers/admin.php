<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function _remap($method, $params = array())
	{
		$session = $this->session->userdata("loggedIn");
		$user_id = $this->session->userdata("user_id");
		$sql = mysql_query("SELECT accounttype FROM customer WHERE idno='$user_id'");
		$row = mysql_fetch_array($sql);
		$accounttype = $row["accounttype"];
		
		if($session && $accounttype == 'admin')
		{
			if (method_exists($this, $method))
			{
				call_user_func_array(array($this, $method), $params);
			}
			else
			{
				show_404();
			}
			
		}
		else if ($session && $accounttype == 'user')
		{
			echo 'No direct access allowed (Do not acces in this way)';
		}
		
	}
	
	public function index() {
		$this->load->view('admin_header');
		$this->load->view('view_admin_dashboard');
		$this->load->view('admin_footer');
	}
	
	function error_pic($msg = NULL) {
		$data['msg'] = $msg;
		$this->load->view('admin_header');
		$this->load->view('view_admin_add_vehicle', $data);
		$this->load->view('footer');
	}
	
	function error_pic_edit($msg = NULL) {
		$data['msg'] = $msg;
		$this->load->view('admin_header');
		$this->load->view('view_admin_update_vehicle', $data);
		$this->load->view('footer');
	}	
	
	function user($sort_by = 'user_id', $sort_order = 'asc', $offset = 0) {
		
		$limit = 10;
		$data['fields'] = array(
			'idno' => 'ID',
			'initials' => 'First Name',
			'lastname' => 'Last Name',
			'gender' => 'Gender',
			'username' => 'Username',
			'email_address' => 'Email Address',
			'signupdate' => 'Signup Date',
			'accounttype' => 'Account Type',
			'phone' => 'Phone',
		);
		
		$this->load->model('model_admin');
		
		$results = $this->model_admin->selected($limit, $offset, $sort_by, $sort_order);
		
		$data['users'] = $results['rows'];
		$data['num_results'] = $results['num_rows'];
		
		// pagination
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = site_url("admin/user/$sort_by/$sort_order");
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;

		$this->load->view('admin_header');
		$this->load->view('view_admin_user', $data);
		$this->load->view('admin_footer');
	}
	
	function getAll_vehicle()
	{
		$this->load->model('model_admin');
		
		if($query = $this->model_admin->getALL())
		{
			
			$data['records'] = $query;
		}
		
		if($count = $this->model_admin->count_vehicle())
		{
			$data['vehicle_no'] = $count['num_rows'];
		}
		
		$this->load->view('admin_header');
		$this->load->view('view_admin_vehicle', $data);
		$this->load->view('admin_footer');
	}
	
	function add_vehicle() 
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('type', 'Type', 'trim|required|alpha');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|name_space');
		$this->form_validation->set_rules('year', 'Car Year', 'trim|required|numeric');
		$this->form_validation->set_rules('model', 'Car Model', 'trim|required|alpha');
		$this->form_validation->set_rules('color', 'Car Color', 'trim|required|alpha');
		$this->form_validation->set_rules('lpno', 'License Plate No', 'trim|required|alphanumeric');
		
		
		if($this->form_validation->run() == FALSE)
		{
			$data['msg'] = NULL;
			$this->load->view('admin_header');
			$this->load->view('view_admin_add_vehicle',$data);
			$this->load->view('admin_footer');
		}
		else
		{			
			$this->load->model('model_admin');			
			$next = $this->db->query("SHOW TABLE STATUS LIKE 'car'");
			$next = $next->row(0);
			$user_id = $next->Auto_increment;
			$pathToUpload = './public/car/';
			$config['file_name'] = $user_id . '.jpg';
			$config['upload_path'] = $pathToUpload;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '5000';
			$config['overwrite'] = True;
			$this->load->library('upload', $config);
			echo '<script language="javascript">';
			echo 'alert("message successfully sent"'.$user_id.')';
			echo '</script>';
			if($this->model_admin->add_vehicle($user_id) && $this->upload->do_upload())
			{
				$data = array('upload_data' => $this->upload->data());
				$this->load->view('admin_header');
				$this->load->view('view_success');
				$this->load->view('admin_footer');
			}
			else
			{
				$this->error_pic($this->upload->display_errors());
			}			
		}
	}
	
	function update_vehicle()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('type', 'Type', 'trim|required|alpha');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|name_space');
		$this->form_validation->set_rules('transmission', 'Transmission', 'trim|required|alpha');
		$this->form_validation->set_rules('ac', 'AC', 'trim|required|numeric');
		$this->form_validation->set_rules('capacity', 'Capacity', 'trim|required|numeric');
		$this->form_validation->set_rules('luggage', 'Luggage', 'trim|required|numeric');
		$this->form_validation->set_rules('daily', 'Daily', 'trim|required|numeric');
		
		if($this->form_validation->run() == FALSE)
		{
			$data['msg'] = NULL;
			$this->load->view('admin_header');
			$this->load->view('view_admin_update_vehicle',$data);
			$this->load->view('admin_footer');
		}
		else
		{			
			$this->load->model('model_admin');			
			// $next = $this->db->query("SHOW TABLE STATUS LIKE 'vehicle'");
			// $next = $next->row(0);
			// $id = $next->Auto_increment;
			
			// $q = $this->db->query('SELECT id FROM vehicle');
			// $id = $q->last_row()->id;
			
			$user_id = $this->uri->segment(3);
			
			$pathToUpload = './public/car/';
			$config['file_name'] = $user_id . '.jpg';
			$config['upload_path'] = $pathToUpload;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '5000';
			$config['overwrite'] = True;
			$this->load->library('upload', $config);
			
			if( $this->upload->do_upload() && $this->model_admin->update_vehicle() )
			{
				$data = array('upload_data' => $this->upload->data());
				redirect('admin/getAll_vehicle');
			}
			else if($this->model_admin->update_vehicle())
			{
				redirect('admin/getAll_vehicle');
			}
			else if($this->upload->do_upload())
			{
				$data = array('upload_data' => $this->upload->data());
				redirect('admin/getAll_vehicle');
			}
			else
			{
				$this->error_pic_edit($this->upload->display_errors());
			}			
		}
	}
	
	function delete_vehicle()
	{
		$this->load->model('model_admin');
		$this->model_admin->delete_vehicle();
		$this->index();
	}
	
	function package($msg = NULL)
	{	
		$this->load->model('model_admin');
		
		if($query = $this->model_admin->get_charges())
		{
			$data['charges'] = $query;
		}
		
		$this->load->view('admin_header');
		$this->load->view('view_admin_package', $data);
		$this->load->view('admin_footer');
	}
	
	function rate($msg = NULL)
	{	
		$this->load->model('model_admin');
		
		if($query = $this->model_admin->get_rates())
		{
			$data['rates'] = $query;
		}
		
		$this->load->view('admin_header');
		$this->load->view('view_admin_package', $data);
		$this->load->view('admin_footer');
	}
	
	function add_charge() 
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('cost', 'Cost', 'trim|required|numeric');


		if($this->form_validation->run() == FALSE)
		{
			$this->package();
		} 
		else
		{
			$this->load->model('model_admin');

			if($this->model_admin->add_charges())
			{
				$this->package();
			}
		}
	}
	
	function add_person() 
	{
		$this->load->library('form_validation');
		//$this->form_validation->set_rules('ownername', 'Owner Type', 'trim|required');
		$this->form_validation->set_rules('ssn', 'SSN', 'trim|required|numeric');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('dlno', 'Driving License Number', 'trim|required');
		$this->form_validation->set_rules('addr', 'Address', 'trim|required');


		if($this->form_validation->run() == FALSE)
		{
			redirect('admin/add_person');
		} 
		else
		{
			$this->load->model('model_admin');

			if($this->model_admin->add_persons())
			{
				redirect('admin/add_vehicle');
			}
		}
	}	

	function add_company() 
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Company Name', 'trim|required');
		$this->form_validation->set_rules('address', 'Company Address', 'trim|required');
		

		if($this->form_validation->run() == FALSE)
		{
			redirect('admin/add_company');
		} 
		else
		{
			$this->load->model('model_admin');

			if($this->model_admin->add_companys())
			{
				redirect('admin/add_vehicle');
			}
		}
	}

	function add_bank() 
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Bank Name', 'trim|required');
		$this->form_validation->set_rules('address', 'Bank Address', 'trim|required');
		

		if($this->form_validation->run() == FALSE)
		{
			redirect('admin/add_bank');
		} 
		else
		{
			$this->load->model('model_admin');

			if($this->model_admin->add_banks())
			{
				redirect('admin/add_vehicle');
			}
		}
	}
	
	function update_charge()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|');
		$this->form_validation->set_rules('cost', 'Cost', 'trim|required|numeric');

		if($this->form_validation->run() == FALSE)
		{		
			$this->load->view('admin_header');
			$this->load->view('view_admin_update_charge');
			$this->load->view('admin_footer');
		}
		else
		{
			$this->load->model('model_admin');
			if($this->model_admin->update_charges())
			{
				$this->package();
			}
		}
	}

	function update_rate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('daily', 'Daily', 'trim|required|numeric');
		$this->form_validation->set_rules('weekly', 'Weekly', 'trim|required|numeric');

		if($this->form_validation->run() == FALSE)
		{		
			$this->load->view('admin_header');
			$this->load->view('view_admin_update_rate');
			$this->load->view('admin_footer');
		}
		else
		{
			$this->load->model('model_admin');
			if($this->model_admin->update_rates())
			{
				$this->package();
			}
		}
	}


	function delete_charge() 
	{
		$this->load->model('model_admin');
		$this->model_admin->delete_charges();
		$this->package();
	}
	
	function delete_res() 
	{
		$this->load->model('model_admin');
		$this->model_admin->delete_resv();
		$this->package();
	}

	function schedule()
	{
		$this->load->view('admin_header');
		$this->load->view('view_admin_schedule');
		$this->load->view('admin_footer');
	}

	function reports()
	{
		$this->load->view('admin_header');
		$this->load->view('view_admin_reports');
		$this->load->view('admin_footer');
	}
	
	function returns()
	{
		$this->load->view('admin_header');
		$this->load->view('view_return');
		$this->load->view('admin_footer');
	}
	
	function schedule_details()
	{
		$this->load->model('model_admin');
		$data['rows'] = $this->model_admin->schedule_details();
		
		$this->load->view('admin_header');
		$this->load->view('view_admin_schedule_details', $data);
		$this->load->view('admin_footer');
	}

	
}
