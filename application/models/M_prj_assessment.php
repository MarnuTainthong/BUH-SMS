<?php
require_once('Da_prj_assessment.php');

class M_prj_assessment extends Da_prj_assessment {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_prj_set_data()
    {
        $sql = "SELECT sms_project.*,sms_year.year_name,sms_sub_str.sstr_name,sms_measure.mea_name,sms_measure.mea_code
                FROM `sms_project` 
                LEFT JOIN sms_year ON sms_project.prj_year_id = sms_year.year_id
                LEFT JOIN sms_sub_str ON sms_project.prj_sub_str_id = sms_sub_str.sstr_id
                LEFT JOIN sms_measure ON sms_project.prj_kpi_id = sms_measure.mea_id
                WHERE  sms_project.prj_id = ?";
		$result = $this->db->query($sql,array($this->prj_id));
		return $result;
    }
    // ดึงข้อมูล prj มา set data
    
    public function get_prj_ind_data()
    {
        $sql = "SELECT sms_project_indicators.prj_ind_id,sms_project_indicators.prj_ind_name,sms_ind_operator.opt_name,sms_ind_operator.opt_symbol,sms_project_indicators.prj_ind_target,sms_project_indicators.prj_ind_unit,sms_result_assess.*
                FROM `sms_project_indicators` 
                LEFT JOIN sms_ind_operator ON sms_project_indicators.prj_ind_opt = sms_ind_operator.opt_id
                LEFT JOIN sms_result_assess ON sms_project_indicators.prj_ind_id = sms_result_assess.rs_prj_ind_id
                WHERE sms_project_indicators.prj_ind_id = ?";
        // $sql = "SELECT sms_project_indicators.prj_ind_id,sms_project_indicators.prj_ind_name,sms_ind_operator.opt_name,sms_ind_operator.opt_symbol,sms_project_indicators.prj_ind_target,sms_project_indicators.prj_ind_unit
        //         FROM `sms_project_indicators` 
        //         LEFT JOIN sms_ind_operator ON sms_project_indicators.prj_ind_opt = sms_ind_operator.opt_id
        //         WHERE  sms_project_indicators.prj_ind_id = ?";
        $result = $this->db->query($sql,array($this->prj_ind_id));
        return $result;
    }
    // ดึงข้อมูลตัวชี้วัดโครงการ by ind_id 
    
    public function get_score()
    {
        // $sql = 'SELECT sms_result_assess.rs_score
        //         FROM `sms_project_indicators` 
        //         LEFT JOIN sms_ind_operator ON sms_project_indicators.prj_ind_opt = sms_ind_operator.opt_id
        //         LEFT JOIN sms_result_assess ON sms_project_indicators.prj_ind_id = sms_result_assess.rs_prj_ind_id';
        $sql = "SELECT sms_result_assess.rs_score
                FROM `sms_project_indicators` 
                LEFT JOIN sms_ind_operator ON sms_project_indicators.prj_ind_opt = sms_ind_operator.opt_id
                LEFT JOIN sms_result_assess ON sms_project_indicators.prj_ind_id = sms_result_assess.rs_prj_ind_id
                WHERE sms_project_indicators.prj_ind_status != 0 AND sms_project_indicators.prj_ind_prj_id = ?";
        $result = $this->db->query($sql,array($this->prj_ind_prj_id));
        return $result;
    }
    // ดึงข้อมูลคะแนนตัวชี้วัด ใช้ disble ปุ่มประเมินผล

}
