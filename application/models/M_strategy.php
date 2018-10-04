<?php
require_once('Da_strategy.php');

class M_strategy extends Da_strategy {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	public function get_str_data()
    {
        $sql = "SELECT sms_strategy.str_id,sms_year.year_name,sms_strategy.str_name
                FROM sms_strategy
                LEFT JOIN sms_year ON sms_strategy.str_year_id = sms_year.year_id
                WHERE sms_strategy.str_status != 0
                ORDER BY sms_year.year_id ASC,sms_strategy.str_name ASC";
        $result = $this->db->query($sql);
        return $result;
    }
    // แสดงยุทธศาสตร์ dataTable

    public function get_str_by_id()
    {
        $sql = "SELECT sms_strategy.str_id,sms_strategy.str_name,sms_year.year_name
                FROM sms_strategy
                LEFT JOIN sms_year ON sms_strategy.str_year_id = sms_year.year_id
                WHERE sms_strategy.str_status = 1 AND sms_strategy.str_id = ?";
        $result = $this->db->query($sql,array($this->str_id));
        return $result;
    }
    // แสดงข้อมูลยุทธศาสตร์ตาม id

    public function table_ind_data()
    {
        $sql = "SELECT  sms_str_ind.str_ind_id, sms_str_ind.str_ind_str_id, sms_str_ind.str_ind_ind_id, sms_str_ind.str_ind_unt, sms_str_ind.str_ind_opt_id, sms_str_ind.str_ind_goal,sms_strategy.str_name,kpi_indicator.ind_name,sms_ind_operator.opt_name,sms_ind_operator.opt_symbol
                FROM `sms_str_ind`
                LEFT JOIN sms_strategy ON sms_str_ind.str_ind_str_id = sms_strategy.str_id
                LEFT JOIN kpi_indicator ON sms_str_ind.str_ind_ind_id = kpi_indicator.ind_id
                LEFT JOIN sms_ind_operator ON sms_str_ind.str_ind_opt_id = sms_ind_operator.opt_id
                WHERE sms_str_ind.str_ind_status != 0 AND sms_strategy.str_status = 1 AND sms_str_ind.str_ind_str_id = ?";
        $result = $this->db->query($sql,array($this->str_ind_str_id));
        return $result;
    }
    // ตารางแสดงข้อมูลตัวชี้วัดของยุทธศาสตร์ โดย str id
    
    public function get_ind_by_str_id()
    {
        $sql = "SELECT kpi_indicator.ind_id,kpi_indicator.ind_name,sms_str_ind.str_ind_id,sms_str_ind.str_ind_str_id,sms_str_ind.str_ind_ind_id
                FROM kpi_indicator
                LEFT JOIN sms_str_ind ON kpi_indicator.ind_id = sms_str_ind.str_ind_ind_id
                WHERE kpi_indicator.ind_status != 0 AND sms_str_ind.str_ind_ind_id IS NULL OR sms_str_ind.str_ind_str_id != ?
                ORDER BY kpi_indicator.ind_id ASC";
        $result = $this->db->query($sql,array($this->str_id));
        return $result; 
    }
    // แสดงตัวชี้วัดที่ยังไม่ได้ใช้ของยุทธศาสตร์ โดย str id

    public function get_ind_by_id()
    {
        $sql = "SELECT sms_str_ind.*,sms_strategy.str_name,kpi_indicator.ind_name,sms_ind_operator.opt_name,sms_ind_operator.opt_symbol
                FROM sms_str_ind
                LEFT JOIN sms_strategy ON sms_str_ind.str_ind_str_id = sms_strategy.str_id
                LEFT JOIN kpi_indicator ON sms_str_ind.str_ind_ind_id = kpi_indicator.ind_id
                LEFT JOIN sms_ind_operator ON sms_str_ind.str_ind_opt_id = sms_ind_operator.opt_id
                WHERE str_ind_id = ?";
        $result = $this->db->query($sql,array($this->str_ind_id));
        return $result;
    }
    // ดึงข้อมูล ind ตอนกดปุ่มแก้ไข โดย ind id

    public function get_ind_by_ind_id()
    {
        $sql = "SELECT sms_str_ind.*,kpi_indicator.ind_name
                FROM sms_str_ind
                LEFT JOIN kpi_indicator ON sms_str_ind.str_ind_ind_id = kpi_indicator.ind_id
                WHERE str_ind_ind_id = ?";
        $result = $this->db->query($sql,array($this->str_ind_ind_id));
        return $result;
    }
    // ดึงข้อมูล ind ตอนกดปุ่มแก้ไข by ind2 id

    public function get_str_not_use()
    {
        $sql = "SELECT sms_strategy.* 
                FROM `sms_strategy`
                LEFT JOIN sms_relation_mis_str ON sms_relation_mis_str.rel_str_id = sms_strategy.str_id
                WHERE sms_relation_mis_str.rel_str_id IS NULL AND sms_strategy.str_status != 0 AND sms_strategy.str_year_id = ?";
        $result = $this->db->query($sql,array($this->str_year_id));
        return $result;
    }
    // ดึงข้อมูลยุทธศาสตร์ที่ไม่ถูกตั้งค่าความสัมพันธ์
}
