<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_Model.php");

class Da_project_manage extends Main_Model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_prj()
    {
        $sql = "INSERT INTO `sms_project` (`prj_year_id`, `prj_site_name`, `prj_sub_str_id`, `prj_kpi_id`, `prj_type`, `prj_code`, `prj_name`, 
                            `prj_set_bdgt_land`, `prj_set_bdgt_fcty`, `prj_set_bdgt_oth`, `prj_bdgt_oth_name`, `prj_start`, `prj_end`, `prj_status`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,1)";
        $this->db->query($sql,array($this->prj_year_id,$this->prj_site_name,$this->prj_sub_str_id,$this->prj_kpi_id,$this->prj_type,$this->prj_code, $this->prj_name,
                        $this->prj_set_bdgt_land,$this->prj_set_bdgt_fcty,$this->prj_set_bdgt_oth,$this->prj_bdgt_oth_name,$this->prj_start,$this->prj_end));
        
    }
    // insert โครงการ

}