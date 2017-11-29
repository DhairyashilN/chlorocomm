<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MoneyController extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		if($this->session->userdata('login')!=1){
			redirect(base_url());
		}
	}

	public function dues(){
		$page_data['page_name'] = 'my_dues';
		$this->db->where('isdelete',0);
		$this->db->order_by('id', 'desc');		
		$page_data['ArrDues'] = $this->db->get('dues_tbl')->result_array();
		$this->load->view('mydues_list',$page_data);
	}

	/*** Load add due amount form ***/
	public function add_due_amount($id=''){
		$page_data['page_name'] = 'my_dues';
		if (isset($id) && !empty($id)){
			$this->db->where('id', $id);
			$page_data['ObjDue'] = $this->db->get('dues_tbl')->row();
			$this->load->view('add_dues',$page_data);
		}else{
			$this->load->view('add_dues',$page_data);
		}
	}

	/*** Store and update Dues ***/
	public function store_due_details($id=''){
		$this->form_validation->set_rules('dname','Name','required');
		$this->form_validation->set_rules('amount','Due Amount','required');
		$this->form_validation->set_rules('due_details','Due Details','required');
		if ($this->form_validation->run() == FALSE) {
			$page_data['page_name'] = 'my_dues';
			$this->load->view('add_dues',$page_data);
		} else {
			$page_data['person_name'] = $this->input->post('dname');
			$page_data['due_amount']  = $this->input->post('amount');
			$page_data['due_details'] = $this->input->post('due_details');
			if (isset($id) && !empty($id)) {
				$this->db->where('id',$id);
				$this->db->update('dues_tbl',$page_data);
				$this->session->set_flashdata('success','Dues updated successfully.');
			} else {
				$this->db->insert('dues_tbl',$page_data);
				$this->session->set_flashdata('success','Dues added successfully.');
			}
			redirect('dues');
		}
	}

	/*** Delete Dues ***/
	public function delete_due_details($id="") {
		$this->db->where('id',$id);
		$this->db->update('dues_tbl',['isdelete'=>1]);
		$this->session->set_flashdata('success','Dues deleted Successfully.');
		redirect('dues');
	}

	public function debtors() {
		$page_data['page_name'] = 'my_debtors';
		$this->db->where('isdelete',0);
		$this->db->order_by('id', 'desc');		
		$page_data['ArrDebtors'] = $this->db->get('debtors_tbl')->result_array();
		$this->load->view('mydebtors_list',$page_data);
	}

	/*** Load add debt amount form ***/
	public function add_debt_amount($id='') {
		$page_data['page_name'] = 'my_debtors';
		if (isset($id) && !empty($id)){
			$this->db->where('id', $id);
			$page_data['ObjDebt'] = $this->db->get('debtors_tbl')->row();
			$this->load->view('add_debts',$page_data);
		}else{
			$this->load->view('add_debts',$page_data);
		}
	}

	/*** Add and Update Debts ***/
	public function store_debt_details($id='') {
		$this->form_validation->set_rules('dname','Name','required');
		$this->form_validation->set_rules('amount','Due Amount','required');
		$this->form_validation->set_rules('due_details','Due Details','required');
		if ($this->form_validation->run() == FALSE) {
			$page_data['page_name'] = 'my_debts';
			$this->load->view('add_debts',$page_data);
		} else {
			$page_data['person_name'] = $this->input->post('dname');
			$page_data['debt_amount']  = $this->input->post('amount');
			$page_data['debt_details'] = $this->input->post('due_details');
			if (isset($id) && !empty($id)) {
				$this->db->where('id',$id);
				$this->db->update('debtors_tbl',$page_data);
				$this->session->set_flashdata('success','Debts updated successfully.');
			} else {
				$this->db->insert('debtors_tbl',$page_data);
				$this->session->set_flashdata('success','Debts added successfully.');
			}
			redirect('debtors');
		}
	}

	/*** Delete Debt ***/
	public function delete_debt_details($id="") {
		$this->db->where('id',$id);
		$this->db->update('debtors_tbl',['isdelete'=>1]);
		$this->session->set_flashdata('success','Debtors deleted Successfully.');
		redirect('debtors');
	}
	
}
/* End of file MoneyController.php */
/* Location: ./application/controllers/MoneyController.php */