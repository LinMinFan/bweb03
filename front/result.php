<?php
$ord = $orders->find(['no' => $_GET['no']]);
$seats = unserialize($ord['seats']);
?>
<div id="mm">
  <div class="w60 mg">
    感謝您的訂購，您的訂單編號是:<?= $ord['no']; ?>
  </div>
  <table class="w60 mg">
    <tr>
      <td>電影名稱:</td>
      <td><?= $ord['name']; ?></td>
    </tr>
    <tr>
      <td>日期:</td>
      <td><?= $ord['date']; ?></td>
    </tr>
    <tr>
      <td>場次時間:</td>
      <td><?= $ord['session']; ?></td>
    </tr>
  </table>
  <div class="w60 mg">
    <div>座位:</div>
    <?php
    foreach ($seats as $key => $i) {
    ?>
      <div><?=floor($i/5)+1;?>排<?=$i%5+1;?>號</div>
    <?php
    }
    ?>
  </div>
  <div class="w60 mg">
    <button onclick="front('main')">確認</button>
  </div>
</div>