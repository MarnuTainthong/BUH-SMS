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

    public function update_prj()
    {
        $sql = "UPDATE `sms_project` 
                SET `prj_site_name` = ?, `prj_sub_str_id` = ?, `prj_kpi_id` = ?, `prj_type` = ?, `prj_code` = ?, `prj_name` = ?, `prj_set_bdgt_land` = ?, `prj_set_bdgt_fcty` = ?, `prj_set_bdgt_oth` = ?, `prj_bdgt_oth_name` = ?, `prj_start` = ?, `prj_end` = ?
                WHERE `sms_project`.`prj_id` = ?";
        $result = $this->db->query($sql,array($this->prj_site_name,$this->prj_sub_str_id,$this->prj_kpi_id,$this->prj_type,$this->prj_code,$this->prj_name,
        $this->prj_set_bdgt_land,$this->prj_set_bdgt_fcty,$this->prj_set_bdgt_oth,$this->prj_bdgt_oth_name,$this->prj_start,$this->prj_end,$this->prj_id));
    }
    // update โครงการ

    public function delete_prj()
    {
        $sql = "UPDATE `sms_project` 
                SET `prj_status` = '0' 
                WHERE `sms_project`.`prj_id` = ?";
        $result = $this->db->query($sql,array($this->prj_id));
    }
    // delete โครงการ

    public function insert_prj_ind()
    {
        $sql = "INSERT INTO `sms_project_indicators` (`prj_ind_prj_id`, `prj_ind_name`, `prj_ind_opt`, `prj_ind_target`, `prj_ind_unit`, `prj_ind_status`) 
                VALUES (?, ?, ?, ?, ?,1)";
        $result = $this->db->query($sql,array($this->prj_ind_prj_id,$this->prj_ind_name,$this->prj_ind_opt,$this->prj_ind_target,$this->prj_ind_unit));
    }
    // insert ตัวชี้วัดโครงการ

    public function update_prj_ind()
    {
        $sql = "UPDATE `sms_project_indicators` 
                SET `prj_ind_prj_id` = ?, `prj_ind_name` = ?, `prj_ind_opt` = ?, `prj_ind_target` = ?, `prj_ind_unit` = ? 
                WHERE `sms_project_indicators`.`prj_ind_id` = ?";
        $result = $this->db->query($sql,array($this->prj_ind_prj_id,$this->prj_ind_name,$this->prj_ind_opt,$this->prj_ind_target,$this->prj_ind_unit,$this->prj_ind_id));
    }
    // update ตัวชี้วัดโครงการ

    public function delete_prj_ind()
    {
       $sql = "UPDATE `sms_project_indicators` 
                SET `prj_ind_status` = '0' 
                WHERE `sms_project_indicators`.`prj_ind_id` = ?";
        $result = $this->db->query($sql,array($this->prj_ind_id));
    }
    // delete ตัวชี้วัดโครงการ

    public function delete_prj_ind_when_del_prj()
    {
        $sql = "UPDATE `sms_project_indicators` 
                SET `prj_ind_status` = '0' 
                WHERE `sms_project_indicators`.`prj_ind_id`IN (SELECT prj_ind_id FROM(
                                                                                SELECT prj_ind_id
                                                                                FROM `sms_project_indicators`
                                                                                WHERE prj_ind_status != 0 AND prj_ind_prj_id = ?) AS T)";
        $result = $this->db->query($sql,array($this->prj_ind_prj_id));
    }
    // delete ตัวชี้วัดโครงการตอนลบโครงการ

}