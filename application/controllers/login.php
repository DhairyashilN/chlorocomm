<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login	 extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
	}

	public function index(){
		$this->load->view('login');
	}
	
	public function validate_login(){
		//store user entered values in variables $username and $password
		$username = $this->input->post('uname');
		$password = $this->input->post('upass');
		if (empty($username) && empty($password)) {
			$this->session->set_flashdata('loginfail','Please Enter username and password');
			redirect(base_url());
		}
		$this->load->library('PasswordHash');
		$credentials = array('username' => $username);
		$query = $this->db->get_where('admin', $credentials);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			if ($this->passwordhash->CheckPassword($password, $row->password)) {
				$this->session->set_userdata('login', '1');
				$this->session->set_userdata('id', $row->id);
				$this->session->set_userdata('name', $row->name);
				$this->session->set_userdata('username', $row->username);
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('loginfail','Incorrect Username & Password');
				redirect(base_url());
			}
		}else{
			$this->session->set_flashdata('loginfail','Incorrect username & Password');
			redirect(base_url());	
		}	
	}
	
	public function dashboard(){
		$this->load->view('dashboard');
	}
	
	public function reset_password(){
		$this->load->view('reset_password');
	}
	
	public function logout(){
		$this->session->unset_userdata();
		$this->session->sess_destroy();
		$this->session->set_flashdata('logout_notification', 'logged_out');
		redirect(base_url());
	}
}
/* End of file login.php */
/* Location: ./application/controllers/login.php */