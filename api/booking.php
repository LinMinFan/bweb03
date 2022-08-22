<?php
include "../base.php";
$ods = $orders->all($_POST);
$seats = [];
foreach ($ods as $key => $od) {
    $s = unserialize($od['set']);
    $seats = array_merge($seats, $s);
}

?>
<style>
    .seats {
        width: 316px;
        height: 340px;
        /* background: #ff000050; */
        top: 20px;
    }

    .seat {
        width: 60px;
        height: 80px;
        background: url(./icon/03D02.png);
        background-size: cover;
        background-repeat: no-repeat;
    }

    .seat.active {
        width: 60px;
        height: 80px;
        background: url(./icon/03D03.png);
        background-size: cover;
        background-repeat: no-repeat;
    }

    .chk_seat {
        bottom: 0;
        right: 0;
    }
</style>
<div class="" id="mm">
    <div class="w100 flex flex_jc flex_ac pos_r" id="set_bg">
        <img src="./icon/03D04.png">
        <div class="seats pos_a w100 flex flex_jb flex_w">
            <?php
            for ($i = 0; $i < 20; $i++) {
                if (in_array($i, $seats)) {
            ?>
                    <div class="seat pos_r active">
                        <span>
                            <?= (floor($i / 5) + 1); ?>排
                            <?= ($i % 5 + 1); ?>號</span>
                    </div>
                <?php
                } else {
                ?>
                    <div class="seat pos_r">
                        <span>
                            <?= (floor($i / 5) + 1); ?>排
                            <?= ($i % 5 + 1); ?>號</span>
                        <input class="pos_a chk_seat" type="checkbox"  value="<?=$i;?>">
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
    <div class="w100 rb">
        <p class="ct">您選擇的電影是: <span id="chk_movie"><?= $_POST['movie']; ?></span></p>
        <p class="ct">您選擇的時刻是:<span id="chk_date"><?= $_POST['date']; ?></span>&nbsp;<span id="chk_session"><?= $_POST['session']; ?></span></p>
        <p class="ct">您已勾選<span class="ticket_num"></span>票，最多可購買四張票</p>
        <div class="ct">
            <button onclick="$('#order').show();$('#booking').hide();">上一步</button>
            <button onclick="checkout()" data-text="" id="checkout">訂購</button>
        </div>
    </div>
</div>
<script>
    let seats=new Array;
$('.chk_seat').on('change',function(){
    let seat=$(this).val();
    let len=seats.length;
    if ($(this).prop('checked')) {
        if (len>=4) {
            alert('最多只能勾選四個座位');
            $(this).prop('checked',false);
        }else {
            seats.push(seat);
            $(this).parent('.seat').toggleClass('active');
        }
    }else {
        seats.splice(seats.indexOf(seat),1);
        $(this).parent('.seat').toggleClass('active');
    }
    $('.ticket_num').text(seats.length);
    $('#checkout').data('text',seats);
})

function checkout(){
    let chk_movie=$('#chk_movie').text();
    let chk_date=$('#chk_date').text();
    let chk_session=$('#chk_session').text();
    let set=$('#checkout').data('text');
    console.log(chk_movie,chk_date,chk_session);
    $.post("./api/orders.php",{chk_movie,chk_date,chk_session,set},(id)=>{
        location.href="?do=result&no="+id;
    })
}

</script>