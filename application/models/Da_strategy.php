<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_Model.php");

class Da_strategy extends Main_Model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_str()
    {
        $sql = "INSERT INTO `sms_strategy` (`str_name`, `str_year_id`, `str_status`) 
                VALUES (?, ?, 1)";
        $this->db->query($sql,array($this->str_name,$this->str_year_id));
    }
    // insert ยุทธศาสตร์

    public function update_str()
    {
        $sql = "UPDATE `sms_strategy`
                SET `str_name` = ?, `str_year_id` = ?
                WHERE `sms_strategy`.`str_id` = ?";
        $this->db->query($sql,array($this->str_name,$this->str_year_id,$this->str_id));
    }
    // update ยุทธศาสตร์

    public function delete_str()
    {
        $sql = "UPDATE `sms_strategy` 
                SET `str_status` = '0' 
                WHERE `sms_strategy`.`str_id` = ?";
        $this->db->query($sql,array($this->str_id));
    }
    // delete ยุทธศาสตร์

    public function insert_str_ind()
    {
        $sql = "INSERT INTO `sms_str_ind` (`str_ind_str_id`, `str_ind_ind_id`, `str_ind_unt`, `str_ind_opt_id`, `str_ind_goal`, `str_ind_status`) 
                VALUES (?, ?, ?, ?, ?, 1)";
        $this->db->query($sql,array($this->str_ind_str_id,$this->str_ind_ind_id,$this->str_ind_unt,$this->str_ind_opt_id,$this->str_ind_goal));
    }
    // insert ตัวชี้วัดยุทธศาสตร์

    public function update_str_ind()
    {
        $sql = "UPDATE `sms_str_ind` 
                SET `str_ind_unt` = ?, `str_ind_opt_id` = ?, `str_ind_goal` = ? 
                WHERE `sms_str_ind`.`str_ind_id` = ?";
        $this->db->query($sql,array($this->str_ind_unt,$this->str_ind_opt_id,$this->str_ind_goal,$this->str_ind_id));
        // return $this->db->last_query();
    }
    // update ตัวชี้วัดยุทธศาสตร์

    public function delete_str_ind()
    {
        $sql = "UPDATE `sms_str_ind` 
                SET `str_ind_status` = '0' 
                WHERE `sms_str_ind`.`str_ind_id` = ?";
        $this->db->query($sql,array($this->str_ind_id));
        // return $this->db->last_query();
    }
    // delete ตัวชี้วัดยุทธศาสตร์
}