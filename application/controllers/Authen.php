<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Login_Controller.php");

class Authen extends Login_Controller {

	public function __construct()
    {
        // Call the Model constructor
		parent::__construct();

		$this->load->model('User','user');
    }

	public function index()
	{

		if ($this->checkUser()) {
			if ($this->session->userdata('us_permission') == 1) {
				$this->session->set_userdata('menu_active',1);
				redirect('admin/Sms_base_data/dashboard');
			}else {
				# code...
			}
		}else {
			$this->output('page_login');
		}

		
	}
	
	public function check_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$url = "http://med.buu.ac.th/scan-med/scanningPersonnel/API/api_checkLogin.php/";
		$data = array("username" => $username, "password" => $password); 
		$curl = curl_init($url); 
		curl_setopt($curl, CURLOPT_FAILONERROR, true); 
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
		$rs_services = json_decode(curl_exec($curl));
		
		
		$json = file_get_contents('http://med.buu.ac.th/scan-med/scanningPersonnel/API/api_getPerson.php');
		$rs_person = json_decode($json, TRUE);

		if($rs_services->data_unit == 1){
            $this->session->set_userdata('us_id',$rs_services->data_result->us_id);
			if($rs_services->data_result->us_ref_ps_id == null || $rs_services->data_result->us_ref_ps_id == ""){
				$this->session->set_userdata('us_ps_id',0);
			}else{
				$this->session->set_userdata('us_ps_id',$rs_services->data_result->us_ref_ps_id);
			}
            $this->session->set_userdata('us_name',$rs_services->data_result->us_name);
			$this->session->set_userdata('us_ref_ug_id',$rs_services->data_result->us_ref_ug_id);
			$this->session->set_userdata('us_permission',$rs_services->data_result->us_ref_ug_id);
			foreach($rs_person['data_result'] as $row){
				if($rs_services->data_result->us_ref_ps_id == $row['ps_id']){
					$ps_name = $row['pf_title_th'].''.$row['ps_fname_th'].' '.$row['ps_lname_th'];
					$this->session->set_userdata('us_ps_name',$ps_name);
				}
			}
            $this->session->set_userdata('logged_in',TRUE);
			
			echo json_encode(true);
			// redirect('Authen', 'refresh'); 
		}else{
			echo json_encode(false);
			// redirect('Authen', 'refresh');
		}   
		
		// $rs_user = $this->user->get_userLogin($username,$password);
		// if($rs_user->num_rows() == 1){
		// 	$this->session->set_userdata('UsId', $rs_user->row()->hr_id);
		// 	$this->session->set_userdata('UsName', $rs_user->row()->hr_pass);
		// 	redirect('admin/Sms_base_data/dashboard');
		// 	die;

		// }else{
		// 	redirect('Authen');
		// 	die;
		// }
		
		// redirect('admin/Home');
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('Page_public');
	}
	
}
