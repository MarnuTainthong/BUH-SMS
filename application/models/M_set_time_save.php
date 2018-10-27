<?php
require_once('Da_set_time_save.php');

class M_set_time_save extends Da_set_time_save {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_tsp_data()
    {
        $sql = "SELECT * 
                FROM `sms_time_save_project`
                WHERE sms_time_save_project.tsp_status != 0 AND sms_time_save_project.tsp_year_id = ?";
        $result = $this->db->query($sql,array($this->tsp_year_id));
        return $result;
    }
    // แสดงข้อมูลช่วงเวลาการบันทึกโครงการ datatable

    public function get_tsp_by_id()
    {
        $sql = "SELECT * 
                FROM `sms_time_save_project` 
                WHERE sms_time_save_project.tsp_id = ?";
        $result = $this->db->query($sql,array($this->tsp_id));
        return $result;

    }
    // ดึงข้อมูล tsp by id ตอนกด edit

    public function get_site_use()
    {
        $sql = "SELECT tsp_site_name
                FROM `sms_time_save_project` 
                WHERE tsp_status != 0 AND tsp_year_id = ?";
        $result = $this->db->query($sql,array($this->tsp_year_id));
        return $result;
    }
    // ดึงข้อมูลชื่อหน่วยงานที่เพิ่มการตั้งค่าบันทึกโครงกแาร้ลว

}
