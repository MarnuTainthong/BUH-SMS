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
    
    public function update_sstr()
    {
        $sql = "UPDATE `sms_sub_str` 
                SET `sstr_name` = ?, `sstr_viewp_id` = ?, `sstr_year_id` = ?
                WHERE `sms_sub_str`.`sstr_id` = ?";
        $this->db->query($sql,array($this->sstr_name,$this->sstr_viewp_id,$this->sstr_year_id,$this->sstr_id));
    }
    // update กลยุทธ์
    
    public function delete_sstr()
    {
        $sql = "UPDATE `sms_sub_str` 
                SET `sstr_status` = '0' 
                WHERE `sms_sub_str`.`sstr_id` = ?";
        $this->db->query($sql,array($this->sstr_id));
    }
    // delete กลยุทธ์

    public function insert_sstr_ind()
    {
        $sql = "INSERT INTO `sms_sub_str_ind` (`sstr_ind_sstr_id`, `sstr_ind_ind_id`, `sstr_ind_unt`, `sstr_ind_opt_id`, `sstr_ind_goal`, `sstr_ind_status`) 
                VALUES (?, ?, ?, ?, ?, 1)";
        $this->db->query($sql,array($this->sstr_ind_str_id,$this->sstr_ind_ind_id,$this->sstr_ind_unt,$this->sstr_ind_opt_id,$this->sstr_ind_goal));
    }
    // insert ตัวชี้วัดผลยุทธ์

    public function update_sstr_ind()
    {
        $sql = "UPDATE `sms_sub_str_ind` 
                SET `sstr_ind_unt` = ?, `sstr_ind_opt_id` = ?, `sstr_ind_goal` = ?
                WHERE `sms_sub_str_ind`.`sstr_ind_id` = ?";
        $this->db->query($sql,array($this->sstr_ind_unt,$this->sstr_ind_opt_id,$this->sstr_ind_goal,$this->sstr_ind_id));
        // return $this->db->last_query();
    }
    // update ตัวชี้วัดกลยุทธ์

    public function delete_sstr_ind()
    {
        $sql = "UPDATE `sms_sub_str_ind` 
                SET `sstr_ind_status` = '0' 
                WHERE `sms_sub_str_ind`.`sstr_ind_id` = ?";
        $this->db->query($sql,array($this->sstr_ind_id));
    }
    // delelte ตัวชี้วัดกลยุทธ์

    public function delete_sstr_ind_when_del_sstr()
    {
        $sql = "UPDATE `sms_sub_str_ind` 
                SET `sstr_ind_status` = '0' 
                WHERE `sms_sub_str_ind`.`sstr_ind_id` IN (SELECT sstr_ind_id FROM(SELECT sms_sub_str_ind.sstr_ind_id
                                        FROM `sms_sub_str_ind`
                                        LEFT JOIN sms_sub_str ON sms_sub_str_ind.sstr_ind_sstr_id = sms_sub_str.sstr_id
                                        WHERE sms_sub_str_ind.status !=0 AND sms_sub_str_ind.sstr_ind_sstr_id = ?) AS T)";
        $this->db->query($sql,array($this->sstr_ind_sstr_id));
    }
    // delete กลยุทธ์

}