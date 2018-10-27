<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_Model.php");

class Da_rel_mst extends Main_Model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_rel_mst()
    {
        $sql = "INSERT INTO `sms_relation_mis_str` (`rel_mis_id`, `rel_str_id`, `rel_year_id`, `rel_mis_str_status`) 
                VALUES (?, ?, ?, 1)";
        $result = $this->db->query($sql,array($this->rel_mis_id,$this->rel_str_id,$this->rel_year_id));
    }
    // insert การตั้งค่าความสัมพันธ์

    public function delete_rel_mst()
    {
        $sql = "UPDATE `sms_relation_mis_str` 
                SET `rel_mis_str_status` = '0' 
                WHERE `sms_relation_mis_str`.`rel_mis_str_id` = ?";
        $result = $this->db->query($sql,array($this->rel_mis_str_id));
    }
    // delete การจับคู่ของพันธกิจกับยุทธศาสตร์

}