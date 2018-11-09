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
        <li class="active">เป้าประสงค์</li>
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
                <h3 class="box-title">ข้อมูลพื้นฐานเป้าประสงค์</h3>
             <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2">
                        <button id="btn_add_poi" type="button" class=" <?php echo $this->config->item('btn_add_color'); ?>" onclick="ToggleTable('panel_add_poi'); year_show();"><i class=" <?php echo $this->config->item('sms_icon_add'); ?>" aria-hidden="true"></i> เพิ่มเป้าประสงค์</button>
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
                <div class="row" id="panel_add_poi" style="display:none;">
                    <div class="col-md-12">
                        <div class="col-md-2">
                        </div>
                        <!-- /.col md 2 -->
                        <div class="col-md-8">
                            <div class="box box-solid <?php echo"box-".$this->config->item('panel_header_color'); ?>">
                                <div class="box-header">
                                    <h3 class="box-title">บันทึกข้อมูลเป้าประสงค์</h3>
                                </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <form class="form-horizontal row-border" id="frm_save_poi" method="post">
                                    <!-- <input type="hidden" class="form-control" name="year_id" id="year_id" value="" disabled> -->
                                    <input type="hidden" class="form-control" name="poi_id" id="poi_id" value="" disabled>
                                    <div class="form-group" id="div_year_name">
                                        <label class="col-md-4 control-label" >ปีงบประมาณ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณาเลือกปีงบประมาณ">
                                            <select name="year_name" id="year_name" class="form-control" onchange="unlock('poi_input')" validate></select>
                                        </div>
                                    </div>                                        
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_poi_name" >
                                        <label class="col-md-4 control-label">ชื่อเป้าประสงค์
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณากรอกชื่อเป้าประสงค์">
                                            <input disabled type="text" class="form-control" name="poi_input" id="poi_input" placeholder="ใส่ชื่อเป้าประสงค์" value="" validate>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="btn-toolbar" style=" padding:5px 20px 5px 20px; border-radius: 0 0 2px 2px; margin: 0px -10px -10px -10px;">
			                            <input type="reset" id="configreset" class="btn btn btn-inverse" onclick="ToggleTable('panel_add_poi'); set_form_ready();" value="<?php echo $this->config->item("txt_cancel")?>">
			                            <input type="button" id="btn_submit" class="btn-success btn pull-right" onclick="add_poi()" value="<?php echo $this->config->item("txt_save")?>">
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
                                <table id="poi_daTable" class="table table-bordered table-striped dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background-color:<?php echo $this->config->item('table_header'); ?>;">
                                            <th width="10%" >ลำดับ</th>
                                            <th width="15%">ปีงบประมาณ</th>
                                            <th>เป้าประสงค์</th>
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
    $("#poi_id").val("");
}

function get_table_show() {
    
    $("#poi_daTable").dataTable({
        processing: true,
        bDestroy: true,
        ajax:{
            type: "POST",
            url: "<?php echo site_url().'/admin/Sms_base_data/get_poi_show'; ?>",
            dataSrc : function(data){
                var return_data = new Array();
                $(data).each(function(seq, data ) {
				    return_data.push({
                       "poi_seq" : data.poi_seq,
                       "poi_year" : data.poi_year,
                       "poi_name" : data.poi_name,
                       "poi_action" : data.poi_action
                   });
                });
                console.log(return_data);             
                return return_data;
            }//end dataSrc
    }, //end ajax
    "columns" :[
        {"data": "poi_seq"},
        {"data": "poi_year"},
        {"data": "poi_name"},
        {"data": "poi_action"}
    ],
	"fnRowCallback": function(nRow, aData, iDisplayIndex) {
		nRow.setAttribute("id","tr_"+aData.poi_id);
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

function edit_poi(poi_id) {
    $("#panel_add_poi").css("display","block");
    
    $.ajax({
        type: "POST",
		url: "<?php echo site_url()."/admin/Sms_base_data/get_poi_by_id/"; ?>",
		data: {poi_id:poi_id},
		dataType : "json",
		success : function(data){
            console.log(data);
            console.log(data["poi_id"]);
            console.log(data["year_name"]);
            console.log(data["poi_name"]);

            $("#poi_id").val(data["poi_id"]);
            select_year_edit(data["poi_id"]); //ส่งค่าไปใน fn เพื่อแสดงปีงบประมาณของ id
            $("#poi_input").prop('disabled', false);
            $("#poi_input").val(data["poi_name"]);

		}
    
    });
}
// ./edit_poi

function select_year_edit(poi_id='') {
    $.ajax({
		type : "POST",
		url : "<?php echo site_url()."/admin/Sms_base_data/get_year_by_poi_id"; ?>",
		data: {poi_id: poi_id},
		dataType : "json",
		success : function(data){
			$("#year_name").html(data);
			$("#year_name").select2({width: '100%'});
		}
	});
}
// แสดงปีงบประมาณของเป้าประสงค์ที่เลือก

function add_poi() {
    var valid_state = validate("frm_save_poi");

    var year_id = $("#year_name").val();
    var poi_name = $("#poi_input").val();
    var poi_id = $("#poi_id").val();

    if (valid_state) {
        $.ajax({
            type: "POST",
    		url: "<?php echo site_url()."/admin/Sms_base_data/ajax_add_poi/"; ?>",
    		data: {year_id:year_id, poi_name:poi_name,poi_id:poi_id},
            dataType : "json",
        	success : function(data){
        		if(data["json_alert"] === true){
        			message_show(data);
                    console.log(data);
                    get_table_show();
                    ToggleTable('panel_add_poi')
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

function remove_poi(poi_id) {

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
        url : "<?php echo site_url().'/admin/Sms_base_data/ajax_del_poi/'; ?>",
        data : {poi_id:poi_id},
        dataType : "json",
        success : function(data){
            get_table_show();
            message_show(data);
     
        }
    });//end ajax

});
}
// ./remove_poi

function message_show(message){
    document.getElementById("frm_save_poi").reset();
    get_table_show();
    swal("บันทึกข้อมูลสำเร็จ", message["json_str"], message["json_type"]);
}//message_show

</script>