<div id="mm">
<div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=admin&redo=tit">網站標題管理</a>| <a href="?do=go">動態文字管理</a>| <a href="?do=posters">預告片海報管理</a>| <a href="?do=movies">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>
<div class="w100">
    <button onclick="location.href='?do=add_movie'">新增電影</button>
</div>
<hr>
<form action="./api/edit.php?do=<?=$do;?>" method="post">
<div class="w100 h400 oy_s">
<?php
    foreach ($$do->all(" order by `rank`") as $key => $data){
        ?>
        <div class="flex w100">
            <div class="w10">
                <img src="./img/<?=$data['img'];?>" width="90px" height="100px">
            </div>
            <div class="w10">
                <span>分級:</span>
                <img src="./icon/<?=$level_icon[$data['level']];?>" alt="">
            </div>
            <div class="w70">
                <div class="w100 flex flex_jb">
                    <div class="w30">片名:<?=$data['name'];?></div>
                    <div class="w30">片長:<?=$data['length'];?></div>
                    <div class="w30">上映時間:<?=$data['ondate'];?></div>
                </div>
                <div class="w100">
                    <input type="text" name="rank[]" value="<?=$data['rank'];?>">
                    <input type="hidden" name="id[]" value="<?=$data['id'];?>">
                    <button type="button" onclick="location.href='?do=edit_movie&id=<?=$data['id'];?>'">編輯電影</button>
                    <button type="button" onclick="del('movies',<?=$data['id'];?>)">刪除電影</button>
                </div>
                <div class="w100">
                    <pre><?=$data['intro'];?></pre>
                </div>
            </div>
        </div>
        <?php
    }
?>
<div class="ct"><input type="submit" value="排序"></div>
</div>
</form>
</div>

