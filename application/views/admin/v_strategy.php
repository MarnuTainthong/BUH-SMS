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
        <li class="active">ยุทธศาสตร์</li>
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
                <h3 class="box-title">ข้อมูลพื้นฐานยุทธศาสตร์</h3>
             <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2">
                        <button id="btn_add_str" type="button" class=" <?php echo $this->config->item('btn_add_color'); ?>" onclick="ToggleTable('panel_add_str'); year_show();"><i class=" <?php echo $this->config->item('sms_icon_add'); ?>" aria-hidden="true"></i> เพิ่มยุทธศาสตร์</button>
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
                <div class="row" id="panel_add_str" style="display:none;">
                    <div class="col-md-12">
                        <div class="col-md-2">
                        </div>
                        <!-- /.col md 2 -->
                        <div class="col-md-8">
                            <div class="box box-solid <?php echo"box-".$this->config->item('panel_header_color'); ?>">
                                <div class="box-header">
                                    <h3 class="box-title">บันทึกข้อมูลยุทธศาสตร์</h3>
                                </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <form class="form-horizontal row-border" id="frm_save_str" method="post">
                                    <!-- <input type="hidden" class="form-control" name="year_id" id="year_id" value="" disabled> -->
                                    <input type="hidden" class="form-control" name="str_id" id="str_id" value="" disabled>
                                    <div class="form-group" id="div_year_name">
                                        <label class="col-md-4 control-label" >ปีงบประมาณ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณาเลือกปีงบประมาณ">
                                            <select name="year_name" id="year_name" class="form-control" onchange="unlock('str_input')" validate></select>
                                        </div>
                                    </div>                                        
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_str_name" >
                                        <label class="col-md-4 control-label">ชื่อยุทธศาสตร์
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณากรอกชื่อยุทธศาสตร์">
                                            <input disabled type="text" class="form-control" name="str_input" id="str_input" placeholder="ใส่ชื่อยุทธศาสตร์" value="" validate>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="btn-toolbar" style=" padding:5px 20px 5px 20px; border-radius: 0 0 2px 2px; margin: 0px -10px -10px -10px;">
			                            <input type="reset" id="configreset" class="btn btn btn-inverse" onclick="ToggleTable('panel_add_str'); set_form_ready();" value="<?php echo $this->config->item("txt_cancel")?>">
			                            <input type="button" id="btn_submit" class="btn-success btn pull-right" onclick="add_str()" value="<?php echo $this->config->item("txt_save")?>">
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
                                <table id="str_daTable" class="table table-bordered table-striped dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background-color:<?php echo $this->config->item('table_header'); ?>;">
                                            <th width="10%" >ลำดับ</th>
                                            <th width="15%">ปีงบประมาณ</th>
                                            <th>ยุทธศาสตร์</th>
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
    $("#str_id").val("");
}

function get_table_show() {
    
    $("#str_daTable").dataTable({
        processing: true,
        bDestroy: true,
        ajax:{
            type: "POST",
            url: "<?php echo site_url().'/admin/Sms_base_data/get_str_show'; ?>",
            dataSrc : function(data){
                var return_data = new Array();
                $(data).each(function(seq, data ) {
				    return_data.push({
                       "str_seq" : data.str_seq,
                       "str_year" : data.str_year,
                       "str_name" : data.str_name,
                       "str_action" : data.str_action
                   });
                });
                console.log(return_data);             
                return return_data;
            }//end dataSrc
    }, //end ajax
    "columns" :[
        {"data": "str_seq"},
        {"data": "str_year"},
        {"data": "str_name"},
        {"data": "str_action"}
    ],
	"fnRowCallback": function(nRow, aData, iDisplayIndex) {
		nRow.setAttribute("id","tr_"+aData.str_id);
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

function edit_str(str_id) {
    $("#panel_add_str").css("display","block");
    
    $.ajax({
        type: "POST",
		url: "<?php echo site_url()."/admin/Sms_base_data/get_str_by_id/"; ?>",
		data: {str_id:str_id},
		dataType : "json",
		success : function(data){
            console.log(data);
            console.log(data["str_id"]);
            console.log(data["year_name"]);
            console.log(data["str_name"]);

            $("#str_id").val(data["str_id"]);
            select_year_edit(data["str_id"]); //ส่งค่าไปใน fn เพื่อแสดงปีงบประมาณของ id
            $("#str_input").prop('disabled', false);
            $("#str_input").val(data["str_name"]);

		}
    
    });
}
// ./edit_str

function select_year_edit(str_id='') {
    $.ajax({
		type : "POST",
		url : "<?php echo site_url()."/admin/Sms_base_data/get_year_by_str_id"; ?>",
		data: {str_id: str_id},
		dataType : "json",
		success : function(data){
			$("#year_name").html(data);
			$("#year_name").select2({width: '100%'});
		}
	});
}
// แสดงปีงบประมาณของยุทธศาสตร์ที่เลือก

function add_str() {
    var valid_state = validate("frm_save_str");

    var year_id = $("#year_name").val();
    var str_name = $("#str_input").val();
    var str_id = $("#str_id").val();

    if (valid_state) {
        $.ajax({
            type: "POST",
    		url: "<?php echo site_url()."/admin/Sms_base_data/ajax_add_str/"; ?>",
    		data: {year_id:year_id, str_name:str_name,str_id:str_id},
            dataType : "json",
        	success : function(data){
        		if(data["json_alert"] === true){
        			message_show(data);
                    console.log(data);
                    get_table_show();
                    ToggleTable('panel_add_str')
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

function remove_str(str_id) {

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
        url : "<?php echo site_url().'/admin/Sms_base_data/ajax_del_str/'; ?>",
        data : {str_id:str_id},
        dataType : "json",
        success : function(data){
            get_table_show();
            message_show(data);
     
        }
    });//end ajax

});
}
// ./remove_str

function message_show(message){
    document.getElementById("frm_save_str").reset();
    get_table_show();
    swal("บันทึกข้อมูลสำเร็จ", message["json_str"], message["json_type"]);
}//message_show

function set_str_kpi (str_id) {
    var path = "<?php echo site_url().'/admin/Sms_base_data/strsion_kpi/'; ?>";
    $.post(path,{str_id:str_id});

}


</script>