<?php
include "../base.php";
$checked=[];
foreach ($orders->all(['name'=>$_POST['name'],'date'=>$_POST['date'],'session'=>$_POST['session']]) as $key => $ord) {
  $checked=array_merge($checked,unserialize($ord['seats']));
}
?>
<style>
  .seats_bg{
    width: 540px;
    height: 370px;
    background: url(./icon/03D04.png);
  }
  .osdbox{
    width: 540px;
    height: 370px;
    margin: 0 auto;
  }
  .seats{
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    width: 314px;
    height: 340px;
  }
  .seat{
    width: 60px;
    height: 80px;
    background: url(./icon/03D02.png);
    background-repeat: no-repeat;
  }
  .seat.active{
    width: 60px;
    height: 80px;
    background: url(./icon/03D03.png);
    background-repeat: no-repeat;
  }
  .ck_box{
    right: 0;
    bottom: 0;
  }
</style>
  <div class="w100 pos_r osdbox">
    <div class="seats_bg pos_a pos_ct">
      <div class="seats pos_r flex flex_w flex_jb flex_ac">
        <?php
        for ($i=0; $i < 20; $i++) {
          if (in_array($i,$checked)) {
            ?>
              <div class="seat pos_r active">
              </div>
            <?php
          }else  {
            ?>
          <div class="seat pos_r">
            <input type="checkbox" class="pos_a ck_box" value="<?=$i;?>">
          </div>
          <?php
          }
        }
        ?>
      </div>
    </div>
  </div>
  <div class="w100 h100 ct">
    <div>您選擇的電影是: <span class="c_name"><?=$_POST['name'];?></span></div>
    <div>您選擇的時刻是: <span class="c_date"><?=$_POST['date'];?></span> <span class="c_session"><?=$_POST['session'];?></span></div>
    <div>您已勾選 <span class="c_len"></span>張票，最多可以購買四張票</div>
    <div class="ct">
      <button onclick="$('#booking').hide(),$('#orders').show()">上一步</button>
      <button onclick="ticket()">訂購</button>
    </div>
  </div>
<script>
  let seats=new Array;
$('.ck_box').on('change',function(){
  let len=$('.ck_box:checked').length;
  if ($(this).prop('checked')) {
    if (len>4) {
      alert("最多只可以購買四張票");
      $(this).prop('checked',false);
    }else{
      seats.push($(this).val());
      $(this).parent().toggleClass('active');
    }
  }else{
    seats.splice(seats.indexOf($(this).val()),1);
    $(this).parent().toggleClass('active');
  }
  console.log(seats);
  $('.c_len').text(seats.length);
})

function ticket(){
  let name=$('.c_name').text();
  let date=$('.c_date').text();
  let session=$('.c_session').text();
  $.post("./api/ticket.php",{name,date,session,seats},(no)=>{
    front(`result&no=${no}`);
  })
}
</script>