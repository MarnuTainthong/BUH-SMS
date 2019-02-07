<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\..\Login_Controller.php");

class Sms_state_project extends Login_Controller {

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        // $this->load->model('m_mission','mis_rs');
        // $this->load->model('m_project_manage','prmng_rs');
        // $this->load->model('m_sub_strategy','sstr_rs');
        // $this->load->model('m_measure','mea_rs');
        // $this->load->model('m_project_position','pos_rs');
        // $this->load->model('m_responsibles','resp_rs');

    }

	public function index()
	{
        // echo "Access system is forbidden.";
        $this->output($this->config->item('admin').'/v_save_state_prj');
        // go to page save state prj
    }


}