<script type="text/javascript">


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