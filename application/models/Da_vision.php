<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_Model.php");

class Da_vision extends Main_Model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_vis()
    {
        $sql = "INSERT INTO sms_vision (`vis_name`, `vis_year_id`, `vis_status`)
                VALUES (?,?,1)";
        $this->db->query($sql,array($this->vis_name,$this->vis_year_id));
    }
    // insert วิสัยทัศน์

    public function update_vis()
    {
        $sql = "UPDATE sms_vision
        SET vis_name = ?
        WHERE sms_vision.vis_id = ?";
        $this->db->query($sql,array($this->vis_name,$this->vis_id));
    }
    // update วิสัยทัศน์

    public function delete_vis()
    {
        $sql = "UPDATE sms_vision
        SET vis_status = 0
        WHERE sms_vision.vis_id = ?";
        $this->db->query($sql,array($this->vis_id));
    }
    // delete วิสัยทัศน์

}