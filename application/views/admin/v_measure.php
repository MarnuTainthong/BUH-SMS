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
        <li class="active">ตัวบ่งชี้</li>
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
                <h3 class="box-title">ข้อมูลพื้นฐานตัวบ่งชี้</h3>
             <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2">
                        <button id="btn_add_mea" type="button" class=" <?php echo $this->config->item('btn_add_color'); ?>" onclick="show_panel('panel_add_mea'); year_show();"><i class=" <?php echo $this->config->item('sms_icon_add'); ?>" aria-hidden="true"></i> เพิ่มตัวบ่งชี้</button>
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
                <div class="row" id="panel_add_mea" style="display:none;">
                    <div class="col-md-12">
                        <div class="col-md-2">
                        </div>
                        <!-- /.col md 2 -->
                        <div class="col-md-8">
                            <div class="box box-solid <?php echo"box-".$this->config->item('panel_header_color'); ?>">
                                <div class="box-header">
                                    <h3 class="box-title">บันทึกข้อมูลตัวบ่งชี้</h3>
                                </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <form class="form-horizontal row-border" id="frm_save_mea" method="post">
                                    <!-- <input type="hidden" class="form-control" name="year_id" id="year_id" value="" disabled> -->
                                    <input type="hidden" class="form-control" name="mea_id" id="mea_id" value="" disabled>
                                    <div class="form-group" id="div_year_name">
                                        <label class="col-md-4 control-label" >ปีงบประมาณ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณาเลือกปีงบประมาณ">
                                            <select name="year_name" id="year_name" class="form-control" onchange="unlock('mea_code_input')" validate></select>
                                        </div>
                                    </div>                                        
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_mea_code" >
                                        <label class="col-md-4 control-label">รหัสตัวบ่งชี้
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณากรอกชื่อตัวบ่งชี้">
                                            <input disabled type="text" class="form-control" name="mea_code_input" id="mea_code_input" placeholder="ใส่รหัสตัวบ่งชี้" value="" onchange="unlock('mea_input')" validate>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_mea_name" >
                                        <label class="col-md-4 control-label">ชื่อตัวบ่งชี้
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณากรอกชื่อตัวบ่งชี้">
                                            <input disabled type="text" class="form-control" name="mea_input" id="mea_input" placeholder="ใส่ชื่อตัวบ่งชี้" value="" validate>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="btn-toolbar" style=" padding:5px 20px 5px 20px; border-radius: 0 0 2px 2px; margin: 0px -10px -10px -10px;">
			                            <input type="reset" id="configreset" class="btn btn btn-inverse" onclick="hide_panel('panel_add_mea')" value="<?php echo $this->config->item("txt_cancel")?>">
			                            <input type="button" id="btn_submit" class="btn-success btn pull-right" onclick="add_mea()" value="<?php echo $this->config->item("txt_save")?>">
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
                                <table id="mea_daTable" class="table table-bordered table-striped dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background-color:<?php echo $this->config->item('table_header'); ?>;">
                                            <th width="5%" >ลำดับ</th>
                                            <th width="10%">ปีงบประมาณ</th>
                                            <th width="15%">รหัสตัวบ่งชี้</th>
                                            <th>ตัวบ่งชี้</th>
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

function get_table_show() {
    
    $("#mea_daTable").dataTable({
        processing: true,
        bDestroy: true,
        ajax:{
            type: "POST",
            url: "<?php echo site_url().'/admin/Sms_base_data/get_mea_show'; ?>",
            dataSrc : function(data){
                var return_data = new Array();
                $(data).each(function(seq, data ) {
				    return_data.push({
                       "mea_seq" : data.mea_seq,
                       "mea_id" : data.mea_id,
                       "mea_year" : data.mea_year,
                       "mea_code" : data.mea_code,
                       "mea_name" : data.mea_name,
                       "mea_action" : data.mea_action
                   });
                });
                console.log(return_data);             
                return return_data;
            }//end dataSrc
    }, //end ajax
    "columns" :[
        {"data": "mea_seq"},
        {"data": "mea_year"},
        {"data": "mea_code"},
        {"data": "mea_name"},
        {"data": "mea_action"}
    ],
	"fnRowCallback": function(nRow, aData, iDisplayIndex) {
        // console.log(aData);
		nRow.setAttribute("id","tr_"+aData.mea_id);
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

function edit_mea(mea_id) {
    $("#panel_add_mea").css("display","block");
    
    $.ajax({
        type: "POST",
		url: "<?php echo site_url()."/admin/Sms_base_data/get_mea_by_id/"; ?>",
		data: {mea_id:mea_id},
		dataType : "json",
		success : function(data){

            $("#mea_id").val(data["mea_id"]);
            select_year_edit(data["mea_year_id"]); //ส่งค่าไปใน fn เพื่อแสดงปีงบประมาณของ id
            unlock('mea_input');
            unlock('mea_code_input');
            $("#mea_code_input").val(data["mea_code"]);
            $("#mea_input").val(data["mea_name"]);

		}
    
    });
}
// ./edit_mea

function select_year_edit(mea_year_id='') {
    $.ajax({
		type : "POST",
		url : "<?php echo site_url()."/admin/Sms_base_data/get_year_by_mea_id"; ?>",
		data: {mea_year_id: mea_year_id},
		dataType : "json",
		success : function(data){
			$("#year_name").html(data);
			$("#year_name").select2({width: '100%'});
		}
	});
}
// แสดงปีงบประมาณของตัวบ่งชี้ที่เลือก

function add_mea() {
    var valid_state = validate("frm_save_mea");

    var mea_id = $("#mea_id").val(); //for check insert or update
    var year_id = $("#year_name").val();
    var mea_code = $("#mea_code_input").val();
    var mea_name = $("#mea_input").val();

    if (valid_state) {
        $.ajax({
            type: "POST",
    		url: "<?php echo site_url()."/admin/Sms_base_data/ajax_add_mea/"; ?>",
    		data: {year_id:year_id ,mea_code:mea_code ,mea_name:mea_name ,mea_id:mea_id},
            dataType : "json",
        	success : function(data){
        		if(data["json_alert"] === true){
        			message_show(data);
                    console.log(data);
                    get_table_show();
                    hide_panel('panel_add_mea')
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

function remove_mea(mea_id) {

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
        url : "<?php echo site_url().'/admin/Sms_base_data/ajax_del_mea/'; ?>",
        data : {mea_id:mea_id},
        dataType : "json",
        success : function(data){
            get_table_show();
            message_show(data);
     
        }
    });//end ajax

});
}
// ./remove_mea

function message_show(message){
    document.getElementById("frm_save_mea").reset();
    // get_table_show();
    swal("บันทึกข้อมูลสำเร็จ", message["json_str"], message["json_type"]);
}//message_show

</script>