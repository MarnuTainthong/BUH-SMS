<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_Model.php");

class Da_mission extends Main_Model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_mis()
    {
        $sql = "INSERT INTO sms_mission (`mis_name`, `mis_year_id`, `mis_status`)
                VALUES (?,?,1)";
        $this->db->query($sql,array($this->mis_name,$this->mis_year_id));
    }
    // insert พันธกิจ 

    public function update_mis()
    {
        $sql = "UPDATE sms_mission
                SET mis_name = ?, mis_year_id = ? 
                WHERE mis_id = ?";
        $this->db->query($sql,array($this->mis_name,$this->mis_year_id,$this->mis_id));
    }
    // update พันธกิจ

    public function delete_mis()
    {
        $sql = "UPDATE sms_mission
                SET mis_status = 0
                WHERE sms_mission.mis_id = ?";
        $this->db->query($sql,array($this->mis_id));
    }
    // delete พันธกิจ

    public function insert_mis_ind()
    {
        $sql = "INSERT INTO `sms_mis_ind` (`mis_ind_mis_id`, `mis_ind_ind_id`, `mis_ind_unt`, `mis_ind_opt_id`, `mis_ind_goal`, `mis_ind_status`)
                VALUES (?,?,?,?,?,1)";
        $this->db->query($sql,array($this->mis_ind_mis_id,$this->mis_ind_ind_id,$this->mis_ind_unt,$this->mis_ind_opt_id,$this->mis_ind_goal));
    }
    // insert ตัวชี้วัดพันธกิจ
    
    public function update_mis_ind()
    {
        $sql = "UPDATE sms_mis_ind
                SET mis_ind_mis_id = ?,mis_ind_ind_id = ?,mis_ind_unt = ?,mis_ind_opt_id = ?,mis_ind_goal = ?
                WHERE mis_ind_mis_id = ? AND mis_ind_ind_id = ?";
        $this->db->query($sql,array($this->mis_ind_mis_id,$this->mis_ind_ind_id,$this->mis_ind_unt,$this->mis_ind_opt_id,$this->mis_ind_goal,$this->mis_ind_mis_id,$this->mis_ind_id));
        // return $this->db->last_query();
    }
    // update ตัวชี้วัดพันธกิจ

    public function delete_mis_ind()
    {
        $sql = "UPDATE `sms_mis_ind` 
                SET `mis_ind_status` = '0' 
                WHERE `sms_mis_ind`.`mis_ind_id` = ?";
        $this->db->query($sql,array($this->mis_ind_id));
    }
    // delete ตัวชี้วัดพันธกิจ
    
    public function delete_mis_ind_when_del_mis()
    {
        $sql = "UPDATE `sms_mis_ind` 
                SET `mis_ind_status` = '0' 
                WHERE `sms_mis_ind`.`mis_ind_id`IN (SELECT mis_ind_id FROM (SELECT sms_mis_ind.mis_ind_id
                        FROM `sms_mis_ind`
                        LEFT JOIN sms_mission ON sms_mis_ind.mis_ind_mis_id = sms_mission.mis_id
                        WHERE sms_mis_ind.mis_ind_status != 0 AND sms_mis_ind.mis_ind_mis_id = ?) AS T)";
        $this->db->query($sql,array($this->mis_ind_mis_id));
    }
    // ลบตัวชี้วัดทั้งหมดของพันธกิจ
}