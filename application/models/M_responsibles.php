<?php
require_once('Da_responsibles.php');

class M_responsibles extends Da_responsibles {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_prj_resp()
    {
        $sql = "SELECT sms_responsibles.resp_id,sms_responsibles.resp_prj_id,sms_responsibles.resp_pos_id,sms_responsibles.resp_name,sms_pos_project.pos_name
                FROM `sms_responsibles`
                LEFT JOIN sms_pos_project ON sms_responsibles.resp_pos_id = sms_pos_project.pos_id
                WHERE resp_status != 0 AND resp_prj_id = ?";
        $result = $this->db->query($sql,array($this->resp_prj_id));
        return $result;
    }
    // datatable project resp by prj_id

    public function get_prj_owner()
    {
        $sql = "SELECT sms_responsibles.resp_id,sms_responsibles.resp_prj_id,sms_responsibles.resp_pos_id,sms_responsibles.resp_name
                FROM `sms_responsibles`
                WHERE sms_responsibles.resp_status != 0 AND sms_responsibles.resp_pos_id = 1";
        $result = $this->db->query($sql);
        return $result;
    }
    // ดึงข้อมูลเจ้าของโครงการ
    
    public function get_resp_name_by_resp()
    {
        $sql = "SELECT resp_id,resp_prj_id,resp_pos_id,resp_name,resp_name
                FROM `sms_responsibles`
                WHERE resp_id = ?";
        $result = $this->db->query($sql,array($this->resp_id));
        return $result;
    }
    // ดึงข้อมูลผู้รับผิดชอบโครงการตอนกด edit

    public function get_pos_by_resp()
    {
        $sql = "SELECT sms_responsibles.resp_id,sms_responsibles.resp_prj_id,sms_responsibles.resp_pos_id,sms_responsibles.resp_name,sms_pos_project.pos_name
                FROM `sms_responsibles`
                LEFT JOIN sms_pos_project ON sms_responsibles.resp_pos_id = sms_pos_project.pos_id
                WHERE sms_responsibles.resp_id = ?";
        $result = $this->db->query($sql,array($this->resp_id));
        return $result;
    }
    // ดึงข้อมูลตำแหน่งในโครงการโดย resp_id

}
