<?php
require_once('Da_sub_strategy.php');

class M_sub_strategy extends Da_sub_strategy {
	
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

    public function get_sstr_by_id()
    {
        $sql = "SELECT sms_sub_str.sstr_id,sms_sub_str.sstr_name,sms_sub_str.sstr_viewp_id,sms_sub_str.sstr_year_id
                FROM `sms_sub_str` 
                WHERE sms_sub_str.sstr_id = ?";
        $result = $this->db->query($sql,array($this->sstr_id));
        return $result;
    }
    // ดึงข้อมูลกลยุทธ์ตาม id
    
    public function table_ind_data()
    {
        $sql = "SELECT sms_sub_str_ind.sstr_ind_id,sms_sub_str_ind.sstr_ind_sstr_id,sms_sub_str_ind.sstr_ind_ind_id,sms_sub_str_ind.sstr_ind_unt,sms_sub_str_ind.sstr_ind_opt_id,sms_sub_str_ind.sstr_ind_goal,sms_sub_str.sstr_name,kpi_indicator.ind_name,sms_ind_operator.opt_name,sms_ind_operator.opt_symbol
                FROM `sms_sub_str_ind`
                LEFT JOIN sms_sub_str ON sms_sub_str_ind.sstr_ind_sstr_id = sms_sub_str.sstr_id
                LEFT JOIN kpi_indicator ON sms_sub_str_ind.sstr_ind_ind_id = kpi_indicator.ind_id
                LEFT JOIN sms_ind_operator ON sms_sub_str_ind.sstr_ind_opt_id = sms_ind_operator.opt_id
                WHERE sms_sub_str_ind.sstr_ind_status != 0 AND sms_sub_str.sstr_status != 0 AND sms_sub_str_ind.sstr_ind_sstr_id = ?";
        $result = $this->db->query($sql,array($this->sstr_ind_sstr_id));
        return $result;
    }
    // ตารางแสดงข้อมูลตัวชี้วัดของกลยุทธ์ โดย sstr id
}
