<?php
require_once('Da_year.php');

class M_year extends Da_year {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	public function get_year(){
		$sql = "SELECT *
				FROM sms_year
				WHERE sms_year.year_status = 1";
		$result = $this->db->query($sql);
		return $result;
	}

	public function get_last_year()
	{
		$sql = "SELECT year_name
				FROM sms_year
				WHERE sms_year.year_status = 1
				ORDER BY year_id DESC LIMIT 1";
		$result = $this->db->query($sql);
		return $result;
	}
	// ดึงค่าปีสุดท้าย
	
	public function check_delete_year()
	{
		$sql = "SELECT sms_vision.vis_id
		FROM `sms_vision`
		LEFT JOIN sms_year ON sms_vision.vis_year_id = sms_year.year_id
		WHERE sms_vision.vis_status != 0 AND sms_vision.vis_year_id = ?";
		$result = $this->db->query($sql,array($this->vis_year_id));
		return $result;
	}
	// check ปีงบประมาณว่ามีวิสัยทัศน์ไหม ถ้ามีจะลบไม่ได้

	public function get_year_have_vis()
	{
		$sql = "SELECT sms_year.year_id,sms_year.year_name,sms_vision.vis_name
				FROM `sms_year`
				LEFT JOIN sms_vision ON sms_year.year_id = sms_vision.vis_year_id
				WHERE sms_year.year_status != 0 AND sms_vision.vis_status != 0";
		$result = $this->db->query($sql);
		return $result;
	}
	// แสดงปีงบประมาณที่มีการเพิ่มวิสัยทัศน์ ใช้การนำไปเลือกเพิ่มข้อมูลพื้นฐานอื่นๆ

	public function get_year_select()
    {
        $sql = "SELECT sms_year.* 
				FROM sms_year
				LEFT JOIN sms_vision ON sms_year.year_id = sms_vision.vis_year_id
				WHERE sms_vision.vis_id IS NULL OR sms_vision.vis_status = 0
				ORDER BY sms_year.year_name ASC";
        $result = $this->db->query($sql);
        return $result;
    }
    // แสดงปีที่ยังไม่มีวิสัยทัศน์ opt 

    public function get_year_by_vis_id()
    {
        $sql = "SELECT sms_vision.vis_id,sms_vision.vis_name,sms_vision.vis_year_id,sms_year.year_name
                FROM sms_year
                LEFT JOIN sms_vision ON sms_year.year_id = sms_vision.vis_year_id
                WHERE sms_vision.vis_id IS NOT NULL AND sms_vision.vis_id = ?
                ORDER BY sms_year.year_name ASC";
        $result = $this->db->query($sql,array($this->vis_id));
        return $result;
    }
	// แสดงปีงบประมาณของวิสัยทัศน์
	
    public function get_year_by_mis_id()
    {
        $sql = "SELECT sms_mission.mis_id,sms_mission.mis_name,sms_mission.mis_year_id,sms_year.year_name
				FROM sms_mission
				LEFT JOIN sms_year ON sms_mission.mis_year_id = sms_year.year_id
				WHERE sms_mission.mis_status = 1 AND sms_mission.mis_id = ?";
        $result = $this->db->query($sql,array($this->mis_id));
        return $result;
    }
	// แสดงปีงบประมาณของพันธกิจ
	
    public function get_year_by_str_id()
    {
        $sql = "SELECT sms_strategy.str_id,sms_strategy.str_name,sms_strategy.str_year_id,sms_year.year_name
				FROM sms_strategy
				LEFT JOIN sms_year ON sms_strategy.str_year_id = sms_year.year_id
				WHERE sms_strategy.str_status = 1 AND sms_strategy.str_id = ?";
        $result = $this->db->query($sql,array($this->str_id));
        return $result;
    }
	// แสดงปีงบประมาณของยุทธศาสตร์
	
	public function get_year_by_poi_id()
	{
		$sql = "SELECT sms_point.poi_id,sms_point.poi_name,sms_point.poi_year_id,sms_year.year_name
				FROM sms_point
				LEFT JOIN sms_year ON sms_point.poi_year_id = sms_year.year_id
				WHERE sms_point.poi_status != 0 AND sms_point.poi_id = ?";
		$result = $this->db->query($sql,array($this->poi_id));
        return $result;
	}
	// แสดงปีงบประมาณของเป้าประสงค์

	public function get_year_by_vpt_id()
	{
		$sql = "SELECT sms_view_point.vpt_id,sms_view_point.vpt_name,sms_view_point.vpt_year_id
				FROM `sms_view_point`
				LEFT JOIN sms_year ON sms_view_point.vpt_year_id = sms_year.year_id
				WHERE sms_view_point.vpt_status != 0 AND sms_view_point.vpt_id = ?";
		$result = $this->db->query($sql,array($this->vpt_id));
        return $result;
	}
	
}
