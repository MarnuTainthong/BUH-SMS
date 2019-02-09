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
        <li class="active"><a href="#">บันทึกผลการดำเนินโครงการ</a></li>
      </ol>
    <!-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
        </ol>
    </nav> -->
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
                <h3 class="box-title">บันทึกผลการดำเนินโครงการ</h3>
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
                    url: "<?php echo site_url().'/admin/Sms_state_project/get_prj_show'; ?>",
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