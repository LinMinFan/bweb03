<?php
$id=$_GET['id']??"";
?>
<div id="mm">
<div class="w100 ct" id="orders">
  <table class="w30 mg">
    <tr>
      <td class="w30">電影:</td>
      <td class="w50"><select name="name" id="name">
      <?php
      foreach ($movies->all($sh," && `date` between '$start_day' AND '$today' order by `rank`") as $key => $mv) {
        ?>
        <option value="<?=$mv['id'];?>"><?=$mv['name'];?></option>
        <?php
      }
      ?>
    </select></td>
    </tr>
    <tr>
    <td class="w30">日期:</td>
      <td class="w50">
      <select name="date" id="date">

      </select>
      </td>
    </tr>
    <tr>
      <td class="w30">場次:</td>
      <td class="w50">
      <select name="times" id="times">
    
    </select>
      </td>
    </tr>
  </table>
  <div class="ct">
    <button onclick="booking()">確定</button>
    <button onclick="reload()">重置</button>
  </div>
 </div>
</div>
<div class="dpn" id="booking"></div>
</div>
<script>
  let id=$('#name').val();
  get_date(id);
  function get_date(id){
    $("#date").load("./front/get_date.php",{id},()=>{
      let date=$("#date").val();
      get_times(id,date);
    })
  }
  function get_times(id,date){
    $("#times").load("./front/get_times.php",{id,date},()=>{
      
    })
  }
</script>