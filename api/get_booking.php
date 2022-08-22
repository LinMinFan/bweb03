<?php
include "../base.php";
$ods=$orders->all(['movie'=>$_GET['movie'],'date'=>$_GET['date'],'session'=>$_GET['session']]);
$seats=[];
foreach($ods as $ord){
    $s=unserialize($ord['set']);
    $seats=array_merge($seats,$s);
}
?>

<style>
#book_box{
    width: 540px;
    height: 370px;
    padding-top: 19px;
    background:url("./icon/03D04.png");
    margin: 0 auto;
}
.seats{
    width: 316px;
    height: 340px;
    margin: auto;
    /* background: #f00; */
    display: flex;
    flex-wrap: wrap;
}
.seat{
    position: relative;
    width: 20%;
    height: 25%;
    background: url(./icon/03D02.png);
    background-position: center;
    background-repeat: no-repeat;
}
.seat.active{
    background: url(./icon/03D03.png);
    background-position: center;
    background-repeat: no-repeat;
}
.chk_box{
    position: absolute;
    bottom: 0;
    right: 0;
}
</style>

<div id="book_box">
    <div class="seats">
        <?php
            for ($i=0; $i < 20; $i++) {
                if(!in_array($i,$seats)){
                    ?>
                        <div class="seat">
                        <span>
                            <?=($i%4)+1;?>排
                            <?=($i%5)+1;?>號
                        </span>
                        <input class="chk_box" type="checkbox" name="seat" value="<?=$i;?>">
                    </div>
                    <?php
                }else {
                    ?>
                        <div class="seat active">
                        <span>
                            <?=($i%4)+1;?>排
                            <?=($i%5)+1;?>號
                        </span>
                    </div>
                    <?php
                }
                ?>
                    
                        
                <?php
            }
        ?>
    </div>
</div>
<div style="width: 540px;margin:10px auto;">
    <div style="width:60%;margin:10px auto;">
        <div>您選擇的電影是: <span id="chk_mm"></span></div>
        <div>您選擇的時刻是 <span id="chk_time"></span>&nbsp;&nbsp;&nbsp;<span id="chk_class"></span></div>
        <div>您已經勾選<span id="tickets"></span>張票，最多可購買四張票</div>
        <div>
            <button onclick="$('#order,#booking').toggle();">上一步</button>
            <button onclick="checkout()" id="chkout" data-text="">訂購</button>
        </div>
    </div>

</div>

<script>
function checkout(){
    let seats=$('#chkout').data('text');
    let movieName=info.movieName;
    let date=info.date;
    let session=info.session;
    $.post("./api/order.php",{movieName,date,session,seats},(no)=>{
        location.href="?do=result&no="+no;
    })
}
</script>