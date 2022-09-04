<div id="mm">
    <div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=tit">網站標題管理</a>| <a href="?do=go">動態文字管理</a>| <a href="?do=posters">預告片海報管理</a>| <a href="?do=movies">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>
<button onclick="back('add_movies')">新增電影</button>
<hr>
<form action="./api/edit.php?do=<?=$do;?>" method="post">
<div class="w100 h400 oy_s">
<table class="w100">
<?php
foreach ($$do->all($rank) as $key => $mv) {
  ?>
  <tr>
    <td>
      <img src="./img/<?=$mv['img'];?>" height="80px">
    </td>
    <td>
      分級:
      <img src="./icon/<?=$level_icon[$mv['level']];?>">
    </td>
    <td>
      <table class="w100">
        <tr>
          <td>片名:<?=$mv['name'];?></td>
          <td>片長:<?=$mv['length'];?></td>
          <td>上映時間:<?=$mv['ondate'];?></td>
        </tr>
        <tr>
          <td>
            排序
            <input type="text" name="rank[]" value="<?=$mv['rank'];?>">
            <input type="hidden" name="id[]" value="<?=$mv['id'];?>">
          </td>
          <td>
            <button type="button" onclick="back('edit_movies&id=<?=$mv['id'];?>')">編輯電影</button>
          </td>
          <td>
            <?php
            if ($mv['sh']==1) {
              ?>
              <button type="button" onclick="sh('movies',<?=$mv['id'];?>,0)">不顯示</button>
              <?php
            }else{
              ?>
              <button type="button" onclick="sh('movies',<?=$mv['id'];?>,1)">顯示</button>
              <?php
            }
            ?>
            <button type="button" onclick="del('movies',<?=$mv['id'];?>)">刪除電影</button>
          </td>
        </tr>
      </table>
      <div>
        劇情介紹:<?=$mv['intro'];?>
      </div>
    </td>
  </tr>
  <?php
}
?>
</table>
<div class="ct">
  <input type="submit" value="排序">
</div>
</div>
</form>
  </div>