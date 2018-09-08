<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_Model.php");

class Da_view_point extends Main_Model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_vpt()
    {
        $sql = "INSERT INTO `sms_view_point` (`vpt_name`, `vpt_year_id`, `vpt_status`) 
                VALUES (?, ?, 1)";
        $this->db->query($sql,array($this->vpt_name,$this->vpt_year_id));
    }
    // insert มุมมองกลยุทธ์

    public function update_vpt()
    {
        $sql = "UPDATE `sms_view_point` 
                SET `vpt_name` = ?, `vpt_year_id` = ?
                WHERE `sms_view_point`.`vpt_id` = ?";
        $this->db->query($sql,array($this->vpt_name,$this->vpt_year_id,$this->vpt_id));
    }
    // update มุมมองกลยุทธ์

    public function delete_vpt()
    {
        $sql = "UPDATE `sms_view_point` 
                SET `vpt_status` = '0' 
                WHERE `sms_view_point`.`vpt_id` = ?";
        $this->db->query($sql,array($this->vpt_id));
    }
    // delete มุมมองกลยุทธ์

}