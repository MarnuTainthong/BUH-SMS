<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_Model.php");

class Da_sub_strategy extends Main_Model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_sstr()
    {
        $sql = "INSERT INTO `sms_sub_str` (`sstr_name`, `sstr_viewp_id`, `sstr_year_id`, `sstr_status`) 
                VALUES (?, ?, ?, 1)";
        $this->db->query($sql,array($this->sstr_name,$this->sstr_viewp_id,$this->sstr_year_id));
        // return $this->db->last_query();
    }
    // insert กลยุทธ์

}