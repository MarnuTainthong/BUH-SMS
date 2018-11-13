<?php
require_once('Da_rel_poi_sstr.php');

class M_rel_poi_sstr extends Da_rel_poi_sstr {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function chk_del_poi()
    {
        $sql = "SELECT rel_po_sstr_id
                FROM `sms_relation_poi_sstr`
                WHERE rel_poi_sstr_status != 0 AND rel_poi_id = ?";
        $result = $this->db->query($sql,array($this->rel_poi_id));
        return $result;
    }
    // เช็คว่าเป้าประสงค์มีการตั้งค่าความสัมพันธ์กับกลยุทธ์หรือไม่
    
    public function get_vpt_use()
    {
        $sql = "SELECT sms_view_point.vpt_id,sms_view_point.vpt_name
                FROM `sms_relation_poi_sstr`
                LEFT JOIN sms_sub_str ON sms_relation_poi_sstr.rel_sstr_id = sms_sub_str.sstr_id
                LEFT JOIN sms_view_point ON sms_sub_str.sstr_viewp_id = sms_view_point.vpt_id
                WHERE sms_relation_poi_sstr.rel_poi_sstr_status != 0 AND sms_relation_poi_sstr.rel_year_id = ?
                GROUP BY sms_view_point.vpt_id
                ORDER BY sms_view_point.vpt_id ASC";
        $result = $this->db->query($sql,array($this->rel_year_id));
        return $result;
    }
    // ดึงมุมมองกลยุทธ์ของกลยุทธ์ที่ตั้งค่าความสัมพันธ์ของปีงบประมาณ
    
    public function get_sstr_use()
    {
        $sql = "SELECT sms_relation_poi_sstr.rel_sstr_id,sms_sub_str.sstr_name,sms_sub_str.sstr_viewp_id
                FROM `sms_relation_poi_sstr`
                LEFT JOIN sms_sub_str ON sms_relation_poi_sstr.rel_sstr_id = sms_sub_str.sstr_id
                LEFT JOIN sms_view_point ON sms_sub_str.sstr_viewp_id = sms_view_point.vpt_id
                WHERE sms_relation_poi_sstr.rel_poi_sstr_status != 0 AND sms_relation_poi_sstr.rel_year_id = ?
                ORDER BY sms_view_point.vpt_id ASC";
        $result = $this->db->query($sql,array($this->rel_year_id));
        return $result;
    }
    // ดึงข้อมูลกลยุทธ์ที่ตั้งค่าความสัมพันธ์ของปีงบประมาณ

}
