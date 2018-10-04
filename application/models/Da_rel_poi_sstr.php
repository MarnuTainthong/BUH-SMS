<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_Model.php");

class Da_rel_poi_sstr extends Main_Model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_rel_psstr()
    {
        $sql = "INSERT INTO `sms_relation_poi_sstr` (`rel_poi_id`, `rel_sstr_id`, `rel_year_id`, `rel_poi_sstr_status`)
                VALUES (?, ?, ?, 1)";
        $result = $this->db->query($sql,array($this->rel_poi_id,$this->rel_sstr_id,$this->rel_year_id));
    }
    // insert การตั้งค่าความสัมพันธ์ 

}