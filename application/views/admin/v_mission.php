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
        <li class="active">พันธกิจ</li>
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
                <h3 class="box-title">ข้อมูลพื้นฐานพันธกิจ</h3>
             <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2">
                        <button id="btn_add_mis" type="button" class=" <?php echo $this->config->item('btn_add_color'); ?>" onclick="ToggleTable('panel_add_mis'); year_show();"><i class=" <?php echo $this->config->item('sms_icon_add'); ?>" aria-hidden="true"></i> เพิ่มพันธกิจ</button>
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
                <div class="row" id="panel_add_mis" style="display:none;">
                    <div class="col-md-12">
                        <div class="col-md-2">
                        </div>
                        <!-- /.col md 2 -->
                        <div class="col-md-8">
                            <div class="box box-solid <?php echo"box-".$this->config->item('panel_header_color'); ?>">
                                <div class="box-header">
                                    <h3 class="box-title">บันทึกข้อมูลพันธกิจ</h3>
                                </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <form class="form-horizontal row-border" id="frm_save_mis" method="post">
                                    <!-- <input type="hidden" class="form-control" name="year_id" id="year_id" value="" disabled> -->
                                    <input type="hidden" class="form-control" name="mis_id" id="mis_id" value="" disabled>
                                    <div class="form-group" id="div_year_name">
                                        <label class="col-md-4 control-label" >ปีงบประมาณ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณาเลือกปีงบประมาณ">
                                            <select name="year_name" id="year_name" class="form-control" onchange="unlock('mis_input')" validate></select>
                                        </div>
                                    </div>                                        
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_mis_name" >
                                        <label class="col-md-4 control-label">ชื่อพันธกิจ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณากรอกชื่อพันธกิจ">
                                            <input disabled type="text" class="form-control" name="mis_input" id="mis_input" placeholder="ใส่ชื่อพันธกิจ" value="" validate>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="btn-toolbar" style=" padding:5px 20px 5px 20px; border-radius: 0 0 2px 2px; margin: 0px -10px -10px -10px;">
			                            <input type="reset" id="configreset" class="btn btn btn-inverse" onclick="ToggleTable('panel_add_mis'); set_form_ready();" value="<?php echo $this->config->item("txt_cancel")?>">
			                            <input type="button" id="btn_submit" class="btn-success btn pull-right" onclick="add_mission()" value="<?php echo $this->config->item("txt_save")?>">
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
                        <!-- ตาราง datatable  -->
                        <div class="col-md-12">
                        <div class="box box-widget">
                            <div class="box-body">
                                <table id="mis_daTable" class="table table-bordered table-striped dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background-color:<?php echo $this->config->item('table_header'); ?>;">
                                            <th width="10%" >ลำดับ</th>
                                            <th width="15%">ปีงบประมาณ</th>
                                            <th>พันธกิจ</th>
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

    get_table_show();
    
});
// end doc-ready

function set_form_ready() {
    $("#mis_id").val("");
}

function get_table_show() {
    
    $("#mis_daTable").dataTable({
        processing: true,
        bDestroy: true,
        ajax:{
            type: "POST",
            url: "<?php echo site_url().'/admin/Sms_base_data/get_mis_show'; ?>",
            dataSrc : function(data){
                var return_data = new Array();
                $(data).each(function(seq, data ) {
				    return_data.push({
                       "mis_seq" : data.mis_seq,
                       "mis_year" : data.mis_year,
                       "mis_name" : data.mis_name,
                       "mis_action" : data.mis_action
                   });
                });
                console.log(return_data);             
                return return_data;
            }//end dataSrc
    }, //end ajax
    "columns" :[
        {"data": "mis_seq"},
        {"data": "mis_year"},
        {"data": "mis_name"},
        {"data": "mis_action"}
    ],
	"fnRowCallback": function(nRow, aData, iDisplayIndex) {
		nRow.setAttribute("id","tr_"+aData.mis_id);
		nRow.setAttribute("class","tr_table");
	}
              
    });

}
// ./get_table_show

function year_show() {
    $.ajax({
		type : "POST",
		url : "<?php echo site_url()."/admin/Sms_base_data/get_year_all"; ?>",
		dataType : "json",
		success : function(data){
			$("#year_name").html(data);
			$("#year_name").select2({width: '100%'});
		}
	});
}
// แสดงปีงบประมาณให้เลือก opt

function edit_mis(mis_id) {
    $("#panel_add_mis").css("display","block");
    
    $.ajax({
        type: "POST",
		url: "<?php echo site_url()."/admin/Sms_base_data/get_mis_by_id/"; ?>",
		data: {mis_id:mis_id},
		dataType : "json",
		success : function(data){
            console.log(data);
            console.log(data["mis_id"]);
            console.log(data["year_name"]);
            console.log(data["mis_name"]);

            $("#mis_id").val(data["mis_id"]);
            select_year_edit(data["mis_id"]); //ส่งค่าไปใน fn เพื่อแสดงปีงบประมาณของ id
            $("#mis_input").prop('disabled', false);
            $("#mis_input").val(data["mis_name"]);

		}
    
    });
}
// ./edit_mis

function select_year_edit(mis_id='') {
    $.ajax({
		type : "POST",
		url : "<?php echo site_url()."/admin/Sms_base_data/get_year_by_mis_id"; ?>",
		data: {mis_id: mis_id},
		dataType : "json",
		success : function(data){
			$("#year_name").html(data);
			$("#year_name").select2({width: '100%'});
		}
	});
}
// แสดงปีงบประมาณของพันธกิจที่เลือก

function add_mission() {
    var valid_state = validate("frm_save_mis");

    var year_id = $("#year_name").val();
    var mis_name = $("#mis_input").val();
    var mis_id = $("#mis_id").val();

    if (valid_state) {
        $.ajax({
            type: "POST",
    		url: "<?php echo site_url()."/admin/Sms_base_data/ajax_add_mis/"; ?>",
    		data: {year_id:year_id, mis_name:mis_name,mis_id:mis_id},
            dataType : "json",
        	success : function(data){
        		if(data["json_alert"] === true){
        			message_show(data);
                    console.log(data);
                    get_table_show();
        		}else{
        			message_show(data);
                    console.log(data);
        			get_table_show();
        		}
        	}// End success
        });// End ajax

        return true;
    }else{
        return false;
    }

}//insert & update

function remove_mis(mis_id) {

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
        url : "<?php echo site_url().'/admin/Sms_base_data/ajax_del_mis/'; ?>",
        data : {mis_id:mis_id},
        dataType : "json",
        success : function(data){
            get_table_show();
            message_show(data);
     
        }
    });//end ajax

});
}
// ./remove_mis

function message_show(message){
    document.getElementById("frm_save_mis").reset();
    get_table_show();
    swal("บันทึกข้อมูลสำเร็จ", message["json_str"], message["json_type"]);
}//message_show

function set_mis_kpi (mis_id) {
    var path = "<?php echo site_url().'/admin/Sms_base_data/mission_kpi/'; ?>";
    $.post(path,{mis_id:mis_id});

}


</script>