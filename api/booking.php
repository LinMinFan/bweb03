<?php
include "../base.php";
$used=[];
foreach ($orders->all(['name'=>$_POST['name'],'date'=>$_POST['date'],'session'=>$_POST['session']]) as $key => $ord) {
    $used=array_merge($used,unserialize($ord['seat']));
}
?>
<style>
.seatbox{
    width: 314px;
    height: 340px;
    top: 20px;
    /* background: #f00; */
}
.ch_box{
    bottom: 0;
    right: 0;
}
</style>
<div id="mm">
    <div class="w100 pos_r h400">
        <div class="seats pos_a pos_ct">
            <div class="seatbox pos_a pos_ct flex flex_jb flex_ac flex_w" data-text="">
                <?php
                for ($i=0; $i < 20; $i++) { 
                    if (in_array($i,$used)) {
                        ?>
                    <div class="seat pos_r active">
                        <span><?=floor(($i/5))+1;?>排<?=($i%5)+1;?>號</span>
                        </div>
                    <?php
                    }else {
                    ?>
                    <div class="seat pos_r">
                        <span><?=floor(($i/5))+1;?>排<?=($i%5)+1;?>號</span>
                        <input class="pos_a ch_box" type="checkbox"  value="<?=$i;?>">
                    </div>
                    <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="w100 h100">
        <div class="ct">
            您選擇的電影是: <span id="ch_n"><?=$_POST['name'];?></span>
        </div>
        <div class="ct">
            您選擇的時刻是:<span id="ch_d"><?=$_POST['date'];?></span>&nbsp;<span id="ch_s"><?=$_POST['session'];?></span>
        </div>
        <div class="ct">
            您已經勾選<span id="ch_t"></span>張票:最多可以購買四張票
        </div>
        <div class="ct">
            <button onclick="$('#booking').hide(),$('#order').show()">上一步</button>
            <button onclick="booking()">訂購</button>
        </div>
    </div>
</div>
<script>
    let tk_s=new Array;
    $('.ch_box').on('change',function(){
        let len=tk_s.length;
        let i=$(this).val();
        if ($(this).prop('checked')) {
            if (len>=4) {
                alert("最多只能勾選四個座位");
                $(this).prop('checked',false);
            }else {
                tk_s.push(i);
                $(this).parent().toggleClass('active');
            }
        }else{
            tk_s.splice(tk_s.indexOf(i),1);
            $(this).parent().toggleClass('active');
        }
        $('#ch_t').text(tk_s.length);
        $('.seatbox').data('text',tk_s);
    })

    function booking(){
        let name=$('#ch_n').text();
        let date=$('#ch_d').text();
        let session=$('#ch_s').text();
        let seat=$('.seatbox').data('text');
        let qt=seat.length;
        $.post("./api/orders.php",{name,date,session,seat,qt},(no)=>{
            location.href='?do=result&no='+no;
        })
    }
</script>