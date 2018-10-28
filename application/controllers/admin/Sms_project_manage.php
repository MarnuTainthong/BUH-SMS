<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\..\Login_Controller.php");

class Sms_project_manage extends Login_Controller {

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        $this->load->model('m_project_manage','prmng_rs');
        $this->load->model('m_sub_strategy','sstr_rs');
        $this->load->model('m_measure','mea_rs');

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
            // $this->prmng_rs->prj_year_id = $year_id;
            // $result = $this->prmng_rs->get_prj_data()->result();

            $data = array(
                'prj_seq'           => '1',
                'prj_code'          => '2',
                'prj_name'          => '3',
                'prj_respon'        => '4',
                'prj_duration'      => '5',
                'prj_action'        => '6'
            );

            echo json_encode($data);
        }
        
    }
    // datatable show prj

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
    // แสดงกลยุทธ์ opt by year_id

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
            $this->pos_rs->pos_name = $pos_name;
            $this->pos_rs->pos_id = $pos_id;
            $this->pos_rs->update_pos();

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

}
