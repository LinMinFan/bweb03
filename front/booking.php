<?php
include "../base.php";
$seats=[];
foreach ($orders->all(['name'=>$_POST['name'],'date'=>$_POST['date'],'session'=>$_POST['session']]) as $key => $ord) {
  $seats=array_merge($seats,unserialize($ord['seats']));
};
?>
<style>
  .seats_bg{
    width: 540px;
    height: 370px;
    background: url(./icon/03D04.png);
  }
  .seats{
    width: 314px;
    height: 340px;
    top: 20px;
  }
  .seat{
    width: 60px;
    height: 80px;
    background: url(./icon/03D02.png);
    background-repeat: no-repeat;
    background-size: cover;
  }
  .seat.active{
    width: 60px;
    height: 80px;
    background: url(./icon/03D03.png);
    background-repeat: no-repeat;
    background-size: cover;
  }
  .ck_box{
    right: 0;
    bottom: 0;
  }
</style>
<div id="mm">
    <div class="w100 h400 pos_r t_bg">
      <div class="seats_bg pos_a pos_ct">
        <div class="seats pos_r pos_ct flex flex_w flex_jb flex_ac">
          <?php
          for ($i=0; $i < 20; $i++) { 
            if (in_array($i,$seats)) {
              ?>
              <div class="seat active"></div>
              <?php
            }else{
              ?>
              <div class="seat pos_r">
                <input class="pos_a ck_box" type="checkbox" name="" value="<?=$i;?>">
              </div>
              <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
    <div class="w100 h100 pos_r ct">
      <div>您選擇的電影是: <span class="name"><?=$_POST['name'];?></span> </div>
      <div>您選擇的時刻是: <span class="date"><?=$_POST['date'];?></span> <span class="session"><?=$_POST['session'];?></span></div>
      <div>您已勾選<span class="len"></span>張票，最多可以購買四張票</div>
      <div class="ct">
        <button onclick="$('#booking').hide(),$('#orders').show()">上一步</button>
        <button onclick="tickets()">訂購</button>
      </div>
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
      $('.len').text(len);
      console.log(seats);
    })
    function tickets(){
      let name=$('.name').text();
      let date=$('.date').text();
      let session=$('.session').text();
      $.post("./api/orders.php",{seats,name,date,session},(no)=>{
        location.href=`?do=result&no=${no}`;
      })
    }
  </script>