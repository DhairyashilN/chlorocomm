<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login_model extends CI_Model {

	public function chkLogin()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$credential = array('username'=>$username, 'password'=>$password);
		//checking login credentials for super admin
		$query = $this->db->get_where('super_admin', $credential);
		if($query->num_rows() > 0)
		{
			$row = $query->row();
            $this->session->set_userdata('admin_login', '1');
            $this->session->set_userdata('admin_id', $row->id);
            $this->session->set_userdata('login_user_id', $row->id);
            $this->session->set_userdata('name', $row->username);
			$this->session->set_userdata('login_type','Super Admin');
            return 'success';
		}
		//checking login credentials for super admin
		$query = $this->db->get_where('acp_profile', $credential);
		if($query->num_rows() > 0)
		{
			$row = $query->row();
            $this->session->set_userdata('acp_login', '1');
            $this->session->set_userdata('admin_id', $row->acp_id);
            $this->session->set_userdata('login_user_id', $row->acp_id);
            $this->session->set_userdata('name', $row->username);
			$this->session->set_userdata('login_type','ACP');
            return 'success';
		}
		else
		{
			//echo 'Invalid Login';
			$this->session->set_flashdata('invalid','Invalid Login Credentials');
			redirect(base_url());
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */