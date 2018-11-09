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
        <li><a href="<?php echo site_url().$this->config->item('admin')."/Sms_project_manage/project_manage" ?>">จัดการโครงการ</a></li>
        <li class="active">ตั้งค่าโครงการ</li>
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

            <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <table class="table table-bordered" width="100%" cellspacing="0" id="mis_info_table">
                                <tr>
                                    <td width="15%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>ปีงบประมาณ</b></td>
                                    <td><span id="year_name">ชื่อปีงบประมาณ</span></td>
                                </tr>
                                <tr>
                                    <td width="15%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>ชื่อโครงการ</b></td>
                                    <td><span id="prj_name">ชื่อโครงการ</span></td>
                                </tr>
                            </table>
                        </div>
                        <!-- ./col md 12 -->
                    </div>
                    <!-- /.col md 12 -->
                </div>
                <!-- /.row -->

                <div class="row" id="panel_add_pst" style="display:block;">
                    <div class="col-md-12">
                        <div class="col-md-2">
                        </div>
                        <!-- /.col md 2 -->
                        <div class="col-md-8">
                            <div class="box box-solid <?php echo"box-".$this->config->item('panel_header_color'); ?>">
                                <div class="box-header">
                                    <h3 class="box-title">ตั้งค่าโครงการ</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">

                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs" >
                                        <li><a href="#prj_resp" data-toggle="tab" onclick="chk_tab_active(1);">ผู้รับผิดชอบ</a></li>
                                        <li><a href="#prj_file" data-toggle="tab" onclick="chk_tab_active(2);">เอกสารแนบ</a></li>
                                        <li><a href="#prj_ind" data-toggle="tab" onclick="chk_tab_active(3);">ตัวชี้วัดโครงการ</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane " id="prj_resp">
                                            
                                        <form class="form-horizontal row-border" id="frm_save_resp" method="post">
                                        <input type="hidden" class="form-control" name="resp_id" id="resp_id" value="" disabled>
                                        <div class="form-group" id="div_prj_resp">
                                            <label class="col-md-4 control-label" >ชื่อผู้รับผิดชอบ
                                                <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                            </label>
                                            <div class="col-md-6" data-tooltip="กรุณากรอกชื่อผู้รับผิดชอบโครงการ">
                                                <input disabled type="text" class="form-control" name="resp_name" id="resp_name" placeholder="ใส่ชื่อผู้รับผิดชอบ" onchange="unlock('pos_name')" validate>
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
                                            <input type="reset" id="configreset" class="btn btn btn-inverse" onclick="set_form_ready()" value="<?php echo $this->config->item("txt_cancel")?>">
                                            <input type="button" id="btn_submit" class="btn-success btn pull-right" onclick="add_resp()" value="<?php echo $this->config->item("txt_save")?>">
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

                                        <div class="tab-pane" id="prj_ind">
                                            <form class="form-horizontal row-border" id="frm_save_ind" method="post">
                                            <input type="hidden" class="form-control" name="ind_id" id="ind_id" value="" disabled>
                                                <div class="form-group" id="div_ind_kpi_name">
                                                    <label class="col-md-4 control-label" >ชื่อตัวชี้วัดโครงการ
                                                        <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                                    </label>
                                                    <div class="col-md-6" data-tooltip="กรุณากรอกชื่อตัวชี้วัดโครงการ">
                                                        <input disabled type="text" class="form-control" name="kpi_name_input" id="kpi_name_input" placeholder="ใส่ชื่อตัวชี้วัดโครงการ" onchange="unlock('prj_ind_unit')" validate>
                                                    </div>
                                                </div>                                        
                                                <!-- ./div form group -->

                                                <div class="form-group" id="div_prj_ind_unit">
                                                    <label class="col-md-4 control-label" >หน่วยนับ
                                                        <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                                    </label>
                                                    <div class="col-md-6" data-tooltip="กรุณากรอกหน่วยนับ">
                                                        <input disabled type="text" class="form-control" name="prj_ind_unit" id="prj_ind_unit" placeholder="ใส่หน่วยนับตัวชี้วัด" onchange="unlock('prj_ind_opt')" validate>
                                                    </div>
                                                </div>                                        
                                                <!-- ./div form group -->

                                                <div class="form-group" id="div_opt">
                                                    <label class="col-md-4 control-label" >คำนวณผล
                                                        <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                                    </label>
                                                    <div class="col-md-6" data-tooltip="กรุณาเลือกการคำนวณ">
                                                        <select disabled name="prj_ind_opt" id="prj_ind_opt" class="form-control" onchange="unlock('prj_ind_goal')" validate></select>
                                                    </div>
                                                </div>                                        
                                                <!-- ./div form group -->

                                                <div class="form-group" id="div_prj_ind_goal">
                                                    <label class="col-md-4 control-label" >ค่าเป้าหมาย
                                                        <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                                    </label>
                                                    <div class="col-md-6" data-tooltip="กรุณากรอกค่าเป้าหมาย">
                                                        <input disabled type="text" class="form-control" name="prj_ind_goal" id="prj_ind_goal" placeholder="ใส่ค่าเป้าหมาย" onchange="" validate>
                                                    </div>
                                                </div>                                        
                                                <!-- ./div form group -->

                                                <div class="btn-toolbar" style=" padding:5px 20px 5px 20px; border-radius: 0 0 2px 2px; margin: 0px -10px -10px -10px;">
                                                    <input type="reset" id="configreset" class="btn btn btn-inverse" onclick="set_form_ready()" value="<?php echo $this->config->item("txt_cancel")?>">
                                                    <input type="button" id="btn_submit" class="btn-success btn pull-right" onclick="add_prj_ind()" value="<?php echo $this->config->item("txt_save")?>">
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
                <div class="row" id="div_datatable_resp" style="display:none;">
                    <div class="col-md-12">
                        <!-- ตาราง datatable  -->
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-10">
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
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-10">
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

                <div class="row" id="div_datatable_ind" style="display:none;">
                    <div class="col-md-12">
                        <!-- ตาราง datatable  -->
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-10">
                        <div class="box box-widget">
                            <div class="box-body">
                                <table id="datatable_ind" class="table table-bordered table-striped dataTable" width="100%" cellspacing="0">
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


    set_form_ready();
    set_data()
    
});
// end doc-ready

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

function set_form_ready() {
    $("#resp_id").val("");
    pos_show();
    $("#ind_id").val("");
    get_opt_show();
}

function set_data() {
    var prj_id = <?php echo($prj_id); ?>;

    $.ajax({
        type : "POST",
        url : "<?php echo site_url()."/admin/Sms_project_manage/get_prj_set_data"; ?>",
        data : {prj_id:prj_id},
        dataType : "json",
        success : function(data){
            $("#year_name").text(data['year_name']);
            $("#prj_name").text(data['prj_name']);
        }
    });
}

function chk_tab_active(num) {
    
    if (num == 1) {
        hide_panel('div_datatable_file');
        hide_panel('div_datatable_ind');
        show_panel('div_datatable_resp');
        pos_show();
        show_resp_data();
    }
    if(num == 2){
        hide_panel('div_datatable_resp');
        hide_panel('div_datatable_ind');
        show_panel('div_datatable_file');
        unlock('file_name_input');
    }
    if(num == 3){
        hide_panel('div_datatable_resp');
        hide_panel('div_datatable_file');
        show_panel('div_datatable_ind');
        unlock('kpi_name_input');
        get_opt_show();
        show_prj_ind_data();
    }
}
// check ว่า tab ไหน active

function pos_show() {
    $.ajax({
        type : "POST",
        url : "<?php echo site_url()."/admin/Sms_project_manage/get_prj_pos"; ?>",
        dataType : "json",
        success : function(data){
            unlock('resp_name');
            $("#pos_name").html(data);
            $("#pos_name").select2({width: '100%'});
        }
    });
}
// แสดงตำแหน่งของโครงการ opt

function show_resp_data() {

    var prj_id = <?php echo($prj_id); ?>;

    $("#datatable_resp").dataTable({
        processing: true,
        bDestroy: true,
        ajax:{
            type: "POST",
            url: "<?php echo site_url().'/admin/Sms_project_manage/get_resp_show'; ?>",
            data: {prj_id:prj_id},
            dataType : "json",
            dataSrc : function(data){
                var return_data = new Array();
                $(data).each(function(seq, data ) {
                    return_data.push({
                        "resp_seq" : data.resp_seq,
                        "resp_name" : data.resp_name,
                        "resp_pos" : data.resp_pos,
                        "resp_action" : data.resp_action
                    });
                });
                        console.log(return_data);             
                        return return_data;
            }//end dataSrc
            }, //end ajax
            "columns" :[
                {"data": "resp_seq"},
                {"data": "resp_name"},
                {"data": "resp_pos"},
                {"data": "resp_action"}
            ]
                    
            });
}
// datatable show resp

function add_resp() {

    var valid_state = validate('frm_save_resp');

    var resp_id = $("#resp_id").val();
    var resp_name = $("#resp_name").val();
    var pos_id = $("#pos_name").val();
    var prj_id = <?php echo($prj_id); ?>;

    if (valid_state) {
        $.ajax({
            type : "POST",
            url : "<?php echo site_url()."/admin/Sms_project_manage/ajax_add_prj_resp"; ?>",
            data: {resp_id:resp_id,resp_name:resp_name,pos_id:pos_id,prj_id:prj_id},
            dataType : "json",
            success : function(data){
                message_show(data,'frm_save_resp');
                pos_show();
                show_resp_data();
            }
        });
        return true;
    }else{
        return false;
    }
}
// add resp

function edit_resp(resp_id) {
    $.ajax({
        type: "POST",
		url: "<?php echo site_url()."/admin/Sms_project_manage/get_resp_by_id/"; ?>",
		data: {resp_id:resp_id},
		dataType : "json",
		success : function(data){
            $("#resp_id").val(data['resp_id']);
            $("#resp_name").val(data['resp_name']);
            get_pos_select(data['resp_id']);
		}
    
    });
}
// edit resp

function remove_resp(resp_id) {
    swal({
    title: "คุณต้องการลบใช่หรือไม่ ?",
    text: "หากลบแล้วจะไม่สามารถกู้คืนได้อีก !",
    type: "warning",
    allowOutsideClick: !0,
    showCancelButton: true,
    confirmButtonColor: "#dd4b39",
    confirmButtonText: "ยืนยัน",
    closeOnConfirm: true ,
    cancelButtonText: 'ยกเลิก'
},
function(){
    $.ajax({
        type : "POST",
        url : "<?php echo site_url().'/admin/Sms_project_manage/ajax_del_resp/'; ?>",
        data : {resp_id:resp_id},
        dataType : "json",
        success : function(data){
            message_show(data,'frm_save_resp');
            show_resp_data();
        }
    });//end ajax

});
}
// delete_resp

function get_pos_select(resp_id) {
    $.ajax({
        type: "POST",
		url: "<?php echo site_url()."/admin/Sms_project_manage/get_pos_by_resp/"; ?>",
		data: {resp_id:resp_id},
		dataType : "json",
		success : function(data){
            unlock('pos_name');
            $("#pos_name").html(data);
            $("#pos_name").select2({width: '100%'});
		}
    
    });
}
// แสดงตำแหน่งของในโครงการ by resp_id

function show_prj_ind_data() {
    var prj_id = <?php echo($prj_id); ?>;

    $("#datatable_ind").dataTable({
        processing: true,
        bDestroy: true,
        ajax:{
            type: "POST",
            url: "<?php echo site_url().'/admin/Sms_project_manage/get_prj_ind_show'; ?>",
            data: {prj_id:prj_id},
            dataType : "json",
            dataSrc : function(data){
                var return_data = new Array();
                $(data).each(function(seq, data ) {
                    return_data.push({
                        "prj_ind_seq" : data.prj_ind_seq,
                        "prj_ind_name" : data.prj_ind_name,
                        "prj_ind_unit" : data.prj_ind_unit,
                        "prj_ind_goal" : data.prj_ind_goal,
                        "prj_ind_action" : data.prj_ind_action
                    });
                });
                        console.log(return_data);             
                        return return_data;
            }//end dataSrc
            }, //end ajax
            "columns" :[
                {"data": "prj_ind_seq"},
                {"data": "prj_ind_name"},
                {"data": "prj_ind_unit"},
                {"data": "prj_ind_goal"},
                {"data": "prj_ind_action"}
            ]
                    
            });
}
// datatable prj ind

function add_prj_ind() {

var valid_state = validate('frm_save_ind');

var ind_id = $("#ind_id").val();  //check insert or delete
var prj_id = <?php echo($prj_id); ?>;
var ind_name = $("#kpi_name_input").val();
var ind_unit = $("#prj_ind_unit").val();
var opt_id = $("#prj_ind_opt").val();
var ind_goal = $("#prj_ind_goal").val();

if (valid_state) {
    $.ajax({
        type : "POST",
        url : "<?php echo site_url()."/admin/Sms_project_manage/ajax_add_prj_ind"; ?>",
        data: {ind_id:ind_id,prj_id:prj_id,ind_name:ind_name,ind_unit:ind_unit,opt_id:opt_id,ind_goal:ind_goal},
        dataType : "json",
        success : function(data){
            message_show(data,'frm_save_ind');
            show_prj_ind_data();
            
        }
    });
    return true;
}else{
    return false;
}
}
// add ind

function edit_prj_ind(prj_ind_id) {
    $.ajax({
        type: "POST",
		url: "<?php echo site_url()."/admin/Sms_project_manage/get_prj_ind_by_id/"; ?>",
		data: {prj_ind_id:prj_ind_id},
		dataType : "json",
		success : function(data){
            $("#ind_id").val(data["prj_ind_id"]);
            $("#kpi_name_input").val(data["prj_ind_name"]);
            $("#prj_ind_unit").val(data["prj_ind_unit"]);
            $("#prj_ind_goal").val(data["prj_ind_target"]);
            get_opt_select(data["prj_ind_id"]);
            unlock("kpi_name_input");
            unlock("prj_ind_unit");
            unlock("prj_ind_opt");
            unlock("prj_ind_goal");
		}
    });
}

function remove_prj_ind(prj_ind_id) {
    swal({
        title: "คุณต้องการลบใช่หรือไม่ ?",
        text: "หากลบแล้วจะไม่สามารถกู้คืนได้อีก !",
        type: "warning",
        allowOutsideClick: !0,
        showCancelButton: true,
        confirmButtonColor: "#dd4b39",
        confirmButtonText: "ยืนยัน",
        closeOnConfirm: true ,
        cancelButtonText: 'ยกเลิก'
    },
    function(){
        $.ajax({
            type : "POST",
            url : "<?php echo site_url().'/admin/Sms_project_manage/ajax_del_prj_ind/'; ?>",
            data : {prj_ind_id:prj_ind_id},
            dataType : "json",
            success : function(data){
                message_show(data);
                show_prj_ind_data();
            }
        });//end ajax

    });
}
// remove prj_ind

function get_opt_show() {
    $.ajax({
		type : "POST",
		url : "<?php echo site_url()."/admin/Sms_base_data/get_opt_ind"; ?>",
		dataType : "json",
		success : function(data){
			$("#prj_ind_opt").html(data);
			$("#prj_ind_opt").select2({width: '100%'});
		}
	});
}
// แสดงตัวดำเนินการตัวชี้วัด

function get_opt_select(prj_ind_id) {
    $.ajax({
		type : "POST",
		url : "<?php echo site_url()."/admin/Sms_project_manage/get_opt_ind_by_id"; ?>",
        data : {prj_ind_id:prj_ind_id},
		dataType : "json",
		success : function(data){
			$("#prj_ind_opt").html(data);
			$("#prj_ind_opt").select2({width: '100%'});
		}
	});
}
// แสดงตัวดำเนินการตัวชี้วัด opt ตอนกด edit


function message_show(message,frm_name){
    // console.log("frm_name = "+frm_name);
    if (frm_name == "" || frm_name == null) {
        swal("บันทึกข้อมูลสำเร็จ", message["json_str"], message["json_type"]);
    }else{
        document.getElementById(frm_name).reset();
        swal("บันทึกข้อมูลสำเร็จ", message["json_str"], message["json_type"]);
    }
    set_form_ready();
    
}//message_show

</script>