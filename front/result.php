<?php
$order_ticket = $orders->find($_GET['no']);
$seats = unserialize($order_ticket['set']);
?>

<div id="mm">
    <div class="w60 mg">
        <div>感謝您的訂購，您的訂單編號是:<?= $order_ticket['no']; ?></div>
        <table class="w100 mg">
            <tr>
                <td class="w30">電影名稱:</td>
                <td class="w70">
                    <?= $order_ticket['movie']; ?>
                </td>
            </tr>
            <tr>
                <td class="w30">日期:</td>
                <td class="w70">
                    <?= $order_ticket['date']; ?>
                </td>
            </tr>
            <tr>
                <td class="w30">場次時間</td>
                <td class="w70">
                    <?= $order_ticket['session']; ?>
                </td>
            </tr>

        </table>
        <div>
            <?php
            foreach ($seats as $key => $seat) {
            ?>
                <p>
                    <?= (floor($seat / 5) + 1); ?>排
                    <?= ($seat % 5 + 1); ?>號
                </p>
            <?php
            }
            ?>
        </div>
        <div class="ct">
            <button onclick="location.href='index.php?do=orders'">確認</button>
        </div>
    </div>
</div>