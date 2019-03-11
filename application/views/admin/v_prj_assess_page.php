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
        <li><a href="<?php echo site_url("admin/Sms_assessment") ?>">บันทึกผลการประเมินโครงการ</a></li>
        <li class="active"><span id="breadcrumb-lastTxt">ชื่อโครงการ</span></li>
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
                <h3 class="box-title">บันทึกผลการประเมินโครงการ</h3>
             <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <table class="table table-bordered" width="100%" cellspacing="0" id="sstr_info_table">
                                <tr>
                                    <td width="20" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>ปีงบประมาณ</b></td>
                                    <td><span id="year_name">ชื่อปีงบประมาณ</span></td>
                                </tr>
                                <tr>
                                    <td width="20%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>ชื่อโครงการ</b></td>
                                    <td><span id="prj_name">ชื่อโครงการ+รหัส</span></td>
                                </tr>
                                <tr>
                                    <td width="20%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>ชื่อหน่วยงาน</b></td>
                                    <td><span id="orh_name">ชื่อหน่วยงาน</span></td>
                                </tr>
                                <tr>
                                    <td width="20%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>ชื่อกลยุทธ์</b></td>
                                    <td><span id="sstr_name">ชื่อกลยุทธ์</span></td>
                                </tr>
                                <tr>
                                    <td width="20%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>ลักษณะโครงการ</b></td>
                                    <td><span id="prj_type">ลักษณะโครงการ</span></td>
                                </tr>
                                <tr>
                                    <td width="20%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>งบประมาณที่ตั้งไว้รวม</b></td>
                                    <td><span id="bdgt_est">งบประมาณที่ตั้งไว้รวม</span></td>
                                </tr>
                                <tr>
                                    <td width="20%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>งบประมาณที่ใช้ทั้งสิ้น</b></td>
                                    <td><span id="bdgt_act">งบประมาณที่ใช้ทั้งสิ้น</span></td>
                                </tr>
                            </table>
                        </div>
                        <!-- ./col md 12 -->
                    </div>
                    <!-- /.col md 12 -->
                </div>
                <!-- /.row -->

                <!-- <div class="row" id="panel_prj_assess" style="display:block;"> -->
                <div class="row" id="panel_prj_assess" style="display:none;">
                    <div class="col-md-12">
                        <div class="col-md-2">
                        </div>
                        <!-- /.col md 2 -->
                        <div class="col-md-8">
                            <div class="box box-solid <?php echo"box-".$this->config->item('panel_header_color'); ?>">
                                <div class="box-header">
                                    <h3 class="box-title">บันทึกข้อมูลตัวชี้วัดโครงการ</h3>
                                </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <form class="form-horizontal row-border" id="frm_save_prj_assess" method="post">
                                    <input type="hidden" class="form-control" name="rs_id" id="rs_id" value="" disabled>
                                    <input type="hidden" class="form-control" name="prj_ind_id" id="prj_ind_id" value="" disabled>
                                    <div class="form-group" id="div_ind_name">
                                        <label class="col-md-4 control-label" >ชื่อตัวชี้วัด
                                        </label>
                                        <div class="col-md-6">
                                            <input disabled type="text" class="form-control" name="ind_name" id="ind_name" onchange="" value="" >
                                        </div>
                                    </div>                                        
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_ind_name" >
                                        <label class="col-md-4 control-label">หน่วยนับ
                                        </label>
                                        <div class="col-md-6">
                                            <input disabled type="text" class="form-control" name="ind_unt_input" id="ind_unt_input" onchange="" value="" >
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_ind_target" >
                                        <label class="col-md-4 control-label">ค่าเป้าหมาย
                                        </label>
                                        <div class="col-md-6">
                                            <input disabled type="text" class="form-control" name="ind_target" id="ind_target"  value="" >
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_ind_score" >
                                        <label class="col-md-4 control-label">ผลการประเมิน
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณากรอกผลการประเมิน">
                                            <input type="text" class="form-control" name="ind_score" id="ind_score"  value="" validate>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_ind_result" >
                                        <label class="col-md-4 control-label">ยืนยันผลการประเมิน
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6">
                                                <div class="col-md-5">
                                                    <input type="radio" name="ind_result" id="ind_result1" value="1"  onchange="" validate> &nbsp;
                                                    <span class="<?php echo($this->config->item("lb-success"))?> lb-radio">บรรลุผล</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="radio" name="ind_result" id="ind_result0" value="0"  onchange="" validate> &nbsp;
                                                    <span class="<?php echo($this->config->item("lb-danger"))?> lb-radio">ไม่บรรลุผล</span>
                                                </div> 

                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="btn-toolbar" style=" padding:5px 20px 5px 20px; border-radius: 0 0 2px 2px; margin: 0px -10px -10px -10px;">
			                            <input type="reset" id="configreset" class="btn btn btn-inverse" onclick="hide_panel('panel_prj_assess'); set_form_ready();" value="<?php echo $this->config->item("txt_cancel")?>">
			                            <input type="button" id="btn_submit" class="btn-success btn pull-right" onclick="assess_prj()" value="<?php echo $this->config->item("txt_save")?>">
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

                <div class="row">
                    <div class="col-md-12">
                        <!-- ตาราง datatable  -->
                        <div class="col-md-12">
                        <div class="box box-widget">
                            <div class="box-body">
                                <table id="sstr_ind_daTable" class="table table-bordered table-striped dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background-color:<?php echo $this->config->item('table_header'); ?>;">
                                            <th width="5%" >ลำดับ</th>
                                            <th width="30%">ตัวชี้วัดโครงการ</th>
                                            <th width="10%">หน่วยนับ</th>
                                            <th width="10%">ค่าเป้าหมาย</th>
                                            <th width="15%">สถานะการบันทึกผล</th>
                                            <th width="15%">สถานะการประเมินผล</th>
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
                        <!-- ./col md 12 -->
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
    var prj_id = "<?php echo $prj_id ?>"; //set val

    set_data(prj_id);
    get_table_show(prj_id);

});
// end doc-ready

function set_form_ready() {
}

function set_data(prj_id="") {
    var txt_money_unit = "<?php echo($this->config->item("txt_money_unit")); ?>";
    $.ajax({
        type: "POST",
		url: "<?php echo site_url()."/admin/Sms_assessment/get_prj_data/"; ?>",
		data: {prj_id:prj_id},
		dataType : "json",
		success : function(data){
            console.log(data);
            $("#breadcrumb-lastTxt").text(data["prj_name"]);
            $("#year_name").text(data["year_name"]);
            $("#prj_name").text(data["prj_name"]+" ("+data["prj_code"]+")");
            $("#orh_name").text(data["prj_site_name"]);
            $("#sstr_name").text(data["sstr_name"]);
            $("#prj_type").text(data["prj_type"]);
            $("#bdgt_est").text(data["bdgt_set"]+txt_money_unit);
            $("#bdgt_act").text(data["bdgt_act"]+txt_money_unit);
		}
    });
}
//replace text from sstr id

function get_table_show(prj_id="") {
    
    $("#sstr_ind_daTable").dataTable({
        processing: true,
        bDestroy: true,
        ajax:{
            type: "POST",
            url: "<?php echo site_url().'/admin/Sms_assessment/get_prj_ind'; ?>",
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
                        "prj_ind_state1" : data.prj_ind_state1,
                        "prj_ind_state2" : data.prj_ind_state2,
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
                {"data": "prj_ind_state1"},
                {"data": "prj_ind_state2"},
                {"data": "prj_ind_action"}
            ]
                    
            });

}
// ./get_table_show

function show_panel_save_result (prj_ind_id="") {
    hide_panel('div_ind_result');
    show_panel('panel_prj_assess');
    unlock('ind_score');
    $.ajax({
        type: "POST",
		url: "<?php echo site_url()."/admin/Sms_assessment/get_ind_data/"; ?>",
		data: {prj_ind_id:prj_ind_id},
		dataType : "json",
		success : function(data){
            console.log(data);
            $("#rs_id").val(data.rs_id);
            $("#prj_ind_id").val(data.prj_ind_id);
            $("#ind_name").val(data.prj_ind_name);
            $("#ind_unt_input").val(data.prj_ind_unit);
            $("#ind_target").val(data.opt_name+" ("+data.opt_symbol+") "+data.prj_ind_target);
            $("#ind_score").val(data.rs_score);
		}
    });
}
// ตอนกดปุ่มบันทึกผลแสดง modal ให้กรอกคะแนน

function show_panel_assessment (prj_ind_id="") {
    show_panel('div_ind_result');
    show_panel('panel_prj_assess');
    lock('ind_score');
    $.ajax({
        type: "POST",
		url: "<?php echo site_url()."/admin/Sms_assessment/get_ind_data/"; ?>",
		data: {prj_ind_id:prj_ind_id},
		dataType : "json",
		success : function(data){
            console.log(data);
            $("#rs_id").val(data.rs_id);
            $("#prj_ind_id").val(data.prj_ind_id);
            $("#ind_name").val(data.prj_ind_name);
            $("#ind_unt_input").val(data.prj_ind_unit);
            $("#ind_target").val(data.opt_name+" ("+data.opt_symbol+") "+data.prj_ind_target);
            $("#ind_score").val(data.rs_score);
            // 0=ไม่ผ่าน , 1=ผ่าน
            if (data.rs_pass == 0) {
                $("#ind_result0").attr('checked', true);
            }else if(data.rs_pass == 1){
                $("#ind_result1").attr('checked', true);
            }else{
                $("#ind_result0").attr('checked', false);
                $("#ind_result1").attr('checked', false);
            }
		}
    });
}

function assess_prj() {
     
    var rs_id = $("#rs_id").val(); // id ผลลัพธ์
    var prj_ind_id = $("#prj_ind_id").val(); // id ตัวชี้วัด
    var rs_ind_score = $("#ind_score").val(); // คะแนนน
    var rs_ind_assess = $("input[name=ind_result]:checked").val()
    // console.log($("#ind_score").prop("disabled"));

    if ($("#ind_score").prop("disabled")) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url()."/admin/Sms_assessment/ajax_add_rs/"; ?>",
            data: {rs_id:rs_id,rs_ind_assess:rs_ind_assess},
            dataType : "json",
            success : function(data){
                if(data["json_alert"] === true){
                    message_show(data);
                    console.log(data);
                }else{
                    message_show(data);
                    console.log(data);
                }
            }
        });
        show_panel_assessment(prj_ind_id);
    }else{
        $.ajax({
            type: "POST",
            url: "<?php echo site_url()."/admin/Sms_assessment/ajax_add_score/"; ?>",
            data: {rs_id:rs_id,prj_ind_id:prj_ind_id,rs_ind_score:rs_ind_score},
            dataType : "json",
            success : function(data){
                if(data["json_alert"] === true){
                    message_show(data);
                    console.log(data);
                }else{
                    message_show(data);
                    console.log(data);
                }
            }
        });
        show_panel_save_result(prj_ind_id);
    }

}
// แสดงส่วนประเมิน

function message_show(message){
    // document.getElementById("frm_save_prj_assess").reset();
    get_table_show(<?php echo $prj_id ?>);
    swal("บันทึกข้อมูลสำเร็จ", message["json_str"], message["json_type"]);
}//message_show

</script>