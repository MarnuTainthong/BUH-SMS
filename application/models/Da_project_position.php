<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_Model.php");

class Da_project_position extends Main_Model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_pos()
    {
        $sql = "INSERT INTO `sms_pos_project` (`pos_name`, `pos_status`) 
                VALUES (?, 1)";
        $result = $this->db->query($sql,array($this->pos_name));
    }
    // insert ตำแหน่งในโครงการ

    public function update_pos()
    {
        $sql = "UPDATE `sms_pos_project` 
                SET `pos_name` = ? 
                WHERE `sms_pos_project`.`pos_id` = ?";
        $result = $this->db->query($sql,array($this->pos_name,$this->pos_id));
    }
    // update ตำแหน่งในโครงการ

    public function delete_pos()
    {
        $sql = "UPDATE `sms_pos_project` 
                SET `pos_status` = '0' 
                WHERE `sms_pos_project`.`pos_id` = ?";
        $result = $this->db->query($sql,array($this->pos_id));
    }
    // delete ตำแหน่งในโครงการ

}