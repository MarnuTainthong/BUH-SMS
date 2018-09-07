<?php
require_once('Da_vision.php');

class M_vision extends Da_vision {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_vision_data()
    {
        $sql = "SELECT sms_vision.vis_id,sms_year.year_name,sms_vision.vis_name
                FROM sms_vision
                LEFT JOIN sms_year ON sms_vision.vis_year_id = sms_year.year_id
                WHERE sms_vision.vis_status = 1";
        $result = $this->db->query($sql);
        return $result;
    }
    // แสดงวิสัยทัศน์

    public function get_vis_by_id()
    {
        $sql = "SELECT sms_vision.vis_id,sms_year.year_name,sms_vision.vis_name
        FROM sms_vision
        LEFT JOIN sms_year ON sms_vision.vis_year_id = sms_year.year_id
        WHERE sms_vision.vis_id = ? AND sms_vision.vis_status = 1";
        $result = $this->db->query($sql,array($this->vis_id));
        return $result;
    }
    // แสดงข้อมูลวิสัยทัศน์ตาม ID
}