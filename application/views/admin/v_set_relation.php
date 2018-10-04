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
        <li class="active">ตั้งค่าความสัมพันธ์</li>
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
                <h3 class="box-title">ตั้งค่าความสัมพันธ์</h3>
             </div>
             <!-- ./div md 9 -->
            <label class="col-md-1 control-label" >ปีงบประมาณ
            </label>
            <div class="col-md-2">
                <select name="year_name" id="year_name" onchange="get_table_show(); set_form_ready();">
                </select>
            </div>
            <!-- ./dov col md 2 -->

            </div>
            <!-- ./ div form froup -->
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
                                    <h3 class="box-title">บันทึกข้อมูลตั้งค่าความสัมพันธ์</h3>
                                </div>
                                

                            <!-- /.box-header -->
                            <div class="box-body">

                                <form class="form-horizontal row-border" id="frm_save_rel" method="post">
                                    <!-- <input type="hidden" class="form-control" name="year_id" id="year_id" value="" disabled> -->
                                    <!-- <input type="hidden" class="form-control" name="mis_id" id="mis_id" value="" disabled> -->
                                    <div class="form-group" id="div_mis_name">
                                        <label class="col-md-4 control-label" >พันธกิจ
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณาเลือกพันธกิจ">
                                            <select disabled name="mis_name" id="mis_name" class="form-control" onchange="unlock('str_name'); get_str();" validate></select>
                                        </div>
                                    </div>                                        
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_str_name">
                                        <label class="col-md-4 control-label" >ยุทธศาสตร์
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณาเลือกยุทธศาสตร์">
                                            <select disabled name="str_name" id="str_name" class="form-control" onchange="unlock('poi_name')" validate></select>
                                        </div>
                                    </div>                                        
                                    <!-- ./div form group -->

                                    <div class="form-group" id="div_poi_name">
                                        <label class="col-md-4 control-label" >เป้าประสงค์
                                            <span style="color: <?php echo $this->config->item('red_color'); ?>">*</span>
                                        </label>
                                        <div class="col-md-6" data-tooltip="กรุณาเลือกเป้าประสงค์">
                                            <select disabled name="poi_name" id="poi_name" class="form-control" onchange="unlock('sstr_name')" validate></select>
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

                                    <div class="btn-toolbar" style=" padding:5px 20px 5px 20px; border-radius: 0 0 2px 2px; margin: 0px -10px -10px -10px;">
			                            <input type="reset" id="configreset" class="btn btn btn-inverse" onclick="set_form_ready()" value="<?php echo $this->config->item("txt_cancel")?>">
			                            <input type="button" id="btn_submit" class="btn-success btn pull-right" onclick="add_rel()" value="<?php echo $this->config->item("txt_save")?>">
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
                                <table id="rel_daTable" class="table table-bordered table-striped dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background-color:<?php echo $this->config->item('table_header'); ?>;">
                                            <th width="5%">ลำดับ</th>
                                            <th width="15%">พันธกิจ</th>
                                            <th width="15%">ยุทธศาสตร์</th>
                                            <th width="15%">เป้าประสงค์</th>
                                            <th width="15%">กลยุทธ์</th>
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
 
    get_year_show();
    get_table_show();

    get_mis_by_year();
    get_str(); 
    get_poi();
    get_sstr();
    
});
// end doc-ready

function set_form_ready() {
    get_mis_by_year(); 
    unlock('mis_name'); 
    lock('str_name'); 
    lock('poi_name'); 
    lock('sstr_name'); 
    get_str(); 
    get_poi(); 
    get_sstr();
}

function get_year_show() {
    $.ajax({
		type : "POST",
		url : "<?php echo site_url()."/admin/Sms_base_data/set_rel_year"; ?>",
		dataType : "json",
		success : function(data){
			$("#year_name").html(data);
			$("#year_name").select2({width: '100%'});
		}
	});
}
// แสดงปีงบประมาณ opt

function get_mis_by_year() {
    var year_id = $("#year_name").val();

    $.ajax({
        type : "POST",
        url : "<?php echo site_url()."/admin/Sms_base_data/get_mis_by_year/"; ?>",
        data: {year_id:year_id},
        dataType : "json",
        success : function (data) {
            $("#mis_name").html(data);
			$("#mis_name").select2({width: '100%'});
        }
    });
}
// แสดงพันธกิจตามปีงบประมาณ opt

function get_str() {
    var year_id = $("#year_name").val();

    $.ajax({
        type : "POST",
        url : "<?php echo site_url()."/admin/Sms_base_data/get_str_not_use/"; ?>",
        data: {year_id:year_id},
        dataType : "json",
        success : function (data) {
            $("#str_name").html(data);
            $("#str_name").select2({width: '100%'});
        }
    });
}
// แสดงยุทธศาสตร์ที่ยังไม่ได้ตั้งค่าความสัมพันธ์

function get_poi() {
    var year_id = $("#year_name").val();

    $.ajax({
        type : "POST",
        url : "<?php echo site_url()."/admin/Sms_base_data/get_poi_not_use/"; ?>",
        data: {year_id:year_id},
        dataType : "json",
        success : function (data) {
            $("#poi_name").html(data);
            $("#poi_name").select2({width: '100%'});
        }
    });
}
// แสดงเป้าประสงค์ที่ยังไม่ได้ตั้งค่าความสัมพันธ์

function get_sstr() {
    var year_id = $("#year_name").val();

    $.ajax({
        type : "POST",
        url : "<?php echo site_url()."/admin/Sms_base_data/get_sstr_not_use/"; ?>",
        data: {year_id:year_id},
        dataType : "json",
        success : function (data) {
            $("#sstr_name").html(data);
            $("#sstr_name").select2({width: '100%'});
        }
    });
}
// แสดงกลยุทธ์ที่ยังไม่ได้ตั้งค่าความสัมพันธ์

function get_table_show() {

    var year_name = $("#year_name").val();
    console.log("year_name = "+year_name); 
    
    $("#rel_daTable").dataTable({
        processing: true,
        bDestroy: true,
        ajax:{
            type: "POST",
            url: "<?php echo site_url().'/admin/Sms_base_data/show_rel'; ?>",
            data: {year_name:year_name},
		    dataType : "json",
            dataSrc : function(data){
                var return_data = new Array();
                $(data).each(function(seq, data ) {
				    return_data.push({
                       "rmst_seq" : data.rmst_seq,
                       "rmst_mis" : data.rmst_mis,
                       "rmst_str" : data.rmst_str,
                       "rmst_point" : data.rmst_point,
                       "rmst_sstr" : data.rmst_sstr
                   });
                });
                console.log(return_data);             
                return return_data;
            }//end dataSrc
    }, //end ajax
    "columns" :[
        {"data": "rmst_seq"},
        {"data": "rmst_mis"},
        {"data": "rmst_str"},
        {"data": "rmst_point"},
        {"data": "rmst_sstr"}
    ],
	"fnRowCallback": function(nRow, aData, iDisplayIndex) {
        // console.log(aData);
		nRow.setAttribute("id","tr_"+aData.pst_id);
		nRow.setAttribute("class","tr_table");
	}
              
    });

}
// ./get_table_show

function add_rel() {
    var valid_state = validate("frm_save_rel");    

    var year_name = $("#year_name").val();
    var mis_name = $("#mis_name").val();
    var str_name = $("#str_name").val();
    var poi_name = $("#poi_name").val();
    var sstr_name = $("#sstr_name").val();

    console.log("year_name = "+year_name);
    console.log("mis_name = "+mis_name);
    console.log("str_name = "+str_name);
    console.log("poi_name = "+poi_name);
    console.log("sstr_name = "+sstr_name);

    if (valid_state) {
        $.ajax({
            type: "POST",
    		url: "<?php echo site_url()."/admin/Sms_base_data/ajax_add_rel/"; ?>",
    		data: {year_name:year_name ,mis_name:mis_name ,str_name:str_name ,poi_name:poi_name ,sstr_name:sstr_name},
            dataType : "json",
        	success : function(data){
        		if(data["json_alert"] === true){
        			message_show(data);
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

}//insert & update

function remove_pst(pst_id) {

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
        url : "<?php echo site_url().'/admin/Sms_base_data/ajax_del_pst/'; ?>",
        data : {pst_id:pst_id},
        dataType : "json",
        success : function(data){
            get_table_show();
            message_show(data);
     
        }
    });//end ajax

});
}
// ./remove_pst

function message_show(message){
    document.getElementById("frm_save_rel").reset();
    // get_table_show();
    swal("บันทึกข้อมูลสำเร็จ", message["json_str"], message["json_type"]);
}//message_show

</script>