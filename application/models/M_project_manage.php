<?php
require_once('Da_project_manage.php');

class M_project_manage extends Da_project_manage {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_prj_data()
    {
        // $sql = "SELECT prj_id,prj_code,prj_name,prj_start,prj_end,prj_year_id
        //         FROM `sms_project` 
        //         WHERE prj_status != 0 AND prj_year_id = ?";
        // $sql = "SELECT sms_project.prj_id,sms_project.prj_code,sms_project.prj_site_name,sms_project.prj_name,sms_project.prj_start,sms_project.prj_end,sms_project.prj_year_id,sms_responsibles.resp_name
        //         FROM `sms_project`
        //         LEFT JOIN sms_responsibles ON sms_project.prj_id = sms_responsibles.resp_prj_id
        //         WHERE sms_project.prj_status != 0 AND sms_project.prj_year_id = ? AND sms_responsibles.resp_status != 0 AND sms_responsibles.resp_pos_id = 1
        //         GROUP BY sms_project.prj_id";
        $sql = "SELECT sms_project.prj_id,sms_project.prj_code,sms_project.prj_site_name,sms_project.prj_name,sms_project.prj_start,sms_project.prj_end,sms_project.prj_year_id
                FROM `sms_project`
                WHERE sms_project.prj_status != 0 AND sms_project.prj_year_id = ?";
        // $sql = "SELECT *
        //         FROM `sms_project`
        //         WHERE sms_project.prj_status != 0 AND sms_project.prj_year_id = ?";
        $result = $this->db->query($sql,array($this->prj_year_id));
        return $result;
    }
    // datatable project manage
    
    public function get_prj_data_by_id()
    {
        $sql = "SELECT * 
                FROM `sms_project`
                WHERE prj_id = ?";
        $result = $this->db->query($sql,array($this->prj_id));
        return $result;
    }
    // ดึงข้อมูลโครงการหน้า edit project

    public function get_prj_set_data()
    {
        $sql = "SELECT sms_project.*,sms_year.year_name
                FROM `sms_project`
                LEFT JOIN sms_year ON sms_project.prj_year_id = sms_year.year_id
                WHERE sms_project.prj_id = ?";
        $result = $this->db->query($sql,array($this->prj_id));
        return $result;
    }
    // set data หน้าตั้งค่าโครงการ

    public function get_org_by_prj()
    {
        $sql = "SELECT prj_site_name
                FROM `sms_project`
                WHERE prj_id = ?";
        $result = $this->db->query($sql,array($this->prj_id));
        return $result;
    }
    // ดึงข้อมูลชื่อหน่วยงานของโครงการตอนกด edit

    public function get_prj_ind_data()
    {
        $sql = "SELECT sms_project_indicators.*,sms_ind_operator.opt_name,sms_ind_operator.opt_symbol
                FROM `sms_project_indicators`
                LEFT JOIN sms_ind_operator ON sms_project_indicators.prj_ind_opt = sms_ind_operator.opt_id
                WHERE sms_project_indicators.prj_ind_status != 0 AND sms_project_indicators.prj_ind_prj_id = ?";
        $result = $this->db->query($sql,array($this->prj_ind_prj_id));
        return $result;
    }
    // datatable prj_ind by prj_id

    public function get_prj_ind_by_id()
    {
        $sql = "SELECT * 
                FROM `sms_project_indicators`
                WHERE prj_ind_id = ?";
        $result = $this->db->query($sql,array($this->prj_ind_id));
        return $result;
    }
    // ดึงข้อมูลตัวชี้วัดโครงการตอนกด edit

    public function get_opt_ind_by_id()
    {
        $sql = "SELECT sms_ind_operator.*
                FROM `sms_project_indicators`
                LEFT JOIN sms_ind_operator ON sms_project_indicators.prj_ind_opt = sms_ind_operator.opt_id
                WHERE sms_project_indicators.prj_ind_id = ?";
        $result = $this->db->query($sql,array($this->prj_ind_id));
        return $result;
    }
    // แสดงข้อมูลตัวชี้วัดโดย ind_id

}
