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
    
    public function get_ind_by_sstr_id()
    {
        $sql = "SELECT kpi_indicator.ind_id,kpi_indicator.ind_name,sms_sub_str_ind.sstr_ind_id,sms_sub_str_ind.sstr_ind_sstr_id,sms_sub_str_ind.sstr_ind_ind_id
                FROM `kpi_indicator`
                LEFT JOIN sms_sub_str_ind ON kpi_indicator.ind_id = sms_sub_str_ind.sstr_ind_ind_id
                WHERE sms_sub_str_ind.sstr_ind_id IS NULL OR sms_sub_str_ind.sstr_ind_sstr_id != ?
                ORDER BY kpi_indicator.ind_id ASC";
        $result = $this->db->query($sql,array($this->sstr_ind_sstr_id));
        return $result;
    }
    // แสดงตัวชี้วัดที่ไม่ได้ใช้ โดย sstr id

    public function get_ind_by_id()
    {
        $sql = "SELECT * 
                FROM `sms_sub_str_ind`
                WHERE sms_sub_str_ind.sstr_ind_id = ?";
        $result = $this->db->query($sql,array($this->sstr_ind_id));
        return $result;
    }
    // ดึงข้อมูลตัวชี้วัดของกลยุทธ์ โดย sstr id

    public function get_ind_by_ind_id()
    {
        $sql = "SELECT sms_sub_str_ind.* ,kpi_indicator.ind_name
                FROM `sms_sub_str_ind`
                LEFT JOIN kpi_indicator ON sms_sub_str_ind.sstr_ind_ind_id = kpi_indicator.ind_id
                WHERE sms_sub_str_ind.sstr_ind_ind_id = ?";
        $result = $this->db->query($sql,array($this->sstr_ind_ind_id));
        return $result;
    }
    // ดึงข้อมูล ind ตอนกดปุ่มแก้ไข by ind2 id

    public function get_sstr_not_use()
    {
        $sql = "SELECT sms_sub_str.* 
                FROM `sms_sub_str`
                LEFT JOIN sms_relation_poi_sstr ON sms_relation_poi_sstr.rel_sstr_id = sms_sub_str.sstr_id
                WHERE sms_sub_str.sstr_id NOT IN (SELECT sms_sub_str.sstr_id
                                            FROM `sms_sub_str`
                                            LEFT JOIN sms_relation_poi_sstr ON sms_relation_poi_sstr.rel_sstr_id = sms_sub_str.sstr_id
                                            WHERE sms_relation_poi_sstr.rel_year_id = ? AND sms_relation_poi_sstr.rel_poi_sstr_status != 0) AND sms_sub_str.sstr_status != 0 AND sms_sub_str.sstr_year_id = ?";
        $result = $this->db->query($sql,array($this->sstr_year_id,$this->sstr_year_id));
        return $result;
    }
    // ดึงข้อมูลกลยุทธ์ที่ไม่ถูกตั้งค่าความสัมพันธ์
    
    public function get_sstr_by_year_id()
    {
        $sql = "SELECT sstr_id,sstr_name
                FROM `sms_sub_str` 
                WHERE sstr_status != 0 AND sstr_year_id = ?";
        $result = $this->db->query($sql,array($this->sstr_year_id));
        return $result;
        
    }
    // ดึงข้อมูลกลยุทธ์โดย year_id
    
    public function get_sstr_by_prj_id()
    {
        $sql = "SELECT sms_sub_str.sstr_id,sms_sub_str.sstr_name
                FROM `sms_sub_str`
                LEFT JOIN sms_project ON sms_sub_str.sstr_id = sms_project.prj_sub_str_id
                WHERE sms_project.prj_sub_str_id IS NOT NULL AND sms_project.prj_id = ?";
        $result = $this->db->query($sql,array($this->prj_id));
        return $result;
    }
    // ดึงข้อมูลกลยุทธ์โดย prj_id

    public function chk_del_sstr()
    {
        $sql = "SELECT sms_project.prj_id
                FROM `sms_sub_str`
                LEFT JOIN sms_project ON sms_sub_str.sstr_id = sms_project.prj_sub_str_id
                WHERE sms_project.prj_status != 0 AND sms_sub_str.sstr_id = ?";
        $result = $this->db->query($sql,array($this->sstr_id));
        return $result;
    }
    // เช็คว่ามีโครงการไหนใช้กลยุทธ์บ้าง

}
