<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\..\Login_Controller.php");

class Sms_state_project extends Login_Controller {

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        // $this->load->model('m_mission','mis_rs');
        $this->load->model('m_project_manage','prmng_rs');
        // $this->load->model('m_sub_strategy','sstr_rs');
        // $this->load->model('m_measure','mea_rs');
        // $this->load->model('m_project_position','pos_rs');
        $this->load->model('m_responsibles','resp_rs');

    }

	public function index()
	{
        // echo "Access system is forbidden.";
        $this->output($this->config->item('admin').'/v_save_state_prj');
        // go to page save state prj
    }

    public function get_prj_show()
    {
        $year_id = $this->input->post('year_id');

        if (empty($year_id)) {
            $data = array(
                'prj_seq'           => 'กรุณาเลือกปีงบประมาณเพื่อแสดงข้อมูล'
            );

            echo json_encode($data);
        }else{

            $this->prmng_rs->prj_year_id = $year_id;
            $result_prj = $this->prmng_rs->get_prj_data()->result();
            $result_resp = $this->resp_rs->get_prj_owner()->result();

            // pre($result_resp);die;

            $all_data = array();
            $i=1;
            $search_state=0; //0=ไม่เจอ 1=เจอ
            $chk_resp=0; //0=ไม่มี 1=มี

            foreach ($result_prj as $row_prj) {
                foreach ($result_resp as $row_resp) {
                    if ($row_prj->prj_id == $row_resp->resp_prj_id) {
                        $data = array(
                            'prj_seq'           => '<center>'.$i++.'</center>',
                            'prj_code'          => '<center>'.$row_prj->prj_code.'</center>',
                            'prj_name'          => $row_prj->prj_name,
                            'prj_respon'        => '- '.$row_prj->prj_site_name.'<br>'.'- '.$row_resp->resp_name,
                            'prj_duration'      => '<center>'.fullDateTH3($row_prj->prj_start).' ถ ึง <br>'.fullDateTH3($row_prj->prj_end).'</center>',
                            'prj_action'        => '<center>
                                                    <a class="'.$this->config->item("btn_success").'" data-tooltip="คลิกเพื่อบันทึกผล" href="'.site_url().'/admin/Sms_state_project/set_state_project/'.$row_prj->prj_id.'"><i class="'.$this->config->item('sms_icon_save').'" aria-hidden="true"></i></a>
                                                    </center>'
                        );
                        array_push($all_data,$data);
                        $chk_resp=1;
                    }else {
                        $search_state++;
                    }
                    
                    if ($search_state>0 && $search_state == count($result_resp)) {
                        $data = array(
                            'prj_seq'           => '<center>'.$i++.'</center>',
                            'prj_code'          => '<center>'.$row_prj->prj_code.'</center>',
                            'prj_name'          => $row_prj->prj_name,
                            'prj_respon'        => '- '.$row_prj->prj_site_name.'<br>'.'- '.'<font color="'.'red'.'">ยังไม่ได้กำหนดผู้รับผิดชอบโครงการ</font>',
                            'prj_duration'      => '<center>'.fullDateTH3($row_prj->prj_start).' ถ ึง <br>'.fullDateTH3($row_prj->prj_end).'</center>',
                            'prj_action'        => '<center>
                                                    <a class="'.$this->config->item("btn_success").'" data-tooltip="คลิกเพื่อบันทึกผล" href=" " ><i class="'.$this->config->item('sms_icon_save').'" aria-hidden="true"></i></a>
                                                    </center>'
                        );
                        array_push($all_data,$data);
                    }
                }
                $search_state=0;
            }
            
            echo json_encode($all_data);
        }
        
    }
    // datatable show prj

    public function set_state_project ($prj_id="")
    {
        $data["prj_id"] = $prj_id;
        $this->output($this->config->item('admin').'/v_save_state_prj_page',$data);
    }
    // go to page set state project


}