<?php
$ticket=$orders->find(['no'=>$_GET['no']]);
?>
<div id="mm">
    <p>感謝您的訂購，您的訂單編號是:<?=$_GET['no'];?></p>
    <div class="w60 mg">
        <table class="w100">
            <tr>
                <td>電影名稱:</td>
                <td><?=$ticket['movie'];?></td>
            </tr>
            <tr>
                <td>日期:</td>
                <td><?=$ticket['date'];?></td>
            </tr>
            <tr>
                <td>場次時間</td>
                <td><?=$ticket['session'];?></td>
            </tr>
        </table>
        <div class="w100">
            <p>座位:</p>
            <?php
                foreach (unserialize($ticket['set']) as $key => $tk) {
                    ?>
                    <p><?=(floor($tk/5)+1);?>排<?=($tk%5)+1;?>號</p>
                    <?php
                }
            ?>
            <p>共<?=$ticket['qt'];?>張電影票</p>
        </div>
    </div>
    <div class="ct">
        <button type="button" onclick="location.href='index.php'">確認</button>
    </div>
</div>