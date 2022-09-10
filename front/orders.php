<?php
$id=$_GET['id']??0;
?>
<div id="mm">
<div id="orders">
<table class="w60 mg">
  <tr>
    <td>電影:</td>
    <td>
      <select name="" id="name">
        <?php
        foreach ($movies->all($sh," && `date` between '$start_day' AND '$today' $rank") as $key => $mv) {
          ?>
          <option value="<?=$mv['id'];?>" <?=($id==$mv['id'])?"selected":"";?>><?=$mv['name'];?></option>
          <?php
        }
        ?>
      </select>
    </td>
  </tr>
  <tr>
    <td>日期:</td>
    <td>
      <select name="" id="date"></select>
    </td>
  </tr>
  <tr>
    <td>場次:</td>
    <td>
      <select name="" id="times"></select>
    </td>
  </tr>
</table>
<div class="ct">
  <button onclick="">確定</button>
  <button onclick="reload()">重置</button>
</div>
</div>
<div id="booking" class="dpn"></div>
 </div>

 <script>
  let id=$('#name').val();
  date_list(id);
  function date_list(id){
    $('#date').load("./front/date_list.php",{id},()=>{
      let date=$('#date').val();
      times_list(id,date);
    })
  }
  function times_list(id,date){
    $('#times').load("./front/times_list.php",{id,date},()=>{
     
    })
  }
  $('#name').on('change',function(){
    id=$('#name').val();
    date_list(id);
  })
  $('#date').on('change',function(){
    id=$('#name').val();
    let date=$('#date').val();
      times_list(id,date);
  })
 </script>