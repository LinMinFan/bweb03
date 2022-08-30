<?php
$mv = $orders->find(['no' => $_GET['no']]);
?>
<div class="" id="mm">
    <div class="w60 mg">
        <div class="w100">改謝您的訂購，您的訂單編號是:<?= $mv['no']; ?></div>
        <table class="w100">
            <tr>
                <td>電影名稱:<?= $mv['name']; ?></td>
                <td></td>
            </tr>
            <tr>
                <td>日期:<?= $mv['date']; ?></td>
                <td></td>
            </tr>
            <tr>
                <td>場次時間:<?= $mv['session']; ?></td>
                <td></td>
            </tr>
        </table>
        <div class="w100">
            <?php
            foreach (unserialize($mv['seats']) as $key => $i) {
            ?>
                <p><?= floor($i / 5) + 1; ?>排<?= ($i % 5) + 1; ?>號</p>
            <?php
            }
            ?>
        </div>
        <div class="w100 ct">
            <button onclick="home()">確認</button>
        </div>
    </div>
</div>