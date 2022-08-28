<?php
include "../base.php";
$rv=[];
foreach ($orders->all(['name'=>$_POST['name'],'date'=>$_POST['date'],'session'=>$_POST['session']]) as $key => $ord) {
    $rv=array_merge($rv,unserialize($ord['seats']));
}
?>
<style>
    .seat_bg{
        width: 540px;
        height: 370px;
        background: url(./icon/03D04.png);
    }
    .seatbox{
        top: 20px;
        width: 316px;
        height: 340px;
        /* background: #f00; */
    }
    .seat{
        width: 60px;
        height: 80px;
        background: url(./icon/03D02.png);
        background-size: cover;
    }
    .seat.active{
        background: url(./icon/03D03.png);
        background-size: cover;
    }
    .seat_chk{
        bottom: 0;
        right: 0;
    }
</style>
<div class="seat_bg mg pos_r">
<div class="seatbox pos_a pos_ct flex flex_w flex_jb flex_ac" data-text="">
    <?php
    for ($i=0; $i < 20; $i++) {
        if (in_array($i,$rv)) {
            ?>
            <div class="seat pos_r active">
                <span><?=floor(($i/5))+1;?>排<?=($i%5)+1;?>號</span>
            </div>
            <?php
        }else{
            ?>
            <div class="seat pos_r">
                <span><?=floor(($i/5))+1;?>排<?=($i%5)+1;?>號</span>
                <input class="pos_a seat_chk" type="checkbox" name="" value="<?=$i;?>">
            </div>
        <?php
        }
    }
    ?>

</div>
</div>
<div class="w100 h100 clo">
    <div class="ct">您選擇的電影是:<span id="ck_n"><?=$_POST['name'];?></span></div>
    <div class="ct">您選擇的時刻是:<span id="ck_d"><?=$_POST['date'];?></span><span id="ck_s"><?=$_POST['session'];?></span></div>
    <div class="ct">您已勾選<span id="t_length"></span>張票，最多可以購買四張票</div>
   <div class="ct">
    <button onclick="$('#booking').hide(),$('#orders').show()">上一步</button>
    <button onclick="ticket()">訂購</button>
   </div> 
</div>
<script>
let seats=new Array;
$('.seat_chk').on('change',function(){
    let len=seats.length;
    if ($(this).prop('checked')) {
        if (len>=4) {
            alert("最多只能勾選四個座位")
            $(this).prop('checked',false)
        }else{
            seats.push($(this).val());
            $(this).parent().toggleClass('active');
        }
    }else{
        seats.splice(seats.indexOf($(this).val()),1);
        $(this).parent().toggleClass('active');
    }
    $('#t_length').text(seats.length)
    $('.seatbox').data('text',seats)
})

function ticket(){
    let name=$('#ck_n').text();
    let date=$('#ck_d').text();
    let session=$('#ck_s').text();
    let seats=$('.seatbox').data('text')
    $.post("./api/ticket.php",{name,date,session,seats},(no)=>{
        console.log(no);
        location.href="./index.php?do=result&no="+no;
    })
}
</script>