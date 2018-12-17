<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_Model.php");

class Da_year extends Main_Model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
    public function delete_year()
    {
        $sql = "UPDATE `sms_year` 
                SET `year_status` = '0' 
                WHERE `sms_year`.`year_id` = ?";
        $this->db->query($sql,array($this->year_id));
    }
    // del_year

    public function insert_year()
    {
        $sql = "INSERT INTO `sms_year` (`year_name`, `year_status`) 
                VALUE(?,1)";
        $this->db->query($sql,array($this->year_name));
    }
    
    public function insert_year_empty()
    {
        $sql = "INSERT INTO `sms_year` (`year_name`, `year_status`) 
                VALUES (?,1)";
        $this->db->query($sql,($this->year_name));
    }
	
}
