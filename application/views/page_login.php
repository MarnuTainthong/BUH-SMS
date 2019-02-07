<?php include(dirname(__FILE__)."/admin/v_sms_main.php"); ?>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo site_url()."/Authen";?>"><b><?php echo $this->config->item('title_system');?></b> <?php echo $this->config->item('title_sub_system');?></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"><b>เข้าสู่<?php echo $this->config->item('title_system_th');?></b></p>

      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="ชื่อผู้ใช้" name="username" id="username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="รหัสผ่าน" name="password" id="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" onclick="chk_login()">เข้าสู่ระบบ</button>
        </div>
        <!-- /.col -->
      </div>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script>

$(document).ready(function () {

  press_enter_to_login();

});

  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });

  function press_enter_to_login() {
    $('input').keypress(function (e) {
      if (e.which == 13) {
        chk_login();
      }
    });
  }
  //press enter to login

  function chk_login() {
    var username = $("#username").val();
    var password = $("#password").val();

    $.ajax({
			type: "POST",
			url: "<?php echo site_url()."/Authen/check_login";?>",
			data: {username:username, password:password},
			dataType : "json",
			success : function(data){
				if(data == false){
          noti_error('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง','กรุณาตรวจสอบข้อมูล');
					$('#username').val("");
					$('#password').val("");
				}else{
					location.reload();
				}
			}//End success
		});
  }

</script>
</body>
</html>