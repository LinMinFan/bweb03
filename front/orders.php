<?php
$id=$_GET['id']??0;
?>
<div id="mm">
<div id="orders">
  <table class="w60 mg">
    <tr>
      <td>電影:</td>
      <td>
        <select name="name" class="name">
          <?php
          foreach ($movies->all($sh,"&& `ondate` between '$start_day' AND '$today' $rank") as $key => $mv) {
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
        <select name="date" class="date">

        </select>
      </td>
    </tr>
    <tr>
      <td>場次:</td>
      <td>
        <select name="session" class="session">

        </select>
      </td>
    </tr>
  </table>
  <div class="ct">
    <button onclick="booking()">確定</button>
    <button onclick="location.reload()">重置</button>
  </div>
</div>
<div id="booking" class="dpn"></div>
</div>
<script>
  let id=$('.name option:selected').val();
  get_date(id);
  function get_date(id){
    $('.date').load("./front/date.php",{id},()=>{
        let date=$('.date option:selected').val();
        $('.session').load("./front/session.php",{id,date},()=>{
        })
    })
  }
$('.name').on('change',function(){
   id=$('.name option:selected').val()
  get_date(id);
})
$('.date').on('change',function(){
   id=$('.name option:selected').val();
   date=$('.date option:selected').val();
   $('.session').load("./front/session.php",{id,date},()=>{
        })
  })

  function booking(){
    $('#orders').hide();
    let name=$('.name option:selected').text();
    let date=$('.date option:selected').val();
    let session=$('.session option:selected').val();
    $('#booking').show();
    $('#booking').load("./front/booking.php",{name,date,session},()=>{
        })
  }
</script>