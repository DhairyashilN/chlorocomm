<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EnquiryController extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		date_default_timezone_set('Asia/Kolkata');
		if($this->session->userdata('login')!=1){
			redirect(base_url());
		}
	}

	public function customer_enquiries(){
		$page_data['page_name'] = 'customer_enquiry';
		$this->db->where('isdelete',0);
		$this->db->order_by('id', 'desc');		
		$page_data['ArrEnquiry'] = $this->db->get('customer_enquiries_tbl')->result_array();
		$this->load->view('customer_enquiries_list',$page_data);
	}

	/*** Load add enquiry form ***/
	public function add_enquiry($id=''){
		$page_data['page_name'] = 'customer_enquiry';
		if (isset($id) && !empty($id)){
			$this->db->where('id', $id);
			$page_data['ObjEnquiry'] = $this->db->get('customer_enquiries_tbl')->row();
			$this->load->view('add_enquiry',$page_data);
		}else{
			$this->load->view('add_enquiry',$page_data);
		}
	}

	/*** Store and Update Enquiry in DB ***/
	public function store_enquiry($id=''){
		$this->form_validation->set_rules('cname','Customer Name','required');
		$this->form_validation->set_rules('details','Details','required');
		$this->form_validation->set_rules('enq_date','Enquiry Date','required');
		$this->form_validation->set_rules('enq_time','Enquiry Time','required');
		if ($this->form_validation->run() == FALSE) {
			$page_data['page_name'] = 'customer_enquiry';
			$this->load->view('add_enquiry',$page_data);
		} else {
			$page_data['name']       = $this->input->post('cname');
			$page_data['details']    = $this->input->post('details');
			$page_data['enq_date']   = $this->input->post('enq_date');
			$page_data['enq_time']   = strtotime($this->input->post('enq_time'));
			$page_data['sms_notify'] = $this->input->post('notify_sms');
			$page_data['sms_count']  = $this->input->post('sms_count');
			if (isset($id) && !empty($id)) {
				$this->db->where('id',$id);
				$this->db->update('customer_enquiries_tbl',$page_data);
				$this->session->set_flashdata('success','Enquiry updated successfully.');
			} else {
				$this->db->insert('customer_enquiries_tbl',$page_data);
				$this->session->set_flashdata('success','Enquiry added successfully.');
			}
			redirect('customer_enquiry');
		}
	}

	/*** Delete Category ***/
	public function delete_enquiry($id=""){
		$this->db->where('id',$id);
		$this->db->update('customer_enquiries_tbl',['isdelete'=>1]);
		$this->session->set_flashdata('success','Enquiry deleted Successfully.');
		redirect(site_url('customer_enquiry'));
	}

	/*** Load list of Reminders ***/
	public function personal_reminder(){
		$page_data['page_name'] = 'personal_reminder';
		$this->db->where('isdelete',0);		
		$this->db->order_by('id', 'desc');	
		$page_data['ArrReminder'] = $this->db->get('reminder_tbl')->result_array();
		$this->load->view('reminder_list',$page_data);
	}

	/*** Load add reminder form ***/
	public function add_reminder($id=''){
		$page_data['page_name'] = 'personal_reminder';
		if (isset($id) && !empty($id)){
			$this->db->where('id', $id);
			$page_data['ObjReminder'] = $this->db->get('reminder_tbl')->row();
			$this->load->view('add_reminder',$page_data);
		}else{
			$this->load->view('add_reminder',$page_data);
		}
	}

	/*** Store and Update Reminder in DB ***/
	public function store_reminder($id=''){
		$this->form_validation->set_rules('title','Customer Name','required');
		$this->form_validation->set_rules('details','Details','required');
		$this->form_validation->set_rules('rem_date','Enquiry Date','required');
		$this->form_validation->set_rules('rem_time','Enquiry Time','required');
		if ($this->form_validation->run() == FALSE) {
			$page_data['page_name'] = 'personal_reminder';
			$this->load->view('add_enquiry',$page_data);
		} else {
			$page_data['title']      = $this->input->post('title');
			$page_data['details']    = $this->input->post('details');
			$page_data['rem_date']   = $this->input->post('rem_date');
			$page_data['rem_time']   = strtotime($this->input->post('rem_time'));
			$page_data['sms_notify'] = $this->input->post('notify_sms');
			$page_data['sms_count']  = $this->input->post('sms_count');
			if (isset($id) && !empty($id)) {
				$this->db->where('id',$id);
				$this->db->update('reminder_tbl',$page_data);
				$this->session->set_flashdata('success','Reminder updated successfully.');
			} else {
				$this->db->insert('reminder_tbl',$page_data);
				$this->session->set_flashdata('success','Reminder added successfully.');
			}
			redirect('personal_reminder');
		}
	}

	/*** Delete Reminder ***/
	public function delete_reminder($id=""){
		$this->db->where('id',$id);
		$this->db->update('reminder_tbl',['isdelete'=>1]);
		$this->session->set_flashdata('success','Reminder deleted Successfully.');
		redirect(site_url('personal_reminder'));
	}
}
/* End of file EnquiryController.php */
/* Location: ./application/controllers/EnquiryController.php */