<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_Model.php");

class Da_project_state extends Main_Model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_pst()
    {
        $sql = "INSERT INTO `sms_project_state` (`pst_name`, `pst_status`) 
                VALUES (?, 1)";
        $result = $this->db->query($sql,array($this->pst_name));
    }
    // insert สถานะของโครงการ

    public function update_pst()
    {
        $sql = "UPDATE `sms_project_state` 
                SET `pst_name` = ? 
                WHERE `sms_project_state`.`pst_id` = ?";
        $result = $this->db->query($sql,array($this->pst_name,$this->pst_id));
    }
    // update สถานะของโครงการ

    public function delete_pst()
    {
        $sql = "UPDATE `sms_project_state` 
                SET `pst_status` = '0' 
                WHERE `sms_project_state`.`pst_id` = ?";
        $result = $this->db->query($sql,array($this->pst_id));
    }
    // delete สถานะของโครงการ

}