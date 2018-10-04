<?php
require_once('Da_mission.php');

class M_mission extends Da_mission {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	public function get_mission_data()
    {
        $sql = "SELECT sms_mission.mis_id,sms_year.year_name,sms_mission.mis_name,sms_mission.mis_year_id
                FROM sms_mission
                LEFT JOIN sms_year ON sms_mission.mis_year_id = sms_year.year_id
                WHERE sms_mission.mis_status = 1
                ORDER BY sms_mission.mis_year_id ASC,sms_mission.mis_name ASC";
        $result = $this->db->query($sql);
        return $result;
    }
    // แสดงพันธกิจ dataTable

    public function get_mis_by_id()
    {
        $sql = "SELECT sms_mission.mis_id,sms_mission.mis_name,sms_year.year_name
                FROM `sms_mission`
                LEFT JOIN sms_year ON sms_mission.mis_year_id = sms_year.year_id
                WHERE  sms_mission.mis_status = 1 AND sms_mission.mis_id = ?";
        $result = $this->db->query($sql,array($this->mis_id));
        return $result;
    }
    // แสดงข้อมูลพันธกิจตาม ID

    public function get_ind_all()
    {
        $sql = "SELECT * FROM `kpi_indicator`WHERE ind_status = 1";
        $result = $this->db->query($sql);
        return $result; 
    }
    // แสดงตัวชี้วัดทั้งหมด

    public function get_ind_by_mis_id()
    {
        $sql = "SELECT kpi_indicator.ind_id,kpi_indicator.ind_name,sms_mis_ind.mis_ind_id,sms_mis_ind.mis_ind_mis_id,sms_mis_ind.mis_ind_ind_id
                FROM `kpi_indicator`
                LEFT JOIN sms_mis_ind ON kpi_indicator.ind_id = sms_mis_ind.mis_ind_ind_id
                WHERE kpi_indicator.ind_status != 0 AND sms_mis_ind.mis_ind_mis_id IS NULL OR sms_mis_ind.mis_ind_mis_id != ? 
                ORDER BY kpi_indicator.ind_id ASC";
        $result = $this->db->query($sql,array($this->mis_id));
        return $result; 
    }
    // แสดงตัวชี้วัดที่ยังไม่ได้ใช้ของพันธกิจ โดย mis id


    public function get_opt_all()
    {
        $sql = "SELECT * FROM `sms_ind_operator`";
        $result = $this->db->query($sql);
        return $result; 
    }
    // แสดงตัวเลือกคำนวณผลทั้งหมด

    public function table_ind_data()
    {
        $sql = "SELECT sms_mis_ind.*,sms_mission.mis_name,kpi_indicator.ind_name,sms_ind_operator.opt_name,sms_ind_operator.opt_symbol
                FROM `sms_mis_ind`
                LEFT JOIN sms_mission ON sms_mis_ind.mis_ind_mis_id = sms_mission.mis_id
                LEFT JOIN kpi_indicator ON sms_mis_ind.mis_ind_ind_id = kpi_indicator.ind_id
                LEFT JOIN sms_ind_operator ON sms_mis_ind.mis_ind_opt_id = sms_ind_operator.opt_id
                WHERE mis_ind_mis_id = ? AND mis_ind_status != 0";
        $result = $this->db->query($sql,array($this->mis_id));
        return $result; 
    
    }
    // ตารางแสดงข้อมูลตัวชี้วัดของพันธกิจ by mis id

    public function get_ind_by_id()
    {
        $sql = "SELECT sms_mis_ind.*,sms_mission.mis_name,kpi_indicator.ind_name,sms_ind_operator.opt_name,sms_ind_operator.opt_symbol 
                FROM `sms_mis_ind` 
                LEFT JOIN sms_mission ON sms_mis_ind.mis_ind_mis_id = sms_mission.mis_id 
                LEFT JOIN kpi_indicator ON sms_mis_ind.mis_ind_ind_id = kpi_indicator.ind_id 
                LEFT JOIN sms_ind_operator ON sms_mis_ind.mis_ind_opt_id = sms_ind_operator.opt_id
                WHERE kpi_indicator.ind_status != 0 AND mis_ind_id = ?";
        $result = $this->db->query($sql,array($this->mis_ind_id));
        return $result;
    }
    // ดึงข้อมูล ind ตอนกดปุ่มแก้ไข by ind id

    public function get_ind_by_ind_id()
    {
        $sql = "SELECT sms_mis_ind.*,sms_mission.mis_name,kpi_indicator.ind_name,sms_ind_operator.opt_name,sms_ind_operator.opt_symbol 
                FROM `sms_mis_ind` 
                LEFT JOIN sms_mission ON sms_mis_ind.mis_ind_mis_id = sms_mission.mis_id 
                LEFT JOIN kpi_indicator ON sms_mis_ind.mis_ind_ind_id = kpi_indicator.ind_id 
                LEFT JOIN sms_ind_operator ON sms_mis_ind.mis_ind_opt_id = sms_ind_operator.opt_id
                WHERE mis_ind_ind_id = ? AND mis_ind_status = 1";
        $result = $this->db->query($sql,array($this->mis_ind_ind_id));
        return $result;
    }
    // ดึงข้อมูล ind ตอนกดปุ่มแก้ไข by ind id

    public function get_opt_by_id()
    {
        $sql = "SELECT sms_mis_ind.*,sms_mission.mis_name,kpi_indicator.ind_name,sms_ind_operator.opt_name,sms_ind_operator.opt_symbol 
                FROM `sms_mis_ind` 
                LEFT JOIN sms_mission ON sms_mis_ind.mis_ind_mis_id = sms_mission.mis_id 
                LEFT JOIN kpi_indicator ON sms_mis_ind.mis_ind_ind_id = kpi_indicator.ind_id 
                LEFT JOIN sms_ind_operator ON sms_mis_ind.mis_ind_opt_id = sms_ind_operator.opt_id
                WHERE mis_ind_opt_id = ?";
        $result = $this->db->query($sql,array($this->mis_ind_opt_id));
        return $result;
    }
    // ดึงข้อมูลตัวดำเนินการตอนกดปุ่มแก้ไข by opt id

    public function get_mis_by_year()
    {
        $sql = "SELECT sms_mission.mis_id,sms_mission.mis_name
                FROM `sms_mission` 
                WHERE sms_mission.mis_status != 0 AND sms_mission.mis_year_id = ?";
        $result = $this->db->query($sql,array($this->mis_year_id));
        return $result;
    }
    // แสดงพันธกิจตามปีงบประมาณ
	
}
