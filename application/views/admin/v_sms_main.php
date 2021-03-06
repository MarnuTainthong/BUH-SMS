<script type="text/javascript">


$(document).ready(function () {
 
  setPageActive();
  setMenuSidebar();
  // $(document).trigger("resize");
  
});

function setPageActive() {
  var url = window.location;
  // console.log(url);
  var element = $('ul.sidebar-menu a').filter(function () {
    return this.href == url || url.href.indexOf(this.href) == 0;
  });
  // console.log("element = "+element);
  $(element).parentsUntil('ul.sidebar-menu', 'li').addClass('active');
}
// active sidemenu ตอนกดเลือกเมนู

function setMenuSidebar() {
  if(localStorage.expandedMenu==0) {
    $("body").addClass('sidebar-collapse');
  }

  $('body').bind('expanded.pushMenu', function() {
    localStorage.expandedMenu = 1;
  });

  $('body').bind('collapsed.pushMenu', function() {
    localStorage.expandedMenu = 0;
  });
}
// แสดง sidemenu ตามที่ผู้ใช้เลือกก่อนหน้า


function ToggleTable(nameblock){
  var x=document.getElementById(nameblock);
  if(x.style.display =='none'){
    x.style.display = 'block';
  }else{
    x.style.display = 'none';
  }
}
// toggle ซ่อน/แสดง panel

function hide_panel(panal) {
  $("#"+panal).hide();
}
// ซ่อน panel

function show_panel(panal) {
  $("#"+panal).show();
}
// ซ่อน panel

function unlock(nameid){
  nameid = "#" + nameid;
  $(nameid).prop('disabled', false);
}
//show

function lock(nameid){
  nameid = "#" + nameid;
  $(nameid).prop('disabled', true);
}
//hide

function noti_error(title="",text="") {
  new PNotify({
    title: title,
    text: text,
    icon: '<?php echo($this->config->item("sms_icon_error")); ?>',
    type: 'error'
});
}

</script>

<style>
th {
    text-align: center;
}
thead > tr:first-child{
    text-align: center;
}

.table_topic{
  background: #f4f4f4;
  font-weight: bold;
}

.lb-radio{
  font-size: 15px;
}
/* font size labelof radio */

input[type="radio"] {
    -ms-transform: scale(1.5); /* IE 9 */
    -webkit-transform: scale(1.5); /* Chrome, Safari, Opera */
    transform: scale(1.5);
}

</style>