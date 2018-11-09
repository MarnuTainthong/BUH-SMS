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
        <li class="active">แก้ไขโครงการ</li>
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
                                                <div class="col-md-12">
                                                    <b>ชื่อแหล่งทุนอื่น</b>
                                                </div>
                                                <!-- ./col md 5 -->
                                                <div class="col-md-12">
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
                                                <div class="col-md-12" data-tooltip="กรุณาเลือกวันเริ่มต้นโครงการ">
                                                    <input disabled type="date" class="form-control" name="prj_start" id="prj_start" value="" onchange="" validate>
                                                </div>
                                                <div class="col-md-12">
                                                    ถึง
                                                </div>
                                                <div class="col-md-12" data-tooltip="กรุณาเลือกวันสิ้นสุดโครงการ">
                                                    <input disabled type="date" class="form-control" name="prj_end" id="prj_end" value="" onchange="" validate>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="btn-toolbar" style=" padding:5px 20px 5px 20px; border-radius: 0 0 2px 2px; margin: 0px -10px -10px -10px;">
			                            <input type="button" id="configreset" class="btn btn btn-inverse" onclick="set_form_ready()" value="<?php echo $this->config->item("txt_cancel")?>">
			                            <input type="button" id="btn_submit" class="btn-success btn pull-right" onclick="update_prj()" value="<?php echo $this->config->item("txt_save")?>">
	                                </div>

                                </form>
                                <!-- ./form -->

                                </div>
                                <!-- /.box body -->
                                <div class="overlay">
                                    <i class="fa fa-refresh fa-spin"></i>
                                </div>
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col md 8 -->
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
    
});
// end doc-ready

function set_form_ready() {
    org_show();
    sstr_show();
    mea_show();
    get_prj_data();
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

function org_show() {
    var prj_id = <?php echo($prj_id); ?>;
    $.ajax({
        type : "POST",
        url : "<?php echo site_url()."/admin/Sms_project_manage/get_org_select"; ?>",
        data : {prj_id:prj_id},
        dataType : "json",
        success : function(data){
            unlock('org_name');
            $("#org_name").html(data);
            $("#org_name").select2({width: '100%'});
            $(".overlay").remove();
        }
    });
}
// แสดงหน่วยงาน opt

function sstr_show() {

    var prj_id = <?php echo($prj_id); ?>;
    var year_id = <?php echo($prj_year_id); ?>;

    $.ajax({
        type : "POST",
        url : "<?php echo site_url()."/admin/Sms_project_manage/get_sstr_by_prj"; ?>",
        data: {prj_id:prj_id,year_id:year_id},
        dataType : "json",
        success : function(data){
            unlock('sstr_name');
            $("#sstr_name").html(data);
            $("#sstr_name").select2({width: '100%'});
        }
    });

}
// แสดงกลยุทธ์ opt

function mea_show() {

    var prj_id = <?php echo($prj_id); ?>;
    var year_id = <?php echo($prj_year_id); ?>;

    $.ajax({
        type : "POST",
        url : "<?php echo site_url()."/admin/Sms_project_manage/get_mea_by_prj"; ?>",
        data: {prj_id:prj_id,year_id:year_id},
        dataType : "json",
        success : function(data){
            unlock('mea_name');
            $("#mea_name").html(data);
            $("#mea_name").select2({width: '100%'});
        }
    });

}
// แสดงตัวบ่งชี้ opt

function get_prj_data() {

    var prj_id = <?php echo($prj_id); ?>;
    $.ajax({
        type : "POST",
        url : "<?php echo site_url()."/admin/Sms_project_manage/get_prj_data_by_id"; ?>",
        data: {prj_id:prj_id},
        dataType : "json",
        success : function(data){
            $("input[type=radio]").attr('disabled', false);
            // 0=ต่อเนื่อง , 1=ใหม่
            if (data["prj_type"] == 0) {
                $("#opt_radio_prj0").attr('checked', true);
            }else if(data["prj_type"] == 1){
                $("#opt_radio_prj1").attr('checked', true);
            }
            unlock("prj_code_input");
            $("#prj_code_input").val(data["prj_code"]);
            unlock("prj_name_input");
            $("#prj_name_input").val(data["prj_name"]);
            unlock("prj_name_input");
            $("#prj_bdgt1").val(data["prj_set_bdgt_land"]);
            $("#prj_bdgt2").val(data["prj_set_bdgt_fcty"]);
            $("#prj_bdgt3").val(data["prj_set_bdgt_oth"]);
            $("#prj_bdgt3_name").val(data["prj_bdgt_oth_name"]);
            $("#sum_bdgt").val(parseInt($("#prj_bdgt1").val())+parseInt($("#prj_bdgt2").val())+parseInt($("#prj_bdgt3").val()));
            unlock("prj_start");
            $("#prj_start").val(data["prj_start"]);
            unlock("prj_end");
            $("#prj_end").val(data["prj_end"]);
            $("#prj_id").val(data["prj_id"]);


        }
    });

}
// ดึงข้อมูล prj

function update_prj() {

    var valid_state = validate('frm_save_prj');

    var prj_id = $("#prj_id").val(); //check inser & update
    var year_id = <?php echo($prj_year_id); ?>;
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
                    message_show(data,"frm_save_prj");
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
// ./update_prj

function message_show(message){
    // console.log("frm_name = "+frm_name);
    document.getElementById('frm_save_prj').reset();
    set_form_ready();
    swal("บันทึกข้อมูลสำเร็จ", message["json_str"], message["json_type"]);
}//message_show

</script>