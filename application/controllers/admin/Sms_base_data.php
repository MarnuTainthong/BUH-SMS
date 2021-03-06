<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\..\Login_Controller.php");

class Sms_base_data extends Login_Controller {

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('m_year','y_rs');
        $this->load->model('m_vision','vis_rs');
        $this->load->model('m_mission','mis_rs');
        $this->load->model('m_strategy','str_rs');
        $this->load->model('m_point','poi_rs');
        $this->load->model('m_view_point','vpt_rs');
        $this->load->model('m_sub_strategy','sstr_rs');
        $this->load->model('m_measure','mea_rs');
        $this->load->model('m_project_position','pos_rs');
        $this->load->model('m_project_state','pst_rs');
        $this->load->model('m_rel_mst','rmst_rs');
        $this->load->model('m_rel_str_poi','stp_rs');
        $this->load->model('m_rel_poi_sstr','psstr_rs');
        $this->load->model('m_set_time_save','tsp_rs');
    }

	public function index()
	{
        echo "Access system is forbidden.";
    }

    public function dashboard()
    {
        $this->output($this->config->item('admin').'/v_dashboard');
    }
    // dashboard first page

    public function year()
    {
        $this->output($this->config->item('admin').'/v_year');
    }

    public function get_year_show()
    {
        $result = $this->y_rs->get_year()->result();

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $all_data = array();
        $i=1;
        foreach ($result as $row) {

            $this->y_rs->vis_year_id = $row->year_id;
            $chk_del_y = $this->y_rs->check_delete_year(); //เช็คว่าปีงบประมาณไหนมีข้อมูล

            if ($chk_del_y->row_array()>0) {
                $data = array(
                    'year_req'      => '<center>'.$i++.'<center>',
                    'year_name'     => $row->year_name,
                    'year_action'   => '<center><button type="button" class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบปข้อมูล" onclick="return remove_year('.$row->year_id.')" disabled><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button></center>'
                );
            }else{
                $data = array(
                    'year_req'      => '<center>'.$i++.'<center>',
                    'year_name'     => $row->year_name,
                    'year_action'   => '<center><button type="button" class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบปข้อมูล" onclick="return remove_year('.$row->year_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button></center>'
                );
            }

            // $all_data[] = $data;
            array_push($all_data,$data);
        }

        echo json_encode($all_data);
    }

    public function ajax_del_year()
    {

        $year_id = $this->input->post('year_id');
        
        $this->y_rs->year_id = $year_id;
        $this->y_rs->delete_year();


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
    // ajax_del_year

    public function ajax_add_year()
    {
        $result = $this->y_rs->get_year()->result();

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";

        if(empty($result))
        {
            $dateNow = date("Y")+543;
            // echo $dateNow;echo gettype($dateNow);die;
            $ty_n = $this->year_name = $dateNow;
            $this->y_rs->insert_year_empty();

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

        }else {

            $last_year = $this->y_rs->get_last_year()->row_array();
            // pre($last_year);die;

            
            $this->y_rs->year_name = $last_year['year_name']+1;
            $this->y_rs->insert_year();

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

    }
    // ajax_add_year

    public function vision()
    {
        $this->output($this->config->item('admin').'/v_vision');
    }
    // vision

    public function get_vis_show()
    {
        $result = $this->vis_rs->get_vision_data()->result();
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";

        $all_data = array();
        $i=1;
        foreach ($result as $row) {
            $data = array(
                'vis_seq'       => '<center>'.$i++.'</center>',
                'vis_id'        => $row->vis_id,
                'vis_year'      => '<center>'.$row->year_name.'</center>',
                'vis_name'      => $row->vis_name,
                'year_action'   => '<center><button type="button" class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" onclick="return edit_vis('.$row->vis_id.')"><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></button>
                                    <button type="button" class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_vis('.$row->vis_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button></center>'
            );
            array_push($all_data,$data);
        }

        echo json_encode($all_data);
    }
    // datatable show vis

    public function get_year_select()
    {
        $result = $this->y_rs->get_year_select()->result();
        $vis_id = $this->input->post('vis_id');

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";

        $opt = '<option selected disabled="disabled">เลือกปีงบประมาณ</option>';
        foreach ($result as $row) {
            $selected = "";
				if($selected == $row->year_id){
					$selected = "selected";
				}

            $opt .= '<option '. $selected .' value="'.$row->year_id.'">'.$row->year_name.'</option>';
        }

        echo json_encode($opt);
    }
    // แสดงปีที่ยังไม่มีวิสัยทัศน์ opt

    public function get_year_all()
    {
        $result = $this->y_rs->get_year_have_vis()->result();

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";

        $opt = '<option selected disabled="disabled">เลือกปีงบประมาณ</option>';
        // $opt = '<option disabled="disabled">เลือกปีงบประมาณ</option>';
        foreach ($result as $row) {
            $selected = "";
				if($selected == $row->year_id){
					$selected = "selected";
				}

            $opt .= '<option '. $selected .' value="'.$row->year_id.'">'.$row->year_name.'</option>';
        }

        echo json_encode($opt);
    }
    // แสดงปีงบประมาณ opt

    public function get_year_by_vis_id()
    {
        $vis_id = $this->input->post('vis_id');
        $this->y_rs->vis_id = $vis_id;
        $result = $this->y_rs->get_year_by_vis_id()->result();

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        // $opt = '<option selected disabled="disabled">เลือกปีงบประมาณ</option>';
        $opt = '';
        foreach ($result as $row) {
            $selected = $row->vis_year_id;
				if($selected == $row->vis_year_id){
					$selected = "selected";
				}

            $opt .= '<option '. $selected .' value="'.$row->vis_year_id.'">'.$row->year_name.'</option>';
        }

        echo json_encode($opt);
    }
    // แสดงปีงบประมาณที่ไม่มีวิสัยทัศน์ตอนกดปุ่ม edit

    public function get_vis_by_id()
    {
        $vis_id = $this->input->post('vis_id');
		$this->vis_rs->vis_id = $vis_id;
		$result = $this->vis_rs->get_vis_by_id()->row_array();

		echo json_encode($result);
    }
    // แสดงข้อมูลวิสัยทัศน์ตอนกด edit

    public function ajax_add_vis()
    {

        $year_id = $this->input->post('year_id');
        $vis_name = $this->input->post('vis_name');
        $vis_id = $this->input->post('vis_id');

        // echo ("year_id = ".$year_id);
        // echo ("vis_name = ".$vis_name);
        // echo ("vis_id = ".$vis_id);die;

        if (empty($vis_id)) {

            // ส่วน insert
            $this->vis_rs->vis_name = $vis_name;
            $this->vis_rs->vis_year_id = $year_id;
            $this->vis_rs->insert_vis();

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
            $this->vis_rs->vis_id = $vis_id;
            $this->vis_rs->vis_name = $vis_name;
            $this->vis_rs->update_vis();

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
    // fn add & update vision

    public function ajax_del_vis()
    {
        $vis_id = $this->input->post('vis_id');
        $this->vis_rs->vis_id = $vis_id;
        $this->vis_rs->delete_vis();

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
    // ลบวิสัยทัศน์

    public function mission()
    {
        $this->output($this->config->item('admin').'/v_mission');
    }
    // go to page mission

    public function get_mis_show()
    {
        $result = $this->mis_rs->get_mission_data()->result();
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";

        $all_data = array();
        $i=1;
        foreach ($result as $row) {

            $this->mis_rs->rel_mis_id = $row->mis_id;
            $chk_del_mis = $this->mis_rs->chk_del_mis();

            if ($chk_del_mis->row_array() > 0) {
                $data = array(
                    'mis_seq'       => '<center>'.$i++.'</center>',
                    'mis_year'      => '<center>'.$row->year_name.'</center>',
                    'mis_name'      => $row->mis_name,
                    'mis_action'    => '<center><a type="" class="'.$this->config->item("btn_set_kpi_color").'" data-tooltip="คลิกเพื่อจัดการตัวชี้วัด" href="'.site_url().'/admin/Sms_base_data/mission_ind/'.$row->mis_id.'" ><i class="'.$this->config->item("sms_icon_set_kpi").'" aria-hidden="true"></i></a>
                                        <button type="button" class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" onclick="return edit_mis('.$row->mis_id.')"><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></button>
                                        <button type="button" disabled class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_mis('.$row->mis_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button></center>'
                );
            }
            else {
                $data = array(
                    'mis_seq'       => '<center>'.$i++.'</center>',
                    'mis_year'      => '<center>'.$row->year_name.'</center>',
                    'mis_name'      => $row->mis_name,
                    'mis_action'    => '<center><a type="" class="'.$this->config->item("btn_set_kpi_color").'" data-tooltip="คลิกเพื่อจัดการตัวชี้วัด" href="'.site_url().'/admin/Sms_base_data/mission_ind/'.$row->mis_id.'" ><i class="'.$this->config->item("sms_icon_set_kpi").'" aria-hidden="true"></i></a>
                                        <button type="button" class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" onclick="return edit_mis('.$row->mis_id.')"><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></button>
                                        <button type="button" class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_mis('.$row->mis_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button></center>'
                );
            }

            
            array_push($all_data,$data);
        }

        echo json_encode($all_data);
    }
    // datatable show mis

    public function get_mis_by_id()
    {
        $mis_id = $this->input->post('mis_id');
		$this->mis_rs->mis_id = $mis_id;
		$result = $this->mis_rs->get_mis_by_id()->row_array();

		echo json_encode($result);
    }
    // แสดงข้อมูลพันธกิจตอนกด edit

    public function get_year_by_mis_id()
    {
        $mis_id = $this->input->post('mis_id');
        $this->y_rs->mis_id = $mis_id;
        $result_sel = $this->y_rs->get_year_by_mis_id()->result(); //check ว่าให้ selectปีไหน
        $result = $this->y_rs->get_year_have_vis()->result();//get ปีทั้งหมดที่มีวิสัยทัศน์

        // echo "<pre>";
        // print_r($result_sel);
        // echo "</pre>";
        // die;

        $opt = '<option disabled="disabled">เลือกปีงบประมาณ</option>';
        // $opt = '';
        foreach ($result_sel as $row_sel) {
            $select = $row_sel->mis_year_id;
            $selected = "";
            // echo ("$selected = ".$selected); die;
            foreach ($result as $row){
                if($select == $row->year_id){
					$selected = "selected";
                }else {
                    $selected = "";
                }
                $opt .= '<option '. $selected .' value="'.$row->year_id.'">'.$row->year_name.'</option>';
            }


        }

        echo json_encode($opt);
    }
    // แสดงปีงบประมาณตอนกดปุ่ม edit พันธกิจ

    public function ajax_add_mis()
    {
        $year_id = $this->input->post('year_id');
        $mis_name = $this->input->post('mis_name');
        $mis_id = $this->input->post('mis_id');

        if (empty($mis_id)) {

            // ส่วน insert
            $this->mis_rs->mis_name = $mis_name;
            $this->mis_rs->mis_year_id = $year_id;
            $this->mis_rs->insert_mis();

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
            $this->mis_rs->mis_id = $mis_id;
            $this->mis_rs->mis_name = $mis_name;
            $this->mis_rs->mis_year_id = $year_id;
            $this->mis_rs->update_mis();

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
    // fn add & update mission

    public function ajax_del_mis()
    {
        $mis_id = $this->input->post('mis_id');
        
        $this->mis_rs->mis_ind_mis_id = $mis_id;
        $this->mis_rs->delete_mis_ind_when_del_mis();
        
        $this->mis_rs->mis_id = $mis_id;
        $this->mis_rs->delete_mis();


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
    // ลบพันธกิจ

    public function mission_ind($mis_id="")
    {
        $data["mis_id"] = $mis_id;
        $this->output($this->config->item('admin').'/v_mission_ind',$data);
    }
    // go to page mission_ind

    public function get_ind_all()
    {
        $result = $this->mis_rs->get_ind_all()->result();

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $opt = '<option selected disabled="disabled">เลือกตัวชี้วัด</option>';
        foreach ($result as $row) {
            $selected = "";
				if($selected == $row->ind_id){
					$selected = "selected";
				}

            $opt .= '<option '. $selected .' value="'.$row->ind_id.'">'.$row->ind_name.'</option>';
        }

        echo json_encode($opt);
    }
    //แสดง opt ตัวชี้วัดทั้งหมด

    public function get_ind_by_mis_id()
    {
        $mis_id = $this->input->post('mis_id');
        $this->mis_rs->mis_id = $mis_id;
        $result = $this->mis_rs->get_ind_by_mis_id()->result();

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $opt = '<option selected disabled="disabled">เลือกตัวชี้วัด</option>';
        foreach ($result as $row) {
            $selected = "";
				if($selected == $row->ind_id){
					$selected = "selected";
				}

            $opt .= '<option '. $selected .' value="'.$row->ind_id.'">'.$row->ind_name.'</option>';
        }

        echo json_encode($opt);
    }
    //แสดง opt ตัวชี้วัดไม่ได้ใช้ของพันธกิจ

    public function get_opt_ind()
    {
        $result = $this->mis_rs->get_opt_all()->result();

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $opt = '<option selected disabled="disabled">เลือกการคำนวณผล</option>';
        foreach ($result as $row) {
            $selected = "";
				if($selected == $row->opt_id){
					$selected = "selected";
				}

            $opt .= '<option '. $selected .' value="'.$row->opt_id.'">'.$row->opt_name.' ('.$row->opt_symbol.')'.'</option>';
        }

        echo json_encode($opt);
    }
    //get_opt_kpi

    public function get_ind_show()
    {
        $mis_id = $this->input->post('mis_id');
        $this->mis_rs->mis_id = $mis_id;
        $result = $this->mis_rs->table_ind_data()->result();
        // echo "<pre>";
        // print_r($mis_id);
        // echo "</pre>";
        // die;

        $all_data = array();
        $i=1;
        foreach ($result as $row) {
            $data = array(
                'mis_ind_seq'       => '<center>'.$i++.'</center>',
                'mis_ind_name'      => $row->ind_name,
                'mis_ind_unit'      => '<center>'.$row->mis_ind_unt.'</center>',
                'mis_ind_goal'      => '<center>'.$row->opt_symbol.' '.$row->mis_ind_goal.'</center>',
                'mis_ind_action'    => '<center><button type="button" class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" onclick="return edit_mis_ind('.$row->mis_ind_id.')"><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></button>
                                        <button type="button" class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_mis_ind('.$row->mis_ind_id.','.$row->mis_ind_mis_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button></center>'
            );
            array_push($all_data,$data);
        }

        echo json_encode($all_data);
    }
    // datatable show mis_ind

    public function get_mis_ind_by_id()
    {
        $mis_ind_id = $this->input->post('mis_ind_id');
		$this->mis_rs->mis_ind_id = $mis_ind_id;
		$result = $this->mis_rs->get_ind_by_id()->row_array();

		echo json_encode($result);
    }
    // แสดงข้อมูลตัวชี้วัดของพันธกิจตอนกด edit

    public function get_ind_by_id()
    {
        $mis_ind_ind_id = $this->input->post('mis_ind_ind_id');
        $this->mis_rs->mis_ind_ind_id = $mis_ind_ind_id;

        $result_sel = $mis_ind_ind_id; //check ว่าให้ select ค่าไหน
        $result = $this->mis_rs->get_ind_by_ind_id()->result();//get ind ทั้งหมด

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $opt = '<option disabled="disabled">เลือกตัวชี้วัด</option>';
        // $opt = '';

            $select = $result_sel;
            $selected = "";
            // echo ("$selected = ".$selected); die;
            foreach ($result as $row){
                if($select == $row->mis_ind_ind_id){
					$selected = "selected";
                }else {
                    $selected = "";
                }
                $opt .= '<option '. $selected .' value="'.$row->mis_ind_ind_id.'">'.$row->ind_name.'</option>';
            }


        echo json_encode($opt);
    }
    // แสดงตัวชี้วัดของพันธกิจตอนกด edit

    public function get_opt_mis_select()
    {
        $mis_ind_opt_id = $this->input->post('mis_ind_opt_id');

        $result_sel = $mis_ind_opt_id; //check ว่าให้ select ค่าไหน
        $result = $this->mis_rs->get_opt_all()->result();//get opt ทั้งหมด

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $opt = '<option disabled="disabled">เลือกการคำนวณผล</option>';
        // $opt = '';

            $select = $result_sel;
            $selected = "";
            // echo ("$selected = ".$selected); die;
            foreach ($result as $row){
                if($select == $row->opt_id){
					$selected = "selected";
                }else {
                    $selected = "";
                }
                $opt .= '<option '. $selected .' value="'.$row->opt_id.'">'.$row->opt_name.'</option>';
            }

        echo json_encode($opt);
    }
    //แสดงตัวดำเนินการตอนกด edit

    public function ajax_add_mis_ind()
    {
        $mis_id     = $this->input->post('mis_id');
        $mis_ind_id = $this->input->post('mis_ind_id'); //for check insert or update
        $ind_id     = $this->input->post('ind_id');
        $unt_input  = $this->input->post('unt_input');
        $opt_id     = $this->input->post('opt_id');
        $goal_input = $this->input->post('goal_input');

        if (empty($mis_ind_id)) {

            // ส่วน insert

            $this->mis_rs->mis_ind_mis_id = $mis_id;
            $this->mis_rs->mis_ind_ind_id = $ind_id;
            $this->mis_rs->mis_ind_unt = $unt_input;
            $this->mis_rs->mis_ind_opt_id = $opt_id;
            $this->mis_rs->mis_ind_goal = $goal_input;

            $this->mis_rs->insert_mis_ind();

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

            $this->mis_rs->mis_ind_mis_id = $mis_id;
            $this->mis_rs->mis_ind_ind_id = $mis_ind_id;
            $this->mis_rs->mis_ind_unt = $unt_input;
            $this->mis_rs->mis_ind_opt_id = $opt_id;
            $this->mis_rs->mis_ind_goal = $goal_input;
            $this->mis_rs->mis_ind_id = $ind_id;

            // echo ("mis_ind_mis_id = ".$mis_id);
            // echo ("mis_ind_id = ".$mis_ind_id);
            // echo ("unt_input = ".$unt_input);
            // echo ("opt_id = ".$opt_id);
            // echo ("goal_input = ".$goal_input);
            // echo ("ind_id = ".$ind_id);
            // die;

            $this->mis_rs->update_mis_ind();

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
    // fn add & update mission

    public function ajax_del_mis_ind()
    {
        $mis_ind_id = $this->input->post('mis_ind_id');
        $this->mis_rs->mis_ind_id = $mis_ind_id;
        $this->mis_rs->delete_mis_ind();

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
    //ลบตัวชี้วัดพันธกิจ

    public function strategy()
    {
        $this->output($this->config->item('admin').'/v_strategy');
    }
    // go to page strategy

    public function get_str_show()
    {
        $result = $this->str_rs->get_str_data()->result();
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";

        $all_data = array();
        $i=1;
        foreach ($result as $row) {

            $this->str_rs->rel_str_id = $row->str_id;
            $chk_del_str = $this->str_rs->chk_del_str();

            if ($chk_del_str->row_array()>0) {
                $data = array(
                    'str_seq'       => '<center>'.$i++.'</center>',
                    'str_year'      => '<center>'.$row->year_name.'</center>',
                    'str_name'      => $row->str_name,
                    'str_action'    => '<center><a type="" class="'.$this->config->item("btn_set_kpi_color").'" data-tooltip="คลิกเพื่อจัดการตัวชี้วัด" href="'.site_url().'/admin/Sms_base_data/strategy_ind/'.$row->str_id.'" ><i class="'.$this->config->item("sms_icon_set_kpi").'" aria-hidden="true"></i></a>
                                        <button type="button" class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" onclick="return edit_str('.$row->str_id.')"><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></button>
                                        <button type="button" disabled class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_str('.$row->str_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button></center>'
                );
            }
            else {
                $data = array(
                    'str_seq'       => '<center>'.$i++.'</center>',
                    'str_year'      => '<center>'.$row->year_name.'</center>',
                    'str_name'      => $row->str_name,
                    'str_action'    => '<center><a type="" class="'.$this->config->item("btn_set_kpi_color").'" data-tooltip="คลิกเพื่อจัดการตัวชี้วัด" href="'.site_url().'/admin/Sms_base_data/strategy_ind/'.$row->str_id.'" ><i class="'.$this->config->item("sms_icon_set_kpi").'" aria-hidden="true"></i></a>
                                        <button type="button" class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" onclick="return edit_str('.$row->str_id.')"><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></button>
                                        <button type="button" class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_str('.$row->str_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button></center>'
                );
            }

            
            array_push($all_data,$data);
        }

        echo json_encode($all_data);
    }
    // datatable show str

    public function get_str_by_id()
    {
        $str_id = $this->input->post('str_id');
		$this->str_rs->str_id = $str_id;
		$result = $this->str_rs->get_str_by_id()->row_array();

		echo json_encode($result);
    }
    // แสดงข้อมูลยุทธศาสตร์ตอนกด edit

    public function get_year_by_str_id()
    {
        $str_id = $this->input->post('str_id');
        $this->y_rs->str_id = $str_id;

        $result_sel = $this->y_rs->get_year_by_str_id()->result(); //check ว่าให้ select ปีไหน
        $result = $this->y_rs->get_year_have_vis()->result(); //get ปีทั้งหมดที่มีวิสัยทัศน์

        // echo "<pre>";
        // print_r($result_sel);
        // echo "</pre>";
        // die;

        $opt = '<option disabled="disabled">เลือกปีงบประมาณ</option>';
        // $opt = '';

            $select = $result_sel;
            $selected = "";
            // echo ("$selected = ".$selected); die;
            foreach ($result_sel as $row_sel) {
                $select = $row_sel->str_year_id;
                $selected = "";
                // echo ("$selected = ".$selected); die;
                foreach ($result as $row){
                    if($select == $row->year_id){
                        $selected = "selected";
                    }else {
                        $selected = "";
                    }
                    $opt .= '<option '. $selected .' value="'.$row->year_id.'">'.$row->year_name.'</option>';
                }


            }

        echo json_encode($opt);
    }
    // แสดงปีงบประมาณตอนกด edit

    public function ajax_add_str()
    {
        $year_id = $this->input->post('year_id');
        $str_name = $this->input->post('str_name');
        $str_id = $this->input->post('str_id');

        if (empty($str_id)) {

            // ส่วน insert
            $this->str_rs->str_name = $str_name;
            $this->str_rs->str_year_id = $year_id;
            $this->str_rs->insert_str();

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
            $this->str_rs->str_id = $str_id;
            $this->str_rs->str_name = $str_name;
            $this->str_rs->str_year_id = $year_id;
            $this->str_rs->update_str();

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
    // fn add & update str

    public function ajax_del_str()
    {
        $str_id = $this->input->post('str_id');
        
        $this->str_rs->str_ind_str_id = $str_id;
        $this->str_rs->delete_str_ind_when_del_str();
        
        $this->str_rs->str_id = $str_id;
        $this->str_rs->delete_str();

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
    // ลบยุทธศาสตร์

    public function strategy_ind($str_id="")
    {
        $data["str_id"] = $str_id;
        $this->output($this->config->item('admin').'/v_strategy_ind',$data);
    }
    // go to page strategy_ind

    public function get_ind_str()
    {
        $str_id = $this->input->post('str_id');
        $this->str_rs->str_ind_str_id = $str_id;
        $result = $this->str_rs->table_ind_data()->result();
        // echo "<pre>";
        // print_r($str_id);
        // echo "</pre>";
        // die;

        $all_data = array();
        $i=1;
        foreach ($result as $row) {
            $data = array(
                'str_ind_seq'       => '<center>'.$i++.'</center>',
                'str_ind_name'      => $row->ind_name,
                'str_ind_unit'      => '<center>'.$row->str_ind_unt.'</center>',
                'str_ind_goal'      => '<center>'.$row->opt_symbol.' '.$row->str_ind_goal.'</center>',
                'str_ind_action'    => '<center><button type="button" class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" onclick="return edit_str_ind('.$row->str_ind_id.')"><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></button>
                                        <button type="button" class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_str_ind('.$row->str_ind_id.','.$row->str_ind_str_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button></center>'
            );
            array_push($all_data,$data);
        }

        echo json_encode($all_data);
    }
    // datatable show str_ind

    public function get_ind_by_str_id()
    {
        $str_id = $this->input->post('str_id');
        $this->str_rs->str_id = $str_id;
        $result = $this->str_rs->get_ind_by_str_id()->result();

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $opt = '<option selected disabled="disabled">เลือกตัวชี้วัด</option>';
        foreach ($result as $row) {
            $selected = "";
				if($selected == $row->ind_id){
					$selected = "selected";
				}

            $opt .= '<option '. $selected .' value="'.$row->ind_id.'">'.$row->ind_name.'</option>';
        }

        echo json_encode($opt);
    }
    //แสดง opt ตัวชี้วัดไม่ได้ใช้ของยุทธศาสตร์

    public function get_str_ind_by_id()
    {
        $str_ind_id = $this->input->post('str_ind_id');
		$this->str_rs->str_ind_id = $str_ind_id;
		$result = $this->str_rs->get_ind_by_id()->row_array();

		echo json_encode($result);
    }
    //แสดงข้อมูลตัวชี้วัดยุทธศาสตร์ตอนกด edit

    public function get_ind_str_select()
    {
        $str_ind_ind_id = $this->input->post('str_ind_ind_id');
        $this->str_rs->str_ind_ind_id = $str_ind_ind_id;

        $result_sel = $str_ind_ind_id; //check ว่าให้ select ค่าไหน
        $result = $this->str_rs->get_ind_by_ind_id()->result();//get ind ทั้งหมด

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $opt = '<option disabled="disabled">เลือกตัวชี้วัด</option>';
        // $opt = '';

            $select = $result_sel;
            $selected = "";
            // echo ("$selected = ".$selected); die;
            foreach ($result as $row){
                if($select == $row->str_ind_ind_id){
					$selected = "selected";
                }else {
                    $selected = "";
                }
                $opt .= '<option '. $selected .' value="'.$row->str_ind_ind_id.'">'.$row->ind_name.'</option>';
            }


        echo json_encode($opt);
    }
    // แสดงตัวชี้วัดของยุทธศาสตร์ตอนกด edit

    public function get_opt_str_select()
    {
        $str_ind_opt_id = $this->input->post('str_ind_opt_id');

        $result_sel = $str_ind_opt_id; //check ว่าให้ select ค่าไหน
        $result = $this->mis_rs->get_opt_all()->result();//get opt ทั้งหมด

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $opt = '<option disabled="disabled">เลือกการคำนวณผล</option>';
        // $opt = '';

            $select = $result_sel;
            $selected = "";
            // echo ("$selected = ".$selected); die;
            foreach ($result as $row){
                if($select == $row->opt_id){
					$selected = "selected";
                }else {
                    $selected = "";
                }
                $opt .= '<option '. $selected .' value="'.$row->opt_id.'">'.$row->opt_name.'</option>';
            }

        echo json_encode($opt);
    }
    //แสดงตัวดำเนินการตอนกด edit

    public function ajax_add_str_ind()
    {
        $str_ind_id = $this->input->post('str_ind_id'); //for check insert or update
        $str_id     = $this->input->post('str_id');
        $ind_id     = $this->input->post('ind_id');
        $unt_input  = $this->input->post('unt_input');
        $opt_id     = $this->input->post('opt_id');
        $goal_input = $this->input->post('goal_input');

        if (empty($str_ind_id)) {

            // ส่วน insert

            $this->str_rs->str_ind_str_id = $str_id;
            $this->str_rs->str_ind_ind_id = $ind_id;
            $this->str_rs->str_ind_unt = $unt_input;
            $this->str_rs->str_ind_opt_id = $opt_id;
            $this->str_rs->str_ind_goal = $goal_input;

            $this->str_rs->insert_str_ind();

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

            $this->str_rs->str_ind_unt = $unt_input;
            $this->str_rs->str_ind_opt_id = $opt_id;
            $this->str_rs->str_ind_goal = $goal_input;
            $this->str_rs->str_ind_id = $str_ind_id;

            $this->str_rs->update_str_ind();

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
    // fn add & update strategy ind

    public function ajax_del_str_ind()
    {
        $str_ind_id = $this->input->post('str_ind_id');
        $this->str_rs->str_ind_id = $str_ind_id;
        $this->str_rs->delete_str_ind();

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
    // fn delete str_ind

    public function point()
    {
        $this->output($this->config->item('admin').'/v_point');
    }
    // go to page point เป้าประสงค์

    public function get_poi_show()
    {
        $result = $this->poi_rs->get_poi_data()->result();
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";

        $all_data = array();
        $i=1;
        foreach ($result as $row) {

            $poi_id = $row->poi_id;
            $this->psstr_rs->rel_poi_id = $poi_id;
            $chk_del_poi = $this->psstr_rs->chk_del_poi();
            
            if ($chk_del_poi->row_array()>0){
                $data = array(
                    'poi_seq'       => '<center>'.$i++.'</center>',
                    'poi_year'      => '<center>'.$row->year_name.'</center>',
                    'poi_name'      => $row->poi_name,
                    'poi_action'    => '<center>
                                        <button type="button" class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" onclick="return edit_poi('.$row->poi_id.')"><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></button>
                                        <button type="button" disabled class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_poi('.$row->poi_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button>
                                        </center>'
                );
            }else {
                $data = array(
                    'poi_seq'       => '<center>'.$i++.'</center>',
                    'poi_year'      => '<center>'.$row->year_name.'</center>',
                    'poi_name'      => $row->poi_name,
                    'poi_action'    => '<center>
                                        <button type="button" class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" onclick="return edit_poi('.$row->poi_id.')"><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></button>
                                        <button type="button" class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_poi('.$row->poi_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button>
                                        </center>'
                );
            }
            
            array_push($all_data,$data);
        }

        echo json_encode($all_data);
    }
    // datatable show point

    public function get_poi_by_id()
    {
        $poi_id = $this->input->post('poi_id');
        $this->poi_rs->poi_id = $poi_id;
        $result = $this->poi_rs->get_poi_by_id()->row_array();

        echo json_encode($result);
    }
    // แสดงข้อมูลเป้าประสงค์ตอนกด edit

    public function get_year_by_poi_id()
    {
        $poi_id = $this->input->post('poi_id');
        $this->y_rs->poi_id = $poi_id;

        $result_sel = $this->y_rs->get_year_by_poi_id()->result(); //check ว่าให้ select ปีไหน
        $result = $this->y_rs->get_year_have_vis()->result();//get ปีทั้งหมดที่มีวิสัยทัศน์

        // echo "<pre>";
        // print_r($result_sel);
        // echo "</pre>";
        // die;

        $opt = '<option disabled="disabled">เลือกปีงบประมาณ</option>';
        // $opt = '';
        foreach ($result_sel as $row_sel) {
            $select = $row_sel->poi_year_id;
            $selected = "";
            // echo ("$selected = ".$selected); die;
            foreach ($result as $row){
                if($select == $row->year_id){
					$selected = "selected";
                }else {
                    $selected = "";
                }
                $opt .= '<option '. $selected .' value="'.$row->year_id.'">'.$row->year_name.'</option>';
            }
        }
        echo json_encode($opt);

    }
    // แสดงปีงบประมาณตอนกดปุ่ม edit ยุทธศาสตร์

    public function ajax_add_poi()
    {
        $poi_id = $this->input->post('poi_id'); //check insert od update
        $year_id = $this->input->post('year_id');
        $poi_name = $this->input->post('poi_name');

        if (empty($poi_id)) {

            // ส่วน insert
            $this->poi_rs->poi_name = $poi_name;
            $this->poi_rs->poi_year_id = $year_id;
            $this->poi_rs->insert_poi();

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
            $this->poi_rs->poi_id = $poi_id;
            $this->poi_rs->poi_name = $poi_name;
            $this->poi_rs->poi_year_id = $year_id;
            $this->poi_rs->update_poi();

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
    // fn add & update poi

    public function ajax_del_poi()
    {
        $poi_id = $this->input->post('poi_id');
        $this->poi_rs->poi_id = $poi_id;
        $this->poi_rs->delete_poi();

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
    // ลบเป้าประสงค์

    public function vpt_sstr()
    {
        $this->output($this->config->item('admin').'/v_vpt_sstr');
    }
    // go to page มุมมองกลยุทธ์

    public function get_vpt_show()
    {
        $result = $this->vpt_rs->get_vpt_data()->result();
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";

        $all_data = array();
        $i=1;
        foreach ($result as $row) {

            $this->vpt_rs->vpt_id = $row->vpt_id;
            $chk_del_vpt = $this->vpt_rs->chk_del_vpt(); //เช็คว่ามุมมองมีกลยุทธ์ไหม ถ้ามีจะลบไม่ได้

            if ($chk_del_vpt->row_array()>0) {
                $data = array(
                    'vpt_seq'       => '<center>'.$i++.'</center>',
                    'vpt_year'      => '<center>'.$row->year_name.'</center>',
                    'vpt_name'      => $row->vpt_name,
                    'vpt_action'    => '<center>
                                        <button type="button" class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" onclick="return edit_vpt('.$row->vpt_id.')"><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></button>
                                        <button type="button" class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_vpt('.$row->vpt_id.')" disabled ><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button>
                                        </center>'
                );
            }else {
                $data = array(
                    'vpt_seq'       => '<center>'.$i++.'</center>',
                    'vpt_year'      => '<center>'.$row->year_name.'</center>',
                    'vpt_name'      => $row->vpt_name,
                    'vpt_action'    => '<center>
                                        <button type="button" class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" onclick="return edit_vpt('.$row->vpt_id.')"><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></button>
                                        <button type="button" class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_vpt('.$row->vpt_id.')" ><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button>
                                        </center>'
                );
            }


            array_push($all_data,$data);
        }

        echo json_encode($all_data);
    }
    // datatable show vpt

    public function get_vpt_by_id()
    {
        $vpt_id = $this->input->post('vpt_id');
        $this->vpt_rs->vpt_id = $vpt_id;
        $result = $this->vpt_rs->get_vpt_by_id()->row_array();

        echo json_encode($result);
    }
    // แสดงข้อมูลมุมมองกลยุทธ์ตอนกด edit

    public function get_year_by_vpt_id()
    {
        $vpt_id = $this->input->post('vpt_id');
        $this->y_rs->vpt_id = $vpt_id;

        $result_sel = $this->y_rs->get_year_by_vpt_id()->result(); //check ว่าให้ select ปีไหน
        $result = $this->y_rs->get_year_have_vis()->result();//get ปีทั้งหมดที่มีวิสัยทัศน์

        // echo "<pre>";
        // print_r($result_sel);
        // echo "</pre>";
        // die;

        $opt = '<option disabled="disabled">เลือกปีงบประมาณ</option>';
        // $opt = '';
        foreach ($result_sel as $row_sel) {
            $select = $row_sel->vpt_year_id;
            $selected = "";
            // echo ("$selected = ".$selected); die;
            foreach ($result as $row){
                if($select == $row->year_id){
					$selected = "selected";
                }else {
                    $selected = "";
                }
                $opt .= '<option '. $selected .' value="'.$row->year_id.'">'.$row->year_name.'</option>';
            }
        }
        echo json_encode($opt);
    }
    //แสดงปีงบประมาณตอนกด edit มุมมองกลยุทธ์

    public function ajax_add_vpt()
    {
        $vpt_id = $this->input->post('vpt_id'); //check insert od update
        $year_id = $this->input->post('year_id');
        $vpt_name = $this->input->post('vpt_name');

        if (empty($vpt_id)) {

            // ส่วน insert
            $this->vpt_rs->vpt_name = $vpt_name;
            $this->vpt_rs->vpt_year_id = $year_id;
            $this->vpt_rs->insert_vpt();

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
            $this->vpt_rs->vpt_id = $vpt_id;
            $this->vpt_rs->vpt_name = $vpt_name;
            $this->vpt_rs->vpt_year_id = $year_id;
            $this->vpt_rs->update_vpt();

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
    // fn add & update vpt

    public function ajax_del_vpt()
    {
        $vpt_id = $this->input->post('vpt_id');
        $this->vpt_rs->vpt_id = $vpt_id;
        $this->vpt_rs->delete_vpt();

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
    //ลบมุมมองกลยุทธ์

    public function sub_strategy()
    {
        $this->output($this->config->item('admin').'/v_sub_strategy');
    }
    // go to page กลยุทธ์

    public function get_sstr_show()
    {
        $result = $this->sstr_rs->get_sstr_data()->result();
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";

        $all_data = array();
        $i=1;
        foreach ($result as $row) {

            $this->sstr_rs->sstr_id = $row->sstr_id;
            $chk_del_sstr = $this->sstr_rs->chk_del_sstr(); //เช็คว่าว่ากลยุทธ์มีโครงการไหม

            if ($chk_del_sstr->row_array()>0) {
                $data = array(
                    'sstr_seq'       => '<center>'.$i++.'</center>',
                    'sstr_year'      => '<center>'.$row->year_name.'</center>',
                    'sstr_vpt'      => '<center>'.$row->vpt_name.'</center>',
                    'sstr_name'      => $row->sstr_name,
                    'sstr_action'    => '<center>
                                        <a type="" class="'.$this->config->item("btn_set_kpi_color").'" data-tooltip="คลิกเพื่อจัดการตัวชี้วัด" href="'.site_url().'/admin/Sms_base_data/sub_strategy_ind/'.$row->sstr_id.'" ><i class="'.$this->config->item("sms_icon_set_kpi").'" aria-hidden="true"></i></a>
                                        <button type="button" class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" onclick="return edit_sstr('.$row->sstr_id.')"><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></button>
                                        <button type="button" disabled  class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_sstr('.$row->sstr_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button>
                                        </center>'
                );
            }else {
                $data = array(
                    'sstr_seq'       => '<center>'.$i++.'</center>',
                    'sstr_year'      => '<center>'.$row->year_name.'</center>',
                    'sstr_vpt'      => '<center>'.$row->vpt_name.'</center>',
                    'sstr_name'      => $row->sstr_name,
                    'sstr_action'    => '<center>
                                        <a type="" class="'.$this->config->item("btn_set_kpi_color").'" data-tooltip="คลิกเพื่อจัดการตัวชี้วัด" href="'.site_url().'/admin/Sms_base_data/sub_strategy_ind/'.$row->sstr_id.'" ><i class="'.$this->config->item("sms_icon_set_kpi").'" aria-hidden="true"></i></a>
                                        <button type="button" class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" onclick="return edit_sstr('.$row->sstr_id.')"><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></button>
                                        <button type="button" class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_sstr('.$row->sstr_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button>
                                        </center>'
                );
            }
            
            array_push($all_data,$data);
        }

        echo json_encode($all_data);
    }
    // datatable แสดงกลยุทธ์

    public function get_vpt_by_year()
    {
        $year_id = $this->input->post('year_id');
        $this->vpt_rs->vpt_year_id = $year_id;
        // $result = $this->vpt_rs->get_vpt_of_year()->result();
        $result = $this->vpt_rs->get_vpt_of_year()->result();

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        // $result = $this->vpt_rs->get_vpt_of_year()->result();

        $opt = '<option selected disabled="disabled">เลือกมุมมองกลยุทธ์</option>';
        foreach ($result as $row) {

            $opt .= '<option value="'.$row->vpt_id.'">'.$row->vpt_name.'</option>';
        }

        echo json_encode($opt);

    }
    // แสดงมุมมองกลยุทธ์ของปีงบประมาณตอนกด add กลยุทธ์

    public function get_sstr_by_id()
    {
        $sstr_id = $this->input->post('sstr_id');
        $this->sstr_rs->sstr_id = $sstr_id;
        $result = $this->sstr_rs->get_sstr_by_id()->row_array();

        echo json_encode($result);
    }
    // แสดงข้อมูลกลยุทธ์ตอนกด edit

    public function get_year_by_sstr_id()
    {
        $sstr_year_id = $this->input->post('sstr_year_id');

        $result = $this->y_rs->get_year_have_vis()->result();//get ปีทั้งหมดที่มีวิสัยทัศน์

        // echo "<pre>";
        // print_r($result_sel);
        // echo "</pre>";
        // die;

        $opt = '<option disabled="disabled">เลือกปีงบประมาณ</option>';
        // $opt = '';
            $select = $sstr_year_id;
            $selected = "";
            foreach ($result as $row){
                if($select == $row->year_id){
					$selected = "selected";
                }else {
                    $selected = "";
                }
                $opt .= '<option '. $selected .' value="'.$row->year_id.'">'.$row->year_name.'</option>';
            }
        echo json_encode($opt);
    }
    // แสดงปีงบประมาณตอนกด edit กลยุทธ์

    public function get_vpt_by_sstr_id()
    {
        $sstr_viewp_id = $this->input->post('sstr_viewp_id');
        $sstr_year_id = $this->input->post('sstr_year_id');
        $this->vpt_rs->vpt_year_id = $sstr_year_id;

        $result = $this->vpt_rs->get_vpt_of_year()->result();//get มุมมองกลยุทธ์ทั้งหมดของปี

        // echo "<pre>";
        // print_r($sstr_viewp_id);
        // print_r($sstr_year_id);
        // echo "</pre>";
        // die;

        $opt = '<option disabled="disabled">เลือกมุมมองกลยุทธ์</option>';
        // $opt = '';
            $select = $sstr_viewp_id;
            $selected = "";
            foreach ($result as $row){
                if($select == $row->vpt_id){
					$selected = "selected";
                }else {
                    $selected = "";
                }
                $opt .= '<option '. $selected .' value="'.$row->vpt_id.'">'.$row->vpt_name.'</option>';
            }
        echo json_encode($opt);

    }
    // ดึงข้อมูลมุมมองกลยุทธ์ตาม id กลยุทธ์

    public function ajax_add_sstr()
    {
        $sstr_id = $this->input->post('sstr_id'); //check insert od update
        $year_id = $this->input->post('year_id');
        $vpt_id = $this->input->post('vpt_id');
        $sstr_name = $this->input->post('sstr_name');


        if (empty($sstr_id)) {

            // ส่วน insert
            $this->sstr_rs->sstr_name = $sstr_name;
            $this->sstr_rs->sstr_viewp_id = $vpt_id;
            $this->sstr_rs->sstr_year_id = $year_id;
            $this->sstr_rs->insert_sstr();


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
            $this->sstr_rs->sstr_name = $sstr_name;
            $this->sstr_rs->sstr_viewp_id = $vpt_id;
            $this->sstr_rs->sstr_year_id = $year_id;
            $this->sstr_rs->sstr_id = $sstr_id;

            $this->sstr_rs->update_sstr();

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
    // fn insert & update sub_strategy

    public function ajax_del_sstr()
    {
        $sstr_id = $this->input->post('sstr_id');

        $this->sstr_rs->sstr_ind_sstr_id = $sstr_id;
        $this->sstr_rs->delete_sstr_ind_when_del_sstr();
        
        $this->sstr_rs->sstr_id = $sstr_id;
        $this->sstr_rs->delete_sstr();

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
    // ลบกลยุทธ์

    public function sub_strategy_ind($sstr_id="")
    {
        $data["sstr_id"] = $sstr_id;
        $this->output($this->config->item('admin').'/v_sstr_ind',$data);
    }
    // go to page strategy_ind

    public function get_year_sstr()
    {
        $sstr_id = $this->input->post('sstr_id');
        $this->y_rs->sstr_id = $sstr_id;
        $result = $this->y_rs->get_year_by_sstr_id()->row_array();

        echo json_encode($result);
    }
    // แสดงปีงบประมาณของกลยุทธ์

    public function get_ind_sstr()
    {
        $sstr_id = $this->input->post('sstr_id');
        $this->sstr_rs->sstr_ind_sstr_id = $sstr_id;
        $result = $this->sstr_rs->table_ind_data()->result();
        // echo "<pre>";
        // print_r($str_id);
        // echo "</pre>";
        // die;

        $all_data = array();
        $i=1;
        foreach ($result as $row) {
            $data = array(
                'sstr_ind_seq'       => '<center>'.$i++.'</center>',
                'sstr_ind_name'      => $row->ind_name,
                'sstr_ind_unit'      => '<center>'.$row->sstr_ind_unt.'</center>',
                'sstr_ind_goal'      => '<center>'.$row->opt_symbol.' '.$row->sstr_ind_goal.'</center>',
                'sstr_ind_action'    => '<center><button type="button" class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" onclick="return edit_sstr_ind('.$row->sstr_ind_id.')"><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></button>
                                        <button type="button" class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_sstr_ind('.$row->sstr_ind_id.','.$row->sstr_ind_sstr_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button></center>'
            );
            array_push($all_data,$data);
        }

        echo json_encode($all_data);
    }
    // datatable show sstr_ind

    public function get_ind_by_sstr_id()
    {
        $sstr_id = $this->input->post('sstr_id');
        $this->sstr_rs->sstr_ind_sstr_id = $sstr_id;
        $result = $this->sstr_rs->get_ind_by_sstr_id()->result();

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $opt = '<option selected disabled="disabled">เลือกตัวชี้วัด</option>';
        foreach ($result as $row) {
            $selected = "";
				if($selected == $row->ind_id){
					$selected = "selected";
				}

            $opt .= '<option '. $selected .' value="'.$row->ind_id.'">'.$row->ind_name.'</option>';
        }

        echo json_encode($opt);
    }
    //แสดง opt ตัวชี้วัดไม่ได้ใช้ของยุทธศาสตร์

    public function ajax_add_sstr_ind()
    {
        $sstr_ind_id = $this->input->post('sstr_ind_id'); //for check insert or update
        $sstr_id     = $this->input->post('sstr_id');
        $ind_id     = $this->input->post('ind_id');
        $unt_input  = $this->input->post('unt_input');
        $opt_id     = $this->input->post('opt_id');
        $goal_input = $this->input->post('goal_input');

        if (empty($sstr_ind_id)) {

            // ส่วน insert

            $this->sstr_rs->sstr_ind_str_id = $sstr_id;
            $this->sstr_rs->sstr_ind_ind_id = $ind_id;
            $this->sstr_rs->sstr_ind_unt = $unt_input;
            $this->sstr_rs->sstr_ind_opt_id = $opt_id;
            $this->sstr_rs->sstr_ind_goal = $goal_input;

            $this->sstr_rs->insert_sstr_ind();

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

            $this->sstr_rs->sstr_ind_unt = $unt_input;
            $this->sstr_rs->sstr_ind_opt_id = $opt_id;
            $this->sstr_rs->sstr_ind_goal = $goal_input;
            $this->sstr_rs->sstr_ind_id = $sstr_ind_id;

            $this->sstr_rs->update_sstr_ind();

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
    // fn insert & update sub strategy ind

    public function ajax_del_sstr_ind()
    {
        $sstr_ind_id = $this->input->post('sstr_ind_id');
        $this->sstr_rs->sstr_ind_id = $sstr_ind_id;
        $this->sstr_rs->delete_sstr_ind();

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
    // ลบข้อมูลตัวชี้วัดกลยุทธ์

    public function get_sstr_ind_by_id()
    {
        $sstr_ind_id = $this->input->post('sstr_ind_id');
		$this->sstr_rs->sstr_ind_id = $sstr_ind_id;
		$result = $this->sstr_rs->get_ind_by_id()->row_array();

		echo json_encode($result);
    }
    // แสดงข้อมูลตัวชี้วัดกลยุทธ์ตอนกด edit

    public function get_ind_sstr_select()
    {
        $sstr_ind_ind_id = $this->input->post('sstr_ind_ind_id');
        $this->sstr_rs->sstr_ind_ind_id = $sstr_ind_ind_id;

        $result_sel = $sstr_ind_ind_id; //check ว่าให้ select ค่าไหน
        $result = $this->sstr_rs->get_ind_by_ind_id()->result();//get ind ทั้งหมด

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $opt = '<option disabled="disabled">เลือกตัวชี้วัด</option>';
        // $opt = '';

            $select = $result_sel;
            $selected = "";
            // echo ("$selected = ".$selected); die;
            foreach ($result as $row){
                if($select == $row->sstr_ind_ind_id){
					$selected = "selected";
                }else {
                    $selected = "";
                }
                $opt .= '<option '. $selected .' value="'.$row->sstr_ind_ind_id.'">'.$row->ind_name.'</option>';
            }


        echo json_encode($opt);
    }
    // แสดงตัวชี้วัดของกลยุทธ์ตอนกด edit

    public function get_opt_sstr_select()
    {
        $sstr_ind_opt_id = $this->input->post('sstr_ind_opt_id');

        $result_sel = $sstr_ind_opt_id; //check ว่าให้ select ค่าไหน
        $result = $this->mis_rs->get_opt_all()->result();//get opt ทั้งหมด

        // echo "<pre>";
        // print_r($sstr_ind_opt_id);
        // echo "</pre>";
        // die;

        $opt = '<option disabled="disabled">เลือกการคำนวณผล</option>';
        // $opt = '';

            $select = $result_sel;
            $selected = "";
            // echo ("$selected = ".$selected); die;
            foreach ($result as $row){
                if($select == $row->opt_id){
					$selected = "selected";
                }else {
                    $selected = "";
                }
                $opt .= '<option '. $selected .' value="'.$row->opt_id.'">'.$row->opt_name.'</option>';
            }

        echo json_encode($opt);
    }
    //แสดงตัวดำเนินการตอนกด edit

    public function measure()
    {
        $this->output($this->config->item('admin').'/v_measure');
    }
    // go to page measure

    public function get_mea_show()
    {
        $result = $this->mea_rs->get_mea_data()->result();
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $all_data = array();
        $i=1;
        foreach ($result as $row) {
            $data = array(
                'mea_seq'       => '<center>'.$i++.'</center>',
                'mea_id'        => $row->mea_id,
                'mea_year'      => '<center>'.$row->year_name.'</center>',
                'mea_code'      => '<center>'.$row->mea_code.'</center>',
                'mea_name'      => $row->mea_name,
                'mea_action'    => '<center>
                                    <button type="button" class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" onclick="return edit_mea('.$row->mea_id.')"><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></button>
                                    <button type="button" class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_mea('.$row->mea_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button>
                                    </center>'
            );
            array_push($all_data,$data);
        }

        echo json_encode($all_data);
    }
    // datatable แสดงตัวบ่งชี้

    public function ajax_add_mea()
    {
        $mea_id = $this->input->post('mea_id'); //check insert od update
        $year_id = $this->input->post('year_id');
        $mea_code = $this->input->post('mea_code');
        $mea_name = $this->input->post('mea_name');


        if (empty($mea_id)) {

            // ส่วน insert
            $this->mea_rs->mea_name = $mea_name;
            $this->mea_rs->mea_year_id = $year_id;
            $this->mea_rs->mea_code = $mea_code;
            $this->mea_rs->insert_mea();


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
            $this->mea_rs->mea_code = $mea_code;
            $this->mea_rs->mea_name = $mea_name;
            $this->mea_rs->mea_year_id = $year_id;
            $this->mea_rs->mea_id = $mea_id;
            $this->mea_rs->update_mea();

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
    // fn insert & update measure

    public function get_mea_by_id()
    {
        $mea_id = $this->input->post('mea_id');
        $this->mea_rs->mea_id = $mea_id;
        $result = $this->mea_rs->get_mea_by_id()->row_array();

        echo json_encode($result);
    }
    // แสดงข้อมูลตัวบ่งชี้ตอนกด edit

    public function get_year_by_mea_id()
    {
        $mea_year_id = $this->input->post('mea_year_id');

        $result = $this->y_rs->get_year_have_vis()->result();//get ปีทั้งหมดที่มีวิสัยทัศน์

        // echo "<pre>";
        // print_r($result_sel);
        // echo "</pre>";
        // die;

        $opt = '<option disabled="disabled">เลือกปีงบประมาณ</option>';
        // $opt = '';
            $select = $mea_year_id;
            $selected = "";
            foreach ($result as $row){
                if($select == $row->year_id){
					$selected = "selected";
                }else {
                    $selected = "";
                }
                $opt .= '<option '. $selected .' value="'.$row->year_id.'">'.$row->year_name.'</option>';
            }
        echo json_encode($opt);
    }
    // แสดงปีงบประมาณตอนกด edit ตัวบ่งชี้

    public function project_position()
    {
        $this->output($this->config->item('admin').'/v_prj_position');
    }
    // go to page prj_position

    public function get_pos_show()
    {
        $result = $this->pos_rs->get_pos_data()->result();
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $all_data = array();
        $i=1;
        foreach ($result as $row) {
            $data = array(
                'pos_seq'       => '<center>'.$i++.'</center>',
                'pos_id'        => $row->pos_id,
                'pos_name'      => $row->pos_name,
                'pos_action'    => '<center>
                                    <button type="button" class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" onclick="return edit_pos('.$row->pos_id.')"><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></button>
                                    <button type="button" class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_pos('.$row->pos_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button>
                                    </center>'
            );
            array_push($all_data,$data);
        }
        echo json_encode($all_data);
    }
    // datatable ตำแหน่งในโครงการ

    public function ajax_add_pos()
    {
        $pos_id = $this->input->post('pos_id'); //check insert od update
        $pos_name = $this->input->post('pos_name');


        if (empty($pos_id)) {

            // ส่วน insert
            $this->pos_rs->pos_name = $pos_name;
            $this->pos_rs->insert_pos();


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

    public function ajax_del_pos()
    {
        $pos_id = $this->input->post('pos_id');
        $this->pos_rs->pos_id = $pos_id;
        $this->pos_rs->delete_pos();

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
    // ลบตำแหน่งในโครงการ

    public function get_pos_by_id()
    {
        $pos_id = $this->input->post('pos_id');
        $this->pos_rs->pos_id = $pos_id;
        $result = $this->pos_rs->get_pos_by_id()->row_array();

        echo json_encode($result);
    }
    // แสดงข้อมูลตำแหน่งตอนกด edit

    public function project_state()
    {
        $this->output($this->config->item('admin').'/v_prj_state');
    }
    // go to page prj_state

    public function get_pst_show()
    {
        $result = $this->pst_rs->get_pst_data()->result();
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $all_data = array();
        $i=1;
        foreach ($result as $row) {
            $data = array(
                'pst_seq'       => '<center>'.$i++.'</center>',
                'pst_id'        => $row->pst_id,
                'pst_name'      => $row->pst_name,
                'pst_action'    => '<center>
                                    <button type="button" class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" onclick="return edit_pst('.$row->pst_id.')"><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></button>
                                    <button type="button" class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_pst('.$row->pst_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button>
                                    </center>'
            );
            array_push($all_data,$data);
        }
        echo json_encode($all_data);
    }
    // datatable สถานะของโครงการ

    public function ajax_add_pst()
    {
        $pst_id = $this->input->post('pst_id'); //check insert od update
        $pst_name = $this->input->post('pst_name');

        if (empty($pst_id)) {

            // ส่วน insert
            $this->pst_rs->pst_name = $pst_name;
            $this->pst_rs->insert_pst();


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
            $this->pst_rs->pst_name = $pst_name;
            $this->pst_rs->pst_id = $pst_id;
            $this->pst_rs->update_pst();

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
    // fn add & update project_state

    public function ajax_del_pst()
    {
        $pst_id = $this->input->post('pst_id');
        $this->pst_rs->pst_id = $pst_id;
        $this->pst_rs->delete_pst();

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
    // ลบสถานะของโครงการ

    public function get_pst_by_id()
    {
        $pst_id = $this->input->post('pst_id');
        $this->pst_rs->pst_id = $pst_id;
        $result = $this->pst_rs->get_pst_by_id()->row_array();

        echo json_encode($result);
    }
    // แสดงข้อมูลสถานะของโครงการตอนกด edit

    public function set_relation()
    {
        $this->output($this->config->item('admin').'/v_set_relation');
    }
    // go to page set_relation


    public function set_rel_year()
    {
        $result = $this->y_rs->get_year_have_vis()->result();

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";

        $opt = '<option selected disabled="disabled">เลือกปีงบประมาณ</option>';
        // $opt = '';

        $select = "";
            $selected = "";
            foreach ($result as $row){
                if($select == $row->year_id){
					$selected = "selected";
                }else {
                    $selected = "";
                }
                $opt .= '<option '. $selected .' value="'.$row->year_id.'">'.$row->year_name.'</option>';
            }

        echo json_encode($opt);
    }
    // แสดงปีงบประมาณ opt

    public function get_mis_by_year()
    {
        $year_id = $this->input->post('year_id');
        $this->mis_rs->mis_year_id = $year_id;
        $result = $this->mis_rs->get_mis_by_year()->result();

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $opt = '<option selected disabled="disabled">เลือกพันธกิจ</option>';
        foreach ($result as $row) {

            $opt .= '<option '.' value="'.$row->mis_id.'">' . $row->mis_name . '</option>';
        }

        echo json_encode($opt);

    }
    // แสดงพันธกิจของปีงบประมาณ opt

    public function get_str_not_use()
    {
        $year_id = $this->input->post('year_id');
        $this->rmst_rs->str_year_id = $year_id;
        $result = $this->rmst_rs->get_str_not_use()->result();

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $opt = '<option selected disabled="disabled">เลือกยุทธศาสตร์</option>';
        foreach ($result as $row) {

            $opt .= '<option '.' value="'.$row->str_id.'">' . $row->str_name . '</option>';
        }

        echo json_encode($opt);
    }
    // แสดงยุทธศาสตร์ที่ยังไม่ได้ตั้งค่าความสัมพันธ์ opt

    public function get_str_use()
    {
        $year_id = $this->input->post('year_id');
        $this->rmst_rs->str_year_id = $year_id;
        $result = $this->rmst_rs->get_str_use()->result();

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $opt = '<option selected disabled="disabled">เลือกยุทธศาสตร์</option>';
        foreach ($result as $row) {

            $opt .= '<option '.' value="'.$row->str_id.'">' . $row->str_name . '</option>';
        }

        echo json_encode($opt);
    }
    // แสดงยุทธศาสตร์ที่ผูกกับพันธกิจแล้ว opt

    public function get_poi_not_use()
    {
        $year_id = $this->input->post('year_id');
        $this->stp_rs->poi_year_id = $year_id;
        $result = $this->stp_rs->get_poi_not_use()->result();

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $opt = '<option selected disabled="disabled">เลือกเป้าประสงค์</option>';
        foreach ($result as $row) {

            $opt .= '<option '.' value="'.$row->poi_id.'">' . $row->poi_name . '</option>';
        }

        echo json_encode($opt);
    }
    // แสดงเป้าประสงค์ที่ยังไม่ได้ตั้งค่าความสัมพันธ์ opt

    public function get_poi_use()
    {
        $year_id = $this->input->post('year_id');
        $this->stp_rs->rel_year_id = $year_id;
        $result = $this->stp_rs->get_poi_use()->result();

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $opt = '<option selected disabled="disabled">เลือกยุทธศาสตร์</option>';
        foreach ($result as $row) {

            $opt .= '<option '.' value="'.$row->poi_id.'">' . $row->poi_name . '</option>';
        }

        echo json_encode($opt);
    }
    // แสดงเป้าประสงค์ที่ผู้กับยุทธศาสตร์แล้ว opt

    public function get_sstr_not_use()
    {
        $year_id = $this->input->post('year_id');
        $this->sstr_rs->sstr_year_id = $year_id;
        $result = $this->sstr_rs->get_sstr_not_use()->result();

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $opt = '<option selected disabled="disabled">เลือกกลยุทธ์</option>';
        foreach ($result as $row) {

            $opt .= '<option '.' value="'.$row->sstr_id.'">' . $row->sstr_name . '</option>';
        }

        echo json_encode($opt);
    }
    // แสดงกลยุทธ์ที่ยังไม่ได้ตั้งค่าความสัมพันธ์ opt

    public function ajax_add_rel()
    {

        $year_name = $this->input->post('year_name');
        $mis_name = $this->input->post('mis_name');
        $str_name = $this->input->post('str_name');
        $poi_name = $this->input->post('poi_name');
        $sstr_name = $this->input->post('sstr_name');

        $this->rmst_rs->rel_mis_id = $mis_name;
        $this->rmst_rs->rel_str_id = $str_name;
        $this->rmst_rs->rel_year_id = $year_name;
        $this->rmst_rs->insert_rel_mst();

        $this->stp_rs->rel_str_id = $str_name;
        $this->stp_rs->rel_po_id = $poi_name;
        $this->stp_rs->rel_year_id = $year_name;
        $this->stp_rs->insert_rel_strp();

        $this->psstr_rs->rel_poi_id = $poi_name;
        $this->psstr_rs->rel_sstr_id = $sstr_name;
        $this->psstr_rs->rel_year_id = $year_name;
        $this->psstr_rs->insert_rel_psstr();

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
    // เพิ่มความสัมพันธ์

    public function ajax_add_rmst()
    {
        $year_name = $this->input->post('year_name');
        $mis_name = $this->input->post('mis_name');
        $str_name = $this->input->post('str_name');

        $this->rmst_rs->rel_mis_id = $mis_name;
        $this->rmst_rs->rel_str_id = $str_name;
        $this->rmst_rs->rel_year_id = $year_name;
        $this->rmst_rs->insert_rel_mst();

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
    // เพิ่มความสัมพันธ์ระหว่างพันธกิจกับยุทธศาสตร์

    public function ajax_add_spoi()
    {
        $year_name = $this->input->post('year_name');
        $str_name = $this->input->post('str_name');
        $poi_name = $this->input->post('poi_name');

        $this->stp_rs->rel_po_id = $poi_name;
        $this->stp_rs->rel_str_id = $str_name;
        $this->stp_rs->rel_year_id = $year_name;
        $this->stp_rs->insert_rel_strp();

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
    // เพิ่มความสัมพันธ์ระหว่างยุทธศาสตร์กับเป้าประสงค์

    public function ajax_add_ppstr()
    {
        $year_name = $this->input->post('year_name');
        $poi_name = $this->input->post('poi_name');
        $sstr_name = $this->input->post('sstr_name');

        $this->psstr_rs->rel_poi_id = $poi_name;
        $this->psstr_rs->rel_sstr_id = $sstr_name;
        $this->psstr_rs->rel_year_id = $year_name;
        $this->psstr_rs->insert_rel_psstr();

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
    // เพิ่มความสัมพันธ์ระหว่างเป้าประสงค์กับกลยุทธ์

    public function ajax_del_rel_str()
    {
        $rmst_id = $this->input->post('rel_mis_str_id');
        $this->rmst_rs->rel_mis_str_id = $rmst_id;
        $this->rmst_rs->delete_rel_mst();

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
    // ลบความสัมพันธ์ของยุทธศาสตร์

    public function ajax_del_rel_poi()
    {
        $stp_id = $this->input->post('rel_str_po_id');
        $this->stp_rs->rel_str_po_id = $stp_id;
        $this->stp_rs->delete_rel_stp();

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
    // ลบความสัมพันธ์ของเป้าประสงค์

    public function ajax_del_rel_sstr()
    {
        $psstr_id = $this->input->post('rel_po_sstr_id');
        $this->psstr_rs->rel_po_sstr_id = $psstr_id;
        $this->psstr_rs->delete_rel_psstr();

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
    // ลบความสัมพันธ์ของกลยุทธ์

    public function show_rel2()
    {
        $year_id = $this->input->post('year_name');
        $this->rmst_rs->rel_year_id = $year_id;
        $this->stp_rs->rel_year_id = $year_id;

        $mis_data = $this->rmst_rs->get_mis_member()->result();

        $n_mis = 1; //number mis
        $n_str = 1; //number str
        $n_poi = 1; //number poi
        $n_sstr = 1; //number sstr

        $all_data = array();
        if(count($mis_data) > 0){
          $str_data = $this->rmst_rs->get_str_member()->result();
          foreach ($mis_data as $row_mis) {
            $temp_mis = $n_mis++.". ".$row_mis->mis_name;
            foreach ($str_data as $row_str) {
              if($row_str->mis_id == $row_mis->mis_id){
                $temp_str = $n_str++.". ".$row_str->str_name;
                $poi_data = $this->rmst_rs->get_poi_member($row_str->str_id)->result();
                if(count($poi_data) > 0){
                  foreach ($poi_data as  $row_poi) {
                    $sstr_data = $this->rmst_rs->get_sstr_member($row_poi->poi_id)->result();
                    if(count($sstr_data) > 0){
                      $temp_poi = $n_poi++.". ".$row_poi->poi_name;
                      foreach ($sstr_data as $row_sstr) {
                        $data = array(
                          'rmst_mis'      => $temp_mis,
                          'rmst_str'      => $temp_str,
                          'rmst_point'    => $temp_poi,
                          'rmst_sstr'     => $n_sstr++.". ".$row_sstr->sstr_name,
                          'rmst_action'   => '<center><button type="button" class="'.$this->config->item("btn_del_sm_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_sstr('.$row_sstr->rel_po_sstr_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button></center>'
                          // ,'action' => 'กล($row_sstr->sstr_id)'
                        );
                        array_push($all_data,$data);
                        $temp_mis = '';
                        $temp_str = '';
                        $temp_poi = '';
                      }
                    }else {
                      $data = array(
                        'rmst_mis'      => $temp_mis,
                        'rmst_str'      => $temp_str,
                        'rmst_point'    => $n_poi++.". ".$row_poi->poi_name,
                        'rmst_sstr'     => '',
                        'rmst_action'   => '<center><button type="button" class="'.$this->config->item("btn_del_sm_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_poi('.$row_poi->rel_str_po_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button></center>'
                        // ,'action' => 'เป้า($row_poi->poi_id)'
                      );
                      array_push($all_data,$data);
                      $temp_mis = '';
                      $temp_str = '';
                    }
                  }
                  $n_sstr=1;
                  $n_poi=1;
                }else{
                  $data = array(
                    'rmst_mis'      => $temp_mis,
                    'rmst_str'      => $temp_str,
                    'rmst_point'    => '',
                    'rmst_sstr'     => '',
                    'rmst_action'   => '<center><button type="button" class="'.$this->config->item("btn_del_sm_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_str('.$row_str->rel_mis_str_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button></center>'
                    // ,'action' => 'ยุท($row_str->str_id)'
                  );
                  array_push($all_data,$data);
                  $temp_mis = '';
                }
              }
            }
            $n_str=1;
          }
        }

        echo json_encode($all_data);
    }

    public function set_time_save()
    {
        $this->output($this->config->item('admin').'/v_set_time_save');
    }
    // go to page set time save

    public function get_tsp_by_id()
    {
        $tsp_id = $this->input->post('tsp_id');
        $this->tsp_rs->tsp_id = $tsp_id;
        $result = $this->tsp_rs->get_tsp_by_id()->row_array();

        echo json_encode($result);
    }
    // ดึงข้อมูล tsp by id

    public function get_org_all()
    {
        $json = file_get_contents('http://med.buu.ac.th/scan-med/scanningPersonnel/API/api_getPerson.php');
        $rs_person = json_decode($json, TRUE);

        // echo("<pre>");
        // print_r($rs_person);
        // echo("</pre>");

        $hr_data = array();


        foreach ($rs_person['data_result'] as $rs_hr) {
            array_push($hr_data,$rs_hr['dm_title_th']);
        }
        // จัดข้อมูลใหม่เอาค่าส่วนงานที่ซ้ำกันออก

        $hr_data = array_unique($hr_data);
        // echo("<pre>");
        // print_r($hr_data);
        // echo("</pre>");
        // die;

        $opt = '<option selected disabled="disabled">เลือกหน่วยงาน/ส่วนงาน</option>';
        foreach ($hr_data as $row_hr) {

            $opt .= '<option '.' value="'.$row_hr.'">' . $row_hr. '</option>';
        }

        echo json_encode($opt);

    }
    // get org data from API

    public function get_org_by_year()
    {
        $year_id = $this->input->post('year_id');
        
        if (empty($year_id)) {
            $opt = '<option selected disabled="disabled">เลือกหน่วยงาน/ส่วนงาน</option>';
            echo json_encode($opt);
        }else{
            $this->tsp_rs->tsp_year_id = $year_id;
            $result = $this->tsp_rs->get_site_use()->result();
            
            // pre($result); die;
            
            $json = file_get_contents('http://med.buu.ac.th/scan-med/scanningPersonnel/API/api_getPerson.php');
            $rs_person = json_decode($json, TRUE);
            
            $hr_data = array();
            
            $chk_state; // 0 = no have , 1 = have
            
            foreach ($rs_person['data_result'] as $rs_hr) {
                foreach ($result as $row_rs) {
                    if ($row_rs->tsp_site_name == $rs_hr['dm_title_th']) {
                        
                        $chk_state = 1;
                        // echo("chk_state = ".$chk_state."<br>");
                    }
                    // if ($chk_state = 0) {
                        // array_push($hr_data,$rs_hr['dm_title_th']);
                        // }
                        
                        
                    } // for result
                    // echo($chk_state);
                    if ($chk_state == 0) {
                        array_push($hr_data,$rs_hr['dm_title_th']);
                    }
                    
                    $chk_state = 0;
                    
                    
                } // for rs_hr
                
                $hr_data = array_unique($hr_data);
                // จัดข้อมูลใหม่เอาค่าส่วนงานที่ซ้ำกันออก
                // pre($hr_data);die;
                
                
                $opt = '<option selected disabled="disabled">เลือกหน่วยงาน/ส่วนงาน</option>';
                foreach ($hr_data as $row_hr) {
                    
                    $opt .= '<option '.' value="'.$row_hr.'">' . $row_hr. '</option>';
                }
                
                echo json_encode($opt);
            }
            // check ว่า year_id ว่างรึป่าว
            
        }
        // แสดงหน่วยงาน opt ที่ยังไม่ได้ถูกเพิ่มของปีงบประมาณ
        
        public function get_org_by_name()
        {
        $org_name = $this->input->post('org_name');

        $json = file_get_contents('http://med.buu.ac.th/scan-med/scanningPersonnel/API/api_getPerson.php');
        $rs_person = json_decode($json, TRUE);

        $hr_data = array();

        foreach ($rs_person['data_result'] as $rs_hr) {
            array_push($hr_data,$rs_hr['dm_title_th']);
        }
        $hr_data = array_unique($hr_data);
        // จัดข้อมูลใหม่เอาค่าส่วนงานที่ซ้ำกันออก

        // echo("<pre>");
        // print_r($hr_data);
        // echo("</pre>");
        // echo($org_name);
        // die;

        $opt = '<option selected disabled="disabled">เลือกหน่วยงาน/ส่วนงาน</option>';
        foreach ($hr_data as $row_hr) {

            if ($row_hr == $org_name) {
                $opt .= '<option selected '.' value="'.$row_hr.'">' . $row_hr. '</option>';
            }

        }

        echo json_encode($opt);

    }
    // แสดงหน่วยงานตอนกด edit opt

    public function ajax_add_tsp()
    {
        $tsp_id = $this->input->post('tsp_id'); //check insert or update
        $year_id = $this->input->post('year_id');
        $org_name = $this->input->post('org_name');
        $tsp_start = $this->input->post('tsp_start');
        $tsp_end = $this->input->post('tsp_end');

        if (empty($tsp_id)) {

            // ส่วน insert
            $this->tsp_rs->tsp_year_id = $year_id;
            $this->tsp_rs->tsp_site_name = $org_name;
            $this->tsp_rs->tsp_start_date = $tsp_start;
            $this->tsp_rs->tsp_end_date = $tsp_end;
            $this->tsp_rs->insert_tsp();

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
            $this->tsp_rs->tsp_id = $tsp_id;
            $this->tsp_rs->tsp_start_date = $tsp_start;
            $this->tsp_rs->tsp_end_date = $tsp_end;
            $this->tsp_rs->update_tsp();

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
    // fn add & update project_state

    public function ajax_del_tsp()
    {
        $tsp_id = $this->input->post('tsp_id');
        $this->tsp_rs->tsp_id = $tsp_id;
        $this->tsp_rs->delete_tsp();

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
    // ลบระยะเวลาบันทึกโครงการ

    public function get_tsp_show()
    {

        $year_id = $this->input->post('year_name');
        $this->tsp_rs->tsp_year_id = $year_id;
        $result = $this->tsp_rs->get_tsp_data()->result();

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $all_data = array();
        $i=1;
        foreach ($result as $row) {
            $data = array(
                'tsp_id'       => $row->tsp_id,
                'tsp_seq'      => '<center>'.$i++.'</center>',
                'tsp_org'      => $row->tsp_site_name,
                'tsp_duration' => '<center>'.fullDateTH3($row->tsp_start_date).' - '.fullDateTH3($row->tsp_end_date).'</center>',
                'tsp_action'   => '<center>
                                    <button type="button" class="'.$this->config->item("btn_edit_color").'" data-tooltip="คลิกเพื่อแก้ไขข้อมูล" onclick="return edit_tsp('.$row->tsp_id.')"><i class="'.$this->config->item("sms_icon_edit").'" aria-hidden="true"></i></button>
                                    <button type="button" class="'.$this->config->item("btn_del_color").'" data-tooltip="คลิกเพื่อลบข้อมูล" onclick="return remove_tsp('.$row->tsp_id.')"><i class="'.$this->config->item("sms_icon_del").'" aria-hidden="true"></i></button>
                                    </center>'
            );
            array_push($all_data,$data);
        }
        echo json_encode($all_data);
    }
    // datatable ระยะเวลาบันทึกโครงการ
}
