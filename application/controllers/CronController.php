<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CronController extends CI_Controller {
	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
	}

	public function send_regular_sms() {
		// SMS API Config
		$sent_date = date('d-m-Y');
		$time    = strtotime(date('h:i:s'));
		$user    = "chlorodots";    
		$api_key = "70651465-1dfb-4f53-9d5b-6b8786ff073e"; 
		$baseurl = "http://sms.hspsms.com";

		$this->db->select('scheduled_date,scheduled_time,receivers,sms_body,sms,sms_count');
		$this->db->from('scheduled_sms_tbl');
		$this->db->where('sms_type','regular');
		$ArrSchedule = $this->db->get()->result_array();
		// echo '<pre/>';print_r($schedule);die;
		if (isset($ArrSchedule) && !empty($ArrSchedule)) {
			foreach ($ArrSchedule as $srow) {
				$a 		= explode('-',$srow['scheduled_date']);
				$day 	= date('d');
				$month 	= date('m');
				if ($day == $a[0] && $month == $a[1]) {
					if (date('h:i A',$srow['scheduled_time']) == date('h:i A')) {
					// echo 'matching';
						if ($srow['sms'] == 'quick') {
							$nos = unserialize($srow['receivers']);
							$mobile_nos = implode(',',unserialize($srow['receivers']));
						// echo '<pre/>';print_r($receiver);
							$ArrNos = $nos;
							$message = urlencode($srow['sms_body']);
							$to      = $mobile_nos;
							$sender  = "CHLORO";
							$url     = "$baseurl/sendSMS?username=$user&message=$message&sendername=$sender&smstype=TRANS&numbers=$to&apikey=$api_key";
						// echo $url;die;    
						// $ret = file_get_contents($url); // Send SMS 
							$ret = 1;
							if(isset($ret) && !empty($ret)) {
								foreach ($ArrNos as $nrow) {
									$data =	array('sms_recepients'=>$nrow,'no_of_sms'=>$srow['sms_count'],'sms_body'=>$srow['sms_body'],'time'=>$time,'sms_sent_date'=>$sent_date);
								// store sent sms record in  DB.
									$this->db->insert('sent_sms_data',$data);
								}
							} else {
								echo 'SMS not sent.';
							}
						} if ($srow['sms'] == 'individual') {
							$nos = unserialize($srow['receivers']);
							$mobile_nos = implode(',',unserialize($srow['receivers']));
						// echo '<pre/>';print_r($receiver);
							$ArrNos = $nos;
							$message = urlencode($srow['sms_body']);
							$to      = $mobile_nos;
							$sender  = "CHLORO";
							$url     = "$baseurl/sendSMS?username=$user&message=$message&sendername=$sender&smstype=TRANS&numbers=$to&apikey=$api_key";
						// echo $url;die;    
						// $ret = file_get_contents($url); // Send SMS 
							$ret = 1;
							if(isset($ret) && !empty($ret)) {
								foreach ($ArrNos as $nrow) {
									$data =	array('sms_recepients'=>$nrow,'no_of_sms'=>$srow['sms_count'],'sms_body'=>$srow['sms_body'],'time'=>$time,'sms_sent_date'=>$sent_date);
								// store sent sms record in  DB.
									$this->db->insert('sent_sms_data',$data);
								}
							} else {
								echo 'SMS not sent.';
							}
						} if ($srow['sms'] == 'bulk') {
							$mobile_nos = $srow['receivers'];
						// echo '<pre/>';print_r($mobile_nos);
							$this->db->select('mobile_no');
							$this->db->where('category_name',$mobile_nos);
							$ArrMobiles  = $this->db->get('user_contacts_tbl')->result_array();
							$ArrMobileNo = array();
							for($i=0;$i < count($ArrMobiles);$i++) {
								$mobno = $ArrMobiles[$i]['mobile_no'];
								array_push($ArrMobileNo, $mobno);
							}
    					// echo '<pre>';print_r($ArrMobileNo);die;
							$message = urlencode($srow['sms_body']);
							$to      = implode(',', $ArrMobileNo);;
							$sender  = "CHLORO";
							$url     = "$baseurl/sendSMS?username=$user&message=$message&sendername=$sender&smstype=TRANS&numbers=$to&apikey=$api_key";
						// echo $url;die;    
						// $ret = file_get_contents($url); // Send SMS 
							$ret = 1;
							if(isset($ret) && !empty($ret)) {
								foreach ($ArrMobileNo as $nrow) {
									$data =	array('sms_recepients'=>$nrow,'no_of_sms'=>$srow['sms_count'],'sms_body'=>$srow['sms_body'],'time'=>$time,'sms_sent_date'=>$sent_date);
								// store sent sms record in  DB.
									$this->db->insert('sent_sms_data',$data);
								}
							} else {
								echo 'SMS not sent.';
							}
						}
					}
				} 
			}
		}
	}

	public function send_festival_sms() {
		// SMS API Config
		$sent_date = date('d-m-Y');
		$time    = strtotime(date('h:i:s'));
		$user    = "chlorodots";    
		$api_key = "70651465-1dfb-4f53-9d5b-6b8786ff073e"; 
		$sender  = "CHLORO";
		$baseurl = "http://sms.hspsms.com";

		$this->db->select('scheduled_date,scheduled_time,sms_body,sms_count');
		$this->db->from('scheduled_sms_tbl');
		$this->db->where('sms_type','festival');
		$this->db->where('isdelete',0);
		$ArrSchedule = $this->db->get()->result_array();
		// echo '<pre/>';print_r($ArrSchedule);die;
		$this->db->select('mobile_no');
		$this->db->from('user_contacts_tbl');
		$this->db->where('isdelete',0);
		$ArrMobileNo = $this->db->get()->result_array();
		// echo '<pre/>';print_r($ArrMobileNo);//die;
		foreach ($ArrMobileNo as $mob) 
			$ArrMobiles[] = $mob['mobile_no'];
		$mobile_nos = implode(',',$ArrMobiles);
		if (isset($ArrSchedule) && !empty($ArrSchedule)) {
			foreach ($ArrSchedule as $srow) {
				$a 		= explode('-',$srow['scheduled_date']);
				$day 	= date('d');
				$month 	= date('m');
				if ($day == $a[0] && $month == $a[1]) {
					// match current time with DB stored
					if (date('h:i A',$srow['scheduled_time']) == date('h:i A')) { 
						$message = urlencode($srow['sms_body']);
						$to      = $mobile_nos;
						$url     = "$baseurl/sendSMS?username=$user&message=$message&sendername=$sender&smstype=TRANS&numbers=$to&apikey=$api_key";
						// echo $url;die;    
						// $ret = file_get_contents($url); // Send SMS 
						$ret = 1;
						if(isset($ret) && !empty($ret)) {
							foreach ($ArrMobiles as $nrow) {
								$data =	array('sms_recepients'=>$nrow,'no_of_sms'=>$srow['sms_count'],'sms_body'=>$srow['sms_body'],'time'=>$time,'sms_sent_date'=>$sent_date);
							// store sent sms record in  DB.
								$this->db->insert('sent_sms_data',$data);
							}
						} else {
							echo 'SMS not sent.';
						}
					}
				} else {
					// echo 'date not match';
				}
			} 
		}
	}

	/*** Send Scheduled SMS for Customer Enquiry ***/
	public function send_enquiry_sms() {
		// Get user data.
		$this->db->select('contact');
		$this->db->from('admin');
		$ObjUser = $this->db->get()->row();
		// Get Enquiry date,time,details and sms count.
		$this->db->select('enq_date,enq_time,details,sms_count');
		$this->db->from('customer_enquiries_tbl');
		$this->db->where('sms_notify',1);
		$this->db->where('isdelete',0);
		$ArrEnqSms = $this->db->get()->result_array();
		if (isset($ArrEnqSms) && !empty($ArrEnqSms)) {
			foreach ($ArrEnqSms as $value) {
				$a 		= explode('-',$value['enq_date']);
				$day 	= date('d');
				$month 	= date('m');
				// match today's date with DB stored date.
				if ($day == $a[0] && $month == $a[1]) { 
						// match current time with DB stored
					if (date('h:i A',$value['enq_time']) == date('h:i A')) { 
						$nos = explode(' ', $ObjUser->contact);
						$sent_date = date('d-m-Y');
						$time    = strtotime(date('h:i:s'));
						$user    = "chlorodots";    
						$api_key = "70651465-1dfb-4f53-9d5b-6b8786ff073e"; 
						$baseurl = "http://sms.hspsms.com";
						$message = urlencode($value['details']);
						$to      = $ObjUser->contact;
						$sender  = "CHLORO";
						$url     = "$baseurl/sendSMS?username=$user&message=$message&sendername=$sender&smstype=TRANS&numbers=$to&apikey=$api_key"; 
						// Send SMS    
						$ret = file_get_contents($url); 
						if(isset($ret) && !empty($ret)) {
							foreach ($nos as $row) {
								$data =	array('sms_recepients'=>$row,'no_of_sms'=>$value['sms_count'],'sms_body'=>$value['details'],'time'=>$time,'sms_sent_date'=>$sent_date);
									// store sent sms record in  DB.
								$this->db->insert('sent_sms_data',$data);
							}
						} else {
							echo 'SMS not sent.';
						}
					} else {
						echo 'time not matched'.'<br/>';
					}
				} else {
					echo 'date not match';
				} 
			}
		}
	}

	/*** Send Scheduled SMS for Customer Enquiry ***/
	public function send_reminder_sms() {
		$this->db->select('contact');
		$this->db->from('admin');
		// Get user data.
		$ObjUser = $this->db->get()->row();
		$this->db->select('rem_date,rem_time,details,sms_count');
		$this->db->from('reminder_tbl');
		$this->db->where('sms_notify',1);
		$this->db->where('isdelete',0);
		// Get Reminder date,time,details and sms count.
		$ArrRemSms = $this->db->get()->result_array();
		if (isset($ArrRemSms) && !empty($ArrRemSms)) {
			foreach ($ArrRemSms as $value) {
				$a 		= explode('-',$value['rem_date']);
				$day 	= date('d');
				$month 	= date('m');
				// match today's date with DB stored date.
				if ($day == $a[0] && $month == $a[1]) { 
					// match current time with DB stored time.
					if (date('h:i A',$value['rem_time']) == date('h:i A')) { 
						$nos = explode(' ', $ObjUser->contact);
						$sent_date = date('d-m-Y');
						$time    = strtotime(date('h:i:s'));
						$user    = "chlorodots";    
						$api_key = "70651465-1dfb-4f53-9d5b-6b8786ff073e"; 
						$baseurl = "http://sms.hspsms.com";
						$message = urlencode($value['details']);
						$to      = $ObjUser->contact;
						$sender  = "CHLORO";
						$url     = "$baseurl/sendSMS?username=$user&message=$message&sendername=$sender&smstype=TRANS&numbers=$to&apikey=$api_key";
						// Send SMS     
						$ret = file_get_contents($url); 
						if(isset($ret) && !empty($ret)) {
							foreach ($nos as $row) {
								$data =	array('sms_recepients'=>$row,'no_of_sms'=>$value['sms_count'],'sms_body'=>$value['details'],'time'=>$time,'sms_sent_date'=>$sent_date);
								// store sent sms record in  DB.
								$this->db->insert('sent_sms_data',$data);
							}
						} else {
							echo 'SMS not sent.';
						}
					} else {
						echo 'time not matched'.'<br/>';
					}
				} else {
					echo 'date not match';
				} 
			}
		}
	}

	/*** Send Birthday SMS ***/
	public function send_birthday_sms() {
		$sent_date = date('d-m-Y');
		$time    = strtotime(date('h:i:s'));
		$user    = "chlorodots";    
		$api_key = "70651465-1dfb-4f53-9d5b-6b8786ff073e"; 
		$baseurl = "http://sms.hspsms.com";
		$sender  = "CHLORO";

		$this->db->select('mobile_no,birth_date');
		$this->db->from('user_contacts_tbl');
		$this->db->where('isdelete',0);
		// Get user mobile number and birth date.
		$ArrUser = $this->db->get()->result_array();
		// echo '<pre/>';print_r($ArrUser);die;
		if (isset($ArrUser) && !empty($ArrUser)) {
			foreach ($ArrUser as $value) {
				$a 		= explode('-',$value['birth_date']);
				$day 	= date('d');
				$month 	= date('m');
				// match today's date with DB stored date.
				if ($day == $a[0] && $month == $a[1]) { 
					$msg_body = 'Wishing you success, happiness and health as you celebrate your big day. Happy Birthday from FONE Group.';
					$message = urlencode($msg_body);
					$to      = $value['mobile_no'];
					$url     = "$baseurl/sendSMS?username=$user&message=$message&sendername=$sender&smstype=TRANS&numbers=$to&apikey=$api_key";
					// Send SMS     
					$ret = file_get_contents($url); 
					// $ret = 1;
					if(isset($ret) && !empty($ret)) {
							$data =	array('sms_recepients'=>$value['mobile_no'],'no_of_sms'=> 1,'sms_body'=>$msg_body,'time'=>$time,'sms_sent_date'=>$sent_date);
								// store sent sms record in  DB.
							$this->db->insert('sent_sms_data',$data);
					} else {
						echo 'SMS not sent.';
					}
				} else {
					echo 'date not match';
				} 
			}
		}
	}

	/*** Send Anniversary SMS ***/
	public function send_anniversary_sms() {
		$sent_date = date('d-m-Y');
		$time    = strtotime(date('h:i:s'));
		$user    = "chlorodots";    
		$api_key = "70651465-1dfb-4f53-9d5b-6b8786ff073e"; 
		$baseurl = "http://sms.hspsms.com";
		$sender  = "CHLORO";

		$this->db->select('mobile_no,anniversary_date');
		$this->db->from('user_contacts_tbl');
		$this->db->where('isdelete',0);
		// Get user mobile number and birth date.
		$ArrUser = $this->db->get()->result_array();
		// echo '<pre/>';print_r($ArrUser);die;
		if (isset($ArrUser) && !empty($ArrUser)) {
			foreach ($ArrUser as $value) {
				$a 		= explode('-',$value['anniversary_date']);
				$day 	= date('d');
				$month 	= date('m');
				// match today's date with DB stored date.
				if ($day == $a[0] && $month == $a[1]) { 
					$msg_body = 'Happy Marriage Anniversary from FONE Group.';
					$message = urlencode($msg_body);
					$to      = $value['mobile_no'];
					$url     = "$baseurl/sendSMS?username=$user&message=$message&sendername=$sender&smstype=TRANS&numbers=$to&apikey=$api_key";
					// Send SMS     
					// $ret = file_get_contents($url); 
					$ret = 1;
					if(isset($ret) && !empty($ret)) {
							$data =	array('sms_recepients'=>$value['mobile_no'],'no_of_sms'=> 1,'sms_body'=>$msg_body,'time'=>$time,'sms_sent_date'=>$sent_date);
								// store sent sms record in  DB.
							$this->db->insert('sent_sms_data',$data);
					} else {
						echo 'SMS not sent.';
					}
				} else {
					echo 'date not match';
				} 
			}
		}
	}			
}
/* End of file CronController.php */
/* Location: ./application/controllers/CronController.php */