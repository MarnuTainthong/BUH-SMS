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
        <li class="active">ตั้งค่าระยะเวลาการบันทึกโครงการ</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Page Content Here -->
    <div class="row">
        <div class="col-md-12">
        <div class="box box-solid <?php echo"box-".$this->config->item('panel_header_color'); ?>">
            <div class="box-header with-border">

             <div class="form-group">
             <div class="col-md-9">
                <i class="fa fa-home"></i>
                <h3 class="box-title">ตั้งค่าระยะเวลาการบันทึกโครงการ</h3>
             </div>
             <!-- ./div md 9 -->
            <label class="col-md-1 control-label" >ปีงบประมาณ
            </label>
            <div class="col-md-2">
                <select name="year_name" id="year_name" onchange="unlock('org_name')">
                </select>
            </div>
            <!-- ./dov col md 2 -->

            </div>
            <!-- ./ div form froup -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2">
                        <button id="btn_add_pst" type="button" class=" <?php echo $this->config->item('btn_add_color'); ?>" onclick="show_panel('panel_add_tsp'); org_show(); "><i class=" <?php echo $this->config->item('sms_icon_add'); ?>" aria-hidden="true"></i> เพิ่มช่วงเวลาบันทึกโครงการ</button>
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

                <div class="row" id="panel_add_tsp" style="display:none;">
                    <div class="col-md-12">
                        <div class="col-md-2">
                        </div>
                        <!-- /.col md 2 -->
                        <div class="col-md-8">
                            <div class="box box-solid <?php echo"box-".$this->config->item('panel_header_color'); ?>">
                                <div class="box-header">
                                    <h3 class="box-title">บันทึกข้อมูลการตั้งค่า</h3>
                                </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <form class="form-horizontal row-border" id="frm_save_tsp" method="post">
                                    <!-- <input type="hidden" class="form-control" name="year_id" id="year_id" value="" disabled> -->
                                    <input type="hidden" class="form-control" name="tsp_id" id="tsp_id" value="" disabled>
                                    <div class="form-group" id="div_org">
                                        <label class="col-md-4 control-label" >หน่วยงาน/ส่วนงาน
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณาเลือกหน่วยงาน/ส่วนงาน">
                                            <select disabled name="org_name" id="org_name" class="form-control" onchange="unlock('tsp_start_input')" validate></select>
                                        </div>
                                    </div>                                        
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_tsp_start" >
                                        <label class="col-md-4 control-label">วันที่เริ่มต้น
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณาเลือกวันที่เริ่มต้น">
                                            <input disabled type="date" class="form-control" name="tsp_start_input" id="tsp_start_input" value="" onchange="unlock('tsp_end_input')" validate>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_tsp_end" >
                                        <label class="col-md-4 control-label">วันที่สิ้นสุด
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณาเลือกวันที่สิ้นสุด">
                                            <input disabled type="date" class="form-control" name="tsp_end_input" id="tsp_end_input" value="" validate>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="btn-toolbar" style=" padding:5px 20px 5px 20px; border-radius: 0 0 2px 2px; margin: 0px -10px -10px -10px;">
			                            <input type="reset" id="configreset" class="btn btn btn-inverse" onclick="hide_panel('panel_add_tsp')" value="<?php echo $this->config->item("txt_cancel")?>">
			                            <input type="button" id="btn_submit" class="btn-success btn pull-right" onclick="add_tsp()" value="<?php echo $this->config->item("txt_save")?>">
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
                                <table id="tsp_daTable" class="table table-bordered table-striped dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background-color:<?php echo $this->config->item('table_header'); ?>;">
                                            <th width="5%" >ลำดับ</th>
                                            <th width="15%">หน่วยงาน</th>
                                            <th width="15%">ช่วงเวลาในการบันทึก</th>
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
 
    // get_table_show();
    year_show();
    
});
// end doc-ready

function get_table_show() {
    
    $("#tsp_daTable").dataTable({
        processing: true,
        bDestroy: true,
        ajax:{
            type: "POST",
            url: "<?php echo site_url().'/admin/Sms_base_data/get_tsp_show'; ?>",
            dataSrc : function(data){
                var return_data = new Array();
                $(data).each(function(seq, data ) {
				    return_data.push({
                       "tsp_seq" : data.tsp_seq,
                       "tsp_id" : data.tsp_id,
                       "tsp_org" : data.tsp_org,
                       "tsp_start" : data.tsp_start,
                       "tsp_end" : data.tsp_end,
                       "tsp_action" : data.tsp_action
                   });
                });
                console.log(return_data);             
                return return_data;
            }//end dataSrc
    }, //end ajax
    "columns" :[
        {"data": "tsp_seq"},
        {"data": "tsp_org"},
        {"data": "tsp_start"},
        {"data": "tsp_end"},
        {"data": "tsp_action"}
    ],
	"fnRowCallback": function(nRow, aData, iDisplayIndex) {
        // console.log(aData);
		nRow.setAttribute("id","tr_"+aData.tsp_id);
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
// แสดงปีงบประมาณ opt

function org_show() {
    $.ajax({
		type : "POST",
		url : "<?php echo site_url()."/admin/Sms_base_data/get_org_all"; ?>",
		dataType : "json",
		success : function(data){
			$("#org_name").html(data);
			$("#org_name").select2({width: '100%'});
		}
	});
}
// แสดงหน่วยงาน opt

// function add_mea() {
//     var valid_state = validate("frm_save_mea");

//     var mea_id = $("#mea_id").val(); //for check insert or update
//     var year_id = $("#year_name").val();
//     var mea_code = $("#mea_code_input").val();
//     var mea_name = $("#mea_input").val();

//     if (valid_state) {
//         $.ajax({
//             type: "POST",
//     		url: "<?php echo site_url()."/admin/Sms_base_data/ajax_add_mea/"; ?>",
//     		data: {year_id:year_id ,mea_code:mea_code ,mea_name:mea_name ,mea_id:mea_id},
//             dataType : "json",
//         	success : function(data){
//         		if(data["json_alert"] === true){
//         			message_show(data);
//                     console.log(data);
//                     get_table_show();
//                     hide_panel('panel_add_mea')
//         		}else{
//         			message_show(data);
//                     console.log(data);
//         			get_table_show();
//         		}
//         	}// End success
//         });// End ajax

//         return true;
//     }else{
//         return false;
//     }

// }//insert & update

// function edit_tsp(tsp_id) {
//     $("#panel_add_tsp").css("display","block");
    
//     $.ajax({
//         type: "POST",
// 		url: "<?php echo site_url()."/admin/Sms_base_data/get_tsp_by_id/"; ?>",
// 		data: {tsp_id:tsp_id},
// 		dataType : "json",
// 		success : function(data){

//             $("#tsp_id").val(data["tsp_id"]);
//             select_year_edit(data["tsp_year_id"]); //ส่งค่าไปใน fn เพื่อแสดงปีงบประมาณของ id
//             unlock('tsp_input');
//             unlock('tsp_code_input');
//             $("#tsp_code_input").val(data["tsp_code"]);
//             $("#tsp_input").val(data["tsp_name"]);

// 		}
    
//     });
// }
// ./edit_mea

// function select_year_edit(mea_year_id='') {
//     $.ajax({
// 		type : "POST",
// 		url : "<?php echo site_url()."/admin/Sms_base_data/get_year_by_mea_id"; ?>",
// 		data: {mea_year_id: mea_year_id},
// 		dataType : "json",
// 		success : function(data){
// 			$("#year_name").html(data);
// 			$("#year_name").select2({width: '100%'});
// 		}
// 	});
// }
// แสดงปีงบประมาณของตัวบ่งชี้ที่เลือก

// function remove_mea(mea_id) {

// swal({
//     title: "คุณต้องการลบใช่หรือไม่ ?",
//     text: "หากลบแล้วจะไม่สามารถกู้คืนได้อีก !",
//     type: "warning",
//     allowOutsideClick: !0,
//     showCancelButton: true,
//     confirmButtonColor: "#dd4b39",
//     confirmButtonText: "ยืนยัน",
//     closeOnConfirm: true ,
//     cancelButtonText: 'ยกเลิก'
// },
// function(){
//     $.ajax({
//         type : "POST",
//         url : "<?php echo site_url().'/admin/Sms_base_data/ajax_del_mea/'; ?>",
//         data : {mea_id:mea_id},
//         dataType : "json",
//         success : function(data){
//             get_table_show();
//             message_show(data);
     
//         }
//     });//end ajax

// });
// }
// ./remove_mea

function message_show(message){
    document.getElementById("frm_save_mea").reset();
    // get_table_show();
    swal("บันทึกข้อมูลสำเร็จ", message["json_str"], message["json_type"]);
}//message_show

</script>