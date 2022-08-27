<?php
$id=$_GET['id']??0;
$mvs=$movie->all($sh," && `ondate` between '$start_day' AND '$today' order by `rank`");
?>
<div id="mm">
<div id="order">
  <h4 class="ct">線上訂票</h4>
  <table class="w60 mg">
    <tr>
      <td>電影:</td>
      <td>
        <select name="" id="m_s">
          <?php
          foreach ($mvs as $key => $mv) {
            ?>
            <option value="<?=$mv['id'];?>" <?=($mv['id']==$id)?"selected":"";?>><?=$mv['name'];?></option>
            <?php
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>日期:</td>
      <td>
        <select name="" id="d_s">

        </select>
      </td>
    </tr>
    <tr>
      <td>場次:</td>
      <td>
      <select name="" id="s_s">
      </td>
    </tr>
  </table>
  <div class="w100 ct">
    <button type="button" onclick="get_booking()">確定</button>
    <button type="button" onclick="location.reload()">重置</button>
  </div>
</div>
<div id="booking" style="display:none;"></div>

</div>

<script>
let id=$('#m_s').val();
get_date(id);

function get_date(id){
  $('#d_s').load("./api/get_date.php",{id},()=>{
    let date=$('#d_s option:selected').val();
    get_session(id,date);
  })
}
function get_session(id,date){
  $('#s_s').load("./api/get_session.php",{id,date},()=>{
  
  })

}

  function get_booking(){
    $('#order').hide();
    $('#booking').show();
    let name=$('#m_s option:selected').text();
    let date=$('#d_s').val();
    let session=$('#s_s').val();
    $('#booking').load("./api/booking.php",{name,date,session},()=>{

    })
  }
</script>