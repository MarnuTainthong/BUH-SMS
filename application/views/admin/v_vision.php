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
        <li class="active">วิสัยทัศน์</li>
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
                <h3 class="box-title">ข้อมูลพื้นฐานวิสัยทัศน์</h3>
             <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2">
                        <button id="btn_add_vis" type="button" class=" <?php echo $this->config->item('btn_add_color'); ?>" onclick="ToggleTable('panel_add_vis'); select_year_show();"><i class=" <?php echo $this->config->item('sms_icon_add'); ?>" aria-hidden="true"></i> เพิ่มวิสัยทัศน์</button>
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
                <div class="row" id="panel_add_vis" style="display:none;">
                    <div class="col-md-12">
                        <div class="col-md-2">
                        </div>
                        <!-- /.col md 2 -->
                        <div class="col-md-8">
                            <div class="box box-solid <?php echo"box-".$this->config->item('panel_header_color'); ?>">
                                <div class="box-header">
                                    <h3 class="box-title">บันทึกข้อมูลวิสัยทัศน์</h3>
                                </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <form class="form-horizontal row-border" id="frm_save_vis" method="post">
                                    <!-- <input type="hidden" class="form-control" name="year_id" id="year_id" value="" disabled> -->
                                    <input type="hidden" class="form-control" name="vis_id" id="vis_id" value="" disabled>
                                    <div class="form-group" id="div_year_name">
                                        <label class="col-md-4 control-label" >ปีงบประมาณ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณาเลือกปีงบประมาณ">
                                            <select name="year_name" id="year_name" class="form-control" onchange="unlock('vis_input')" validate></select>
                                        </div>
                                    </div>                                        
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_vis_name" >
                                        <label class="col-md-4 control-label">ชื่อวิสัยทัศน์
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณากรอกชื่อวิสัยทัศน์">
                                            <input disabled type="text" class="form-control" name="vis_input" id="vis_input" placeholder="ใส่ชื่อวิสัยทัศน์" value="" validate>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="btn-toolbar" style=" padding:5px 20px 5px 20px; border-radius: 0 0 2px 2px; margin: 0px -10px -10px -10px;">
			                            <input type="reset" id="configreset" class="btn btn btn-inverse" onclick="ToggleTable('panel_add_vis')" value="<?php echo $this->config->item("txt_cancel")?>">
			                            <input type="button" id="btn_submit" class="btn-success btn pull-right" onclick="add_vision()" value="<?php echo $this->config->item("txt_save")?>">
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
                                <table id="data_table" class="table table-bordered table-striped dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background-color:<?php echo $this->config->item('table_header'); ?>;">
                                            <th width="10%" >ลำดับ</th>
                                            <th width="15%">ปีงบประมาณ</th>
                                            <th>วิสัยทัศน์</th>
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
    // select_year_show();
    
 
});
// end doc-ready

function get_table_show() {
    
    $("#data_table").dataTable({
        processing: true,
        bDestroy: true,
        ajax:{
            type: "POST",
            url: "<?php echo site_url().'/admin/Sms_base_data/get_vis_show'; ?>",
            dataSrc : function(data){
                var return_data = new Array();
                $(data).each(function(seq, data ) {
				    return_data.push({
                       "vis_seq" : data.vis_seq,
                    //    "vis_id" : data.vis_id,
                       "vis_year" : data.vis_year,
                       "vis_name" : data.vis_name,
                       "year_action" : data.year_action
                   });
                });
                console.log(return_data);             
                return return_data;
            }//end dataSrc
    }, //end ajax
    "columns" :[
        {"data": "vis_seq"},
        // {"data": "vis_id"},
        {"data": "vis_year"},
        {"data": "vis_name"},
        {"data": "year_action"}
    ],
	"fnRowCallback": function(nRow, aData, iDisplayIndex) {
		nRow.setAttribute("id","tr_"+aData.vis_id);
		nRow.setAttribute("class","tr_table");
	}
              
    });

}
// ./get_table_show

function add_vision() {

    var valid_state = validate("frm_save_vis");
    // console.log("valid_state = "+valid_state);

    var year_id = $("#year_name").val();
    var vis_name = $("#vis_input").val();
    var vis_id = $("#vis_id").val();

    console.log("#year_name = "+year_id);
    console.log("#vis_input = "+vis_name);
    console.log("#vis_id = "+vis_id);

    if (valid_state) {
        $.ajax({
            type: "POST",
    		url: "<?php echo site_url()."/admin/Sms_base_data/ajax_add_vis/"; ?>",
    		data: {year_id:year_id, vis_name:vis_name,vis_id:vis_id},
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
    
}
// ./add vision

function edit_vis(vis_id){

    $("#panel_add_vis").css("display","block");
    
    $.ajax({
        type: "POST",
		url: "<?php echo site_url()."/admin/Sms_base_data/get_vis_by_id/"; ?>",
		data: {vis_id:vis_id},
		dataType : "json",
		success : function(data){
            console.log(data);
            console.log(data["vis_id"]);
            console.log(data["year_name"]);
            console.log(data["vis_name"]);

            $("#vis_id").val(data["vis_id"]);
            select_year_edit(data["vis_id"]); //ส่งค่าไปใน fn เพื่อแสดงปีงบประมาณของ id
            $("#vis_input").prop('disabled', false);
            $("#vis_input").val(data["vis_name"]);

		}
    
    });
}
// ./edit_vis

function remove_vis(vis_id) {

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
            url : "<?php echo site_url().'/admin/Sms_base_data/ajax_del_vis/'; ?>",
            data : {vis_id:vis_id},
            dataType : "json",
            success : function(data){
                swal('ดำเนินการสำเร็จ','ข้อมูลของคุณถูกลบออกจากระบบแล้ว', "success");
                get_table_show();
            }
        });//end ajax

	});
}
// ./remove_vis


function select_year_show(vis_id='') {
    $.ajax({
		type : "POST",
		url : "<?php echo site_url()."/admin/Sms_base_data/get_year_select"; ?>",
		data: {vis_id: vis_id},
		dataType : "json",
		success : function(data){
			$("#year_name").html(data);
			$("#year_name").select2({width: '100%'});
		}
	});
}
// แสดงปีงบประมาณที่ยังไม่ได้เพิ่มวิสัยทัศน์

function select_year_edit(vis_id='') {
    $.ajax({
		type : "POST",
		url : "<?php echo site_url()."/admin/Sms_base_data/get_year_by_vis_id"; ?>",
		data: {vis_id: vis_id},
		dataType : "json",
		success : function(data){
			$("#year_name").html(data);
			$("#year_name").select2({width: '100%'});
		}
	});
}
// แสดงปีงบประมาณของวิสัยทัศน์ที่เลือก

function message_show(message){
    document.getElementById("frm_save_vis").reset();
    get_table_show();
    swal("บันทึกข้อมูลสำเร็จ", message["json_str"], message["json_type"]);
  }//message_show

</script>