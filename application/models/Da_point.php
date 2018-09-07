<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_Model.php");

class Da_point extends Main_Model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_poi()
    {
        $sql = "INSERT INTO `sms_point` (`poi_name`, `poi_year_id`, `poi_status`) 
                VALUES (?,?,1)";
        $this->db->query($sql,array($this->poi_name,$this->poi_year_id));
    }
    // insert เป้าประสงค์

    public function update_poi()
    {
        $sql = "UPDATE `sms_point` 
                SET `poi_name` = ?, `poi_year_id` = ? 
                WHERE `sms_point`.`poi_id` = ?";
        $this->db->query($sql,array($this->poi_name,$this->poi_year_id,$this->poi_id));
    }
    // update เป้าประสงค์

    public function delete_poi()
    {
        $sql = "UPDATE `sms_point` 
                SET `poi_status` = '0' 
                WHERE `sms_point`.`poi_id` = ?";
        $this->db->query($sql,array($this->poi_id));
    }
    // delete เป้าประสงค์

}