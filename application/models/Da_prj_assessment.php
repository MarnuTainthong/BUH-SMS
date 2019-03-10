<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_Model.php");

class Da_prj_assessment extends Main_Model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_prj_ind_score()
    {
        $sql = "INSERT INTO `sms_result_assess` (`rs_prj_ind_id`, `rs_score`) 
                VALUES (?, ?)";
        $result = $this->db->query($sql,array($this->rs_prj_ind_id,$this->rs_score));
    }
    // บันทึกคะแนนตัวชี้วัด
    
    public function update_prj_ind_score()
    {
        $sql = "UPDATE `sms_result_assess` 
                SET `rs_score` = ? 
                WHERE `sms_result_assess`.`rs_id` = ?";
        $result = $this->db->query($sql,array($this->rs_score,$this->rs_id));
    }

}