<?php
require_once('Da_project_state.php');

class M_project_state extends Da_project_state {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_pst_data()
    {
        $sql = "SELECT * 
                FROM `sms_project_state` 
                WHERE sms_project_state.pst_status != 0";
        $result = $this->db->query($sql);
        return $result;
    }
    // แสดงสถานะของโครงการ datatable

    public function get_pst_by_id()
    {
        $sql = "SELECT * 
                FROM `sms_project_state` 
                WHERE sms_project_state.pst_id = ?";
        $result = $this->db->query($sql,array($this->pst_id));
        return $result;
    }
    // แสดงข้อมูลสถานะของโครงการตอนกด edit

}
