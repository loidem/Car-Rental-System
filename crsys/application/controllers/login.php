<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	function _remap($method)
	{
		switch( $method )
		{
			case 'index':
				$this->index();
				break;
			case 'session':
				$this->session();
				break;
			default:
				show_404();;
				break;
		}
	}
	
	public function index($msg = NULL) {
		$data['msg'] = $msg;
		$this->load->view('header');
		$this->load->view('view_login', $data);
		$this->load->view('footer');
		
	}

	public function session() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');

		    if($this->form_validation->run() == FALSE) {
		        $msg = validation_errors();
		        $this->index($msg);
		    } else {
		        $this->load->model('model_user');
		        $query = $this->model_user->validate();
			
		    	if($query) {
		        	redirect(base_url() . "profile");
		    	} else {
		        	$msg = "Invalid combination. <br>";
		        	$this->index($msg);
		    	}
				//echo $query;
				
				
		    }
	}
}

?>