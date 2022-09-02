<div id="mm">
    <div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=tit">網站標題管理</a>| <a href="?do=go">動態文字管理</a>| <a href="?do=posters">預告片海報管理</a>| <a href="?do=movies">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>
    <div class="w100 h300">
        <button onclick="back('add_movie')">新增電影</button>
        <hr>
        <form action="./api/edit.php?do=<?= $do; ?>" method="post">
            <div class="w100 h400 oy_s">
                <table class="w100">
                    <?php
                    foreach ($$do->all($rank) as $key => $mv) {
                    ?>
                        <tr>
                            <td>
                                <div class="w100 flex">
                                    <div class="w10 ct">
                                        <img src="./img/<?=$mv['img'];?>" height="100px">
                                    </div>
                                    <div class="w10 ct flex flex_jc flex_ac">
                                        <div>分級:</div>
                                        <div>
                                            <img src="./icon/<?=$level_icon[$mv['level']];?>" alt="">
                                        </div>
                                    </div>
                                    <div class="w80 flex flex_w flex_jb">
                                        <div class="w33">片名:<?=$mv['name'];?></div>
                                        <div class="w33">片長:<?=$mv['length'];?></div>
                                        <div class="w33">上映時間:<?=$mv['ondate'];?></div>
                                        <div class="w100">
                                            <input type="text" name="rank[]" value="<?=$mv['rank'];?>">排序
                                            <input type="hidden" name="id[]" value="<?=$mv['id'];?>">
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
                                            <button type="button" onclick="back('edit_movie&id=<?=$mv['id'];?>')">編輯電影</button>
                                            <button type="button" onclick="del('movies',<?=$mv['id'];?>)">刪除電影</button>
                                        </div>
                                        <div class="w100">
                                            劇情介紹:<?=$mv['intro'];?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <div class="ct">
                <input type="submit" value="排序">
                <input type="reset" value="重置">
            </div>
        </form>
    </div>
</div>