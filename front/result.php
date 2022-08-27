<?php
$mv=$orders->find(['no'=>$_GET['no']]);
$seats=unserialize($mv['seat']);
?>
<div id="mm">
    <div class="w60">
      感謝您的訂購，您的訂單編號是:<?=$_GET['no'];?>
    </div>
    <table class="w60">
      <tr>
        <td>電影名稱:</td>
        <td><?=$mv['name'];?></td>
      </tr>
      <tr>
        <td>日期:</td>
        <td><?=$mv['date'];?></td>
      </tr>
      <tr>
        <td>場次時間:</td>
        <td><?=$mv['session'];?></td>
      </tr>
    </table>
    <div class="w60">
      <?php
        foreach ($seats as $key => $seat) {
          ?>
          <p><?=floor(($seat/5))+1;?>排<?=($seat%5)+1;?>號</p>
          <?php
        }
      ?>
      <p>共<?=$mv['qt'];?>張電影票</p>
    </div>
    <div class="ct">
      <button onclick="location.href='./index.php'">返回</button>
    </div>
  </div>