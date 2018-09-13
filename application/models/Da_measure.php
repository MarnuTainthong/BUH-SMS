<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_Model.php");

class Da_measure extends Main_Model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_mea()
    {
        $sql = "INSERT INTO `sms_measure` (`mea_name`, `mea_year_id`, `mea_code`, `mea_status`) 
                VALUES (?, ?, ?, 1)";
        $this->db->query($sql,array($this->mea_name,$this->mea_year_id,$this->mea_code));
    }
    // insert ตัวบ่งชี้

    public function update_mea()
    {
        $sql = "UPDATE `sms_measure` 
                SET `mea_code` = ?, `mea_name` = ?, `mea_year_id` = ? 
                WHERE `sms_measure`.`mea_id` = ?";
        $this->db->query($sql,array($this->mea_code,$this->mea_name,$this->mea_year_id,$this->mea_id));
    }
    // update ตัวบ่งชี้


}