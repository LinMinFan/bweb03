<?php
//"SELECT * FROM `movie` WHERE  `ondate` BETWEEN '2022-08-22' AND '2022-08-24';"
//$start_day=date("Y-m-d",strtotime("-2 days"));
$mvs=$$do->all();
//echo $start_day;
?>

<div id="mm">
<div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=tit">網站標題管理</a>| <a href="?do=go">動態文字管理</a>| <a href="?do=poster">預告片海報管理</a>| <a href="?do=movie">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>
<button onclick="location.href='?do=add_movie'">新增電影</button>
<hr>
<div class="w100 h420">
    <?php
        foreach ($mvs as $key => $mv) {
            ?>
                <div class="flex">
                    <div class="w20 flex flex_jc flex_ac">
                        <img src="./upload/<?=$mv['poster'];?>" height="80px">
                    </div>
                    <div class="w15 flex flex_jc flex_ac">
                        <span>分級: <img src="./icon/<?=$arraystr[$mv['level']];?>"></span>
                    </div>
                    <div class="w60">
                        <table class="w100">
                            <tr>
                                <td>片名:<?=$mv['name'];?></td>
                                <td>片長:<?=$mv['length'];?></td>
                                <td>上映時間:<?=$mv['ondate'];?></td>
                            </tr>
                        </table>
                        <div class="w100">
                            <div class="flex flex_je">
                                <?php
                                    if ($mv['sh']==1) {
                                        ?>
                                            <button onclick="sh('movie',<?=$mv['id'];?>)">不顯示</button>
                                        <?php
                                    }else {
                                        ?>
                                            <button onclick="sh('movie',<?=$mv['id'];?>)">顯示</button>
                                        <?php
                                    }
                                ?>
                                <button onclick="location.href='?do=edit_movie&id=<?=$mv['id'];?>'">編輯電影</button>
                                <button onclick="del('movie',<?=$mv['id'];?>)">刪除電影</button>
                            </div>
                        </div>
                        <div class="w100">
                            <p>
                                <?=$mv['intro'];?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php
        }
    ?>
</div>

</div>

