<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_Model.php");

class User extends Main_Model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	public function get_userLogin($username,$password){
		$sql = "select *
				from sms_hr
				where hr_user = ? and hr_pass = ? and hr_active = 'Y' 
			   ";
		$result = $this->db->query($sql,array($username,$password));
		// echo $this->db->last_query();
		return $result;
	}
	
}
