<?php
$mvs=$movie->all(" order by `rank`");
?>
<div id="mm">
    <div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=admin&redo=tit">網站標題管理</a>| <a href="?do=admin&redo=go">動態文字管理</a>| <a href="?do=poster">預告片海報管理</a>| <a href="?do=movie">院線片管理</a>| <a href="./back.php?do=orders">電影訂票管理</a> </div>
        <div class="w100 h500 flex flex_w oy_s">
            <div>
                <button type="button" onclick="location.href='?do=add_movie'">新增電影</button>
            </div>
            <hr class="w100">
            <form action="./api/edit.php?do=movie" method="post">
            <?php
                foreach ($mvs as $key => $mv) {
                    ?>
                        <div class="w100 flex flex_jc">
                            <div class="w15 flex flex_jc flex_ac">
                                <img src="./upload/<?=$mv['poster'];?>" width="90px">
                            </div>
                            <div class="w15">
                                <span>分級: <img src="./icon/<?=$level_icon[$mv['level']];?>" width="24px"></span>
                            </div>
                            <div class="w60 flex flex_w">
                                <table class="w100">
                                    <tr>
                                        <td>片名:<?=$mv['name'];?></td>
                                        <td>片長:<?=$mv['length'];?></td>
                                        <td>上映時間:<?=$mv['ondate'];?></td>
                                    </tr>
                                </table>
                                <div class="w100">
                                    <input type="text" name="rank[]" value="<?=$mv['rank'];?>">
                                    <input type="hidden" name="id[]" value="<?=$mv['id'];?>">
                                    <button type="button" onclick="location.href='?do=edit_movie&id=<?=$mv['id'];?>'">編輯電影</button>
                                    <?php
                                    if ($mv['sh']==1) {
                                        ?>
                                        <button type="button" onclick="sh('movie',<?=$mv['id'];?>)">不顯示</button>
                                        <?php
                                    }else{
                                        ?>
                                        <button type="button" onclick="sh('movie',<?=$mv['id'];?>)">顯示</button>
                                        <?php
                                    }
                                    ?>
                                    <button type="button" onclick="del('movie',<?=$mv['id'];?>)">刪除</button>
                                </div>
                                <div class="w100">
                                    <p><?=$mv['intro'];?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            ?>
            <div class="ct">
                <input type="submit" value="排序">
            </div>
            </form>
        </div>
</div>