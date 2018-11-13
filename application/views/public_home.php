<style>
	/* text format */
	#txt_title {
		text-align: center;
	}
	/* box color */
	#div_vis_box {
		background-color: #52BE80;
	}
	#div_mis_box {
		background-color: #7DCEA0;
	}
	#div_str_box {
		background-color: #A9DFBF;
	}
	#div_poi_box {
		background-color: #E9F7EF;
	}
	
	#div_sstr_box1 {
		background-color: #bdc3c7;
	}
	#div_sstr_box2 {
		background-color: #cacfd2;
	}
	#div_sstr_box3 {
		background-color: #d7dbdd;
	}
	#div_sstr_box4 {
		background-color: #e5e7e9;
	}
	#div_sstr_box5 {
		background-color: #f2f3f4;
	}
	#div_sstr_box6 {
		background-color: #f8f9f9;
	}
	#topic {
		text-align: center;
		font-weight: bold;
	}

</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

      <!-- Page Content Here -->
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">

					<div class="row">
						<div class="col-md-4">
						</div>
						<!-- ./col md 4 -->
							<label class="col-md-1 control-label" >ปีงบประมาณ</label>
						<div class="col-md-2">
							<select name="year_name" id="year_name" onchange="load_data();"></select>
						</div>
						<!-- ./col md 2 -->
						</div>
						<!-- ./row year -->
					</div>
					<div class="box-body no-padding">
						<div class="row">
							<span id="txt_title"><h4 class="box-title">แผนที่ยุทธศาสตร์การพัฒนาคณะแพทยศาสตร์ มหาวิทยาลัยบูรพา</h4></span>
						</div>
					</div>
				</div>
			</div>
			<!-- ./col md 12 -->
		</div>
		<!-- ./row -->


		<div class="row">
			<div class="col-md-12">
				<div class="box box-solid">
					<div class="box-body">

						<div class="row">
							<div class="col-md-12">

								<div class="row">
									<div class="col-md-2" id="topic">
										<span id="vis_title">วิสัยทัศน์</span>
									</div>
									<div class="col-md-10">
										<div class="row">
											<div class="col-md-12">
												<div class="box box-solid">
													<div class="box-body" id="div_vis_box">
														<center><span id="vis_text"></span></center>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- ./col md 10 -->
								</div>
								<!-- ./row -->

								<div class="row">
									<div class="col-md-2" id="topic">
										<span id="mis_title">พันธกิจ</span>
									</div>
									<div class="col-md-10" id="div_mis">
									</div>
									<!-- ./col md 10 -->
								</div>
								<!-- ./row -->

								<div class="row">
									<div class="col-md-2" id="topic">
										<span id="str_title">ยุทธศาสตร์</span>
									</div>
									<div class="col-md-10" id="div_str">
									</div>
									<!-- ./col md 10 -->
								</div>
								<!-- ./row -->

								<div class="row">
									<div class="col-md-2" id="topic">
										<span id="poi_title">เป้าประสงค์</span>
									</div>
									<div class="col-md-10" id="div_poi">
									</div>
									<!-- ./col md 10 -->
								</div>
								<!-- ./row -->

								<br>

								<div id="vpt_sstr">
								
								</div>
								<!-- ./vpt_sstr -->

							</div>
							<!-- ./col md 12 -->
						</div>
						<!-- ./row -->

          			</div>
					<!-- ./box body -->
        		</div>
				<!-- ./box -->

			</div>
			<!-- ./col md 12 -->
		</div>
		<!-- ./row -->

    </section>
    <!-- /.content -->

  </div>
<!-- /.content-wrapper -->

<script type="text/javascript">

$(document).ready(function () {

	year_show();
	load_data();

});

function load_data() {

	var year_id = $("#year_name").val();
	console.log('year_id = '+year_id);

	if (year_id == null || year_id == "") {
		year_id = <?php echo $year_select; ?>;
	}else

	get_vis_select(year_id);
	get_mis_select(year_id);
	get_str_select(year_id);
	get_poi_select(year_id);
	create_vpt_sstr(year_id);
}

function year_show() {
    $.ajax({
			type : "POST",
			url : "<?php echo site_url() . "/admin/Sms_base_data/get_year_all"; ?>",
			dataType : "json",
			success : function(data){

				$("#year_name").html(data);
				$("#year_name").select2({width: '100%'});

				var year_select = <?php echo $year_select; ?>;
				$("#year_name").val(year_select).trigger('change');

			}
		});

}
// แสดงปีงบประมาณให้เลือก opt

function get_vis_select(year_id="") {
	$.ajax({
			type : "POST",
			url : "<?php echo site_url() . "/Page_public/get_vis_select"; ?>",
			data : {year_id:year_id},
			dataType : "json",
			success : function(data){
				$("#vis_text").text(data['vis_name']);
			}
		});
}

function get_mis_select(year_id) {
	$.ajax({
			type : "POST",
			url : "<?php echo site_url() . "/Page_public/get_mis_select"; ?>",
			data : {year_id:year_id},
			dataType : "json",
			success : function(data){

				var row = '';
				var count_item = 0;

				console.log('mis = '+$(data).size());

				$(data).each(function(seq,val){
					count_item = seq+1;
					if (count_item == 1 || count_item%6 == 1) {
						row +=	'<div class="row">';
						row +=	'	<div class="col-md-2">';
						row +=	'		<div class="box box-solid">';
						row +=	'			<div class="box-body" id="div_mis_box">';
						row +=	'				<center><span id="mis_text">'+val.mis_name+'</span></center>';
						row +=	'			</div>';
						row +=	'		</div>';
						row +=	'	</div>';
					}
					else{
						row +=	'	<div class="col-md-2">';
						row +=	'		<div class="box box-solid">';
						row +=	'			<div class="box-body" id="div_mis_box">';
						row +=	'				<center><span id="mis_text">'+val.mis_name+'</span></center>';
						row +=	'			</div>';
						row +=	'		</div>';
						row +=	'	</div>';
						// row +=	'</div>';
					}

					if (count_item%6 == 0 || count_item == $(data).size()) {
						row +=	'</div>';
					}
				});
				// end each
				$("#div_mis").html(row);

			}
		});
}
// แสดงพันธกิจ

function get_str_select(year_id) {
	$.ajax({
			type : "POST",
			url : "<?php echo site_url() . "/Page_public/get_str_select"; ?>",
			data : {year_id:year_id},
			dataType : "json",
			success : function(data){

				var row = '';
				var count_item = 0;

				console.log('str = '+$(data).size());

				$(data).each(function(seq,val){
					count_item = seq+1;
					if (count_item == 1 || count_item%6 == 1) {
						row +=	'<div class="row">';
						row +=	'	<div class="col-md-2">';
						row +=	'		<div class="box box-solid">';
						row +=	'			<div class="box-body" id="div_str_box">';
						row +=	'				<center><span id="mis_text">'+val.str_name+'</span></center>';
						row +=	'			</div>';
						row +=	'		</div>';
						row +=	'	</div>';
					}
					else{
						row +=	'	<div class="col-md-2">';
						row +=	'		<div class="box box-solid">';
						row +=	'			<div class="box-body" id="div_str_box">';
						row +=	'				<center><span id="mis_text">'+val.str_name+'</span></center>';
						row +=	'			</div>';
						row +=	'		</div>';
						row +=	'	</div>';
						// row +=	'</div>';
					}

					if (count_item%6 == 0 || count_item == $(data).size()) {
						row +=	'</div>';
					}
				});
				// end each
				$("#div_str").html(row);

			}
		});
}
// แสดงยุทธศาสตร์

function get_poi_select(year_id) {
	$.ajax({
		type : "POST",
		url : "<?php echo site_url() . "/Page_public/get_poi_select"; ?>",
		data : {year_id:year_id},
		dataType : "json",
		success : function(data){

			var row = '';
			var count_item = 0;

			console.log('poi = '+$(data).size());

			$(data).each(function(seq,val){
				count_item = seq+1;
				if (count_item == 1 || count_item%6 == 1) {
					row +=	'<div class="row">';
					row +=	'	<div class="col-md-2">';
					row +=	'		<div class="box box-solid">';
					row +=	'			<div class="box-body" id="div_poi_box">';
					row +=	'				<center><span id="mis_text">'+val.poi_name+'</span></center>';
					row +=	'			</div>';
					row +=	'		</div>';
					row +=	'	</div>';
				}
				else{
					row +=	'	<div class="col-md-2">';
					row +=	'		<div class="box box-solid">';
					row +=	'			<div class="box-body" id="div_poi_box">';
					row +=	'				<center><span id="mis_text">'+val.poi_name+'</span></center>';
					row +=	'			</div>';
					row +=	'		</div>';
					row +=	'	</div>';
					// row +=	'</div>';
				}

				if (count_item%6 == 0 || count_item == $(data).size()) {
					row +=	'</div>';
				}
			});
			// end each
			$("#div_poi").html(row);

		}
	});
}
// แสดงยุทธศาสตร์

function create_vpt_sstr(year_id) {
	$.ajax({
		type : "POST",
		url : "<?php echo site_url() . "/Page_public/create_vpt_sstr"; ?>",
		data : {year_id:year_id},
		dataType : "json",
		success : function(data){
			$("#vpt_sstr").html(data);
		}
	});
}

</script>