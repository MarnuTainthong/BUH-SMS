<?php
require_once('Da_rel_mst.php');

class M_rel_mst extends Da_rel_mst {

	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_mis_use()
    {
        $sql = "SELECT sms_relation_mis_str.*,sms_mission.mis_name
                FROM `sms_relation_mis_str`
                LEFT JOIN sms_mission ON sms_relation_mis_str.rel_mis_id = sms_mission.mis_id
                WHERE sms_relation_mis_str.rel_mis_str_status != 0 AND sms_relation_mis_str.rel_year_id = ?
                GROUP BY sms_relation_mis_str.rel_mis_id
                ORDER BY sms_relation_mis_str.rel_mis_str_id ASC";
        $result = $this->db->query($sql,array($this->rel_year_id));
        return $result;
    }
    // แสดงข้อมูลพันธกิจ ตั้งค่าความสัมพันธ์ datatable ตามปีงบประมาณ

    public function get_str_not_use()
    {
        // $sql = "SELECT sms_strategy.*
        //         FROM `sms_strategy`
        //         LEFT JOIN sms_relation_mis_str ON sms_relation_mis_str.rel_str_id = sms_strategy.str_id
        //         WHERE sms_relation_mis_str.rel_str_id IS NULL AND sms_strategy.str_status != 0 AND sms_strategy.str_year_id = ?";
        // $sql = "SELECT sms_strategy.*
        //         FROM `sms_strategy`
        //         LEFT JOIN sms_relation_mis_str ON sms_relation_mis_str.rel_str_id = sms_strategy.str_id
        //         WHERE sms_relation_mis_str.rel_str_id NOT IN (SELECT sms_strategy.str_id
        //                                     FROM `sms_strategy`
        //                                     LEFT JOIN sms_relation_mis_str ON sms_strategy.str_id = sms_relation_mis_str.rel_str_id
        //                                     WHERE sms_relation_mis_str.rel_mis_str_status != 0 AND sms_strategy.str_year_id = ?) AND sms_strategy.str_year_id = ?
        //         GROUP BY sms_strategy.str_id";
        // $sql = "SELECT * 
        // FROM `sms_strategy` 
        // WHERE sms_strategy.str_id NOT IN (SELECT sms_strategy.str_id
        //                                 FROM `sms_strategy`
        //                                 LEFT JOIN sms_relation_mis_str ON sms_strategy.str_id = sms_relation_mis_str.rel_str_id
        //                                 WHERE sms_relation_mis_str.rel_year_id = ? AND sms_relation_mis_str.rel_mis_str_status != 0) AND sms_strategy.str_year_id = ?";
        $sql = "SELECT * 
        FROM `sms_strategy` 
        WHERE sms_strategy.str_id NOT IN (SELECT sms_strategy.str_id
                                        FROM `sms_strategy`
                                        LEFT JOIN sms_relation_mis_str ON sms_strategy.str_id = sms_relation_mis_str.rel_str_id
                                        WHERE sms_relation_mis_str.rel_year_id = ? AND sms_relation_mis_str.rel_mis_str_status != 0) AND sms_strategy.str_year_id = ?";
        $result = $this->db->query($sql,array($this->str_year_id,$this->str_year_id));
        return $result;
    }
    // ดึงข้อมูลยุทธศาสตร์ที่ไม่ถูกตั้งค่าความสัมพันธ์

    public function get_str_use()
    {
        $sql = "SELECT sms_strategy.*
                FROM `sms_strategy`
                LEFT JOIN sms_relation_mis_str ON sms_strategy.str_id = sms_relation_mis_str.rel_str_id
                WHERE sms_relation_mis_str.rel_mis_str_status != 0 AND sms_strategy.str_year_id = ?";
        $result = $this->db->query($sql,array($this->str_year_id));
        return $result;
    }
    // ดึงข้อมูลยุทธศาสตร์ที่ตั้งค่าความสัมพันธ์แล้ว

    public function get_rel_str()
    {
        $sql = "SELECT sms_relation_mis_str.*,sms_strategy.str_name
                FROM `sms_relation_mis_str`
                LEFT JOIN sms_strategy ON sms_relation_mis_str.rel_str_id = sms_strategy.str_id
                WHERE sms_relation_mis_str.rel_mis_str_status != 0 AND sms_relation_mis_str.rel_year_id = ?";
        $result = $this->db->query($sql,array($this->rel_year_id));
        return $result;
    }
    // แสดงข้อมูลยุทธศาสตร์ ตั้งค่าความสัมพันธ์ datatable ตามปีงบประมาณ
		public function get_mis_member()
    {
        $sql = "SELECT table_a.mis_id,table_a.mis_name,COUNT(table_b.str_id) AS member
								FROM `sms_mission` AS table_a
								 JOIN `sms_relation_mis_str` AS link_a ON link_a.rel_mis_id = table_a.mis_id
								 JOIN `sms_strategy` AS table_b ON link_a.rel_str_id = table_b.str_id
								 WHERE table_a.mis_status = 1 AND table_b.str_status = 1 AND
								 table_a.mis_year_id = ?
								 AND link_a.rel_mis_str_status = 1
								 GROUP BY table_a.mis_id
								 ORDER BY table_a.mis_name ASC,table_b.str_name ASC";
        $result = $this->db->query($sql,array($this->rel_year_id));
        return $result;
    }

		public function get_str_member()
    {
        $sql = "SELECT table_a.mis_id,table_a.mis_name, table_b.str_id ,table_b.str_name,link_a.rel_mis_str_id
								FROM `sms_mission` AS table_a
								JOIN `sms_relation_mis_str` AS link_a ON link_a.rel_mis_id = table_a.mis_id
								JOIN `sms_strategy` AS table_b ON link_a.rel_str_id = table_b.str_id
								WHERE table_a.mis_status = 1 AND table_b.str_status = 1 AND
								table_a.mis_year_id = ?
								AND link_a.rel_mis_str_status = 1
								ORDER BY table_a.mis_name ASC,table_b.str_name ASC";
        $result = $this->db->query($sql,array($this->rel_year_id));
        return $result;
    }

		public function get_poi_member($str_id)
    {
        $sql = "SELECT table_c.poi_id,table_c.poi_name,link_b.rel_str_po_id
								FROM `sms_mission` AS table_a
								JOIN `sms_relation_mis_str` AS link_a ON link_a.rel_mis_id = table_a.mis_id
								JOIN `sms_strategy` AS table_b ON link_a.rel_str_id = table_b.str_id

								JOIN `sms_relation_str_po` AS link_b ON link_b.rel_str_id = table_b.str_id
								JOIN `sms_point` AS table_c ON link_b.rel_po_id = table_c.poi_id

								WHERE table_a.mis_status = 1 AND table_b.str_status = 1 AND table_c.poi_status = 1 AND
								table_a.mis_year_id = ?

								AND link_a.rel_mis_str_status = 1 AND  link_b.rel_str_poi_status = 1 AND table_b.str_id = ".$str_id."
								ORDER BY table_b.str_name,table_c.poi_name ASC";
        $result = $this->db->query($sql,array($this->rel_year_id));
        return $result;
    }

				public function get_sstr_member($poi_id)
		    {
		        $sql = "SELECT table_d.sstr_name,link_c.rel_po_sstr_id
										FROM `sms_mission` AS table_a
										JOIN `sms_relation_mis_str` AS link_a ON link_a.rel_mis_id = table_a.mis_id
										JOIN `sms_strategy` AS table_b ON link_a.rel_str_id = table_b.str_id

										JOIN `sms_relation_str_po` AS link_b ON link_b.rel_str_id = table_b.str_id
										JOIN `sms_point` AS table_c ON link_b.rel_po_id = table_c.poi_id

										JOIN `sms_relation_poi_sstr` AS link_c ON link_c.rel_poi_id = table_c.poi_id
										JOIN `sms_sub_str` AS table_d ON link_c.rel_sstr_id = table_d.sstr_id

										WHERE table_a.mis_status = 1 AND table_b.str_status = 1 AND  table_c.poi_status = 1 AND table_d.sstr_status = 1 AND
										table_a.mis_year_id = ?

										AND link_a.rel_mis_str_status = 1 AND link_b.rel_str_poi_status = 1 AND link_c.rel_poi_sstr_status = 1
										AND table_c.poi_id = ".$poi_id."
										ORDER BY table_d.sstr_name ASC";
		        $result = $this->db->query($sql,array($this->rel_year_id));
		        return $result;
		    }

		// public function get_str_member()
		// {
		// 		$sql = "SELECT table_b.str_id ,table_b.str_name,table_c.poi_id,table_c.poi_name
		// 						FROM `sms_mission` AS table_a
		// 						JOIN `sms_relation_mis_str` AS link_a ON link_a.rel_mis_id = table_a.mis_id
		// 						JOIN `sms_strategy` AS table_b ON link_a.rel_str_id = table_b.str_id
		//
		// 						JOIN `sms_relation_str_po` AS link_b ON link_b.rel_str_id = table_b.str_id
		// 						JOIN `sms_point` AS table_c ON link_b.rel_po_id = table_c.poi_id
		//
		// 						WHERE table_a.mis_status = 1 AND table_b.str_status = 1 AND table_c.poi_status = 1 AND
		// 						table_a.mis_year_id = ?
		//
		// 						AND link_a.rel_mis_str_status = 1 AND link_b.rel_str_poi_status = 1
		//
		// 						ORDER BY table_b.str_name,table_c.poi_name ASC";
		// 		$result = $this->db->query($sql,array($this->rel_year_id));
		// 		return $result;
		// }
}
