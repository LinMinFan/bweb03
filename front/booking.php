<?php
include "../base.php";
$mv=$movies->find($_POST['id']);
$seats=(!empty($orders->find(['name'=>$mv['name'],'date'=>$_POST['date'],'session'=>$_POST['session']])['seats']))?unserialize($orders->find(['name'=>$mv['name'],'date'=>$_POST['date'],'session'=>$_POST['session']])['seats']):[];
?>
<style>
    .bg_box{
        width: 540px;
        height: 370px;
        background: url(./icon/03D04.png);
    }
    .seats_bg{
        top: 20px;
        width: 316px;
        height: 340px;
    }
    .seat{
        width: 60px;
        height: 80px;
        background: url(./icon/03D02.png);
        background-repeat: no-repeat;
        background-size: cover;
    }
    .seat.active{
        background: url(./icon/03D03.png);
        background-repeat: no-repeat;
        background-size: cover;
    }
    .s_ck{
        right:  0;
        bottom: 0;
    }
</style>
<div class="bg_box pos_r mg">
    <div class="seats_bg pos_a pos_ct flex flex_w flex_jb" data-text="">
    <?php
        for ($i=0; $i < 20; $i++) { 
            if (in_array($i,$seats)) {
                ?>
                <div class="seat pos_r active">
                </div>
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
<div class="w100 ct">
    <table class="w60 mg">
        <tr>
            <td>您選擇的電影是: <span class="name"><?=$mv['name'];?></span></td>
            <td></td>
        </tr>
        <tr>
            <td>您選擇的時刻是: <span class="date"><?=$_POST['date'];?></span> <span class="session"><?=$_POST['session'];?></span></td>
            <td></td>
        </tr>
        <tr>
            <td>您已經勾選<span id="len"></span>張票，最多可以購買四張票</td>
            <td></td>
        </tr>
    </table>
    <div class="ct">
    <button onclick="$('#booking').hide(),$('#orders').show()">上一步</button>    
    <button onclick="tickets()">訂購</button>    
    </div>
</div>
<script>
    let seats=new Array;
    $('.s_ck').on('change',function(){
    let len=seats.length;
    if ($(this).prop('checked')) {
        if (len >= 4) {
            alert("最多只能勾選四個座位");
            $(this).prop('checked',false);
        }else{
            seats.push($(this).val());
            $(this).parent().toggleClass('active');
        }
    }else{
        seats.splice(seats.indexOf($(this).val()),1);
        $(this).parent().toggleClass('active');
    }
    $('#len').text(seats.length);
    $('.seats_bg').data('text',seats);
})
function tickets(){
    let name=$('.name').text();
    let session=$('.session').text();
    let date=$('.date').text();
    $.post("./api/result.php",{name,date,session,seats},(no)=>{
        location.href="?do=result&no="+no;
    })
}
</script>