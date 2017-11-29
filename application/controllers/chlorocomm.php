<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chlorocomm extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		date_default_timezone_set('Asia/Kolkata');
		if($this->session->userdata('login')!=1)
			redirect(base_url());
		$sum=0;
		$this->db->select('no_of_sms');
		$this->db->from('sent_sms_data');
		$result	= $this->db->get()->result_array();
		foreach ($result as $row)
			$sum+=$row['no_of_sms'];
		$SMS = $this->db->get('app_settings')->row();
		if ($SMS->sms_credit == $sum)
			echo '<div class="row app-info text-center" style="color:#fff;background-color:#dc5540">
		<div class="col-lg-12">
		<h2>Your SMS Credit is 0. Please purchase SMS credit.</h2>
		</div>
		</div>';
	}

	public function index() {
		$page_data['page_name'] 	= 'dashboard';
		$this->load->view('dashboard',$page_data);
	}

	/*** Load view page of Categories list  ***/
	public function category() {
		$this->db->where('isdelete',0);
		$this->db->order_by('id','desc');
		$page_data['category'] = $this->db->get('category_tbl')->result_array();
		$page_data['page_name'] = 'add_contact';
		$page_data['page_link_name'] = 'category';
		$this->load->view('category_list',$page_data);
	}

	/*** Load add category form ***/ 
	public function add_category($cat_id='') {
		$page_data['page_name'] = 'add_contact';
		$page_data['page_link_name'] = 'category';
		if (isset($cat_id) && !empty($cat_id)) {
			$this->db->where('id', $cat_id);
			$page_data['ObjCat'] = $this->db->get('category_tbl')->row();
			$this->load->view('add_category',$page_data);
		} else {
			$this->load->view('add_category',$page_data);
		}
	}	

	/*** Create and Update Category in DB ***/ 
	public function store_category($cat_id='') {
		$this->form_validation->set_rules('category_name','Category Name','required');
		if ($this->form_validation->run() == FALSE) {
			$page_data['page_name'] = 'add_contact';
			$page_data['page_link_name'] = 'category';
			$this->load->view('add_category',$page_data);
		} else {
			$page_data['name'] = $this->input->post('category_name');
			if (isset($cat_id) && !empty($cat_id)) {
				$this->db->where('id',$cat_id);
				$this->db->update('category_tbl',$page_data);
				$this->session->set_flashdata('success','Category updated successfully.');
			} else {
				$this->db->insert('category_tbl',$page_data);
				$this->session->set_flashdata('success','Category added successfully.');
			}
			redirect('category');
		}
	}

	/*** Delete Category ***/
	public function delete_category($param2="") {
		$this->db->where('id',$param2);
		$this->db->update('category_tbl',['isdelete'=>1]);
		$this->db->where('category_name',$param2);
		$this->db->update('user_contacts_tbl',['isdelete'=>1]);
		$this->session->set_flashdata('success','Category deleted Successfully.');
		redirect('category');
	}

	/*** Load view page of Categories list ***/
	public function contact_type() {
		$this->db->where('isdelete',0);
		$this->db->order_by('id','desc');
		$page_data['ArrTypes'] = $this->db->get('type_tbl')->result_array();
		$page_data['page_name'] = 'add_contact';
		$page_data['page_link_name'] = 'category';
		$this->load->view('type_list',$page_data);
	}

	/*** Load add category form ***/ 
	public function add_type($type_id='') {
		$page_data['page_name'] = 'add_contact';
		$page_data['page_link_name'] = 'type';
		if (isset($type_id) && !empty($type_id)) {
			$this->db->where('id', $type_id);
			$page_data['ObjType'] = $this->db->get('type_tbl')->row();
			$this->load->view('add_type',$page_data);
		} else {
			$this->load->view('add_type',$page_data);
		}
	}

	/*** Create and Update Type in DB ***/
	public function store_type($type_id='') {
		$this->form_validation->set_rules('type_name','Type Name','required');
		if ($this->form_validation->run() == FALSE) {
			$page_data['page_name'] = 'add_contact';
			$page_data['page_link_name'] = 'type';
			$this->load->view('add_type',$page_data);
		} else {
			$page_data['name'] = $this->input->post('type_name');
			if (isset($type_id) && !empty($type_id)) {
				$this->db->where('id',$type_id);
				$this->db->update('type_tbl',$page_data);
				$this->session->set_flashdata('success','Type updated successfully.');
			} else {
				$this->db->insert('type_tbl',$page_data);
				$this->session->set_flashdata('success','Type added Successfully.');
			}
			redirect('contact_type');
		}
	}

	/**** Load view page of contacts list ****/
	public function contacts() {
		$page_data['page_name'] = 'add_contact';  
		$page_data['page_link_name'] = 'contacts';
		$this->db->where('isdelete',0);
		$this->db->order_by('id','DESC');
		$page_data['ArrContacts'] = $this->db->get('user_contacts_tbl')->result_array();
		$this->db->where('isdelete',0);
		$page_data['ArrCategory'] = $this->db->get('category_tbl')->result_array();
		$this->load->view('contact_list',$page_data);
	}

	/*** Load add contact form ***/ 
	public function add_contact($id='') {
		$page_data['page_name'] = 'add_contact';
		$page_data['page_link_name'] = 'contacts';
		$this->db->where('isdelete',0);
		$page_data['ArrCat']  = $this->db->get('category_tbl')->result_array();
		$this->db->where('isdelete',0);
		$page_data['ArrType'] = $this->db->get('type_tbl')->result_array();
		if (isset($id) && !empty($id)) {
			$this->db->where('id', $id);
			$page_data['ObjContact'] = $this->db->get('user_contacts_tbl')->row();
			$this->load->view('add_contact',$page_data);
		} else {
			$this->load->view('add_contact',$page_data);
		}
	}

	/**** Create and Update contact in DB ****/
	public function store_contact($id='') {
		$this->form_validation->set_rules('category','Category','required');
		$this->form_validation->set_rules('person_name','Name','required');
		$this->form_validation->set_rules('person_mobile','Mobile','required');
		if ($this->form_validation->run() == FALSE) {
			$page_data['page_name'] = 'add_contact';
			$page_data['page_link_name'] = 'contacts';
			$this->db->where('isdelete',0);
			$page_data['ArrCat']  = $this->db->get('category_tbl')->result_array();
			$this->db->where('isdelete',0);
			$page_data['ArrType'] = $this->db->get('type_tbl')->result_array();
			$this->load->view('add_contact',$page_data);
		} else {
			$page_data['category_name']	= $this->input->post('category');
			$page_data['type_name']		= $this->input->post('type');
			$page_data['user_name']		= $this->input->post('person_name');
			$page_data['mobile_no']		= $this->input->post('person_mobile');
			$page_data['email']			= $this->input->post('person_email');
			$page_data['birth_date']	= $this->input->post('dob');
			$page_data['anniversary_date'] = $this->input->post('doa');
			if (isset($id) && !empty($id)) {
				$this->db->where('id',$id);
				$this->db->update('user_contacts_tbl',$page_data);
				$this->session->set_flashdata('success','Contact updated successfully.');
			} else {
				$this->db->insert('user_contacts_tbl',$page_data);
				$this->session->set_flashdata('success','Contact added successfully.');
			}
			redirect('contacts');
		}
	}

	/*** Delete Contact ***/
	public function delete_contact() {
		if(isset($_POST['checked_id'])) {
			$idArr = $_POST['checked_id'];
			//echo '<pre/>';print_r($idArr);die;
			foreach($idArr as $id){
				$this->db->where('id',$id);
				$result = $this->db->update('user_contacts_tbl',['isdelete'=>1]);
			} if ($result) {
				echo json_encode(['success'=>1]);
			}
		}
	}

	public function upload_vcf() {
		$page_data['page_name'] = 'add_contact';
		$page_data['page_link_name'] = 'vcard_upload';
		$this->load->view('upload_contact',$page_data);
	}

	public function import_vcf_contacts() {
		require_once('Contact_Vcard_Parse.php');
		$extension = array("vcf");
		$file_name = $_FILES['file']['name'];
		$ext = pathinfo($file_name,PATHINFO_EXTENSION);
		if(in_array($ext,$extension)) {
			if ($_FILES['file']['tmp_name']) {
				$parse    = new Contact_Vcard_Parse();
				$cardinfo = $parse->fromFile($_FILES['file']['tmp_name']);
				// echo '<pre>';print_r($cardinfo);die;
				foreach($cardinfo as $card) {
					$page_data['category_name']	= $this->input->post('category');
					if(array_key_exists("FN",$card)){
						$page_data['user_name']	= $card['FN'][0]['value'][0][0];
					} if(array_key_exists("TEL",$card)) {
						// echo 'No. '.$i.' '.$mobile = preg_replace('/[^0-9]/','',$card['TEL'][0]['value'][0][0]).'<br/>';
						$mobile = preg_replace('/[^0-9]/','',$card['TEL'][0]['value'][0][0]);
						if(strlen($mobile)==12 && substr($mobile, 0, 2)=="91")
							// echo 'No.'.$i.'- '. $mobile = substr($mobile,2,10).'<br/>';
							$mobile = substr($mobile,2,10);
						if(strlen($mobile)<10)
							$mobile = 0;
						if (!preg_match('/^[7-9][0-9]{9}$/',$mobile)) 
							$mobile = 0;
						$page_data['mobile_no']	= $mobile ;
					} else {
						$page_data['mobile_no'] = 0;
					} if (array_key_exists("EMAIL",$card)){
						$page_data['email']	= $card['EMAIL'][0]['value'][0][0];
					} else {
						$page_data['email']	= '';
					}
					$this->db->insert('user_contacts_tbl',$page_data);
					//$i++;
				}//die;
				//Delete mobile no.s having less than 10 digits;
				$this->db->where('mobile_no',0);
				$this->db->delete('user_contacts_tbl');
				$this->session->set_flashdata('insertsuccess','Contact information added successfully.');
				redirect('chlorocomm/contacts');
			}
		} else { 
			$this->session->set_flashdata('failure','Please select only .vcf format file.');
			redirect('chlorocomm/upload_vcf');
		}

	}

	/*** Load view page of Categories list  ***/
	public function sms_template() {
		$this->db->where('isdelete',0);
		$this->db->order_by('id','desc');
		$page_data['ArrTemplates'] = $this->db->get('sms_templates_tbl')->result_array();
		$page_data['page_name'] = 'sms_settings';
		$page_data['page_link_name'] = 'sms_template';
		$this->load->view('sms_template_list',$page_data);
	}

	/*** Load add sms template form ***/ 
	public function add_sms_template($id='') {
		$page_data['page_name'] = 'sms_settings';
		$page_data['page_link_name'] = 'sms_template';
		if (isset($id) && !empty($id)){
			$this->db->where('id', $id);
			$page_data['ObjTemplate'] = $this->db->get('sms_templates_tbl')->row();
			$this->load->view('add_sms_template',$page_data);
		} else {
			$this->load->view('add_sms_template',$page_data);
		}
	}

	/*** Create and Update SMS Template in DB ***/ 
	public function store_template($id='') {
		$this->form_validation->set_rules('temp_name','Template Name','required');
		$this->form_validation->set_rules('temp_msg','Template Message','required');
		if ($this->form_validation->run() == FALSE) {
			$page_data['page_name'] = 'sms_settings';
			$page_data['page_link_name'] = 'sms_template';
			$this->load->view('add_sms_template',$page_data);
		} else {
			$page_data['sms_type'] = 'festival';
			$page_data['title'] = $this->input->post('temp_name');
			$page_data['message'] = $this->input->post('temp_msg');
			if (isset($id) && !empty($id)) {
				$this->db->where('id',$id);
				$this->db->update('sms_templates_tbl',$page_data);
				$this->session->set_flashdata('success','SMS Template updated successfully.');
			} else {
				$this->db->insert('sms_templates_tbl',$page_data);
				$this->session->set_flashdata('success','SMS Template added successfully.');
			}
			redirect('sms_template');
		}
	}

	/*** Delete Category ***/
	public function delete_template($id="") {
		$this->db->where('id',$id);
		$this->db->update('sms_templates_tbl',['isdelete'=>1]);
		$this->session->set_flashdata('success','SMS Template deleted Successfully.');
		redirect('sms_template');
	}	

	/**** Load SMS View page ****/
	public function send_sms() {
		$page_data['page_name'] = 'sms_section';    
		$page_data['page_link_name'] = 'send_sms'; 
		$this->load->view('send_sms',$page_data);
	}

	public function individual_sms() {
		$page_data['page_name'] = 'sms_section';    
		$page_data['page_link_name'] = 'send_indi_sms'; 
		$this->load->view('send_inidividual_sms',$page_data);
	}

	public function bulk_sms() {
		$page_data['page_name'] = 'sms_section';    
		$page_data['page_link_name'] = 'send_bulk_sms'; 
		$this->load->view('send_bulk_sms',$page_data);
	}

	public function quick_sms() {
		// echo '<pre/>';print_r($this->input->post());die;
		if ($this->input->post('send_sms_btn') == 'send_sms_btn') {
			$receiver =	$this->input->post('receiver');
			$no = explode(",", $receiver);
			$msg_body  = $this->input->post('sms_body_one');
			$sent_date = date('d-m-Y');
			$time = date('H:i:s');
			$user = "chlorodots";    
			$api_key = "70651465-1dfb-4f53-9d5b-6b8786ff073e"; 
			$baseurl ="http://sms.hspsms.com";
			$message = urlencode($msg_body);
			$to     = $receiver;
			$sender = "CHLORO";
			$url = "$baseurl/sendSMS?username=$user&message=$message&sendername=$sender&smstype=TRANS&numbers=$to&apikey=$api_key";    
			//$ret = file_get_contents($url);
			$ret = 1;
			if(isset($ret) && !empty($ret)) {
				foreach ($no as $value) {
					$data 	=	array('sms_recepients'=>$value,'no_of_sms'=>$this->input->post('sms_count'),'sms_body'=>$msg_body,'time'=>$time,'sms_sent_date'=>$sent_date);
					//$this->db->insert('sent_sms_data',$data);
				}
				$this->session->set_flashdata('sms_sent_success','Your SMS has been sent successfully.');
				redirect('send_sms');
			} else {
				$this->session->set_flashdata('sms_sent_success','Your SMS not sent.');
				redirect('send_sms');
			}
		} if ($this->input->post('schedule_sms_btn') == 'schedule_sms_btn') {
			$receiver = $this->input->post('receiver');
			$ArrReceivers = explode(",", $receiver);
			$page_data['sms_type']		 = 'regular';
			$page_data['sms']		 	 = 'quick';
			$page_data['sms_count']		 = $this->input->post('sms_count');
			$page_data['receivers']		 = serialize($ArrReceivers);
			$page_data['sms_body']		 = $this->input->post('sms_body_one');
			$page_data['scheduled_date'] = $this->input->post('schedule_date');
			$page_data['scheduled_time'] = strtotime($this->input->post('schedule_time'));
			$this->db->insert('scheduled_sms_tbl',$page_data);
			$this->session->set_flashdata('sms_sent_success','SMS scheduled successfully.');
			redirect('send_sms');
		}
	}

	public function send_individual_sms() {
		//echo '<pre/>';print_r($this->input->post());die;
		if ($this->input->post('send_sms_btn') == 'send_sms_btn') {
			$receiver 	= $this->input->post('bunch_receiver');
			$msg_body 	= $this->input->post('sms_body_one');
			$sent_date 	= date('d-m-Y');
			$time 		= date('H:i:s');
			$sms_receiver = implode(',', $receiver);
			$user 	 = "chlorodots";    
			$api_key = "70651465-1dfb-4f53-9d5b-6b8786ff073e"; 
			$baseurl ="http://sms.hspsms.com";
			$message = urlencode($msg_body);
			$to 	 = $sms_receiver;
			$sender  = "CHLORO";
			$url     = "$baseurl/sendSMS?username=$user&message=$message&sendername=$sender&smstype=TRANS&numbers=$to&apikey=$api_key";    
			//$ret = file_get_contents($url);
			$ret = 1;
			$data='';
			if(isset($ret) && !empty($ret)) {
				foreach ($receiver as $value) {
					$data 	=	array('sms_recepients'=>$value,'no_of_sms'=>$this->input->post('sms_count'),'sms_body'=>$msg_body,'time'=>$time,'sms_sent_date'=>$sent_date);
					$this->db->insert('sent_sms_data',$data);
				}
			    //print_r($data);die;
				$this->session->set_flashdata('sms_sent_success','Your SMS has been sent successfully.');
				redirect('send_individual');
			} else {
				$this->session->set_flashdata('sms_sent_success','Your SMS not sent.');
				redirect('send_individual');
			}
		} if ($this->input->post('schedule_sms_btn') == 'schedule_sms_btn') {
			$page_data['sms_type']		 = 'regular';
			$page_data['sms']		 	 = 'individual';
			$page_data['sms_count']		 = $this->input->post('sms_count');
			$page_data['receivers']		 = serialize($this->input->post('bunch_receiver'));
			$page_data['sms_body']		 = $this->input->post('sms_body_one');
			$page_data['scheduled_date'] = $this->input->post('schedule_date');
			$page_data['scheduled_time'] = strtotime($this->input->post('schedule_time'));
			$this->db->insert('scheduled_sms_tbl',$page_data);
			$this->session->set_flashdata('sms_sent_success','SMS scheduled successfully.');
			redirect('scheduled_sms');
		}
	}

	public function send_bulk_sms() {
		// echo '<pre/>';print_r($this->input->post());die;
		if ($this->input->post('send_sms_btn') == 'send_sms_btn') {
			$receiver 	= $this->input->post('bunch_receiver');
			$msg_body 	= $this->input->post('sms_body_one');
			$this->db->select('mobile_no');
			$this->db->where('category_name',$receiver);
			$ArrMobiles = $this->db->get('user_contacts_tbl')->result_array();
			$ArrMobileNo =array();
			for($i=0;$i < count($ArrMobiles);$i++){
				$mobno = $ArrMobiles[$i]['mobile_no'];
				array_push($ArrMobileNo, $mobno);
			}
			$user 	 = "chlorodots";    
			$api_key = "70651465-1dfb-4f53-9d5b-6b8786ff073e";
			$baseurl = "http://sms.hspsms.com";
			$message = urlencode($msg_body);
			$to 	 = implode(',', $ArrMobileNo);
			$sender  = "CHLORO";
			$url = "$baseurl/sendSMS?username=$user&message=$message&sendername=$sender&smstype=TRANS&numbers=$to&apikey=$api_key";    
			//$ret = file_get_contents($url);
			$ret = 1;
			$data='';
			if(isset($ret) && !empty($ret)) {
				foreach ($ArrMobileNo as $value) {
					$data 	=	array('sms_recepients'=>$value,'no_of_sms'=>$this->input->post('sms_count'),'sms_body'=>$msg_body,'time'=>date('H:i:s'),'sms_sent_date'=>date('d-m-Y'));
					$this->db->insert('sent_sms_data',$data);
				}
				$this->session->set_flashdata('sms_sent_success','Your SMS has been sent successfully.');
				redirect('send_bulk');
			} else{
				$this->session->set_flashdata('sms_sent_success','Your SMS not sent.');
				redirect('send_bulk');
			}
		} if ($this->input->post('schedule_sms_btn') == 'schedule_sms_btn') {
			$page_data['sms_type']		 = 'regular';
			$page_data['sms']		 	 = 'bulk';
			$page_data['sms_count']		 = $this->input->post('sms_count');
			$page_data['receivers']		 = $this->input->post('bunch_receiver');
			$page_data['sms_body']		 = $this->input->post('sms_body_one');
			$page_data['scheduled_date'] = $this->input->post('schedule_date');
			$page_data['scheduled_time'] = strtotime($this->input->post('schedule_time'));
			$this->db->insert('scheduled_sms_tbl',$page_data);
			$this->session->set_flashdata('sms_sent_success','SMS scheduled successfully.');
			redirect('send_bulk');
		}
	}

	/*** View list of scheduled SMS ***/ 
	public function scheduled_sms() {
		$this->db->where('sms_type','regular');
		$this->db->where('isdelete',0);
		$this->db->order_by('id','desc');
		$page_data['ArrSMS'] = $this->db->get('scheduled_sms_tbl')->result_array();
		$page_data['page_name'] = 'sms_section';
		$page_data['page_link_name'] = 'schedule_sms';
		$this->load->view('scheduled_sms_list',$page_data);
	}

	/*** Load view page of Categories list  ***/
	public function schedule_festival_sms() {
		$this->db->where('sms_type','festival');
		$this->db->where('isdelete',0);
		$this->db->order_by('id','desc');
		$page_data['ArrSMS'] = $this->db->get('scheduled_sms_tbl')->result_array();
		$page_data['page_name'] = 'schedule_sms_section';
		$this->load->view('festival_sms_list',$page_data);
	}

	/*** Load schedule festival sms form ***/ 
	public function add_fetival_sms($id='') {
		$page_data['page_name'] = 'schedule_sms_section';
		$this->db->where('isdelete',0);
		$this->db->where('sms_type','festival');
		$page_data['ArrTemplates'] = $this->db->get('sms_templates_tbl')->result_array();
		if (isset($id) && !empty($id)) {
			$this->db->where('id', $id);
			$page_data['ObjSchedule'] = $this->db->get('scheduled_sms_tbl')->row();
			$this->load->view('add_festival_sms',$page_data);
		} else {
			$this->load->view('add_festival_sms',$page_data);
		}
	}

	/**** Create and Update schedule SMS in DB ****/
	public function store_festival_sms($id='') {
		$this->form_validation->set_rules('sms_body_one','SMS Body','required');
		$this->form_validation->set_rules('schedule_date','SMS Schedule Date','required');
		$this->form_validation->set_rules('schedule_time','SMS Schedule Time','required');
		if ($this->form_validation->run() == FALSE) {
			$page_data['page_name'] = 'schedule_sms_section';
			$this->db->where('isdelete',0);
			$this->db->where('sms_type','regular');
			$page_data['ArrTemplates']  = $this->db->get('sms_templates_tbl')->result_array();
			$this->load->view('add_festival_sms',$page_data);
		} else {
			$page_data['sms_type']		 = 'festival';
			$page_data['sms_body']		 = $this->input->post('sms_body_one');
			$page_data['sms_template']	 = $this->input->post('sms_template');
			$page_data['sms_count']		 = $this->input->post('sms_count');
			$page_data['scheduled_date'] = $this->input->post('schedule_date');
			$page_data['scheduled_time'] = strtotime($this->input->post('schedule_time'));
			if (isset($id) && !empty($id)) {
				$this->db->where('id',$id);
				$this->db->update('scheduled_sms_tbl',$page_data);
				$this->session->set_flashdata('success','Festival SMS schedule updated successfully.');
			} else {
				$this->db->insert('scheduled_sms_tbl',$page_data);
				$this->session->set_flashdata('success','Festival SMS scheduled successfully.');
			}
			redirect('schedule_festival_sms');
		}
	}

	/**** Delete Scheduled SMS ****/ 
	public function delete_festival_sms($id='') {
		if (isset($id) && !empty($id)) {
			$this->db->where('id',$id);
			$this->db->update('scheduled_sms_tbl',['isdelete'=>1]);
			$this->session->set_flashdata('success', 'Festival SMS deleted successfully.');
			redirect('schedule_festival_sms','refresh');
		}
	}

	/*** Load schedule regular sms form ***/ 
	public function add_schedule_sms($id='') {
		$page_data['page_name'] = 'sms_section';
		$page_data['page_link_name'] = 'schedule_sms';
		if (isset($id) && !empty($id)) {
			$this->db->where('id', $id);
			$page_data['ObjSchedule'] = $this->db->get('scheduled_sms_tbl')->row();
			$this->load->view('add_schedule_sms',$page_data);
		} else {
			$this->load->view('add_schedule_sms',$page_data);
		}
	}

	/**** Create and Update schedule SMS in DB ****/
	public function store_scheduled_sms($id='') {
	// echo '<pre/>';print_r($_POST);die;
		$this->form_validation->set_rules('sms_body_one','SMS Body','required');
		$this->form_validation->set_rules('schedule_date','SMS Schedule Date','required');
		$this->form_validation->set_rules('schedule_time','SMS Schedule Time','required');
		if ($this->form_validation->run() == FALSE) {
			$page_data['page_name'] = 'schedule_sms_section';
			$page_data['page_link_name'] = 'regular_sms';
			$this->load->view('add_regular_sms',$page_data);
		} else {
			$page_data['sms_type'] = 'regular';
			$page_data['sms'] = $this->input->post('sms');
			if ($this->input->post('sms')!="" && $this->input->post('sms') == 'quick') {
				$receiver = $this->input->post('receiver');
				$ArrReceivers = explode(",", $receiver);
				$page_data['receivers']	 = serialize($ArrReceivers);
			} if ($this->input->post('sms')!="" && $this->input->post('sms') == 'individual') {
				$page_data['receivers']	 = serialize($this->input->post('bunch_receiver'));
			} if ($this->input->post('sms')!="" && $this->input->post('sms') == 'bulk') {
				$page_data['receivers']	 = $this->input->post('bunch_receiver');
			}
			$page_data['sms_body']		 = $this->input->post('sms_body_one');
			$page_data['sms_count']		 = $this->input->post('sms_count');
			$page_data['scheduled_date'] = $this->input->post('schedule_date');
			$page_data['scheduled_time'] = strtotime($this->input->post('schedule_time'));
			if (isset($id) && !empty($id)) {
				$this->db->where('id',$id);
				$this->db->update('scheduled_sms_tbl',$page_data);
				$this->session->set_flashdata('success','SMS schedule updated successfully.');
			} else {
				$this->db->insert('scheduled_sms_tbl',$page_data);
				$this->session->set_flashdata('success','SMS scheduled successfully.');
			}
			redirect('scheduled_sms');
		}
	}

	/**** Delete Scheduled SMS ****/ 
	public function delete_scheduled_sms($id='') {
		if (isset($id) && !empty($id)) {
			$this->db->where('id',$id);
			$this->db->update('scheduled_sms_tbl',['isdelete'=>1]);
			$this->session->set_flashdata('success', 'Scheduled SMS deleted successfully.');
			redirect('scheduled_sms','refresh');
		}
	}	

//********************** Statistics of sent emails and SMS *************************//	
	/*** Displays SMS statistics view ***/
	public function sms_statistics(){
		$page_data['page_name'] = 'statistics';    
		$page_data['page_link_name'] = 'sms_statistics';    
		$this->load->view('sms_statistics',$page_data);
	}

	/*** View statistics of sent SMS ***/
	public function view_sent_sms_satistics() {
		$from =	$this->input->post('from_date');
		$to	= $this->input->post('to_date');
		$this->db->where('sms_sent_date >=', $from);
		$this->db->where('sms_sent_date <=', $to);
		$page_data['sms_stats'] = $this->db->get('sent_sms_data')->result_array();
		$page_data['page_name'] = 'sms_statistics'; 
		$this->load->view('sms_statistics',$page_data);
	}

	public function calculator() {
		$page_data['page_name'] = 'calculator';
		$this->load->view('calculater', $page_data);
	}
	
	public function calendar() {
		$page_data['page_name'] = 'calendar';
		$this->load->view('calendar', $page_data);
	}

//**************************************** Change password *********************************************************//
	/*** Displays the view file ***/
	public function edit_profile() {
		$page_data['details'] = $this->db->get('admin')->result_array();
		$page_data['page_name'] = 'edit_profile';
		$this->load->view('admin_profile',$page_data);
	}

	/*** Change Password ***/
	public function change_password() {
		$this->load->library('PasswordHash');
		$data['password']             = $this->input->post('password');
		$data['new_password']         = $this->input->post('newpassword');
		$data['confirm_new_password'] = $this->input->post('cpassword');
		$data['contact'] = $this->input->post('contact');
		$current_pass = $this->db->get_where('admin', array('id' => $this->session->userdata('id')))->row()->password;
			//echo $current_pass;die;
		if (!empty($data['password'])) {
			if ($data['new_password'] == $data['confirm_new_password']) {
				$this->db->where('id', $this->session->userdata('id'));
				$this->db->update('admin', array('password' =>  $this->passwordhash->HashPassword($data['new_password']), 'contact'=>$data['contact']));
				$this->session->set_flashdata('flash_message','password updated successfully');
			} else {
				$this->session->set_flashdata('flash_message','password mismatch');
			}
		} else {
			$this->db->where('id', $this->session->userdata('id'));
			$this->db->update('admin', array('contact'=>$data['contact']));
			$this->session->set_flashdata('flash_message','Contact No updated successfully');
		}
		redirect('profile');
	}


	/*** AJAX call function ***/
	public function getTemplateMsg() {
		$this->db->select('message');
		$this->db->from('sms_templates_tbl');
		$this->db->where('id',$this->input->post('id'));
		$ObjMsg = $this->db->get()->row();
		echo json_encode($ObjMsg);
	} 

	public function getCatRecords() {
		if ($this->input->post('category') == "") 
			redirect('contacts','refresh');
		$page_data['page_name'] = 'add_contact';  
		$page_data['page_link_name'] = 'contacts';
		$this->db->where('category_name',$this->input->post('category'));
		$this->db->where('isdelete',0);
		$this->db->order_by('id','DESC');
		$page_data['ArrContacts'] = $this->db->get('user_contacts_tbl')->result_array();
		$this->db->where('isdelete',0);
		$page_data['ArrCategory'] = $this->db->get('category_tbl')->result_array();
		$page_data['CatContacts'] = 'Set';
		$this->load->view('contact_list',$page_data);
	}

	public function get_templates() {
		$this->db->where('type',$this->input->post('type'));
		$ObjMsg = $this->db->get('sms_templates_tbl')->result_array();
		echo json_encode($ObjMsg);
	} 

	public function check_mobile_no() {
		if (!preg_match('/^[789]\d{9}$/', $this->input->post('mobile_no'))) {
			echo json_encode(['length_error'=>1]);
		} else {
			$this->db->select('mobile_no');
			$this->db->from('user_contacts_tbl');
			$this->db->where('mobile_no',$this->input->post('mobile_no'));
			$OjMobileNo = $this->db->get();
			if ($OjMobileNo->num_rows() >= 1) {
				echo json_encode(['success'=>1]);
			}else{
				echo json_encode(['success'=>0]);
			}
		}
	}

	public function vcard_export() {
		$contactData = '{
			"data": [
				{
					"name": "User Name 1",
					"mobile_number": "9898098980",
					"email_address": "user1@domain.com"
				}
			]
		}';
		$userContacts = json_decode($contactData);
		$dataArray = '';
		foreach($userContacts as $contact){
			for($i=0; $i<sizeof($contact);$i++){
				$fullname = $contact[$i]->name;
				$fullnameArray = explode(" ",$fullname);
				$first_name = $fullnameArray[0];
				$last_name = $fullnameArray[1];
				$mobile_number = $contact[$i]->mobile_number;
				$email_address= $contact[$i]->email_address;
				$dataArray .="BEGIN:VCARD\nN:$first_name;$last_name\nFN:$first_name\nTEL:$mobile_number;TYPE=WORK,MSG;\nEMAIL;TYPE=INTERNET:$email_address\nEND:VCARD\n";
			}
		}
		$data = $dataArray;
		// echo '<pre/>';print_r($dataArray);die;
		$size = strlen($data);
		$filename = "contact.vcf";
		header("Content-Type: application/octet-stream");
		header("Content-Length: $size");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Transfer-Encoding: binary");
		return $data;
	}
	//echo vcard_export($contactData);

	/*TESTING*/
	public function test_report(){
		// $url = "http://sms.hspsms.com/getDLRReport?username=chlorodots&apikey=70651465-1dfb-4f53-9d5b-6b8786ff073e&from=2017-10-10&to=2017-10-11&sendername=CHLORO";    
		// $ret = file_get_contents($url);
		// echo '<pre/>';print_r($ret);
	}
}
/* End of file Chlorocomm.php */
/* Location: ./application/controllers/Chlorocomm.php */