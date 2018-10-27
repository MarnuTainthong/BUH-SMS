<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_Model.php");

class Da_rel_str_poi extends Main_Model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_rel_strp()
    {
        $sql = "INSERT INTO `sms_relation_str_po` (`rel_str_id`, `rel_po_id`, `rel_year_id`, `rel_str_poi_status`)
                VALUES (?, ?, ?, 1)";
        $result = $this->db->query($sql,array($this->rel_str_id,$this->rel_po_id,$this->rel_year_id));
    }
    // insert การตั้งค่าความสัมพันธ์ 

    public function delete_rel_stp()
    {
        $sql = "UPDATE `sms_relation_str_po` 
                SET `rel_str_poi_status` = '0' 
                WHERE `sms_relation_str_po`.`rel_str_po_id` = ?";
        $result = $this->db->query($sql,array($this->rel_str_po_id));
    }
    // delete การจับคู่ของยุทธศาสตร์กับเป้าประสงค์

}