<?php
$id=$_GET['id']??0;
?>
<div id="mm">
  <div class="w100" id="orders">
  <h3 class="ct">線上訂票</h3>
  <table class="w60 mg">
    <tr>
      <td>電影"</td>
      <td>
        <select name="name" id="sn">
          <?php
          foreach ($movies->all($sh, " &&  `ondate` BETWEEN '$start_day' AND '$today' order by `rank`") as $key => $mv) {
            ?>
            <option value="<?=$mv['id'];?>"<?=($mv['id']==$id)?"selected":"";?>><?=$mv['name'];?></option>
            <?php
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>日期:</td>
      <td>
      <select name="date" id="sd">

      </select>
      </td>
    </tr>
    <tr>
      <td>場次:</td>
      <td>
      <select name="session" id="ss">

      </select>
      </td>
    </tr>
  </table>
  <div class="ct">
    <button onclick="booking()">確定</button>
    <button onclick="location.reload()">重置</button>
  </div>
</div>
<div class="w100" id="booking" style="display:none;"></div>
</div>
<script>
  let id=$('#sn option:selected').val();
  get_date(id);
  $('#sn').on('change',function(){
    id=$('#sn option:selected').val();
    get_date(id);
  })
  $('#sd').on('change',function(){
    date=$('#sd option:selected').val();
      get_session(id,date);
  })
  function get_date(id){
    $('#sd').load("./api/get_date.php",{id},()=>{
      let date=$('#sd option:selected').val();
      get_session(id,date);
    })
  }
  function get_session(id,date){
    $('#ss').load("./api/get_session.php",{id,date},()=>{

    })
  }

  function booking(){
    let name=$('#sn option:selected').text();
    let date=$('#sd option:selected').val();
    let session=$('#ss option:selected').val();
    $('#orders').hide();
    $('#booking').show();
    $('#booking').load("./api/booking.php",{name,date,session},()=>{

    });
  }
</script>