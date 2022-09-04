<div id="mm">
    <div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=tit">網站標題管理</a>| <a href="?do=go">動態文字管理</a>| <a href="?do=posters">預告片海報管理</a>| <a href="?do=movies">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>
<div class="w">
  快速刪除:
  <input type="radio" name="way" data-text="date">
  依日期:
  <input type="text" name="" id="date">
  <input type="radio" name="way" data-text="name">
  <select name="" id="name">
    <?php
    foreach ($orders->all(" group by `name`") as $key => $od) {
      ?>
        <option value="<?=$od['name'];?>"><?=$od['name'];?></option>
      <?php
    }
    ?>
  </select>
  <button type="button" onclick="q_del()">刪除</button>
  <div class="w100 h400 oy_s">
    <table class="w100">
      <tr>
        <td>訂單編號</td>
        <td>電影名稱</td>
        <td>日期</td>
        <td>場次時間</td>
        <td>訂購數量</td>
        <td>訂購位置</td>
        <td>操作</td>
      </tr>
      <?php
      foreach ($orders->all("order by `no`") as $key => $od) {
        ?>
        <tr>
          <td><?=$od['no'];?></td>
          <td><?=$od['name'];?></td>
          <td><?=$od['date'];?></td>
          <td><?=$od['session'];?></td>
          <td><?=$od['qt'];?></td>
          <td>
            <?php
            foreach (unserialize($od['seats']) as $key => $i) {
              ?>
              <div><?=floor($i/5)+1;?>排<?=($i%5)+1;?>號</div>
              <?php
            }
            ?>
          </td>
          <td>
            <button type="button" onclick="del('orders',<?=$od['id'];?>)">刪除</button>
          </td>
        </tr>
        <?php
      }
      ?>
    </table>
  </div>
</div>
  </div>