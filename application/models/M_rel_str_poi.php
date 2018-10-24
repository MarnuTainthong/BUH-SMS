<?php
require_once('Da_rel_str_poi.php');

class M_rel_str_poi extends Da_rel_str_poi {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_poi_use()
    {
        // $sql = "SELECT sms_relation_str_po.*,sms_point.poi_name
        //         FROM `sms_relation_str_po`
        //         LEFT JOIN sms_point ON sms_relation_str_po.rel_po_id = sms_point.poi_id
        //         WHERE sms_relation_str_po.rel_str_poi_status != 0 AND sms_relation_str_po.rel_year_id = ?
        //         ORDER BY sms_point.poi_id ASC";
        $sql = "SELECT sms_point.*
                FROM `sms_relation_str_po`
                LEFT JOIN sms_point ON sms_relation_str_po.rel_po_id = sms_point.poi_id
                WHERE sms_relation_str_po.rel_str_poi_status != 0 AND sms_relation_str_po.rel_year_id = ?";
        $result = $this->db->query($sql,array($this->rel_year_id));
        return $result;
    }
    // แสดงข้อมูลเป้าประสงค์ ตั้งค่าความสัมพันธ์ datatable ตามปีงบประมาณ

    public function get_poi_not_use()
    {
        // $sql = "SELECT * 
        //         FROM `sms_point`
        //         LEFT JOIN sms_relation_str_po ON sms_relation_str_po.rel_po_id = sms_point.poi_id
        //         WHERE sms_relation_str_po.rel_str_poi_status !=1 OR sms_relation_str_po.rel_po_id IS NULL AND sms_point.poi_status != 0 AND sms_point.poi_year_id = ?";
        $sql = "SELECT *
        FROM sms_point
        WHERE sms_point.poi_id NOT IN (SELECT sms_point.poi_id
                                        FROM sms_point
                                        LEFT JOIN sms_relation_str_po ON sms_point.poi_id = sms_relation_str_po.rel_po_id
                                        WHERE sms_relation_str_po.rel_str_poi_status !=0 AND sms_relation_str_po.rel_year_id = ?) AND sms_point.poi_year_id = ?";
        $result = $this->db->query($sql,array($this->poi_year_id,$this->poi_year_id));
        return $result;
    }
   // ดึงข้อมูลเป้าประสงค์ที่ไม่ถูกตั้งค่าความสัมพันธ์

   public function get_rel_poi()
   {
       $sql = "SELECT sms_relation_str_po.* ,sms_point.poi_name
                FROM `sms_relation_str_po`
                LEFT JOIN sms_point ON sms_relation_str_po.rel_po_id = sms_point.poi_id
                WHERE sms_relation_str_po.rel_str_poi_status != 0 AND sms_relation_str_po.rel_year_id = ?";
        $result = $this->db->query($sql,array($this->rel_year_id));
        return $result;
    }
    // แสดงข้อมูลเป้าประสงค์ ตั้งค่าความสัมพันธ์ datatable ตามปีงบประมาณ

}
