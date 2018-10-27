<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_Model.php");

class Da_set_time_save extends Main_Model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_tsp()
    {
        $sql = "INSERT INTO `sms_time_save_project` (`tsp_site_name`, `tsp_start_date`, `tsp_end_date`, `tsp_year_id`, `tsp_status`) 
                VALUES (?, ?, ?, ?, ?)";
        $result = $this->db->query($sql,array($this->tsp_site_name,$this->tsp_start_date,$this->tsp_end_date,$this->tsp_year_id,1));
    }
    // insert ระยะเวลาบันทึกโครงการ

    public function update_tsp()
    {
        $sql = "UPDATE `sms_time_save_project` 
                SET `tsp_start_date` = ?, `tsp_end_date` = ? 
                WHERE `sms_time_save_project`.`tsp_id` = ?";
        $result = $this->db->query($sql,array($this->tsp_start_date,$this->tsp_end_date,$this->tsp_id));
    }
    // update ระยเวลาบันทึกโครงการ

    public function delete_tsp()
    {
        $sql = "UPDATE `sms_time_save_project` 
                SET `tsp_status` = '0' 
                WHERE `sms_time_save_project`.`tsp_id` = ?";
        $result = $this->db->query($sql,array($this->tsp_id));
    }
    // update ระยเวลาบันทึกโครงการ

}