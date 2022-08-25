<?php
include_once "../base.php";
$books=[];
foreach ($orders->all(['movie'=>$_POST['movie'],'date'=>$_POST['date'],'session'=>$_POST['session']]) as $key => $array) {
    $books=array_merge(unserialize($array['set']),$books);
}
?>
<style>
.ticketout{
    right: 0;
    bottom: 0;
}
</style>
<div id="mm">
    <div class="w100 h400 flex flex_jc">
        <div class="seats pos_r">
            <div class="seat_bg pos_r pos_ct flex flex_jb flex_ac flex_w">
                <?php
                    for ($i=0; $i < 20; $i++) {
                        if (in_array($i,$books)) {
                            ?>
                            <div class="seat pos_r active">
                            <span><?=(floor($i/5)+1);?>排<?=($i%5)+1;?>號</span>
                            </div>
                            <?php
                        }else {
                            ?>
                            <div class="seat pos_r">
                            <span><?=(floor($i/5)+1);?>排<?=($i%5)+1;?>號</span>
                                <input class="pos_a ticketout" type="checkbox" name="ticketout" id="t<?=$i;?>" value="<?=$i;?>">
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="w100 h100">
        <div class="ct">您選擇的電影是: <span class="s_movie"><?=$_POST['movie'];?></span></div>
        <div class="ct">您選擇的時刻是: <span class="ms_date"><?=$_POST['date'];?></span> <span class="ms_session"><?=$_POST['session'];?></span></div>
        <div class="ct">您已勾選 <span class="ms_length"></span>張票，最多可以購買四張票</div>
        <div class="ct">
            <button type="button" onclick="$('#booking').hide(),$('#menu').show()">上一步</button>
            <button type="button" onclick="chk_ticket()" class="chk_ticket">訂購</button>
        </div>
    </div>
  </div>
  <script>
      let seats=new Array;
    $('.ticketout').on('change',function(){
        let len=seats.length;
        let now=parseInt($(this).val());
        
        if ($(this).prop('checked')) {
            if (len>=4) {
            alert('最多只能勾選四個座位');
            $(this).prop('checked',false);
            }else{
                seats.push($(this).val());
                $(this).parent().toggleClass('active');
            }
        }else{
            seats.splice(seats.indexOf(now),1);
            $(this).parent().toggleClass('active');
            }
        $('.ms_length').text(seats.length);
            $('.chk_ticket').data('text',seats);
    })

    function chk_ticket(){
        let movie=$('.s_movie').text();
        let date=$('.ms_date').text();
        let session=$('.ms_session').text();
        let set=$('.chk_ticket').data('text');
        let qt=set.length;
        $.post("./api/add_ticket.php",{movie,date,session,set,qt},(no)=>{
            location.href='?do=result&no='+no;
        })
    }
    
  </script>