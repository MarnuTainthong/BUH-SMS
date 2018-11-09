<?php
require_once('Da_measure.php');

class M_measure extends Da_measure {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_mea_data()
    {
        $sql = "SELECT sms_measure.*,sms_year.year_name 
                FROM `sms_measure`
                LEFT JOIN sms_year ON sms_measure.mea_year_id = sms_year.year_id
                WHERE sms_measure.mea_status != 0
                ORDER BY sms_measure.mea_year_id ASC,sms_measure.mea_id ASC";
        $result = $this->db->query($sql);
        return $result;
    }
    // แสดงตัวบ่งชี้ datatable
   
    public function get_mea_by_id()
    {
        $sql = "SELECT * 
                FROM `sms_measure`
                WHERE sms_measure.mea_id = ?";
        $result = $this->db->query($sql,array($this->mea_id));
        return $result;
    }
    // ดึงข้อมูลตัวบ่งชี้ตาม id

    public function get_mea_by_year()
    {
        $sql = "SELECT mea_id,mea_name
                FROM `sms_measure`
                WHERE mea_status !=0 AND mea_year_id = ?";
        $result = $this->db->query($sql,array($this->mea_year_id));
        return $result;
    }
    // ดึงข้อมูลตัวบ่งชี้ตาม year_id

    public function get_mea_by_prj_id()
    {
        $sql = "SELECT sms_measure.mea_id,sms_measure.mea_name
                FROM `sms_measure` 
                LEFT JOIN sms_project ON sms_measure.mea_id = sms_project.prj_kpi_id
                WHERE sms_project.prj_id = ?";
        $result = $this->db->query($sql,array($this->prj_id));
        return $result;
    }
    // ดึงข้อมูลตัวบ่งชี้โดย prj_id
}
