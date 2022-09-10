<?php

?>
<div id="mm">
<div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=tit">網站標題管理</a>| <a href="?do=go">動態文字管理</a>| <a href="?do=posters">預告片海報管理</a>| <a href="?do=movies">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>
<div class="rb tab">
<h3 class="ct">預告片清單</h3>
<div class="w100 h200 oy_s">
<form action="./api/save.php?do=<?=$do;?>" method="post">
<table class="w100">
    <tr>
        <td>預告片海報</td>
        <td>預告片片名</td>
        <td>預告片排序</td>
        <td>操作</td>
    </tr>
<?php
foreach ($posters->all($rank) as $key => $pt) {
?>
    <tr>
        <td class="ct">
            <img src="./img/<?=$pt['img'];?>" height="80px">
            <input type="hidden" name="id[]" value="<?=$pt['id'];?>">
        </td>
        <td>
            <input type="text" name="name[]" value="<?=$pt['name'];?>">
        </td>
        <td>
            <input type="text" name="rank[]" value="<?=$pt['rank'];?>">
        </td>
        <td>
            <input type="checkbox" name="sh[]" value="<?=$pt['id'];?>" <?=($pt['sh']==1)?"checked":"";?>>顯示
            <input type="checkbox" name="del[]" value="<?=$pt['id'];?>">刪除
            <select name="ani[]" >
                <option value="1" <?=($pt['ani']==1)?"selected":"";?>>淡出</option>
                <option value="2" <?=($pt['ani']==2)?"selected":"";?>>縮放</option>
                <option value="3" <?=($pt['ani']==3)?"selected":"";?>>滑出</option>
            </select>
        </td>
    </tr>
<?php
}
?>
</table>
<div class="ct">
    <input type="submit" value="編輯確定">
    <input type="reset" value="重置">
</div>
</form>
</div>
<div class="w100 h150">
<h3 class="ct">新增預告片海報</h3>
<form action="./api/save.php?do=<?=$do;?>" method="post" enctype="multipart/form-data">
<table class="w100">
    <tr>
        <td>
            預告片海報:
            <input type="file" name="img">
        </td>
        <td>
            預告片片名:
            <input type="text" name="name">
        </td>
    </tr>
</table>
<div class="ct">
    <input type="submit" value="新增">
    <input type="reset" value="重置">
</div>
</form>
</div>
</div>
</div>
