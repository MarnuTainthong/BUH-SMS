<?php
require_once('Da_point.php');

class M_point extends Da_point {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	public function get_poi_data()
    {
        $sql = "SELECT sms_point.poi_id,sms_point.poi_name,sms_year.year_name
                FROM `sms_point`
                LEFT JOIN sms_year ON sms_point.poi_year_id = sms_year.year_id
                WHERE sms_point.poi_status != 0
                ORDER BY sms_year.year_id ASC";
        $result = $this->db->query($sql);
        return $result;
    }
    // แสดงเป้าประสงค์ dataTable

    public function get_poi_by_id()
    {
        $sql = "SELECT sms_point.poi_id,sms_point.poi_name
                FROM `sms_point`
                WHERE sms_point.poi_id = ?";
        $result = $this->db->query($sql,array($this->poi_id));
        return $result;
    }
    // ดึงข้อมูลเป้าประสงค์ตาม id

}
