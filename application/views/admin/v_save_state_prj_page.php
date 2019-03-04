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
        <li><a href="<?php echo site_url().$this->config->item('admin')."/Sms_state_project/" ?>">บันทึกผลการดำเนินโครงการ</a></li>
        <li class="active">โครงการ<span id="tab_prj_name"></span></li>
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
                <h3 class="box-title">บันทึกผลการดำเนินโครงการ</h3>
             <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <table class="table table-bordered" width="100%" cellspacing="0" id="prj_info_table">
                                <tr>
                                    <td width="15%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>ปีงบประมาณ</b></td>
                                    <td><span id="year_name">ปีงบประมาณ</span></td>
                                </tr>
                                <tr>
                                    <td width="15%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>ส่วนงาน</b></td>
                                    <td><span id="prj_site_name">ส่วนงาน</span></td>
                                </tr>
                                <tr>
                                    <td width="15%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>ชื่อโครงการ</b></td>
                                    <td><span id="prj_name">ชื่อโครงการ</span></td>
                                </tr>
                                <tr>
                                    <td width="15%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>รหัสโครงการ</b></td>
                                    <td><span id="prj_code">รหัสโครงการ</span></td>
                                </tr>
                                <tr>
                                    <td width="15%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>ลักษณะโครงการ</b></td>
                                    <td><span id="prj_type">ลักษณะโครงการ</span></td>
                                </tr>
                                <tr>
                                    <td width="15%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>ระยะเวลาโครงการ</b></td>
                                    <td><span id="prj_duration">ระยะเวลาโครงการ</span></td>
                                </tr>
                                <tr>
                                    <td width="15%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>งบประมาณ</b></td>
                                    <td><span id="prj_bdgt">งบประมาณ</span></td>
                                </tr>
                            </table>
                        </div>
                        <!-- ./col md 12 -->
                    </div>
                    <!-- /.col md 12 -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2">
                        <button id="btn_add_state" type="button" class=" <?php echo $this->config->item('btn_add_color'); ?>" onclick="set_add_state()" data-toggle="modal" data-target="#modal_add_state"><i class=" <?php echo $this->config->item('sms_icon_add'); ?>" aria-hidden="true"></i> บันทึกผลการดำเนินโครงการ</button>
                        </div>
                        <!-- ./col md 2 -->
                        <div class="col-md-10">
                        </div>
                        <!-- ./col md 10 -->
                    </div>
                    <!-- /.col md 12 -->
                </div>
                <!-- /.row -->
<br>

                <div class="row">
                    <div class="col-md-12">
                        <!-- ตาราง datatable  -->
                        <div class="col-md-12">
                        <div class="box box-widget">
                            <div class="box-body">
                                <table id="prj_dataTable" class="table table-bordered table-striped dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background-color:<?php echo $this->config->item('table_header'); ?>;">
                                            <th width="5%" rowspan="2">ลำดับ</th>
                                            <th width="20%" rowspan="2">สถานะ</th>
                                            <th width="15%" rowspan="2">วันที่ดำเนินการ</th>
                                            <th width="35" colspan="4">งบประมาณที่ใช้ในการดำเนินการ (บาท)</th>
                                            <!-- <th width="5%" rowspan="2">เอกสารประกอบ</th> -->
                                            <th width="15%" rowspan="2">ดำเนินการ</th>
                                        </tr>
                                        <tr style="background-color:<?php echo $this->config->item('table_header'); ?>;">
                                            <th>เงินแผ่นดิน</th>
                                            <th>เงินรายได้</th>
                                            <th>แหล่งทุนอื่น</th>
                                            <th>รวม</th>
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
                        <!-- ./col md 12 -->
                        <!-- ตาราง datatable  -->
                    </div>
                    <!-- /.col md 12 -->
                </div>
                <!-- /.row -->       

<!-- modal -->

                <div class="modal fade" id="modal_add_state" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title">บันทึกข้อมูลสถานะ</h4>
                        </div>
                        <div class="modal-body">
                            
                            <form class="form-horizontal row-border" id="frm_add_state" method="post">
                                    <input type="hidden" class="form-control" name="state_id" id="state_id" value="" disabled>
                                    <div class="form-group" id="div_state">
                                        <label class="col-md-4 control-label" >สถานะ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณาเลือกสถานะ">
                                            <select name="state_name" id="state_name" class="form-control" onchange="unlock('state_start')" validate></select>
                                        </div>
                                    </div>                                        
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_prj_time" >
                                        <label class="col-md-4 control-label">ระยะเวลาดำเนินโครงการ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12" data-tooltip="กรุณาเลือกวันเริ่มต้นโครงการ">
                                                    <input disabled type="date" class="form-control" name="state_start" id="state_start" value="" onchange="unlock('state_end')" validate>
                                                </div>
                                                <div class="col-md-12">
                                                    ถึง
                                                </div>
                                                <div class="col-md-12" data-tooltip="กรุณาเลือกวันสิ้นสุดโครงการ">
                                                    <input disabled type="date" class="form-control" name="state_end" id="state_end" value="" onchange="" validate>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_budget" >
                                        <label class="col-md-4 control-label">งบประมาณ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-md-12">
                                                    งบประมาณแผ่นดิน
                                                </div>
                                                <!-- ./col md 5 -->
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="prj_bdgt1" id="prj_bdgt1" placeholder="ใส่งบประมาณแผ่นดิน" value="" onkeyup="calculate_bdgt()">
                                                        <span class="input-group-addon">บาท</span>
                                                    </div>
                                                </div>
                                                <!-- ./col md 7 -->
                                                <div class="col-md-12">
                                                    งบประมาณเงินรายได้คณะ
                                                </div>
                                                <!-- ./col md 5 -->
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="prj_bdgt2" id="prj_bdgt2" placeholder="ใส่งบประมาณเงินรายได้คณะ" value="" onkeyup="calculate_bdgt()">
                                                        <span class="input-group-addon">บาท</span>
                                                    </div>
                                                </div>
                                                <!-- ./col md 7 -->
                                                <div class="col-md-12">
                                                    งบประมาณจากแหล่งทุนอื่น
                                                </div>
                                                <!-- ./col md 5 -->
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="prj_bdgt3" id="prj_bdgt3" placeholder="ใส่งบประมาณจากแหล่งทุนอื่น" value="" onkeyup="calculate_bdgt()" onchange="unlock('prj_bdgt3_name')">
                                                        <span class="input-group-addon">บาท</span>
                                                    </div>
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
                                            <!-- <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span> -->
                                        </label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input disabled type="text" class="form-control" name="sum_bdgt" id="sum_bdgt" placeholder="งบประมาณที่ตั้งไว้รวม" onchange="">
                                                <span class="input-group-addon">บาท</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_prj_name" >
                                        <label class="col-md-4 control-label">รายละเอียด
                                            <!-- <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span> -->
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณากรอกรายละเอียด">
                                            <textarea type="text" class="form-control" name="state_des" id="state_des" placeholder="ใส่รายละเอียดของโครงการ" value="" onchange="unlock('prj_start'); unlock('prj_end');"></textarea>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->
                                    
                                    <!-- <div class="btn-toolbar" style=" padding:5px 20px 5px 20px; border-radius: 0 0 2px 2px; margin: 0px -10px -10px -10px;">
			                            <input type="reset" id="configreset" class="btn btn btn-inverse" onclick="hide_panel('panel_add_prj')" value="<?php echo $this->config->item("txt_cancel")?>">
			                            <input type="button" id="btn_submit" class="btn-success btn pull-right" onclick="add_prj()" value="<?php echo $this->config->item("txt_save")?>">
	                                </div> -->

                                </form>
                                <!-- ./form -->


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="<?php echo $this->config->item('btn_close_modal')?> pull-left" data-dismiss="modal"><?php echo $this->config->item("txt_cancel")?></button>
                            <button type="button" class="<?php echo $this->config->item('btn_success')?>" onclick="add_state()"><?php echo $this->config->item("txt_save")?></button>
                        </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>     
<!-- modal -->

<!-- modal more info -->
                <div class="modal fade" id="modal_more_info" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title">รายละเอียดเพิ่มเติม</h4>
                        </div>
                        <div class="modal-body">
                            
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td colspan="2" class="table_topic">รายละเอียดสถานะ</td>
                                </tr>
                                <tr>
                                    <td>สถานะ</td>
                                    <td><span id="text_place1"></span></td>
                                </tr>
                                <tr>
                                    <td>วันที่ดำเนินการ</td>
                                    <td><span id="text_place2"></span></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="table_topic">งบประมาณที่ใช้</td>
                                </tr>
                                <tr>
                                    <td>งบประมาณแผ่นดิน</td>
                                    <td><span id="text_place3"></span></td>
                                </tr>
                                <tr>
                                    <td>งบประมาณคณะ</td>
                                    <td><span id="text_place4"></span></td>
                                </tr>
                                <tr>
                                    <td>งบประมาณจากแหล่งอื่น</td>
                                    <td><span id="text_place5"></span></td>
                                </tr>
                                <tr>
                                    <td>รวมงบประมาณทั้งสิ้น</td>
                                    <td><span id="text_place6"></span></td>
                                </tr>
                                <tr>
                                    <!-- <td colspan="2" class="table_topic">รายละเอียดเพิ่มเติม</td> -->
                                    <td colspan="2" class="table_topic">คำอธิบาย</td>
                                </tr>
                                <tr>
                                    <td colspan="2" ><span id="text_place7"></span></td>
                                </tr>
                                
                            </tbody>
                        </table>

                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">เอกสารแนบ</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                
                            </div>
                            <!-- /.box-body -->
                        </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="<?php echo $this->config->item('btn_close_modal')?> pull-right" data-dismiss="modal"><?php echo $this->config->item("txt_close")?></button>
                        </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>     
<!-- modal -->

            </div>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        </div>
        <!-- ./ col md 12 -->
    </div>
    <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">

$(document).ready(function () {

    set_data();
    get_table_show();
    
});
// end doc-ready

function get_table_show() {
    var prj_id = <?php echo($prj_id); ?>;
    $("#prj_dataTable").dataTable({
        // processing: true,
        // bDestroy: true,
        ajax:{
            type: "POST",
            url: "<?php echo site_url().'/admin/Sms_state_project/get_state_dtable'; ?>",
            data: {prj_id:prj_id},
            dataType : "json",
            dataSrc : function(data){
                var return_data = new Array();
                $(data).each(function(seq, data ) {
                    return_data.push({
                        "ss_seq" : data.ss_seq,
                        "ss_status" : data.ss_status,
                        "ss_duration" : data.ss_duration,
                        "ss_bdgt_land" : data.ss_bdgt_land,
                        "ss_bdgt_fcty" : data.ss_bdgt_fcty,
                        "ss_bdgt_oth" : data.ss_bdgt_oth,
                        "ss_bdgt_sum" : data.ss_bdgt_sum,
                        // "ss_file" : data.ss_file,
                        "ss_action" : data.ss_action
                    });
                });
                console.log(return_data);             
                return return_data;
            }//end dataSrc
    }, //end ajax
    "columns" :[
        {"data": "ss_seq"},
        {"data": "ss_status"},
        {"data": "ss_duration"},
        {"data": "ss_bdgt_land"},
        {"data": "ss_bdgt_fcty"},
        {"data": "ss_bdgt_oth"},
        {"data": "ss_bdgt_sum"},
        // {"data": "ss_file"},
        {"data": "ss_action"}
    ]
                    
    });
}
// get table show

function add_state() {
    var valid_state = validate('frm_add_state');

    var state_id = $("#state_id").val(); //check insert & update
    var prj_id = <?php echo($prj_id); ?>;
    var state_name = $("#state_name").val();
    var state_start = $("#state_start").val();
    var state_end = $("#state_end").val();
    var prj_bdgt1 = $("#prj_bdgt1").val();
    var prj_bdgt2 = $("#prj_bdgt2").val();
    var prj_bdgt3 = $("#prj_bdgt3").val();
    var state_des = $("#state_des").val();

    if (valid_state) {
        $.ajax({
            type: "POST",
    		url: "<?php echo site_url()."/admin/Sms_state_project/ajax_add_state/"; ?>",
    		data: {state_id:state_id, prj_id:prj_id,state_name:state_name,state_start:state_start,state_end:state_end,prj_bdgt1:prj_bdgt1,prj_bdgt2:prj_bdgt2,prj_bdgt3:prj_bdgt3,state_des:state_des},
            dataType : "json",
        	success : function(data){
        		if(data["json_alert"] === true){
        			message_show(data,"frm_add_state");
                    console.log(data);
                    // get_table_show();
        		}else{
        			message_show(data);
                    console.log(data);
        			// get_table_show();
        		}
                $("#modal_add_state").modal('hide');
        	}// End success
        });// End ajax

        return true;
    }else{
        return false;
    }

}
// ./add_prj

function edit_state(ss_id="") {
    $.ajax({
        type : "POST",
        url : "<?php echo site_url()."/admin/Sms_state_project/get_state_by_ss_id"; ?>",
        data : {ss_id:ss_id},
        dataType : "json",
        success : function(data){
            console.log(data);
            $("#text_place2").text(data['ss_duration']);
            $("#text_place3").text(data['ss_bdgt_land']);
            $("#text_place4").text(data['ss_bdgt_fcty']);
            $("#text_place5").text(data['ss_bdgt_oth']);
            $("#text_place6").text(data['ss_bdgt_sum']);
            $("#text_place7").text(data['ss_des']);
        }
    });
}
// แก้ไขข้อมูลสถานะ

function state_show() {

$.ajax({
    type : "POST",
    url : "<?php echo site_url()."/admin/Sms_state_project/get_state_show"; ?>",
    dataType : "json",
    success : function(data){
        $("#state_name").html(data);
        $("#state_name").select2({width: '100%'});
    }
});
}
// แสดงหน่วยงาน opt

function show_state_info(ss_id="") {
    $.ajax({
        type : "POST",
        url : "<?php echo site_url()."/admin/Sms_state_project/get_state_by_ss_id"; ?>",
        data : {ss_id:ss_id},
        dataType : "json",
        success : function(data){
            console.log(data);

            $("#text_place1").text(data['pst_name']);
            $("#text_place2").text(data['ss_duration']);
            $("#text_place3").text(data['ss_bdgt_land']);
            $("#text_place4").text(data['ss_bdgt_fcty']);
            $("#text_place5").text(data['ss_bdgt_oth']);
            $("#text_place6").text(data['ss_bdgt_sum']);
            $("#text_place7").text(data['ss_des']);
        }
    });
}
// modal แสดงข้อมูลเพิ่มเติม

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

function set_data() {
    var prj_id = <?php echo($prj_id); ?>;

    $.ajax({
        type : "POST",
        url : "<?php echo site_url()."/admin/Sms_project_manage/get_prj_set_data"; ?>",
        data : {prj_id:prj_id},
        dataType : "json",
        success : function(data){
            // console.log(data);
            $("#year_name").text(data['year_name']);
            $("#prj_site_name").text(data['prj_site_name']);
            $("#prj_name").text(data['prj_name']);
            $("#tab_prj_name").text(data['prj_name']);
            $("#prj_code").text(data['prj_code']);
            // $("#prj_type").text(data['prj_type']);
            if(data['prj_type']==0)  $("#prj_type").text('โครงการต่อเนื่อง');
            else  $("#prj_type").text('โครงการใหม่');
            $("#prj_duration").text(data['prj_start']+' ถึง '+data['prj_end']);
            $("#prj_bdgt").text(Number(data['prj_set_bdgt_land'])+Number(data['prj_set_bdgt_fcty'])+Number(data['prj_set_bdgt_oth'])+' บาท');
        }
    });
}
// set data

function set_add_state() {

    $('#frm_add_state').trigger("reset");
    state_show();

}
// set_add_state ตั้งค่าข้อมูลตอนกดปุ่มเพิ่มสถานะ

function message_show(message,frm_name){
    // console.log("frm_name = "+frm_name);
    if (frm_name == "" || frm_name == null) {
        swal("บันทึกข้อมูลสำเร็จ", message["json_str"], message["json_type"]);
    }else{
        document.getElementById(frm_name).reset();
        swal("บันทึกข้อมูลสำเร็จ", message["json_str"], message["json_type"]);
    }
    // set_form_ready();
    
}//message_show

</script>