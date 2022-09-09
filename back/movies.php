<?php

?>
<div id="mm">

<div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=admin&redo=tit">網站標題管理</a>| <a href="?do=admin&redo=go">動態文字管理</a>| <a href="?do=posters">預告片海報管理</a>| <a href="?do=movies">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>
<div class="rb tab">
<button onclick="bb('add_mv')">新增電影</button>
<hr>
<div class="w100 h400 oy_s">
<form action="./api/save.php?do=<?=$do;?>" method="post">
<?php
foreach ($movies->all($rank) as $key => $mv) {
?>
<table class="w100">
    <tr>
        <td class="w15">
            <img src="./img/<?=$mv['img'];?>" height="80px">
        </td>
        <td class="w15">
            <div>分級:<img src="./icon/<?=$level_icon[$mv['level']];?>"></div>
        </td>
        <td class="w70">
            <table class="w100">
                <tr>
                    <td>片名:<?=$mv['name'];?></td>
                    <td>片長:<?=$mv['length'];?></td>
                    <td>上映時間:<?=$mv['date'];?></td>
                </tr>
            </table>
            <div class="w100">
                <input type="text" name="rank[]" value="<?=$mv['rank'];?>">
                <input type="hidden" name="id[]" value="<?=$mv['id'];?>">
                <button type="button" onclick="bb('edit_mv&id=<?=$mv['id'];?>')">編輯電影</button>
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
                <button type="button" onclick="del('movies',<?=$mv['id'];?>)">刪除</button>
            </div>
            <div class="w100">
                劇情介紹:<?=$mv['intro'];?>
            </div>
        </td>
    </tr>
</table>

<?php
}
?>
<div class="ct">
    <input type="submit" value="排序">
</div>
</form>
</div>
</div>
</div>

