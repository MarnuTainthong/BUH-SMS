<?php include(dirname(__FILE__)."/v_sms_main.php"); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard page
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#">จัดการโครงการ</a></li>
        <li class="active">เพิ่มโครงการ</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Page Content Here -->
    <div class="row">
        <div class="col-md-12">
        <div class="box box-solid <?php echo"box-".$this->config->item('panel_header_color'); ?>">
            <div class="box-header with-border">
                <i class="fa fa-home"></i>
                <h3 class="box-title">จัดการโครงการ</h3>
             <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <div class="row" id="panel_add_pst" style="display:block;">
                    <div class="col-md-12">
                        <div class="col-md-2">
                        </div>
                        <!-- /.col md 2 -->
                        <div class="col-md-8">
                            <div class="box box-solid <?php echo"box-".$this->config->item('panel_header_color'); ?>">
                                <div class="box-header">
                                    <h3 class="box-title">บันทึกข้อมูลโครงการ</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">

                                <form class="form-horizontal row-border" id="frm_save_prj" method="post">
                                    <input type="hidden" class="form-control" name="prj_id" id="prj_id" value="" disabled>
                                    <div class="form-group" id="div_org">
                                        <label class="col-md-4 control-label" >หน่วยงาน/ส่วนงาน
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณาเลือกหน่วยงาน/ส่วนงาน">
                                            <select disabled name="org_name" id="org_name" class="form-control" onchange="unlock('sstr_name')" validate></select>
                                        </div>
                                    </div>                                        
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_sstr_name">
                                        <label class="col-md-4 control-label" >กลยุทธ์
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณาเลือกกลยุทธ์">
                                            <select disabled name="sstr_name" id="sstr_name" class="form-control" onchange="unlock('mea_name')" validate></select>
                                        </div>
                                    </div>                                        
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_mea_name">
                                        <label class="col-md-4 control-label" >ตัวบ่งชี้ประกันคุณภาพ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณาเลือกตัวบ่งชี้ประกันคุณภาพ">
                                            <select disabled name="mea_name" id="mea_name" class="form-control" onchange="unlock('opt_radio_prj1'); unlock('opt_radio_prj0')" validate></select>
                                        </div>
                                    </div>                                        
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_prj_type">
                                        <label class="col-md-4 control-label" >ลักษณะโครงการ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6">
                                                <input disabled type="radio" name="opt_radio_prj" id="opt_radio_prj1" value="1"  onchange="unlock('prj_code_input')" validate> โครงการใหม่
                                                <input disabled type="radio" name="opt_radio_prj" id="opt_radio_prj0" value="0"  onchange="unlock('prj_code_input')" validate> โครงการต่อเนื่อง
                                        </div>
                                    </div>                                        
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_prj_code" >
                                        <label class="col-md-4 control-label">รหัสโครงการ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณากรอกรหัสโครงการ">
                                            <input disabled type="text" class="form-control" name="prj_code_input" id="prj_code_input" placeholder="ใส่รหัสโครงการ" value="" onchange="unlock('prj_name_input')" validate>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_prj_name" >
                                        <label class="col-md-4 control-label">ชื่อโครงการ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณากรอกชื่อโครงการ">
                                            <input disabled type="text" class="form-control" name="prj_name_input" id="prj_name_input" placeholder="ใส่ชื่อโครงการ" value="" onchange="unlock('prj_start'); unlock('prj_end');" validate>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->
                                    
                                    <div class="form-group" id="div_budget" >
                                        <label class="col-md-4 control-label">งบประมาณ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-md-5">
                                                    งบประมาณแผ่นดิน
                                                </div>
                                                <!-- ./col md 5 -->
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="prj_bdgt1" id="prj_bdgt1" placeholder="ใส่งบประมาณแผ่นดิน" value="" onkeyup="calculate_bdgt()">
                                                        <span class="input-group-addon">บาท</span>
                                                    </div>
                                                </div>
                                                <!-- ./col md 7 -->
                                                <div class="col-md-5">
                                                    งบประมาณเงินรายได้คณะ
                                                </div>
                                                <!-- ./col md 5 -->
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="prj_bdgt2" id="prj_bdgt2" placeholder="ใส่งบประมาณเงินรายได้คณะ" value="" onkeyup="calculate_bdgt()">
                                                        <span class="input-group-addon">บาท</span>
                                                    </div>
                                                </div>
                                                <!-- ./col md 7 -->
                                                <div class="col-md-5">
                                                    งบประมาณจากแหล่งทุนอื่น
                                                </div>
                                                <!-- ./col md 5 -->
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="prj_bdgt3" id="prj_bdgt3" placeholder="ใส่งบประมาณจากแหล่งทุนอื่น" value="" onkeyup="calculate_bdgt()" onchange="unlock('prj_bdgt3_name')">
                                                        <span class="input-group-addon">บาท</span>
                                                    </div>
                                                </div>
                                                <!-- ./col md 7 -->
                                                <div class="col-md-5">
                                                    <b>ชื่อแหล่งทุนอื่น</b>
                                                </div>
                                                <!-- ./col md 5 -->
                                                <div class="col-md-7">
                                                    <input disabled type="text" class="form-control" name="prj_bdgt3_name" id="prj_bdgt3_name" placeholder="ใส่ชื่อแหล่งทุนอื่น" value="" onchange="">
                                                </div>
                                                <!-- ./col md 7 -->
                                            </div>
                                            <!-- ./col md 6 -->
                                        </div>
                                        <!-- ./ row -->
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_sum_bdgt" >
                                        <label class="col-md-4 control-label">งบประมาณที่ตั้งไว้รวม
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input disabled type="text" class="form-control" name="sum_bdgt" id="sum_bdgt" placeholder="งบประมาณที่ตั้งไว้รวม" onchange="">
                                                <span class="input-group-addon">บาท</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_prj_time" >
                                        <label class="col-md-4 control-label">ระยะเวลาดำเนินโครงการ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-5" data-tooltip="กรุณาเลือกวันเริ่มต้นโครงการ">
                                                    <input disabled type="date" class="form-control" name="prj_start" id="prj_start" value="" onchange="" validate>
                                                </div>
                                                <div class="col-md-2">
                                                    <center>ถึง</center>
                                                </div>
                                                <div class="col-md-5" data-tooltip="กรุณาเลือกวันสิ้นสุดโครงการ">
                                                    <input disabled type="date" class="form-control" name="prj_end" id="prj_end" value="" onchange="" validate>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="btn-toolbar" style=" padding:5px 20px 5px 20px; border-radius: 0 0 2px 2px; margin: 0px -10px -10px -10px;">
			                            <input type="reset" id="configreset" class="btn btn btn-inverse" onclick="hide_panel('panel_add_prj')" value="<?php echo $this->config->item("txt_cancel")?>">
			                            <input type="button" id="btn_submit" class="btn-success btn pull-right" onclick="add_prj()" value="<?php echo $this->config->item("txt_save")?>">
	                                </div>

                                </form>
                                <!-- ./form -->

                                </div>
                                <!-- /.box body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col md 8 -->
                    </div>
                    <!-- /.col md 12 -->
                </div>
                <!-- /.row -->
<br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2">
                        </div>
                        <!-- ./col md 2 -->
                        <div class="col-md-8">

                            <div class="nav-tabs-custom">

                                <ul class="nav nav-tabs" >
                                    <li><a href="#prj_resp" data-toggle="tab" onclick="show_panel('div_datatable_resp'); chk_tab_active(1);">ผู้รับผิดชอบ</a></li>
                                    <li><a href="#prj_file" data-toggle="tab" onclick="chk_tab_active(2)">เอกสารแนบ</a></li>
                                    <li><a href="#prj_kpi" data-toggle="tab" onclick="chk_tab_active(3);">ตัวชี้วัดโครงการ</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane " id="prj_resp">
                                        
                                    <form class="form-horizontal row-border" id="frm_save_resp" method="post">
                                    <div class="form-group" id="div_prj_resp">
                                        <label class="col-md-4 control-label" >ชื่อผู้รับผิดชอบ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณากรอกชื่อผู้รับผิดชอบโครงการ">
                                            <input disabled type="text" class="form-control" name="sum_bdgt" id="sum_bdgt" placeholder="ใส่ชื่อผู้รับผิดชอบ" onchange="" validate>
                                        </div>
                                    </div>                                        
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_position">
                                        <label class="col-md-4 control-label" >ตำแหน่งในโครงการ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณาเลือกตำแหน่ง">
                                            <select disabled name="pos_name" id="pos_name" class="form-control" onchange="" validate></select>
                                        </div>

                                    </div>                        
                                    <!-- ./div form group -->

                                    <div class="btn-toolbar" style=" padding:5px 20px 5px 20px; border-radius: 0 0 2px 2px; margin: 0px -10px -10px -10px;">
                                        <input type="reset" id="configreset" class="btn btn btn-inverse" onclick="" value="<?php echo $this->config->item("txt_cancel")?>">
                                        <input type="button" id="btn_submit" class="btn-success btn pull-right" onclick="" value="<?php echo $this->config->item("txt_save")?>">
                                    </div>
                                    <!-- ./btn toolbar -->

                                    </form>
                                    <!-- ./form -->
                                    </div>
                                    <!-- /.tab-pane -->

                                    <div class="tab-pane" id="prj_file">
                                        <form class="form-horizontal row-border" id="frm_save_file" method="post">
                                        <div class="form-group" id="div_prj_file_name">
                                            <label class="col-md-4 control-label" >ชื่อเอกสาร
                                                <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                            </label>
                                            <div class="col-md-6" data-tooltip="กรุณากรอกชื่อเอกสาร">
                                                <input disabled type="text" class="form-control" name="file_name_input" id="file_name_input" placeholder="ใส่ชื่อชื่อเอกสาร" onchange="" validate>
                                            </div>
                                        </div>                                        
                                        <!-- ./div form group -->

                                        <div class="form-group" id="div_poi_name">
                                            <label class="col-md-4 control-label" >ไฟล์เอกสาร
                                                <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="file" name="prj_file_up" id="prj_file_up" validate>
                                            </div>
                                        </div>                                        
                                        <!-- ./div form group -->

                                        <div class="btn-toolbar" style=" padding:5px 20px 5px 20px; border-radius: 0 0 2px 2px; margin: 0px -10px -10px -10px;">
                                            <input type="reset" id="configreset" class="btn btn btn-inverse" onclick="" value="<?php echo $this->config->item("txt_cancel")?>">
                                            <input type="button" id="btn_submit" class="btn-success btn pull-right" onclick="" value="<?php echo $this->config->item("txt_save")?>">
                                        </div>
                                        <!-- ./btn toolbar -->

                                        </form>
                                        <!-- ./form -->
                                    </div>
                                    <!-- /.tab-pane -->

                                    <div class="tab-pane" id="prj_kpi">
                                        <form class="form-horizontal row-border" id="frm_save_psstr" method="post">

                                            <div class="form-group" id="div_prj_kpi_name">
                                                <label class="col-md-4 control-label" >ชื่อตัวชี้วัดโครงการ
                                                    <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                                </label>
                                                <div class="col-md-6" data-tooltip="กรุณากรอกชื่อตัวชี้วัดโครงการ">
                                                    <input disabled type="text" class="form-control" name="file_name_input" id="file_name_input" placeholder="ใส่ชื่อตัวชี้วัดโครงการ" onchange="" validate>
                                                </div>
                                            </div>                                        
                                            <!-- ./div form group -->

                                            <div class="form-group" id="div_prj_kpi_unit">
                                                <label class="col-md-4 control-label" >หน่วยนับ
                                                    <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                                </label>
                                                <div class="col-md-6" data-tooltip="กรุณากรอกหน่วยนับ">
                                                    <input disabled type="text" class="form-control" name="prj_kpi_unit" id="prj_kpi_unit" placeholder="ใส่หน่วยนับตัวชี้วัด" onchange="" validate>
                                                </div>
                                            </div>                                        
                                            <!-- ./div form group -->

                                            <div class="form-group" id="div_prj_kpi_goal">
                                                <label class="col-md-4 control-label" >ค่าเป้าหมาย
                                                    <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                                </label>
                                                <div class="col-md-6" data-tooltip="กรุณากรอกค่าเป้าหมาย">
                                                    <input disabled type="text" class="form-control" name="prj_kpi_goal" id="prj_kpi_goal" placeholder="ใส่ค่าเป้าหมาย" onchange="" validate>
                                                </div>
                                            </div>                                        
                                            <!-- ./div form group -->

                                            <div class="btn-toolbar" style=" padding:5px 20px 5px 20px; border-radius: 0 0 2px 2px; margin: 0px -10px -10px -10px;">
                                                <input type="reset" id="configreset" class="btn btn btn-inverse" onclick="" value="<?php echo $this->config->item("txt_cancel")?>">
                                                <input type="button" id="btn_submit" class="btn-success btn pull-right" onclick="" value="<?php echo $this->config->item("txt_save")?>">
                                            </div>
                                            <!-- ./btn toolbar -->

                                        </form>
                                        <!-- ./form -->
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane active" id="tab_index">
                                        <b>Please select menu.</b>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                                </div>
                                <!-- nav-tabs-custom -->

                        </div>
                        <!-- ./col md 8 -->
                        
                    </div>
                    <!-- ./col md 12 -->
                </div>
                <!-- ./row -->

                <div class="row" id="div_datatable_resp" style="display:none;">
                    <div class="col-md-12">
                        <!-- ตาราง datatable  -->
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8">
                        <div class="box box-widget">
                            <div class="box-body">
                                <table id="datatable_resp" class="table table-bordered table-striped dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background-color:<?php echo $this->config->item('table_header'); ?>;">
                                            <th width="15%">ลำดับ</th>
                                            <th>ผู้รับผิดชอบ</th>
                                            <th>ตำแหน่ง</th>
                                            <th width="15%">ดำเนินการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <!-- table -->
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                        </div>
                        <!-- ./col md 10 -->
                        <!-- ตาราง datatable  -->
                        
                    </div>
                    <!-- /.col md 12 -->
                </div>
                <!-- /.row -->

                <div class="row" id="div_datatable_file" style="display:none;">
                    <div class="col-md-12">
                        <!-- ตาราง datatable  -->
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8">
                        <div class="box box-widget">
                            <div class="box-body">
                                <table id="datatable_file" class="table table-bordered table-striped dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background-color:<?php echo $this->config->item('table_header'); ?>;">
                                            <th width="15%">ลำดับ</th>
                                            <th>ชื่อเอกสาร</th>
                                            <th width="15%">ดำเนินการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <!-- table -->
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                        </div>
                        <!-- ./col md 10 -->
                        <!-- ตาราง datatable  -->
                        
                    </div>
                    <!-- /.col md 12 -->
                </div>
                <!-- /.row -->

                <div class="row" id="div_datatable_kpi" style="display:none;">
                    <div class="col-md-12">
                        <!-- ตาราง datatable  -->
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8">
                        <div class="box box-widget">
                            <div class="box-body">
                                <table id="datatable_kpi" class="table table-bordered table-striped dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background-color:<?php echo $this->config->item('table_header'); ?>;">
                                            <th width="15%">ลำดับ</th>
                                            <th>ตัวชี้วัด</th>
                                            <th width="15%">หน่วยนับ</th>
                                            <th width="15%">ค่าเป้าหมาย</th>
                                            <th width="15%">ดำเนินการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <!-- table -->
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                        </div>
                        <!-- ./col md 10 -->
                        <!-- ตาราง datatable  -->
                        
                    </div>
                    <!-- /.col md 12 -->
                </div>
                <!-- /.row -->
            
            </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        </div>
        <!-- ./ col -->
    </div>
    <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">

$(document).ready(function () {

    var year_id = <?php echo($year_id); ?>;

    get_year_show();
    set_form_ready();
    
});
// end doc-ready

function set_form_ready() {
    org_show();
    sstr_show();
    mea_show();
    unlock('org_name'); 
}

function calculate_bdgt() {
    var bdgt1 = $("#prj_bdgt1").val()
    var bdgt2 = $("#prj_bdgt2").val()
    var bdgt3 = $("#prj_bdgt3").val()

    if (isNaN(bdgt1) || bdgt1 === "") {
        bdgt1 = 0;
    }
    if (isNaN(bdgt2) || bdgt2 === "") {
        bdgt2 = 0;
    }
    if (isNaN(bdgt3) || bdgt3 === "") {
        bdgt3 = 0;
    }

    $("#sum_bdgt").val(parseInt(bdgt1)+parseInt(bdgt2)+parseInt(bdgt3));

}
// คำนวณงบประมาณรวม

function chk_tab_active(num) {
    
    if (num == 1) {
        hide_panel('div_datatable_file');
        hide_panel('div_datatable_kpi');
        show_panel('div_datatable_resp');
    }
    if(num == 2){
        hide_panel('div_datatable_resp');
        hide_panel('div_datatable_kpi');
        show_panel('div_datatable_file');
    }
    if(num == 3){
        hide_panel('div_datatable_resp');
        hide_panel('div_datatable_file');
        show_panel('div_datatable_kpi');
    }
}
// check ว่า tab ไหน active

function get_year_show() {
    $.ajax({
		type : "POST",
		url : "<?php echo site_url()."/admin/Sms_base_data/set_rel_year"; ?>",
		dataType : "json",
		success : function(data){
			$("#year_name").html(data);
			$("#year_name").select2({width: '100%'});
		}
	});
}
// แสดงปีงบประมาณ opt

function org_show() {

$.ajax({
    type : "POST",
    url : "<?php echo site_url()."/admin/Sms_base_data/get_org_all"; ?>",
    dataType : "json",
    success : function(data){
        $("#org_name").html(data);
        $("#org_name").select2({width: '100%'});
    }
});
}
// แสดงหน่วยงาน opt

function sstr_show() {
    var year_id = <?php echo($year_id); ?>;

    $.ajax({
    type : "POST",
    url : "<?php echo site_url()."/admin/Sms_project_manage/get_sstr_by_year"; ?>",
    data: {year_id:year_id},
    dataType : "json",
    success : function(data){
        $("#sstr_name").html(data);
        $("#sstr_name").select2({width: '100%'});
    }
});
}
// แสดงกลยุทธ์ opt

function mea_show() {
    var year_id = <?php echo($year_id); ?>;

    $.ajax({
    type : "POST",
    url : "<?php echo site_url()."/admin/Sms_project_manage/get_mea_by_year"; ?>",
    data: {year_id:year_id},
    dataType : "json",
    success : function(data){
        $("#mea_name").html(data);
        $("#mea_name").select2({width: '100%'});
    }
});
}
// แสดงตัวบ่งชี้ opt

function add_prj() {
    var valid_state = validate('frm_save_prj');

    var prj_id = $("#prj_id").val(); //check inser & update
    var year_id = <?php echo($year_id); ?>;
    var org_name = $("#org_name").val();
    var sstr_name = $("#sstr_name").val();
    var mea_name = $("#mea_name").val();
    var prj_type = $("input[name=opt_radio_prj]:checked").val()
    var prj_code_input = $("#prj_code_input").val();
    var prj_name_input = $("#prj_name_input").val();
    var prj_bdgt1 = $("#prj_bdgt1").val();
    var prj_bdgt2 = $("#prj_bdgt2").val();
    var prj_bdgt3 = $("#prj_bdgt3").val();
    var prj_bdgt3_name = $("#prj_bdgt3_name").val();
    var prj_start = $("#prj_start").val();
    var prj_end = $("#prj_end").val();

    if (valid_state) {
        $.ajax({
            type: "POST",
    		url: "<?php echo site_url()."/admin/Sms_project_manage/ajax_add_prj/"; ?>",
    		data: {prj_id:prj_id, year_id:year_id, org_name:org_name, sstr_name:sstr_name, mea_name:mea_name, prj_type:prj_type, prj_code_input:prj_code_input, 
            prj_name_input:prj_name_input, prj_bdgt1:prj_bdgt1, prj_bdgt2:prj_bdgt2, prj_bdgt3:prj_bdgt3, prj_bdgt3_name:prj_bdgt3_name, prj_start:prj_start, prj_end:prj_end},
            dataType : "json",
        	success : function(data){
        		if(data["json_alert"] === true){
        			message_show(data,"frm_save_rmst");
                    console.log(data);
                    // get_table_show();
                    // hide_panel('panel_add_pst')
        		}else{
        			message_show(data);
                    console.log(data);
        			// get_table_show();
        		}
        	}// End success
        });// End ajax

        return true;
    }else{
        return false;
    }

}
// ./add_prj

// function get_table_show() {
    
    //     var year_name = $("#year_name").val();
    //     console.log("year_name = "+year_name); 
    
    //     $("#rel_daTable").dataTable({
//         ordering: false,
//         processing: true,
//         bDestroy: true,
//         lengthChange: false,
//         paging: false,
//         ajax:{
//             type: "POST",
//             url: "<?php echo site_url().'/admin/Sms_base_data/show_rel2'; ?>",
//             data: {year_name:year_name},
// 		    dataType : "json",
//             dataSrc : function(data){
//                 var return_data = new Array();
//                 $(data).each(function(seq, data ) {
// 				    return_data.push({
//                     //    "rmst_seq" : data.rmst_seq,
//                        "rmst_mis" : data.rmst_mis,
//                        "rmst_str" : data.rmst_str,
//                        "rmst_point" : data.rmst_point,
//                        "rmst_sstr" : data.rmst_sstr,
//                        "rmst_action" : data.rmst_action
//                    });
//                 });
//                 console.log(return_data);             
//                 return return_data;
//             }//end dataSrc
//     }, //end ajax
//     "columns" :[
//         // {"data": "rmst_seq"},
//         {"data": "rmst_mis"},
//         {"data": "rmst_str"},
//         {"data": "rmst_point"},
//         {"data": "rmst_sstr"},
//         {"data": "rmst_action"}
//     ]
              
//     });

// }
// ./get_table_show



// function add_rel() {
//     var valid_state = validate("frm_save_rel");    

//     var year_name = $("#year_name").val();
//     var mis_name = $("#mis_name").val();
//     var str_name = $("#str_name").val();
//     var poi_name = $("#poi_name").val();
//     var sstr_name = $("#sstr_name").val();

//     console.log("year_name = "+year_name);
//     console.log("mis_name = "+mis_name);
//     console.log("str_name = "+str_name);
//     console.log("poi_name = "+poi_name);
//     console.log("sstr_name = "+sstr_name);

//     if (valid_state) {
//         $.ajax({
//             type: "POST",
//     		url: "<?php echo site_url()."/admin/Sms_base_data/ajax_add_rel/"; ?>",
//     		data: {year_name:year_name ,mis_name:mis_name ,str_name:str_name ,poi_name:poi_name ,sstr_name:sstr_name},
//             dataType : "json",
//         	success : function(data){
//         		if(data["json_alert"] === true){
//         			message_show(data);
//                     console.log(data);
//                     // get_table_show();
//                     // hide_panel('panel_add_pst')
//         		}else{
//         			message_show(data);
//                     console.log(data);
//         			// get_table_show();
//         		}
//         	}// End success
//         });// End ajax

//         return true;
//     }else{
//         return false;
//     }

// }
//insert & update

// function remove_str(rel_mis_str_id) {

// swal({
//     title: "คุณต้องการลบใช่หรือไม่ ?",
//     text: "หากลบแล้วจะไม่สามารถกู้คืนได้อีก !",
//     type: "warning",
//     allowOutsideClick: !0,
//     showCancelButton: true,
//     confirmButtonColor: "#dd4b39",
//     confirmButtonText: "ยืนยัน",
//     closeOnConfirm: true ,
//     cancelButtonText: 'ยกเลิก'
// },
// function(){
//     $.ajax({
//         type : "POST",
//         url : "<?php echo site_url().'/admin/Sms_base_data/ajax_del_rel_str/'; ?>",
//         data : {rel_mis_str_id:rel_mis_str_id},
//         dataType : "json",
//         success : function(data){
//             get_table_show();
//             message_show(data);
     
//         }
//     });//end ajax

// });
// }
// ./remove_str

function message_show(message){
    // console.log("frm_name = "+frm_name);
    // document.getElementById(frm_name).reset();
    set_form_ready()
    get_table_show();
    swal("บันทึกข้อมูลสำเร็จ", message["json_str"], message["json_type"]);
}//message_show

</script>