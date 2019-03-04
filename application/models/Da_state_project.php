<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_Model.php");

class Da_state_project extends Main_Model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_state_project()
    {
        $sql = "INSERT INTO `sms_save_state_project` (`ss_state_id`, `ss_prj_id`, `ss_start_date`, `ss_end_date`, `ss_bdgt_land`, `ss_bdgt_fcty`, `ss_bdgt_oth`, `ss_des`, `ss_status`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $result = $this->db->query($sql,array($this->ss_state_id,$this->ss_prj_id,$this->ss_start_date,$this->ss_end_date,$this->ss_bdgt_land,$this->ss_bdgt_fcty,$this->ss_bdgt_oth,$this->ss_des,1));
    }
    // บันทึกสถานะของโครงการ

}