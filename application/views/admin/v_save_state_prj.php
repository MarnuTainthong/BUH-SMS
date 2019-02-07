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
        <li class="active"><a href="#">จัดการโครงการ</a></li>
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
                <h3 class="box-title">จัดการโครงการ</h3>
             </div>
             <!-- ./div md 9 -->
            <label class="col-md-1 control-label" >ปีงบประมาณ
            </label>
            <div class="col-md-2">
                <select name="year_name" id="year_name" onchange="get_table_show()">
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
                        <div class="col-md-2" id="div_btn_add">
                        <!-- <button id="btn_add_prj" type="button" class=" <?php echo $this->config->item('btn_add_color'); ?>" onclick="show_panel('panel_add_prj'); "><i class=" <?php echo $this->config->item('sms_icon_add'); ?>" aria-hidden="true"></i> เพิ่มโครงการ</button> -->
                        <a id="btn_add_prj" class="<?php echo($this->config->item("btn_add_color")) ?>" href=" " ><i class=" <?php echo $this->config->item('sms_icon_add'); ?>" aria-hidden="true"></i> เพิ่มโครงการ</a>
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
                <div class="row" id="panel_add_prj" style="display:none;">
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
                                    <!-- <input type="hidden" class="form-control" name="year_id" id="year_id" value="" disabled> -->
                                    <input type="hidden" class="form-control" name="prj_id" id="prj_id" value="" disabled>
                                    <div class="form-group" id="div_org">
                                        <label class="col-md-4 control-label" >หน่วยงาน/ส่วนงาน
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณาเลือกหน่วยงาน/ส่วนงาน">
                                            <select disabled name="org_name" id="org_name" class="form-control" onchange="" validate></select>
                                        </div>
                                    </div>                                        
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_sstr_name">
                                        <label class="col-md-4 control-label" >กลยุทธ์
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณาเลือกกลยุทธ์">
                                            <select disabled name="sstr_name" id="sstr_name" class="form-control" onchange="" validate></select>
                                        </div>
                                    </div>                                        
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_mea_name">
                                        <label class="col-md-4 control-label" >ตัวบ่งชี้ประกันคุณภาพ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณาเลือกตัวบ่งชี้ประกันคุณภาพ">
                                            <select disabled name="mea_name" id="mea_name" class="form-control" onchange="" validate></select>
                                        </div>
                                    </div>                                        
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_prj_type">
                                        <label class="col-md-4 control-label" >ลักษณะโครงการ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6">
                                                <input type="radio" name="opt_radio_prj" id="opt_radio_prj1" value="1" validate> โครงการใหม่
                                                <input type="radio" name="opt_radio_prj" id="opt_radio_prj0" value="0" validate> โครงการต่อเนื่อง
   
                                        </div>
                                    </div>                                        
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_prj_code" >
                                        <label class="col-md-4 control-label">รหัสโครงการ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณากรอกรหัสโครงการ">
                                            <input disabled type="text" class="form-control" name="prj_code_input" id="prj_code_input" placeholder="ใส่รหัสโครงการ" value="" onchange="" validate>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_prj_name" >
                                        <label class="col-md-4 control-label">ชื่อโครงการ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณากรอกชื่อโครงการ">
                                            <input disabled type="text" class="form-control" name="prj_name_input" id="prj_name_input" placeholder="ใส่ชื่อโครงการ" value="" onchange="" validate>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->
                                    
                                    <div class="form-group" id="div_budget" >
                                        <label class="col-md-4 control-label">งบประมาณ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-md-5">
                                                    งบประมาณแผ่นดิน
                                                </div>
                                                <!-- ./col md 5 -->
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="prj_bdgt1" id="prj_bdgt1" placeholder="ใส่งบประมาณแผ่นดิน" value="" onchange="">
                                                        <span class="input-group-addon">บาท</span>
                                                    </div>
                                                </div>
                                                <!-- ./col md 7 -->
                                                <div class="col-md-5">
                                                    งบประมาณเงินรายได้คณะ
                                                </div>
                                                <!-- ./col md 5 -->
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="prj_bdgt2" id="prj_bdgt2" placeholder="ใส่งบประมาณเงินรายได้คณะ" value="" onchange="">
                                                        <span class="input-group-addon">บาท</span>
                                                    </div>
                                                </div>
                                                <!-- ./col md 7 -->
                                                <div class="col-md-5">
                                                    งบประมาณจากแหล่งทุนอื่น
                                                </div>
                                                <!-- ./col md 5 -->
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="prj_bdgt3" id="prj_bdgt3" placeholder="ใส่งบประมาณจากแหล่งทุนอื่น" value="" onchange="">
                                                        <span class="input-group-addon">บาท</span>
                                                    </div>
                                                </div>
                                                <!-- ./col md 7 -->
                                                <div class="col-md-5">
                                                    <b>ชื่อแหล่งทุนอื่น</b>
                                                </div>
                                                <!-- ./col md 5 -->
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" name="prj_bdgt3" id="prj_bdgt3" placeholder="ใส่ชื่อแหล่งทุนอื่น" value="" onchange="">
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
                                            <input disabled type="text" class="form-control" name="sum_bdgt" id="sum_bdgt" placeholder="งบประมาณที่ตั้งไว้รวม" onchange="" validate>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_prj_time" >
                                        <label class="col-md-4 control-label">ระยะเวลาดำเนินโครงการ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input disabled type="date" class="form-control" name="prj_start" id="prj_start" value="" onchange="" validate>
                                                </div>
                                                <div class="col-md-2">
                                                    <center>ถึง</center>
                                                </div>
                                                <div class="col-md-5">
                                                    <input disabled type="date" class="form-control" name="prj_end" id="prj_end" value="" onchange="" validate>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_file" >
                                        <label class="col-md-4 control-label">555
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <input disabled type="text" class="form-control" name="sum_bdgt" id="sum_bdgt" placeholder="งบประมาณที่ตั้งไว้รวม" onchange="" validate>
                                        </div>
                                    </div>
                                    <!-- ./div form group -->

                                    <div class="btn-toolbar" style=" padding:5px 20px 5px 20px; border-radius: 0 0 2px 2px; margin: 0px -10px -10px -10px;">
			                            <input type="reset" id="configreset" class="btn btn btn-inverse" onclick="hide_panel('panel_add_prj')" value="<?php echo $this->config->item("txt_cancel")?>">
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
                                <table id="prj_dataTable" class="table table-bordered table-striped dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background-color:<?php echo $this->config->item('table_header'); ?>;">
                                            <th width="10%" >ลำดับ</th>
                                            <th width="10%">รหัสโครงการ</th>
                                            <th>โครงการ</th>
                                            <th width="15%">ผู้รับผิดชอบ</th>
                                            <th width="20%">ระยะเวลาดำเนินการ</th>
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

    year_show(); 
 
});
// end doc-ready

function get_table_show() {

    var year_id = $("#year_name").val();
    // console.log("year_id = "+year_id);

    if (year_id == null) {

        $("#prj_dataTable").dataTable({
        processing: true,
        bDestroy: true,
        searching:false,
        ajax:{
            type: "POST",
            url: "<?php echo site_url().'/admin/Sms_project_manage/get_prj_show'; ?>",
            data: {year_id:year_id},
		    dataType : "json",
            dataSrc : function(data){
                var return_data = new Array();
                $(data).each(function(seq, data ) {
				    return_data.push({
                       "prj_seq" : data.prj_seq
                   });
                });
                console.log(return_data);             
                return return_data;
            }//end dataSrc
        }, //end ajax
        "columns" :[
            {"data": "prj_seq"}
        ],
        'columnDefs': [
            {
                'targets': 0,
                'createdCell':  function (td, cellData, rowData, row, col) {
                $(td).attr('colspan', '6'); 
                }
            }
        ]
                
        });

    }else{
        $("#prj_dataTable").dataTable({
                processing: true,
                bDestroy: true,
                ajax:{
                    type: "POST",
                    url: "<?php echo site_url().'/admin/Sms_project_manage/get_prj_show'; ?>",
                    data: {year_id:year_id},
                    dataType : "json",
                    dataSrc : function(data){
                        var return_data = new Array();
                        $(data).each(function(seq, data ) {
                            return_data.push({
                            "prj_seq" : data.prj_seq,
                            "prj_code" : data.prj_code,
                            "prj_name" : data.prj_name,
                            "prj_respon" : data.prj_respon,
                            "prj_duration" : data.prj_duration,
                            "prj_action" : data.prj_action
                        });
                        });
                        console.log(return_data);             
                        return return_data;
                    }//end dataSrc
            }, //end ajax
            "columns" :[
                {"data": "prj_seq"},
                {"data": "prj_code"},
                {"data": "prj_name"},
                {"data": "prj_respon"},
                {"data": "prj_duration"},
                {"data": "prj_action"}
            ]
                    
            });
    }

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

function remove_prj(prj_id) {
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
            url : "<?php echo site_url().'/admin/Sms_project_manage/ajax_del_prj/'; ?>",
            data : {prj_id:prj_id},
            dataType : "json",
            success : function(data){
                message_show(data);
                // show_prj_ind_data();
            }
        });//end ajax

    });
}
// ลบโครงการ


function set_mis_kpi (mis_id) {
    var path = "<?php echo site_url().'/admin/Sms_base_data/mission_kpi/'; ?>";
    $.post(path,{mis_id:mis_id});

}

function message_show(message,frm_name){
    if (frm_name == "" || frm_name == null) {
        swal("บันทึกข้อมูลสำเร็จ", message["json_str"], message["json_type"]);
    }else{
        document.getElementById(frm_name).reset();
        swal("บันทึกข้อมูลสำเร็จ", message["json_str"], message["json_type"]);
    }
    get_table_show();
}//message_show

</script>