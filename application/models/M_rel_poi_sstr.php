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

}
