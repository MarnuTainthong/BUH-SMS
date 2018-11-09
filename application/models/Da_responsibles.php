<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_Model.php");

class Da_responsibles extends Main_Model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_resp()
    {
        $sql = "INSERT INTO `sms_responsibles` (`resp_prj_id`, `resp_pos_id`, `resp_name`, `resp_status`) 
                VALUES (?, ?, ?, 1)";
        $result = $this->db->query($sql,array($this->resp_prj_id,$this->resp_pos_id,$this->resp_name));
    }
    // บันทึกผู้รับผิดชอบโครงการ

    public function update_resp()
    {
        $sql = "UPDATE `sms_responsibles` 
                SET `resp_pos_id` = ?, `resp_name` = ? 
                WHERE `sms_responsibles`.`resp_id` = ?";
        $result = $this->db->query($sql,array($this->resp_pos_id,$this->resp_name,$this->resp_id));
    }
    // update ผู้รับผิดชอบโครงการ

    public function delete_resp()
    {
        $sql = "UPDATE `sms_responsibles` 
                SET `resp_status` = '0' 
                WHERE `sms_responsibles`.`resp_id` = ?";
        $result = $this->db->query($sql,array($this->resp_id));

    }
    // delete ผู้รับผิดชอบโครงการ

    public function delete_resp_when_del_prj()
    {
        $sql = "UPDATE `sms_responsibles` 
                SET `resp_status` = '0'
                WHERE `sms_responsibles`.`resp_id` IN (SELECT resp_id FROM(
                                                                    SELECT sms_responsibles.resp_id
                                                                    FROM `sms_responsibles`
                                                                    LEFT JOIN sms_pos_project ON sms_responsibles.resp_pos_id = sms_pos_project.pos_id
                                                                    WHERE resp_status != 0 AND resp_prj_id = ?) AS T)";
        $result = $this->db->query($sql,array($this->resp_prj_id));
    }
    // delete ผู้รับผิดชอบโครงการตอนลบโครงการ

}