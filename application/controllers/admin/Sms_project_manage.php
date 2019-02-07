<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\..\Login_Controller.php");

class Sms_project_manage extends Login_Controller {

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        $this->load->model('m_mission','mis_rs');
        $this->load->model('m_project_manage','prmng_rs');
        $this->load->model('m_sub_strategy','sstr_rs');
        $this->load->model('m_measure','mea_rs');
        $this->load->model('m_project_position','pos_rs');
        $this->load->model('m_responsibles','resp_rs');

    }

	public function index()
	{
        echo "Access system is forbidden.";
    }

    public function project_manage()
    {
        $this->output($this->config->item('admin').'/v_project_manage');
    }
    // go to page จัดการโครงการ

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
                                                    <a class="'.$this->config->item("btn_set_kpi_color").'" data-tooltip="คลิกเพื่อตั้งค่าโครงการ" href="'.site_url().'/admin/Sms_project_manage/setting_project/'.$row_prj->prj_id.'" ><i class="'.$this->config->item("sms_icon_set_kpi").'" aria-hidden="true"></i></a>
                                                    <a class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" href="'.site_url().'/admin/Sms_project_manage/edit_project/'.$row_prj->prj_id.'/'.$row_prj->prj_year_id.'" ><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></a>
                                                    <button type="button" class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_prj('.$row_prj->prj_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button>
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
                                                    <a class="'.$this->config->item("btn_set_kpi_color").'" data-tooltip="คลิกเพื่อตั้งค่าโครงการ" href="'.site_url().'/admin/Sms_project_manage/setting_project/'.$row_prj->prj_id.'" ><i class="'.$this->config->item("sms_icon_set_kpi").'" aria-hidden="true"></i></a>
                                                    <a class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" href="'.site_url().'/admin/Sms_project_manage/edit_project/'.$row_prj->prj_id.'/'.$row_prj->prj_year_id.'" ><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></a>
                                                    <button type="button" class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_prj('.$row_prj->prj_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button>
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

    public function get_prj_data_by_id()
    {
        $prj_id = $this->input->post('prj_id');
        $this->prmng_rs->prj_id = $prj_id;
        $result = $this->prmng_rs->get_prj_data_by_id()->row_array();

        echo json_encode($result);
    }

    public function add_project($year_id="")
    {
        $data["year_id"] = $year_id;
        $this->output($this->config->item('admin').'/v_add_project',$data);
    }
    // go to page add_project with year_id data
    
    public function get_sstr_by_year()
    {
        $year_id = $this->input->post('year_id');
        
        $this->sstr_rs->sstr_year_id = $year_id;
        $result = $this->sstr_rs->get_sstr_by_year_id()->result();
        
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        
        $opt = '<option selected disabled="disabled">เลือกกลยุทธ์</option>';
        foreach ($result as $row) {
            
            $opt .= '<option value="'.$row->sstr_id.'">'.$row->sstr_name.'</option>';
        }
        
        echo json_encode($opt);
    }
    // แสดงกลยุทธ์ opt by year_id

    public function get_sstr_by_prj()
    {
        $prj_id = $this->input->post('prj_id');
        $year_id = $this->input->post('year_id');

        $this->sstr_rs->prj_id = $prj_id;
        $result_sel = $this->sstr_rs->get_sstr_by_prj_id()->result();

        // pre($result_sel);
        
        $this->sstr_rs->sstr_year_id = $year_id;
        $result = $this->sstr_rs->get_sstr_by_year_id()->result();
        
        // pre($result);die;
        

        $opt = '<option disabled="disabled">เลือกกลยุทธ์</option>';

            $select = $result_sel;
            $selected = "";
            foreach ($result_sel as $row_sel) {
                $select = $row_sel->sstr_id;
                $selected = "";
                foreach ($result as $row){
                    if($select == $row->sstr_id){
                        $selected = "selected";
                    }else {
                        $selected = "";
                    }
                    $opt .= '<option '. $selected .' value="'.$row->sstr_id.'">' . $row->sstr_name. '</option>';
                }
            }

        echo json_encode($opt);
        
    }
    
    public function get_mea_by_year()
    {
        $year_id = $this->input->post('year_id');
        
        $this->mea_rs->mea_year_id = $year_id;
        $result = $this->mea_rs->get_mea_by_year()->result();
        
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        
        $opt = '<option selected disabled="disabled">เลือกตัวบ่งชี้</option>';
        foreach ($result as $row) {
            
            $opt .= '<option value="'.$row->mea_id.'">'.$row->mea_name.'</option>';
        }
        
        echo json_encode($opt);
    }
    // แสดงตัวบ่งชี้ opt by year_id

    public function get_mea_by_prj()
    {
        $prj_id = $this->input->post('prj_id');
        $year_id = $this->input->post('year_id');

        $this->mea_rs->prj_id = $prj_id;
        $result_sel = $this->mea_rs->get_mea_by_prj_id()->result();

        // pre($result_sel);
        
        $this->mea_rs->mea_year_id = $year_id;
        $result = $this->mea_rs->get_mea_by_year()->result();
        
        // pre($result);die;

        $opt = '<option disabled="disabled">เลือกตัวบ่งชี้ประกันคุณภาพ</option>';

            $select = $result_sel;
            $selected = "";
            foreach ($result_sel as $row_sel) {
                $select = $row_sel->mea_id;
                $selected = "";
                foreach ($result as $row){
                    if($select == $row->mea_id){
                        $selected = "selected";
                    }else {
                        $selected = "";
                    }
                    $opt .= '<option '. $selected .' value="'.$row->mea_id.'">' . $row->mea_name. '</option>';
                }
            }

        echo json_encode($opt);
    }

    public function get_org_select()
    {
        $prj_id = $this->input->post('prj_id');
        $this->prmng_rs->prj_id = $prj_id;
        $result = $this->prmng_rs->get_org_by_prj()->result();

        $json = file_get_contents('http://med.buu.ac.th/scan-med/scanningPersonnel/API/api_getPerson.php');
        $rs_person = json_decode($json, TRUE);

        $hr_data = array();


        foreach ($rs_person['data_result'] as $rs_hr) {
            array_push($hr_data,$rs_hr['dm_title_th']);
        }
        // จัดข้อมูลใหม่เอาค่าส่วนงานที่ซ้ำกันออก

        $hr_data = array_unique($hr_data);

        $opt = '<option disabled="disabled">เลือกปหน่วยงานประมาณ</option>';

            $select = $result;
            $selected = "";
            foreach ($result as $row_sel) {
                $select = $row_sel->prj_site_name;
                $selected = "";
                foreach ($hr_data as $row_hr){
                    if($select == $row_hr){
                        $selected = "selected";
                    }else {
                        $selected = "";
                    }
                    $opt .= '<option '. $selected .' value="'.$row_hr.'">' . $row_hr. '</option>';
                }
            }

        echo json_encode($opt);


    }
    
    public function ajax_add_prj()
    {
        $prj_id = $this->input->post('prj_id'); //check insert od update
        $year_id = $this->input->post('year_id');
        $org_name = $this->input->post('org_name');
        $sstr_name = $this->input->post('sstr_name');
        $mea_name = $this->input->post('mea_name');
        $prj_type = $this->input->post('prj_type');
        $prj_code_input = $this->input->post('prj_code_input');
        $prj_name_input = $this->input->post('prj_name_input');
        $prj_bdgt1 = $this->input->post('prj_bdgt1');
        $prj_bdgt2 = $this->input->post('prj_bdgt2');
        $prj_bdgt3 = $this->input->post('prj_bdgt3');
        $prj_bdgt3_name = $this->input->post('prj_bdgt3_name');
        $prj_start = $this->input->post('prj_start');
        $prj_end = $this->input->post('prj_end');
        
        
        if (empty($prj_id)) {
            
            // ส่วน insert
            $this->prmng_rs->prj_year_id = $year_id;
            $this->prmng_rs->prj_site_name = $org_name;
            $this->prmng_rs->prj_sub_str_id = $sstr_name;
            $this->prmng_rs->prj_kpi_id = $mea_name;
            $this->prmng_rs->prj_type = $prj_type;
            $this->prmng_rs->prj_code = $prj_code_input;
            $this->prmng_rs->prj_name = $prj_name_input;
            $this->prmng_rs->prj_set_bdgt_land = $prj_bdgt1;
            $this->prmng_rs->prj_set_bdgt_fcty = $prj_bdgt2;
            $this->prmng_rs->prj_set_bdgt_oth = $prj_bdgt3;
            $this->prmng_rs->prj_bdgt_oth_name = $prj_bdgt3_name;
            $this->prmng_rs->prj_start = $prj_start;
            $this->prmng_rs->prj_end = $prj_end;
            $this->prmng_rs->insert_prj();
            
            
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
            // ส่วน update
            $this->prmng_rs->prj_site_name = $org_name;
            $this->prmng_rs->prj_sub_str_id = $sstr_name;
            $this->prmng_rs->prj_kpi_id = $mea_name;
            $this->prmng_rs->prj_type = $prj_type;
            $this->prmng_rs->prj_code = $prj_code_input;
            $this->prmng_rs->prj_name = $prj_name_input;
            $this->prmng_rs->prj_set_bdgt_land = $prj_bdgt1;
            $this->prmng_rs->prj_set_bdgt_fcty = $prj_bdgt2;
            $this->prmng_rs->prj_set_bdgt_oth = $prj_bdgt3;
            $this->prmng_rs->prj_bdgt_oth_name = $prj_bdgt3_name;
            $this->prmng_rs->prj_start = $prj_start;
            $this->prmng_rs->prj_end = $prj_end;
            $this->prmng_rs->prj_id = $prj_id;
            $this->prmng_rs->update_prj();
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $data["json_alert"] = false;
                $data["json_type"] 	= "warning";
                $data["json_str"] 	= "การแก้ไขพบข้อผิดพลาดไม่สามารถบันทึกได้";
            }else{
                $this->db->trans_commit();
                $data["json_alert"] = true;
                $data["json_type"] 	= "success";
                $data["json_str"] 	= "ระบบได้บันทึกข้อมูลที่แก้ไขเรียบร้อยแล้ว";
            }
            
        }
        echo json_encode($data);
    }
    // fn insert & update project_position

    public function ajax_del_prj()
    {
        $prj_id = $this->input->post('prj_id');
        
        $this->resp_rs->resp_prj_id = $prj_id;
        $this->resp_rs->delete_resp_when_del_prj(); // ลบผู้รับผิดชอบทั้งหมดของโครงการ
        
        $this->prmng_rs->prj_ind_prj_id = $prj_id;
        $this->prmng_rs->delete_prj_ind_when_del_prj(); // ลบข้อมูลตัวชี้วัดทั้งหมดของโครงการ

        $this->prmng_rs->prj_id = $prj_id;
        $this->prmng_rs->delete_prj(); // ลบโครงการ

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $data["json_alert"] = false;
            $data["json_type"] 	= "warning";
            $data["json_str"] 	= "การลบพบข้อผิดพลาดไม่สามารถบันทึกได้";
        }else{
            $this->db->trans_commit();
            $data["json_alert"] = true;
            $data["json_type"] 	= "success";
            $data["json_str"] 	= "ระบบได้บันทึกข้อมูลที่แก้ไขเรียบร้อยแล้ว";
        }
        echo json_encode($data);
    }
    // ลบโครงการ
    
    public function edit_project($prj_id="",$prj_year_id="")
    {
        $data["prj_id"] = $prj_id;
        $data["prj_year_id"] = $prj_year_id;
        $this->output($this->config->item('admin').'/v_edit_project',$data);
    }
    // go to page edit_project with prj_id

    public function setting_project($prj_id="")
    {
        $data["prj_id"] = $prj_id;
        $this->output($this->config->item('admin').'/v_setting_project',$data);
    }
    // go to page setting project with prj_id

    public function get_prj_set_data()
    {
        $prj_id = $this->input->post('prj_id');
        $this->prmng_rs->prj_id = $prj_id;
        $result = $this->prmng_rs->get_prj_set_data()->row_array();

        echo json_encode($result);

    }
    // set data หน้าตั้งค่าโครงการ

    public function get_prj_pos()
    {
        $result = $this->pos_rs->get_pos_data()->result();

        $opt = '<option selected disabled="disabled">เลือกตำแหน่งในโครงการ</option>';
        foreach ($result as $row) {
            
            $opt .= '<option value="'.$row->pos_id.'">'.$row->pos_name.'</option>';
        }
        
        echo json_encode($opt);
        
    }
    // แสดงข้อมูลตำแหน่งในโครงการ opt

    public function get_resp_show()
    {
        $prj_id = $this->input->post('prj_id');
        $this->resp_rs->resp_prj_id = $prj_id;
        $result = $this->resp_rs->get_prj_resp()->result();
        
        
        $all_data = array();
        $i=1;
        foreach ($result as $row) {
            $data = array(
                'resp_seq'      => '<center>'.$i++.'</center>',
                'resp_name'     => $row->resp_name,
                'resp_pos'      => $row->pos_name,
                'resp_action'    => '<center>
                                    <button type="button" class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" onclick="return edit_resp('.$row->resp_id.')"><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></button>
                                    <button type="button" class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_resp('.$row->resp_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button>
                                    </center>'
            );
            array_push($all_data,$data);
        }
        echo json_encode($all_data);

    }
    // get_resp_show

    public function get_resp_by_id()
    {
        $resp_id = $this->input->post('resp_id');
        $this->resp_rs->resp_id = $resp_id;
        $result = $this->resp_rs->get_resp_name_by_resp()->row_array();
        
        echo json_encode($result);
    }
    
    public function ajax_add_prj_resp()
    {
        $resp_id = $this->input->post('resp_id'); //check insert or update
        $resp_name = $this->input->post('resp_name');
        $pos_id = $this->input->post('pos_id');
        $prj_id = $this->input->post('prj_id');
        if (empty($resp_id)) {
            
            // ส่วน insert
            $this->resp_rs->resp_prj_id = $prj_id;
            $this->resp_rs->resp_pos_id = $pos_id;
            $this->resp_rs->resp_name = $resp_name;
            $this->resp_rs->insert_resp();
            
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
            // ส่วน update
            $this->resp_rs->resp_id = $resp_id;
            $this->resp_rs->resp_prj_id = $prj_id;
            $this->resp_rs->resp_pos_id = $pos_id;
            $this->resp_rs->resp_name = $resp_name;
            $this->resp_rs->update_resp();
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $data["json_alert"] = false;
                $data["json_type"] 	= "warning";
                $data["json_str"] 	= "การแก้ไขพบข้อผิดพลาดไม่สามารถบันทึกได้";
            }else{
                $this->db->trans_commit();
                $data["json_alert"] = true;
                $data["json_type"] 	= "success";
                $data["json_str"] 	= "ระบบได้บันทึกข้อมูลที่แก้ไขเรียบร้อยแล้ว";
            }
            
        }
        echo json_encode($data);
    }
    // fn insert & update resp

    public function ajax_del_resp()
    {
        $resp_id = $this->input->post('resp_id');
        $this->resp_rs->resp_id = $resp_id;
        $this->resp_rs->delete_resp();

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $data["json_alert"] = false;
            $data["json_type"] 	= "warning";
            $data["json_str"] 	= "การลบพบข้อผิดพลาดไม่สามารถบันทึกได้";
        }else{
            $this->db->trans_commit();
            $data["json_alert"] = true;
            $data["json_type"] 	= "success";
            $data["json_str"] 	= "ระบบได้บันทึกข้อมูลที่แก้ไขเรียบร้อยแล้ว";
        }
        echo json_encode($data);
    }
    // ลบผู้รับผิดชอบโครงการ
    
    public function get_pos_by_resp()
    {
        $resp_id = $this->input->post('resp_id');
        $this->resp_rs->resp_id = $resp_id;
        $result_sel = $this->resp_rs->get_pos_by_resp()->result(); //ค่าที่ต้องการให้ select
        $result = $this->pos_rs->get_pos_data()->result(); //ค่าทั้งหมด

        $opt = '<option disabled="disabled">เลือกตำแหน่งในโครงการ</option>';
            $select = $result_sel;
            $selected = "";
            foreach ($result_sel as $row_sel) {
                $select = $row_sel->resp_pos_id;
                $selected = "";
                foreach ($result as $row){
                    if($select == $row->pos_id){
                        $selected = "selected";
                    }else {
                        $selected = "";
                    }
                    $opt .= '<option '. $selected .' value="'.$row->pos_id.'">' . $row->pos_name. '</option>';
                }
            }

        echo json_encode($opt);
        
    }
    // แสดงข้อมูลตำแหน่งในโครงการ opt โดย resp_id

    public function get_prj_ind_show()
    {
        $prj_id = $this->input->post('prj_id');
        $this->prmng_rs->prj_ind_prj_id = $prj_id;
        $result = $this->prmng_rs->get_prj_ind_data()->result();
        
        $all_data = array();
        $i=1;
        foreach ($result as $row) {
            $data = array(
                'prj_ind_seq'       => '<center>'.$i++.'</center>',
                'prj_ind_name'      => $row->prj_ind_name,
                'prj_ind_unit'      => '<center>'.$row->prj_ind_unit.'</center>',
                'prj_ind_goal'      => '<center>'.$row->opt_symbol.' '.$row->prj_ind_target.'</center>',
                'prj_ind_action'    => '<center>
                <button type="button" class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" onclick="return edit_prj_ind('.$row->prj_ind_id.')"><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></button>
                <button type="button" class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_prj_ind('.$row->prj_ind_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button>
                </center>'
            );
            array_push($all_data,$data);
        }
        echo json_encode($all_data);
    }
    // datatable prj_ind
    
    public function get_prj_ind_by_id()
    {
        $prj_ind_id = $this->input->post('prj_ind_id');
        $this->prmng_rs->prj_ind_id = $prj_ind_id;
        $result = $this->prmng_rs->get_prj_ind_by_id()->row_array();
        
        echo json_encode($result);
    }
    // ดึงข้อมูลตัวชี้วัดโครงการตอนกด edit
    
    public function get_opt_ind_by_id()
    {
        $prj_ind_id = $this->input->post('prj_ind_id');
        $this->prmng_rs->prj_ind_id = $prj_ind_id;
        
        $result_sel = $this->prmng_rs->get_opt_ind_by_id()->result(); //ค่าที่ต้องการให้ select
        $result = $this->mis_rs->get_opt_all()->result(); //ค่าทั้งหมด

        $opt = '<option disabled="disabled">เลือกตการคำนวณผล</option>';
            $select = $result_sel;
            $selected = "";
            foreach ($result_sel as $row_sel) {
                $select = $row_sel->opt_id;
                $selected = "";
                foreach ($result as $row){
                    if($select == $row->opt_id){
                        $selected = "selected";
                    }else {
                        $selected = "";
                    }
                    $opt .= '<option '. $selected .' value="'.$row->opt_id.'">' . $row->opt_name. '</option>';
                }
            }

        echo json_encode($opt);
    }
    // แสดงการคำนวณผล opt ตอนกด edit

    public function ajax_add_prj_ind()
    {
        $ind_id = $this->input->post('ind_id'); //check insert or update
        $prj_id = $this->input->post('prj_id');
        $ind_name = $this->input->post('ind_name');
        $ind_unit = $this->input->post('ind_unit');
        $opt_id = $this->input->post('opt_id');
        $ind_goal = $this->input->post('ind_goal');

        if (empty($ind_id)) {
            
            // ส่วน insert
            $this->prmng_rs->prj_ind_prj_id = $prj_id;
            $this->prmng_rs->prj_ind_name = $ind_name;
            $this->prmng_rs->prj_ind_opt = $opt_id;
            $this->prmng_rs->prj_ind_target = $ind_goal;
            $this->prmng_rs->prj_ind_unit = $ind_unit;
            $this->prmng_rs->insert_prj_ind();
            
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
            // ส่วน update
            $this->prmng_rs->prj_ind_prj_id = $prj_id;
            $this->prmng_rs->prj_ind_name = $ind_name;
            $this->prmng_rs->prj_ind_opt = $opt_id;
            $this->prmng_rs->prj_ind_target = $ind_goal;
            $this->prmng_rs->prj_ind_unit = $ind_unit;
            $this->prmng_rs->prj_ind_id = $ind_id;
            $this->prmng_rs->update_prj_ind();

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $data["json_alert"] = false;
                $data["json_type"] 	= "warning";
                $data["json_str"] 	= "การแก้ไขพบข้อผิดพลาดไม่สามารถบันทึกได้";
            }else{
                $this->db->trans_commit();
                $data["json_alert"] = true;
                $data["json_type"] 	= "success";
                $data["json_str"] 	= "ระบบได้บันทึกข้อมูลที่แก้ไขเรียบร้อยแล้ว";
            }
            
        }
        echo json_encode($data);
    }
    // fn insert & delete prj_ind

    public function ajax_del_prj_ind()
    {
        $prj_ind_id = $this->input->post('prj_ind_id');
        $this->prmng_rs->prj_ind_id = $prj_ind_id;
        $this->prmng_rs->delete_prj_ind();

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $data["json_alert"] = false;
            $data["json_type"] 	= "warning";
            $data["json_str"] 	= "การลบพบข้อผิดพลาดไม่สามารถบันทึกได้";
        }else{
            $this->db->trans_commit();
            $data["json_alert"] = true;
            $data["json_type"] 	= "success";
            $data["json_str"] 	= "ระบบได้บันทึกข้อมูลที่แก้ไขเรียบร้อยแล้ว";
        }
        echo json_encode($data);
    }
    // fn delete prj_ind

}
