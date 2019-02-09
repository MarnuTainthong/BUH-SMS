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
        <li><a href="<?php echo site_url().$this->config->item('admin')."/Sms_state_project/" ?>">บันทึกผลการดำเนินโครงการ</a></li>
        <li class="active">โครงการ<span id="tab_prj_name"></span></li>
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
                <h3 class="box-title">จัดการโครงการ</h3>
             <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <table class="table table-bordered" width="100%" cellspacing="0" id="prj_info_table">
                                <tr>
                                    <td width="15%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>ปีงบประมาณ</b></td>
                                    <td><span id="year_name">ปีงบประมาณ</span></td>
                                </tr>
                                <tr>
                                    <td width="15%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>ส่วนงาน</b></td>
                                    <td><span id="prj_site_name">ส่วนงาน</span></td>
                                </tr>
                                <tr>
                                    <td width="15%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>ชื่อโครงการ</b></td>
                                    <td><span id="prj_name">ชื่อโครงการ</span></td>
                                </tr>
                                <tr>
                                    <td width="15%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>รหัสโครงการ</b></td>
                                    <td><span id="prj_code">รหัสโครงการ</span></td>
                                </tr>
                                <tr>
                                    <td width="15%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>ลักษณะโครงการ</b></td>
                                    <td><span id="prj_type">ลักษณะโครงการ</span></td>
                                </tr>
                                <tr>
                                    <td width="15%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>ระยะเวลาโครงการ</b></td>
                                    <td><span id="prj_duration">ระยะเวลาโครงการ</span></td>
                                </tr>
                                <tr>
                                    <td width="15%" style="background-color:<?php echo $this->config->item('table_tr_show_info'); ?>;"><b>งบประมาณ</b></td>
                                    <td><span id="prj_bdgt">งบประมาณ</span></td>
                                </tr>
                            </table>
                        </div>
                        <!-- ./col md 12 -->
                    </div>
                    <!-- /.col md 12 -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2">
                        <button id="btn_add_state" type="button" class=" <?php echo $this->config->item('btn_add_color'); ?>" onclick="" data-toggle="modal" data-target="#modal_add_state"><i class=" <?php echo $this->config->item('sms_icon_add'); ?>" aria-hidden="true"></i> บันทึกผลการดำเนินโครงการ</button>
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

                <div class="row">
                    <div class="col-md-12">
                        <!-- ตาราง datatable  -->
                        <div class="col-md-12">
                        <div class="box box-widget">
                            <div class="box-body">
                                <table id="prj_dataTable" class="table table-bordered table-striped dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background-color:<?php echo $this->config->item('table_header'); ?>;">
                                            <th width="5%" rowspan="2">ลำดับ</th>
                                            <th width="10%" rowspan="2">สถานะ</th>
                                            <th width="15%" rowspan="2">วันที่ดำเนินการ</th>
                                            <th width="50" colspan="4">งบประมาณที่ใช้ในการดำเนินการ (บาท)</th>
                                            <th width="5%" rowspan="2">เอกสารประกอบ</th>
                                            <th width="15%" rowspan="2">ดำเนินการ</th>
                                        </tr>
                                        <tr style="background-color:<?php echo $this->config->item('table_header'); ?>;">
                                            <th>เงินแผ่นดิน</th>
                                            <th>เงินรายได้</th>
                                            <th>แหล่งทุนอื่น</th>
                                            <th>รวม</th>
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


                <div class="modal fade" id="modal_add_state" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title">บันทึกข้อมูลสถานะ</h4>
                        </div>
                        <div class="modal-body">
                            <p>One fine body…</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="<?php echo $this->config->item('btn_close_modal')?> pull-left" data-dismiss="modal"><?php echo $this->config->item("txt_cancel")?></button>
                            <button type="button" class="<?php echo $this->config->item('btn_success')?>"><?php echo $this->config->item("txt_save")?></button>
                        </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>     
            

            </div>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        </div>
        <!-- ./ col md 12 -->
    </div>
    <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">

$(document).ready(function () {

    set_data();
    get_table_show();
    
});
// end doc-ready

function get_table_show() {
    $("#prj_dataTable").dataTable({
            //     processing: true,
            //     bDestroy: true,
            //     ajax:{
            //         type: "POST",
            //         url: "<?php echo site_url().'/admin/Sms_state_project/get_prj_show'; ?>",
            //         data: {year_id:year_id},
            //         dataType : "json",
            //         dataSrc : function(data){
            //             var return_data = new Array();
            //             $(data).each(function(seq, data ) {
            //                 return_data.push({
            //                 "prj_seq" : data.prj_seq,
            //                 "prj_code" : data.prj_code,
            //                 "prj_name" : data.prj_name,
            //                 "prj_respon" : data.prj_respon,
            //                 "prj_duration" : data.prj_duration,
            //                 "prj_action" : data.prj_action
            //             });
            //             });
            //             console.log(return_data);             
            //             return return_data;
            //         }//end dataSrc
            // }, //end ajax
            // "columns" :[
            //     {"data": "prj_seq"},
            //     {"data": "prj_code"},
            //     {"data": "prj_name"},
            //     {"data": "prj_respon"},
            //     {"data": "prj_duration"},
            //     {"data": "prj_action"}
            // ]
                    
            });
}

function set_data() {
    var prj_id = <?php echo($prj_id); ?>;

    $.ajax({
        type : "POST",
        url : "<?php echo site_url()."/admin/Sms_project_manage/get_prj_set_data"; ?>",
        data : {prj_id:prj_id},
        dataType : "json",
        success : function(data){
            console.log(data);
            $("#year_name").text(data['year_name']);
            $("#prj_site_name").text(data['prj_site_name']);
            $("#prj_name").text(data['prj_name']);
            $("#tab_prj_name").text(data['prj_name']);
            $("#prj_code").text(data['prj_code']);
            // $("#prj_type").text(data['prj_type']);
            if(data['prj_type']==0)  $("#prj_type").text('โครงการต่อเนื่อง');
            else  $("#prj_type").text('โครงการใหม่');
            $("#prj_duration").text(data['prj_start']+' ถึง '+data['prj_end']);
            $("#prj_bdgt").text(Number(data['prj_set_bdgt_land'])+Number(data['prj_set_bdgt_fcty'])+Number(data['prj_set_bdgt_oth'])+' บาท');
        }
    });
}
// set data

function message_show(message,frm_name){
    // console.log("frm_name = "+frm_name);
    if (frm_name == "" || frm_name == null) {
        swal("บันทึกข้อมูลสำเร็จ", message["json_str"], message["json_type"]);
    }else{
        document.getElementById(frm_name).reset();
        swal("บันทึกข้อมูลสำเร็จ", message["json_str"], message["json_type"]);
    }
    // set_form_ready();
    
}//message_show

</script>