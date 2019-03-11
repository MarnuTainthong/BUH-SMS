<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\..\Login_Controller.php");

class Sms_assessment extends Login_Controller {

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
        $this->load->model('m_prj_assessment','prj_ast_rs');

    }

	public function index()
	{
        // echo "Access system is forbidden.";
        $this->output($this->config->item('admin').'/v_prj_assessment');
    }
    // go to page save state prj

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
                                                    <a class="'.$this->config->item("btn_save").'" data-tooltip="คลิกเพื่อบันทึกผล" href="'.site_url().'/admin/Sms_assessment/prj_assess/'.$row_prj->prj_id.'"><i class="'.$this->config->item('sms_icon_save').'" aria-hidden="true"></i></a>
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
                                                    <a class="'.$this->config->item("btn_save").'" data-tooltip="คลิกเพื่อบันทึกผล" href="'.site_url().'/admin/Sms_assessment/prj_assess/'.$row_prj->prj_id.'"><i class="'.$this->config->item('sms_icon_save').'" aria-hidden="true"></i></a>
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

    public function prj_assess ($prj_id="")
    {
        $data["prj_id"] = $prj_id;
        $this->output($this->config->item('admin').'/v_prj_assess_page',$data);
    }
    // go to page prj_assess

    public function get_prj_data()
    {
        $prj_id = $this->input->post('prj_id');
        $this->prj_ast_rs->prj_id = $prj_id;
        $result_prj = $this->prj_ast_rs->get_prj_set_data()->result();
        // $result = $this->prj_ast_rs->get_prj_set_data()->row_array();

        $this->state_rs->ss_prj_id = $prj_id;
        $result_bdgt = $this->state_rs->get_sum_bdgt()->result();
        // pre($result_prj);die;

        foreach ($result_prj as $row_prj) {
            foreach ($result_bdgt as $row_bdgt) {
                if ($row_prj->prj_type == 1) {
                    $data = array(
                        'year_name'        => $row_prj->year_name,
                        'prj_id'           => $row_prj->prj_id,
                        'prj_name'         => $row_prj->prj_name,
                        'prj_code'         => $row_prj->prj_code,
                        'prj_site_name'    => $row_prj->prj_site_name,
                        'sstr_name'        => $row_prj->sstr_name,
                        'prj_type'         => 'โครงการใหม่',
                        'bdgt_set'         => $row_prj->prj_set_bdgt_land+$row_prj->prj_set_bdgt_fcty+$row_prj->prj_set_bdgt_oth,
                        'bdgt_act'         => $row_bdgt->sum_bdgt_land+$row_bdgt->sum_bdgt_fcty+$row_bdgt->sum_bdgt_oth
                    );
                }else{
                    $data = array(
                        'year_name'        => $row_prj->year_name,
                        'prj_id'           => $row_prj->prj_id,
                        'prj_name'         => $row_prj->prj_name,
                        'prj_code'         => $row_prj->prj_code,
                        'prj_site_name'    => $row_prj->prj_site_name,
                        'sstr_name'        => $row_prj->sstr_name,
                        'prj_type'         => 'โครงการต่อเนื่อง',
                        'bdgt_set'         => $row_prj->prj_set_bdgt_land+$row_prj->prj_set_bdgt_fcty+$row_prj->prj_set_bdgt_oth,
                        'bdgt_act'         => $row_bdgt->sum_bdgt_land+$row_bdgt->sum_bdgt_fcty+$row_bdgt->sum_bdgt_oth
                    );
                }
            }
            // for row_bdgt
        }
        // for row_prj
        echo json_encode($data);
    }
    // แสดงข้อมูลโครงการ

    public function get_prj_ind()
    {
        $prj_id = $this->input->post('prj_id');
        $this->prmng_rs->prj_ind_prj_id = $prj_id;
        $result = $this->prmng_rs->get_prj_ind_result()->result();

        $all_data = array();
        $i=1;
        foreach ($result as $row) {
            if (empty($row->rs_score) && is_null($row->rs_pass)) {
                $data = array(
                    'prj_ind_seq'       => '<center>'.$i++.'</center>',
                    'prj_ind_name'      => $row->prj_ind_name,
                    'prj_ind_unit'      => '<center>'.$row->prj_ind_unit.'</center>',
                    'prj_ind_goal'      => '<center>'.$row->opt_symbol.' '.$row->prj_ind_target.'</center>',
                    'prj_ind_state1'    => '<center><span class="'.$this->config->item("lb-danger").' lb-radio">ยังไม่บันทึกผล</span></center>',
                    'prj_ind_state2'    => '<center><span class="'.$this->config->item("lb-danger").' lb-radio">ยังไม่ประเมินผล</span></center>',
                    'prj_ind_action'    => '<center>
                    <button type="button" class="'.$this->config->item("btn_save").'" data-tooltip="บันทึกผล" onclick="show_panel_save_result('.$row->prj_ind_id.')"><i class="'.$this->config->item("sms_icon_save_score").'" aria-hidden="true"></i></button>
                    <button type="button" class="'.$this->config->item("btn_assess").' disabled" data-tooltip="ประเมินผล" onclick="show_panel_assessment('.$row->prj_ind_id.')"><i class="'.$this->config->item("sms_icon_save").'" aria-hidden="true"></i></button>
                    </center>'
                );
            }elseif (!empty($row->rs_score) && is_null($row->rs_pass)) {
                $data = array(
                    'prj_ind_seq'       => '<center>'.$i++.'</center>',
                    'prj_ind_name'      => $row->prj_ind_name,
                    'prj_ind_unit'      => '<center>'.$row->prj_ind_unit.'</center>',
                    'prj_ind_goal'      => '<center>'.$row->opt_symbol.' '.$row->prj_ind_target.'</center>',
                    'prj_ind_state1'    => '<center><span class="'.$this->config->item("lb-success").' lb-radio">บันทึกผลเสร็จสิ้น</span></center>',
                    'prj_ind_state2'    => '<center><span class="'.$this->config->item("lb-danger").' lb-radio">ยังไม่ประเมินผล</span></center>',
                    'prj_ind_action'    => '<center>
                                                <button type="button" class="'.$this->config->item("btn_save").'" data-tooltip="บันทึกผล" onclick="show_panel_save_result('.$row->prj_ind_id.')"><i class="'.$this->config->item("sms_icon_save_score").'" aria-hidden="true"></i></button>
                                                <button type="button" class="'.$this->config->item("btn_assess").'" data-tooltip="ประเมินผล" onclick="show_panel_assessment('.$row->prj_ind_id.')"><i class="'.$this->config->item("sms_icon_save").'" aria-hidden="true"></i></button>
                                            </center>'
                );
            }else{
                $data = array(
                    'prj_ind_seq'       => '<center>'.$i++.'</center>',
                    'prj_ind_name'      => $row->prj_ind_name,
                    'prj_ind_unit'      => '<center>'.$row->prj_ind_unit.'</center>',
                    'prj_ind_goal'      => '<center>'.$row->opt_symbol.' '.$row->prj_ind_target.'</center>',
                    'prj_ind_state1'    => '<center><span class="'.$this->config->item("lb-success").' lb-radio">บันทึกผลเสร็จสิ้น</span></center>',
                    'prj_ind_state2'    => '<center><span class="'.$this->config->item("lb-success").' lb-radio">ประเมินผลเสร็จสิ้น</span></center>',
                    'prj_ind_action'    => '<center>
                                                <button type="button" class="'.$this->config->item("btn_save").'" data-tooltip="บันทึกผล" onclick="show_panel_save_result('.$row->prj_ind_id.')"><i class="'.$this->config->item("sms_icon_save_score").'" aria-hidden="true"></i></button>
                                                <button type="button" class="'.$this->config->item("btn_assess").'" data-tooltip="ประเมินผล" onclick="show_panel_assessment('.$row->prj_ind_id.')"><i class="'.$this->config->item("sms_icon_save").'" aria-hidden="true"></i></button>
                                            </center>'
                );
            }
    
            array_push($all_data,$data);
        }
        echo json_encode($all_data);
    }
    // แสดงตัวชี้วัดของโครงการ datatable

    public function get_ind_data()
    {
        $prj_ind_id = $this->input->post('prj_ind_id');
        $this->prj_ast_rs->prj_ind_id = $prj_ind_id;
        $result = $this->prj_ast_rs->get_prj_ind_data()->row_array();
        // pre($result);die;
        echo json_encode($result);
    }
    // replace text ตอนกดปุ่มบันทึกผล assess_page
    
    public function ajax_add_score()
    {
        $rs_id = $this->input->post('rs_id');
        $prj_ind_id = $this->input->post('prj_ind_id');
        $rs_ind_score = $this->input->post('rs_ind_score');
        $this->prj_ast_rs->rs_id = $rs_id;
        $this->prj_ast_rs->rs_prj_ind_id = $prj_ind_id;
        $this->prj_ast_rs->rs_score = $rs_ind_score;
        if ($rs_ind_score == 0) {
            $this->prj_ast_rs->rs_pass = null;
            $this->prj_ast_rs->update_ind_rs();
        }
        
        if (empty($rs_id)) {
            $result = $this->prj_ast_rs->insert_prj_ind_score();
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
        }else {
            $result = $this->prj_ast_rs->update_prj_ind_score();
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
        echo json_encode($data);
    }
    // insert และ update คะแนนที่บันทึกผล
    
    public function ajax_add_rs()
    {
        $rs_id = $this->input->post('rs_id');
        $rs_pass = $this->input->post('rs_ind_assess');
        $this->prj_ast_rs->rs_id = $rs_id;
        $this->prj_ast_rs->rs_pass = $rs_pass;

        $result = $this->prj_ast_rs->update_ind_rs();
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
        echo json_encode($data);
    }
    // update ผลการประเมินโครงการ
    
}