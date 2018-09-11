<script type="text/javascript">


$(document).ready(function () {
 
  setPageActive();
  setMenuSidebar();
  
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
// ซ่อน/แสดง panel

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

</script>

<style>
th {
    text-align: center;
}
thead > tr:first-child{
    text-align: center;
}
</style>