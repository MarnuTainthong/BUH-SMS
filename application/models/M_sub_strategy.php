<?php
require_once('Da_sub_strategy.php');

class M_sub_strategy extends Da_view_point {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	public function get_sstr_data()
    {
        $sql = "SELECT sms_sub_str.sstr_id,sms_sub_str.sstr_name,sms_view_point.vpt_name,sms_year.year_name
                FROM `sms_sub_str` 
                LEFT JOIN sms_view_point ON sms_sub_str.sstr_viewp_id = sms_view_point.vpt_id
                LEFT JOIN sms_year ON sms_sub_str.sstr_year_id = sms_year.year_id
                WHERE sms_sub_str.sstr_status != 0
                ORDER BY sms_year.year_name ASC, sms_view_point.vpt_name ASC";
        $result = $this->db->query($sql);
        return $result;
    }
    // แสดงกลยุทธ์ dataTable

    public function get_vpt_by_id()
    {
        // $sql = "SELECT sms_view_point.vpt_id,sms_view_point.vpt_name
        //         FROM `sms_view_point` 
        //         WHERE sms_view_point.vpt_id = ?";
        // $result = $this->db->query($sql,array($this->vpt_id));
        // return $result;
    }
    // ดึงข้อมูลมุมมองกลยุทธ์ตาม id

   
}
