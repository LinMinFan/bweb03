<?php
include "../base.php";
$_POST['name'];
$_POST['date'];
$_POST['session'];
$qt=[];
foreach ($orders->all(['name'=>$_POST['name'],'date'=>$_POST['date'],'session'=>$_POST['session']]) as $key => $ord) {
    $qt=array_merge($qt,unserialize($ord['seats']));
}
$countO=count($qt);
?>
<style>
    .seats_bg{
        width: 540px;
        height: 370px;
        background: url(./icon/03D04.png);
    }
    .seats{
        top: 20px;
        width: 316px;
        height: 340px;
    }
    .seat{
        width: 60px;
        height: 80px;
        background: url(./icon/03D02.png);
        background-size: cover;
        background-repeat: no-repeat;
    }
    .seat.active{
        width: 60px;
        height: 80px;
        background: url(./icon/03D03.png);
        background-size: cover;
        background-repeat: no-repeat;
    }
    .s_ck{
        right: 0;
        bottom: 0;
    }
</style>
<div class="w100 pos_r" style="height: 370px;">
    <div class="pos_a pos_ct seats_bg">
    <div class="seats flex flex_jb flex_ac flex_w pos_a pos_ct">
        <?php
        for ($i=0; $i < 20; $i++) { 
            if (in_array($i,$qt)) {
                ?>
                    <div class="seat active"></div>
                <?php
            }else{
                ?>
                    <div class="seat pos_r">
                        <input class="pos_a s_ck" type="checkbox" name="" value="<?=$i;?>">
                    </div>
                <?php
            }
        }
        ?>
    </div>
    </div>
</div>
<div class="w100 h100">
    <div class="ct">您選擇的電影是: <span id="name"><?=$_POST['name'];?></span></div>
    <div class="ct">您選擇的時刻是: <span id="date"><?=$_POST['date'];?></span> <span id="session"><?=$_POST['session'];?></span></div>
    <div class="ct">您已勾選<span id="len" data-text=""></span>張票，最多可購買四張票</div>
</div>
<div class="ct">
    <button onclick="$('#booking').hide(),$('#orders').show();">上一步</button>
    <button onclick="tickets()">訂購</button>
</div>
<script>
    let seats=new Array;
    $('.s_ck').on('change',function(){
        let len=$('.s_ck:checked').length;
        if ($(this).prop('checked')) {
            if (len>4) {
                alert("最多只能買四張票");
                $(this).prop('checked',false);
            }else{
                $(this).parent().toggleClass('active');
                seats.push($(this).val());
            }
        }else{
            $(this).parent().toggleClass('active');
            seats.splice(seats.indexOf($(this).val()),1);
        }
        $('#len').text($('.s_ck:checked').length);
        $('#len').data('text',seats);
    })

    function tickets(){
        let name=$('#name').text();
        let date=$('#date').text();
        let session=$('#session').text();
        $.post("./api/tickets.php",{name,date,session,seats},(no)=>{
            front(`result&no=${no}`);
        })
    }
</script>
