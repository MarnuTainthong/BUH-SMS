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
        <li><a href="#">ข้อมูลพื้นฐาน</a></li>
        <li><a href="<?php echo site_url("admin/Sms_base_data/strategy") ?>">ยุทธศาสตร์</a></li>
        <li class="active">ตัวชี้วัดยุทธศาสตร์</li>
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
                <h3 class="box-title">ตัวชี้วัดยุทธศาสตร์</h3>
             <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <table class="table table-bordered" width="100%" cellspacing="0" id="str_info_table">
                                <tr>
                                    <td width="15%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>ปีงบประมาณ</b></td>
                                    <td><span id="year_name">ชื่อปีงบประมาณ</span></td>
                                </tr>
                                <tr>
                                    <td width="15%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>ชื่อยุทธศาสตร์</b></td>
                                    <td><span id="str_name">ชื่อยุทธศาสตร์</span></td>
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
                        <button id="btn_add_str_ind" type="button" class=" <?php echo $this->config->item('btn_add_color'); ?>" onclick="add_btn(<?php echo($str_id); ?>)"><i class=" <?php echo $this->config->item('sms_icon_add'); ?>" aria-hidden="true"></i> เพิ่มตัวชี้วัด</button>
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
                <div class="row" id="panel_add_str_ind" style="display:none;">
                    <div class="col-md-12">
                        <div class="col-md-2">
                        </div>
                        <!-- /.col md 2 -->
                        <div class="col-md-8">
                            <div class="box box-solid <?php echo"box-".$this->config->item('panel_header_color'); ?>">
                                <div class="box-header">
                                    <h3 class="box-title">บันทึกข้อมูลตัวชี้วัดยุทธศาสตร์</h3>
                                </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <form class="form-horizontal row-border" id="frm_save_str_ind" method="post">
                                    <!-- <input type="hidden" class="form-control" name="year_id" id="year_id" value="" disabled> -->
                                    <input type="hidden" class="form-control" name="str_ind_id" id="str_ind_id" value="" disabled>
                                    <div class="form-group" id="div_ind_name">
                                        <label class="col-md-4 control-label" >ชื่อตัวชี้วัด
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณาเลือกตัวชี้วัด">
                                            <select name="ind_name" id="ind_name" class="form-control" onchange="unlock('str_ind_unt_input')" validate></select>
                                        </div>
                                    </div>                                        
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_str_ind_name" >
                                        <label class="col-md-4 control-label">หน่วยนับ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณากรอกหน่วยนับ">
                                            <input disabled type="text" class="form-control" name="str_ind_unt_input" id="str_ind_unt_input" onchange="unlock('ind_opt')" value="" validate>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_ind_opt">
                                        <label class="col-md-4 control-label" >คำนวณผล
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณาเลือกการคำนวณ">
                                            <select disabled name="ind_opt" id="ind_opt" class="form-control" onchange="unlock('str_ind_target')" validate></select>
                                        </div>
                                    </div>                                        
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_str_ind_target" >
                                        <label class="col-md-4 control-label">ค่าเป้าหมาย
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณากรอกค่าเป้าหมาย">
                                            <input disabled type="text" class="form-control" name="str_ind_target" id="str_ind_target"  value="" validate>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="btn-toolbar" style=" padding:5px 20px 5px 20px; border-radius: 0 0 2px 2px; margin: 0px -10px -10px -10px;">
			                            <input type="reset" id="configreset" class="btn btn btn-inverse" onclick="ToggleTable('panel_add_str_ind'); set_form_ready();" value="<?php echo $this->config->item("txt_cancel")?>">
			                            <input type="button" id="btn_submit" class="btn-success btn pull-right" onclick="add_str_ind(<?php echo $str_id ?>)" value="<?php echo $this->config->item("txt_save")?>">
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
                                <table id="str_ind_daTable" class="table table-bordered table-striped dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background-color:<?php echo $this->config->item('table_header'); ?>;">
                                            <th width="5%" >ลำดับ</th>
                                            <th width="45%">ตัวชี้วัดยุทธศาสตร์</th>
                                            <th width="10%">หน่วยนับ</th>
                                            <th width="10%">ค่าเป้าหมาย</th>
                                            <th width="10%">ดำเนินการ</th>
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
    var str_id = "<?php echo $str_id ?>"; //set val

    get_table_show(str_id);
    set_data(str_id);
    
});
// end doc-ready

function set_form_ready() {
    $("#str_ind_id").val("");
}

function add_btn(str_id) {


    $("#str_ind_unt_input").prop('disabled', true);
    $("#str_ind_target").prop('disabled', true);
    $("#ind_opt").prop('disabled', true);
    ToggleTable('panel_add_str_ind');
    show_ind(str_id);
    show_operate();

}

function get_table_show(str_id) {
    
    $("#str_ind_daTable").dataTable({
        processing: true,
        bDestroy: true,
        ajax:{
            type: "POST",
            url: "<?php echo site_url().'/admin/Sms_base_data/get_ind_str'; ?>",
            data: {str_id:str_id},
            dataSrc : function(data){
                var return_data = new Array();
                $(data).each(function(seq, data ) {
				    return_data.push({
                       "str_ind_seq" : data.str_ind_seq,
                       "str_ind_name" : data.str_ind_name,
                       "str_ind_unit" : data.str_ind_unit,
                       "str_ind_goal" : data.str_ind_goal,
                       "str_ind_action" : data.str_ind_action
                   });
                });
                console.log(return_data);             
                return return_data;
            }//end dataSrc
    }, //end ajax
    "columns" :[
        {"data": "str_ind_seq"},
        {"data": "str_ind_name"},
        {"data": "str_ind_unit"},
        {"data": "str_ind_goal"},
        {"data": "str_ind_action"}
    ],
	"fnRowCallback": function(nRow, aData, iDisplayIndex) {
		nRow.setAttribute("id","tr_"+aData.str_id);
		nRow.setAttribute("class","tr_table");
	}
              
    });

}
// ./get_table_show

function set_data(str_id) {
    $.ajax({
        type: "POST",
		url: "<?php echo site_url()."/admin/Sms_base_data/get_str_by_id/"; ?>",
		data: {str_id:str_id},
		dataType : "json",
		success : function(data){

            console.log(data["year_name"]);
            console.log(data["str_name"]);
            
            $("#year_name").text(data["year_name"]);
            $("#str_name").text(data["str_name"]);

		}
    
    });
}
//replace text from str id

function show_ind(str_id) {
    $.ajax({
		type : "POST",
		url : "<?php echo site_url()."/admin/Sms_base_data/get_ind_by_str_id"; ?>",
        data : {str_id:str_id},
		dataType : "json",
		success : function(data){
			$("#ind_name").html(data);
			$("#ind_name").select2({width: '100%'});
		}
	});
}

function show_operate() {
    $.ajax({
		type : "POST",
		url : "<?php echo site_url()."/admin/Sms_base_data/get_opt_ind"; ?>",
		dataType : "json",
		success : function(data){
			$("#ind_opt").html(data);
			$("#ind_opt").select2({width: '100%'});
		}
	});
}

function edit_str_ind(str_ind_id) {
    $("#panel_add_str_ind").css("display","block");
    
    $.ajax({
        type: "POST",
		url: "<?php echo site_url()."/admin/Sms_base_data/get_str_ind_by_id/"; ?>",
		data: {str_ind_id:str_ind_id},
		dataType : "json",
		success : function(data){
            select_ind_edit(data["str_ind_ind_id"]);
            select_opt_edit(data["str_ind_opt_id"]);
            $("#str_ind_id").val(data["str_ind_id"]);
            $("#str_ind_unt_input").val(data["str_ind_unt"]);
            $("#str_ind_target").val(data["str_ind_goal"]);
            $("#str_ind_unt_input").prop('disabled', false);
            $("#str_ind_target").prop('disabled', false);
            $("#ind_opt").prop('disabled', false);
		}
    });
}
// ./edit_str_ind

function select_ind_edit(str_ind_ind_id='') {
    $.ajax({
		type : "POST",
		url : "<?php echo site_url()."/admin/Sms_base_data/get_ind_str_select"; ?>",
		data: {str_ind_ind_id: str_ind_ind_id},
		dataType : "json",
		success : function(data){
			$("#ind_name").html(data);
			$("#ind_name").select2({width: '100%'});
		}
	});
}
//แสดงชื่อตัวชี้วัด opt

function select_opt_edit(str_ind_opt_id='') {
    $.ajax({
		type : "POST",
		url : "<?php echo site_url()."/admin/Sms_base_data/get_opt_str_select"; ?>",
		data: {str_ind_opt_id: str_ind_opt_id},
		dataType : "json",
		success : function(data){
			$("#ind_opt").html(data);
			$("#ind_opt").select2({width: '100%'});
		}
	});
}
//แสดงตัวดำเนินการ opt ตอนด edit

function add_str_ind(str_id='') {

    var valid_state = validate("frm_save_str_ind");

    // set val
    var str_ind_id = $("#str_ind_id").val(); //for check insert or update
    var ind_id = $("#ind_name").val()
    var unt_input = $("#str_ind_unt_input").val()
    var opt_id = $("#ind_opt").val()
    var goal_input = $("#str_ind_target").val()

    // console.log("str_ind_id = "+str_ind_id);
    // console.log("ind_id = "+ind_id);
    // console.log("unt_input = "+unt_input);
    // console.log("opt_id = "+opt_id);
    // console.log("goal_input = "+goal_input);

    if (valid_state) {
        $.ajax({
            type: "POST",
    		url: "<?php echo site_url()."/admin/Sms_base_data/ajax_add_str_ind/"; ?>",
    		data: {str_id:str_id,str_ind_id:str_ind_id, ind_id:ind_id,unt_input:unt_input,opt_id:opt_id,goal_input:goal_input},
            dataType : "json",
        	success : function(data){
        		if(data["json_alert"] === true){
        			message_show(data);
                    console.log(data);
                    get_table_show(str_id);

                    show_ind(str_id);
                    show_operate();
                    // year_show();
        		}else{
        			message_show(data);
                    console.log(data);
        			get_table_show(str_id);
        		}
        	}// End success
        });// End ajax

        return true;
    }else{
        return false;
    }
}

function remove_str_ind(str_ind_id='',str_ind_str_id='') {
    console.log("str_ind_id = "+str_ind_id);
    console.log("str_ind_str_id = "+str_ind_str_id);

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
        url : "<?php echo site_url().'/admin/Sms_base_data/ajax_del_str_ind/'; ?>",
        data : {str_ind_id:str_ind_id},
        dataType : "json",
        success : function(data){
            message_show(data);
        }
    });//end ajax
    get_table_show(str_ind_str_id);

});
}

function message_show(message){
    document.getElementById("frm_save_str_ind").reset();
    // get_table_show();
    swal("บันทึกข้อมูลสำเร็จ", message["json_str"], message["json_type"]);
}//message_show

</script>