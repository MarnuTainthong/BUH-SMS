<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Login_Controller.php");

class Authen extends Login_Controller {

	public function index()
	{
		$this->output('page_login');

		if ($this->session->userdata('UsName') != null) {
			redirect('admin/Sms_base_data/dashboard');
		}
		//check ว่า login รึยัง
	}
	
	public function check_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		// $md5_password = md5("APP|".$password."|APP");
		// echo "<pre>";
		// print_r($this->input->post());
		// echo "</pre>";
		
		$this->load->model('User','user');
		// $rs_user = $this->user->get_userLogin($username,$md5_password);
		$rs_user = $this->user->get_userLogin($username,$password);
		if($rs_user->num_rows() == 1){
			$this->session->set_userdata('UsId', $rs_user->row()->hr_id);
			$this->session->set_userdata('UsName', $rs_user->row()->hr_pass);
			// $this->session->set_userdata('UgId', $rs_user->row()->us_ref_ug_id);
			echo "Login pass";
			redirect('admin/Sms_base_data/dashboard');
			die;

		}else{
			echo "Login fail";
			redirect('Authen');
			die;
		}
		
		// redirect('admin/Home');
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('Page_public');
	}
	
}
