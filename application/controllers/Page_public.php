<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Non_Login_Controller.php");

class Page_public extends Non_Login_Controller {

	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->model('m_year','y_rs');
		$this->load->model('m_vision','vis_rs');
		$this->load->model('m_rel_mst','rmst_rs');
		$this->load->model('m_rel_str_poi','stp_rs');
		$this->load->model('m_rel_poi_sstr','psstr_rs');
    }

	public function index()
	{
		$this->home();
		
	}

	public function home()
	{
		// $this->output('public_home');
		$this->chk_year_select();
	}
	// redirect to public_page

	public function chk_year_select()
	{
		$day = date("d");
		$month = date("m");
		$year = date("Y")+543;
		
		if($day >= "1" && $month >= "10"){
			$now_year = $year+1;
		}else{
			$now_year = $year;
		}

		$chk_state=0;
		$year_select=0;
		$rs_year = $this->y_rs->get_year_have_vis()->result();

		foreach ($rs_year as $rs_year) {
			if ($rs_year->year_name == strval($now_year)) {
				$chk_state=1;
				$year_select = $rs_year->year_id;
			}
		}

		if($chk_state == 1){
			$data["year_select"] = $year_select;
		}

		$this->output('public_home',$data);

	}

	public function get_vis_select()
	{
        $year_id = $this->input->post('year_id');
		$this->vis_rs->vis_year_id = $year_id;
		$result = $this->vis_rs->get_vis_select_year()->row_array();
		
		echo json_encode($result);
	}
	// ดึงข้อมูลวิสัยทัศน์
	
	public function get_mis_select()
	{
		$year_id = $this->input->post('year_id');
		$this->rmst_rs->rel_year_id = $year_id;
		$result = $this->rmst_rs->get_mis_use()->result();
		
		echo json_encode($result);
	}
	// ดึงข้อมูลพันธกิจ
	
	public function get_str_select()
	{
		$year_id = $this->input->post('year_id');
		$this->rmst_rs->str_year_id = $year_id;
		$result = $this->rmst_rs->get_str_use()->result();
		
		echo json_encode($result);
	}
	// ดึงข้อมูลยุทธศาสตร์
	
	public function get_poi_select()
	{
		$year_id = $this->input->post('year_id');
		$this->stp_rs->rel_year_id = $year_id;
		$result = $this->stp_rs->get_poi_use()->result();
		
		echo json_encode($result);
	}
	// ดึงข้อมูลเป้าประสงค์
	
	public function create_vpt_sstr()
	{
		$year_id = $this->input->post('year_id');

		$this->psstr_rs->rel_year_id = $year_id;
		$result_vpt = $this->psstr_rs->get_vpt_use()->result();
		
		$this->psstr_rs->rel_year_id = $year_id;
		$result_sstr = $this->psstr_rs->get_sstr_use()->result();

		// pre($result_vpt);
		// pre($result_sstr);
		// die;

		$row = '';
		$count_vpt = 1;
		$count_sstr = 1;

		// echo('$count_vpt = '.$count_vpt);
		// echo('$count_sstr = '.$count_sstr);
		//  die;

		foreach ($result_vpt as $vpt_rs) {
			$row .= '<div id="vpt_sstr">';
			$row .= '	<div class="row">';
			$row .= '		<div class="col-md-2" id="topic">';
			$row .= ' 			<span id="sstr_title">'.$vpt_rs->vpt_name.'</span>';
			$row .= '		</div>';
			$row .= ' 		<div class="col-md-10">';
			
			foreach ($result_sstr as $sstr_rs) {
				if ($vpt_rs->vpt_id == $sstr_rs->sstr_viewp_id) {
					if ($count_sstr == 1 || $count_sstr%6 == 0) {
						$row .=	'<div class="row">';
						$row .=	'	<div class="col-md-2">';
						$row .=	'		<div class="box box-solid">';
						$row .=	'			<div class="box-body" id="div_sstr_box'.$count_vpt.'">';
						$row .=	'				<center><span id="sstr_text">'.$sstr_rs->sstr_name.'</span></center>';
						$row .=	'			</div>';
						$row .=	'		</div>';
						$row .=	'	</div>';
					}else {
						$row .=	'	<div class="col-md-2">';
						$row .=	'		<div class="box box-solid">';
						$row .=	'			<div class="box-body" id="div_sstr_box'.$count_vpt.'">';
						$row .=	'				<center><span id="sstr_text">'.$sstr_rs->sstr_name.'</span></center>';
						$row .=	'			</div>';
						$row .=	'		</div>';
						$row .=	'	</div>';
					}
	
					if ($count_sstr%6 == 0 || $count_sstr == count($result_sstr)) {
						$row +=	'</div>';
					}
	
					$count_sstr++;
				}
				
			}
			// sstr_rs
			$count_sstr = 1;

			$row .= '		</div>';
			$row .= '	</div>';
			$row .= '</div>';

			$count_vpt++;
		}
		// vpt_rs
		echo json_encode($row);

	}
	
}


// <div id="vpt_sstr">
// 	<div class="row">
// 		<div class="col-md-2">
// 			<span>มุมมองกลยุทธ์</span>
// 		</div>
// 		<div class="col-md-10">
// 		</div>
// 	</div>
// </div>
