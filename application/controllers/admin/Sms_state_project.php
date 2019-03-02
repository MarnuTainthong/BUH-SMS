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
        $this->load->model('m_state_project','state_rs');

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
                            'prj_duration'      => '<center>'.fullDateTH3($row_prj->prj_start).' ถึง <br>'.fullDateTH3($row_prj->prj_end).'</center>',
                            'prj_action'        => '<center>
                                                    <a class="'.$this->config->item("btn_save").'" data-tooltip="คลิกเพื่อบันทึกผล" href="'.site_url().'/admin/Sms_state_project/set_state_project/'.$row_prj->prj_id.'"><i class="'.$this->config->item('sms_icon_save').'" aria-hidden="true"></i></a>
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
                            'prj_duration'      => '<center>'.fullDateTH3($row_prj->prj_start).' ถึง <br>'.fullDateTH3($row_prj->prj_end).'</center>',
                            'prj_action'        => '<center>
                                                    <a class="'.$this->config->item("btn_save").'" data-tooltip="คลิกเพื่อบันทึกผล" href=" " ><i class="'.$this->config->item('sms_icon_save').'" aria-hidden="true"></i></a>
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
    
    public function get_state_show()
    {
        $result = $this->state_rs->get_state()->result();
        $opt = '<option selected disabled="disabled">เลือกสถานะ</option>';
        foreach ($result as $row) {
            
            $opt .= '<option value="'.$row->pst_id.'">'.$row->pst_name.'</option>';
        }
        
        echo json_encode($opt);
    }
    // show all state for save

    public function get_state_dtable()
    {
        $prj_id = $this->input->post('prj_id');
        $this->state_rs->ss_prj_id = $prj_id;
        $result = $this->state_rs->get_state_data()->result();

        // $state_data = array();
        // pre($result);die;

        // $all_data = array();
        $i=1;

        foreach ($result as $row) {
            $sum_bdgt = intval($row->ss_bdgt_land)+intval($row->ss_bdgt_fcty)+intval($row->ss_bdgt_oth); //sum_bdgt
            if ($row->ss_start_date == $row->ss_end_date) {
                $state_data  = array(
                    'ss_seq'        => '<center>'.$i++.'</center>',
                    'ss_status'     => $row->pst_name,
                    'ss_duration'   => '<center>'.fullDateTH3($row->ss_start_date).'</center>',
                    'ss_bdgt_land'  => '<center>'.$row->ss_bdgt_land.'</center>',
                    'ss_bdgt_fcty'  => '<center>'.$row->ss_bdgt_fcty.'</center>',
                    'ss_bdgt_oth'   => '<center>'.$row->ss_bdgt_oth.'</center>',
                    'ss_bdgt_sum'   => '<center>'.$sum_bdgt.'</center>',
                    // 'ss_file'       => '<center>'.'-'.'</center>',
                    'ss_action'     => '<center>
                                            <button type="button" class="'.$this->config->item("btn_view_info").'" data-tooltip="คลิกเพื่อแสดงข้อมูลเพิ่มเติม" onclick="return show_state_info('.$row->ss_id.')" data-toggle="modal" data-target="#modal_more_info"><i class="'.$this->config->item("sms_icon_search").'" aria-hidden="true"></i></button>
                                            <button type="button" class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" onclick="return edit_state('.$row->ss_id.')"><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></button>
                                            <button type="button" class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_state('.$row->ss_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button>
                                        </center>'
                );
            }else {
                $state_data  = array(
                    'ss_seq'        => '<center>'.$i++.'</center>',
                    'ss_status'     => $row->pst_name,
                    'ss_duration'   => '<center>'.fullDateTH3($row->ss_start_date).' ถึง '.fullDateTH3($row->ss_end_date).'</center>',
                    'ss_bdgt_land'  => '<center>'.$row->ss_bdgt_land.'</center>',
                    'ss_bdgt_fcty'  => '<center>'.$row->ss_bdgt_fcty.'</center>',
                    'ss_bdgt_oth'   => '<center>'.$row->ss_bdgt_oth.'</center>',
                    'ss_bdgt_sum'   => '<center>'.$sum_bdgt.'</center>',
                    // 'ss_file'       => '<center>'.'-'.'</center>',
                    'ss_action'     => '<center>
                                            <button type="button" class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" onclick="return edit_resp('.$row->ss_id.')"><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></button>
                                            <button type="button" class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_resp('.$row->ss_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button>
                                        </center>'
                );
            }
            //ถ้าวันที่เป็นวันเดียวกัน
            
        }

        // pre($state_data);die;

        echo json_encode($state_data);
    }
    // datatable ข้อมูลสถานะที่รายงาน

    public function get_state_by_ss_id()
    {
        $ss_id = $this->input->post('ss_id');
        $this->state_rs->ss_id = $ss_id;
        $result = $this->state_rs->get_state_by_ss_id()->result_array();

        foreach ($result as $row) {
            $sum_bdgt = intval($row['ss_bdgt_land'])+intval($row['ss_bdgt_fcty'])+intval($row['ss_bdgt_oth']); //sum_bdgt
            if ($row['ss_start_date'] == $row['ss_end_date']) {
                $state_data  = array(
                    'ss_id'             => $row['ss_id'],
                    'ss_state_id'       => $row['ss_state_id'],
                    'ss_duration'       => fullDateTH3($row['ss_start_date']),
                    // 'ss_start_date'     => $row['ss_start_date'],
                    // 'ss_end_date'       => $row['ss_end_date'],
                    'ss_bdgt_land'      => $row['ss_bdgt_land'].$this->config->item("txt_money_unit"),
                    'ss_bdgt_fcty'      => $row['ss_bdgt_fcty'].$this->config->item("txt_money_unit"),
                    'ss_bdgt_oth'       => $row['ss_bdgt_oth'].$this->config->item("txt_money_unit"),
                    'ss_bdgt_sum'       => $sum_bdgt.$this->config->item("txt_money_unit"),
                    'ss_des'            => $row['ss_des'],
                    'pst_name'          => $row['pst_name'],
                );
                echo json_encode($state_data);
            }else {
                $state_data  = array(
                    'ss_id'             => $row['ss_id'],
                    'ss_state_id'       => $row['ss_state_id'],
                    'ss_duration'       => fullDateTH3($row['ss_start_date']).'ถึง'.fullDateTH3($row['ss_end_date']),
                    // 'ss_start_date'     => $row['ss_start_date'],
                    // 'ss_end_date'       => $row['ss_end_date'],
                    'ss_bdgt_land'      => $row['ss_bdgt_land'].$this->config->item("txt_money_unit"),
                    'ss_bdgt_fcty'      => $row['ss_bdgt_fcty'].$this->config->item("txt_money_unit"),
                    'ss_bdgt_oth'       => $row['ss_bdgt_oth'].$this->config->item("txt_money_unit"),
                    'ss_bdgt_sum'       => $sum_bdgt.$this->config->item("txt_money_unit"),
                    'ss_des'            => $row['ss_des'],
                    'pst_name'          => $row['pst_name'],
                );
                echo json_encode($state_data);
            }
        }
        
    }
    // set ข้อมูลตอนกดแสดงข้อมูลเพิ่มเติม

    public function ajax_add_state()
    {
        $state_id = $this->input->post('state_id'); //check insert od update
        $prj_id = $this->input->post('prj_id');
        $state_name = $this->input->post('state_name');
        $state_start = $this->input->post('state_start');
        $state_end = $this->input->post('state_end');
        $prj_bdgt1 = $this->input->post('prj_bdgt1');
        $prj_bdgt2 = $this->input->post('prj_bdgt2');
        $prj_bdgt3 = $this->input->post('prj_bdgt3');
        $state_des = $this->input->post('state_des');

        if (empty($state_id)) {
            $this->state_rs->ss_state_id = $prj_id;
            $this->state_rs->ss_prj_id = $state_name;
            $this->state_rs->ss_start_date = $state_start;
            $this->state_rs->ss_end_date = $state_end;
            $this->state_rs->ss_bdgt_land = $prj_bdgt1;
            $this->state_rs->ss_bdgt_fcty = $prj_bdgt2;
            $this->state_rs->ss_bdgt_oth = $prj_bdgt3;
            $this->state_rs->ss_des = $state_des;
            $this->state_rs->insert_state_project();

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $data["json_alert"] = false;
                $data["json_type"] 	= "warning";
                $data["json_str"] 	= "การบันทึกพบข้อผิดพลาดไม่สามารถบันทึกได้";
            }else{
                $this->db->trans_commit();
                $data["json_alert"] = true;
                $data["json_type"] 	= "success";
                $data["json_str"] 	= "บันทึกข้อมูลเข้าสู่ระบบเรียบร้อยแล้ว";
            }
        }
        else {
            # code...
        }
        echo json_encode($data);
    }

    

}