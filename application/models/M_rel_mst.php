<?php
require_once('Da_rel_mst.php');

class M_rel_mst extends Da_rel_mst {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_rmst_data()
    {
        $sql = "SELECT sms_relation_mis_str.*,sms_mission.mis_name,sms_strategy.str_name
                FROM `sms_relation_mis_str` 
                LEFT JOIN sms_mission ON sms_relation_mis_str.rel_mis_id = sms_mission.mis_id
                LEFT JOIN sms_strategy ON sms_relation_mis_str.rel_str_id = sms_strategy.str_id
                WHERE sms_relation_mis_str.rel_mis_str_status != 0";
        $result = $this->db->query($sql);
        return $result;
    }
    // แสดงข้อมูล ความสัมพันธ์พันธกิจ-ยุทธศาสตร์ datatable ตามปีงบประมาณที่เลือก

}
