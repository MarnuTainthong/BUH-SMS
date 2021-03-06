<?php
require_once('Da_view_point.php');

class M_view_point extends Da_view_point {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	public function get_vpt_data()
    {
        $sql = "SELECT sms_view_point.vpt_id,sms_view_point.vpt_name,sms_year.year_name
                FROM `sms_view_point`
                LEFT JOIN sms_year ON sms_view_point.vpt_year_id = sms_year.year_id
                WHERE sms_view_point.vpt_status != 0
                ORDER BY sms_year.year_id ASC";
        $result = $this->db->query($sql);
        return $result;
    }
    // แสดงมุมมองกลยุทธ์ dataTable

    public function get_vpt_by_id()
    {
        $sql = "SELECT sms_view_point.vpt_id,sms_view_point.vpt_name
                FROM `sms_view_point` 
                WHERE sms_view_point.vpt_id = ?";
        $result = $this->db->query($sql,array($this->vpt_id));
        return $result;
    }
    // ดึงข้อมูลมุมมองกลยุทธ์ตาม id

    public function get_vpt_of_year()
    {
        $sql = "SELECT * 
                FROM `sms_view_point`
                WHERE sms_view_point.vpt_year_id = ? AND sms_view_point.vpt_status != 0";
        $result = $this->db->query($sql,array($this->vpt_year_id));
        return $result;
    }
    // แสดงข้อมูลมุมมองกลยุทธ์ของปีงบประมาณ

    public function chk_del_vpt()
    {
        $sql = "SELECT sms_view_point.vpt_id
                FROM `sms_view_point`
                RIGHT JOIN sms_sub_str ON sms_sub_str.sstr_viewp_id = sms_view_point.vpt_id
                WHERE sms_sub_str.sstr_status != 0 AND sms_view_point.vpt_id = ?";
        $result = $this->db->query($sql,array($this->vpt_id));
        return $result;
    }
    // เช็คว่ามุมมองมีกลยุทธืหรือไม่ ถ้ามีจะลบไม่ได้
   
}
