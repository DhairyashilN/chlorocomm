<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "login";
$route['login'] = "login/validate_login";
$route['dashboard'] = "chlorocomm/index";
$route['category'] = "chlorocomm/category";
$route['add_category'] = "chlorocomm/add_category";
$route['store_category'] = "chlorocomm/store_category";
$route['edit_category/(:num)'] = 'chlorocomm/add_category/$1';
$route['store_category/(:num)'] = "chlorocomm/store_category/$1";
$route['delete_category/(:num)'] = 'chlorocomm/delete_category/$1';
$route['contact_type'] = "chlorocomm/contact_type";
$route['add_type'] = "chlorocomm/add_type";
$route['store_type'] = "chlorocomm/store_type";
$route['store_type/(:num)'] = "chlorocomm/store_type/$1";
$route['edit_type/(:num)'] = 'chlorocomm/add_type/$1';
$route['contacts'] = "chlorocomm/contacts";
$route['add_contact'] = "chlorocomm/add_contact";
$route['store_contact'] = "chlorocomm/store_contact";
$route['edit_contact/(:num)'] = 'chlorocomm/add_contact/$1';
$route['store_contact/(:num)'] = "chlorocomm/store_contact/$1";
$route['vcard_contacts'] = "chlorocomm/upload_vcf";
$route['upload_vcf_contact'] = "chlorocomm/import_vcf_contacts";
$route['delete_contact'] = "chlorocomm/delete_contact";
$route['send_email'] = "chlorocomm/send_email";
$route['sms_template'] = "chlorocomm/sms_template";
$route['add_sms_template'] = "chlorocomm/add_sms_template";
$route['store_template'] = "chlorocomm/store_template";
$route['edit_template/(:num)'] = 'chlorocomm/add_sms_template/$1';
$route['store_template/(:num)'] = "chlorocomm/store_template/$1";
$route['delete_template/(:num)'] = "chlorocomm/delete_template/$1";
$route['send_sms'] = "chlorocomm/send_sms";
$route['send_individual'] = "chlorocomm/individual_sms";
$route['send_bulk'] = "chlorocomm/bulk_sms";
$route['quick_sms'] = "chlorocomm/quick_sms";
$route['send_individual_sms'] = "chlorocomm/send_individual_sms";
$route['send_bulk_sms'] = "chlorocomm/send_bulk_sms";
$route['scheduled_sms'] = "chlorocomm/scheduled_sms";
$route['schedule_festival_sms'] = "chlorocomm/schedule_festival_sms";
$route['add_fetival_sms'] = "chlorocomm/add_fetival_sms";
$route['store_festival_sms'] = "chlorocomm/store_festival_sms";
$route['store_festival_sms/(:num)'] = "chlorocomm/store_festival_sms/$1";
$route['store_scheduled_sms'] = "chlorocomm/store_scheduled_sms";
$route['edit_festival_sms_shedule/(:num)'] = "chlorocomm/add_fetival_sms/$1";
$route['delete_festival_sms/(:num)'] = "chlorocomm/delete_festival_sms/$1";
$route['edit_sms_shedule/(:num)'] = "chlorocomm/add_schedule_sms/$1";
$route['store_scheduled_sms/(:num)'] = "chlorocomm/store_scheduled_sms/$1";
$route['delete_scheduled_sms/(:num)'] = "chlorocomm/delete_scheduled_sms/$1";
$route['schedule_festival_sms'] = "chlorocomm/schedule_festival_sms";
$route['sent_emails_log'] = "chlorocomm/email_statistics";
$route['sent_sms_log'] = "chlorocomm/sms_statistics";
$route['view_sent_sms_satistics'] = "chlorocomm/view_sent_sms_satistics";
$route['profile'] = "chlorocomm/edit_profile";
$route['change_password'] = "chlorocomm/change_password";
$route['getByCategory'] = "chlorocomm/getCatRecords";
$route['vcard_export'] = "chlorocomm/vcard_export";
/*Enquiry Routes*/
$route['customer_enquiry'] = "EnquiryController/customer_enquiries";
$route['add_enquiry'] = "EnquiryController/add_enquiry";
$route['edit_enquiry/(:num)'] = "EnquiryController/add_enquiry/$1";
$route['store_enquiry/(:num)'] = "EnquiryController/store_enquiry/$1";
$route['delete_enquiry/(:num)'] = "EnquiryController/delete_enquiry/$1";
$route['personal_reminder'] = "EnquiryController/personal_reminder";
$route['add_reminder'] = "EnquiryController/add_reminder";
$route['store_reminder'] = "EnquiryController/store_reminder";
$route['edit_reminder/(:num)'] = "EnquiryController/add_reminder/$1";
$route['store_reminder/(:num)'] = "EnquiryController/store_reminder/$1";
$route['delete_reminder/(:num)'] = "EnquiryController/delete_reminder/$1";
/*Dues and Bebtors Routes*/
$route['dues'] = "MoneyController/dues";
$route['add_due_amount'] = "MoneyController/add_due_amount";
$route['store_due_details'] = "MoneyController/store_due_details";
$route['edit_due_details/(:num)'] = "MoneyController/add_due_amount/$1";
$route['store_due_details/(:num)'] = "MoneyController/store_due_details/$1";
$route['debtors'] = "MoneyController/debtors";
$route['add_debt_amount'] = "MoneyController/add_debt_amount";
$route['store_debt_details'] = "MoneyController/store_debt_details";
$route['edit_debt_details/(:num)'] = "MoneyController/add_debt_amount/$1";
$route['store_debt_details/(:num)'] = "MoneyController/store_debt_details/$1";
$route['delete_debt_details/(:num)'] = "MoneyController/delete_debt_details/$1";
/*Calendar & Calculater Routes*/
$route['calculator'] = 'chlorocomm/calculator';
$route['calendar'] = 'chlorocomm/calendar';
//TESTING URLs
$route['test_report'] = "chlorocomm/test_report";
$route['404_override'] = '';
/* End of file routes.php */
/* Location: ./application/config/routes.php */