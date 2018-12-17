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
        <li class="active">ปีงบประมาณ</li>
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
                <h3 class="box-title">ข้อมูลพื้นฐานปีงบประมาณ</h3>
             <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <button id="btn_add_year" type="button" class=" <?php echo $this->config->item('btn_add_color'); ?>" data-tooltip="คลิกเพื่อเพิ่มปีงบประมาณ" onclick="add_year()"><i class=" <?php echo $this->config->item('sms_icon_add'); ?>" aria-hidden="true"></i> เพิ่มปีงบประมาณ</button>
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
                <div class="row" id="row_add_year" style="display:none;">
                    <div class="col-md-12">
                        <div class="col-md-4">
                        </div>
                        <!-- /.col md 4 -->
                        <div class="col-md-4">
                            <div class="box box-solid <?php echo"box-".$this->config->item('panel_header_color'); ?>">
                                <div class="box-header">
                                    <h3 class="box-title">บันทึกข้อมูลปีงบประมาณ</h3>
                                </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                            </div>
                            <!-- /.box body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col md 4 -->
                        <div class="col-md-4">
                        </div>
                        <!-- /.col md 4 -->
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
                                            <th>ปีงบประมาณ</th>
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
    
    $("#data_table").dataTable({
        processing: true,
        bDestroy: true,
        ajax:{
            type: "POST",
            url: "<?php echo site_url().'/admin/Sms_base_data/get_year_show'; ?>",
            dataSrc : function(data){
                var return_data = new Array();
                $(data).each(function(seq, data ) {
				    return_data.push({
                       "year_seq" : data.year_req,
                       "year_name" : data.year_name,
                       "year_action" : data.year_action
                   });
                });
                console.log(return_data);             
                return return_data;
            }//end dataSrc
    }, //end ajax
    "columns" :[
        {"data": "year_seq"},
        {"data": "year_name"},
        {"data": "year_action"}
    ],
	"fnRowCallback": function(nRow, aData, iDisplayIndex) {
		nRow.setAttribute("id","tr_"+aData.year_id);
		nRow.setAttribute("class","tr_table");
	}
              
    });

}
// ./get_table_show

function remove_year(year_id) {
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
            url : "<?php echo site_url().'/admin/Sms_base_data/ajax_del_year/'; ?>",
            data : {year_id:year_id},
            dataType : "json",
            success : function(data){
                get_table_show();
                message_show(data);
            }
        });//end ajax

    });
}
// ./remove year

function add_year() {

    $.ajax({
        type : "POST",
        url : "<?php echo site_url().'/admin/Sms_base_data/ajax_add_year/'; ?>",
        dataType : "json",
        success : function(data){
            get_table_show();
            message_show(data);
        }
    });//end ajax
}

function message_show(message){
    get_table_show();
    swal("บันทึกข้อมูลสำเร็จ", message["json_str"], message["json_type"]);
}//message_show


</script>