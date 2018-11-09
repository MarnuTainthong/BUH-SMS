<?php
require_once('Da_project_position.php');

class M_project_position extends Da_project_position {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_pos_data()
    {
        $sql = "SELECT pos_id,pos_name
                FROM `sms_pos_project`
                WHERE pos_status != 0
                ORDER BY pos_level ASC";
        $result = $this->db->query($sql);
        return $result;
    }
    // แสดงตำแหน่งของโครงการ datatable

    public function get_pos_by_id()
    {
        $sql = "SELECT * 
                FROM `sms_pos_project` 
                WHERE sms_pos_project.pos_id = ?";
        $result = $this->db->query($sql,$this->pos_id);
        return $result;
    }
    // ข้อมูลตำแหน่งในโครงการตาม id

    // public function get_pos_prj()
    // {
    //     $sql = "SELECT pos_id,pos_name
    //             FROM `sms_pos_project`
    //             WHERE pos_status != 0
    //             ORDER BY pos_level ASC";
    //     $result = $this->db->query($sql);
    //     return $result;
    // }
    // ดึงข้อมูลตำแหน่งในโครงการหน้าตั้งค่าโครงการ
   
}
