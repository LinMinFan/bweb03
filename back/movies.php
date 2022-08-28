<div id="mm">
    <div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=tit">網站標題管理</a>| <a href="?do=go">動態文字管理</a>| <a href="?do=posters">預告片海報管理</a>| <a href="?do=movies">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>
    <div class="w100 h400 ofy_s">
        <button onclick="location.href='?do=add_movie'">新增電影</button>
        <hr>
        <form action="./api/edit.php?do=<?= $do; ?>" method="post">
            <?php
            foreach ($$do->all(" order by `rank`") as $key => $data) {
            ?>
                <div class="w100 h150 flex">
                    <div class="w15 ct">
                        <img src="./upload/<?=$data['img'];?>" height="100px">
                    </div>
                    <div class="w15">
                        <span>分級:</span><img src="./icon/<?=$level_icon[$data['level']];?>" >
                    </div>
                    <div class="w70">
                        <table>
                            <tr>
                                <td>片名:<?=$data['name'];?></td>
                                <td>片長:<?=$data['length'];?></td>
                                <td>上映時間:<?=$data['ondate'];?></td>
                            </tr>
                        </table>
                        <div class="w100">
                            <input type="text" name="rank[]" value="<?=$data['rank'];?>">
                            <input type="hidden" name="id[]" value="<?=$data['id'];?>">
                            <?php
                            if ($data['sh']==1) {
                                ?>
                                <button type="button" onclick="sh('movies',<?=$data['id'];?>,0)">不顯示</button>
                                <?php
                            }else{
                                ?>
                                <button type="button" onclick="sh('movies',<?=$data['id'];?>,1)">顯示</button>
                                <?php
                            }
                            ?>
                            <button type="button" onclick="location.href='?do=edit_movie&id=<?=$data['id'];?>'">編輯電影</button>
                            <button type="button" onclick="del('movies',<?=$data['id'];?>)">刪除</button>
                        </div>
                        <div class="w100">
                            <?=$data['intro'];?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <div class="ct">
                <input type="submit" value="排序">
                <input type="reset" value="重置">
            </div>
        </form>
    </div>

</div>