<?php
$mv=$movies->find($_GET['id']);
$y=explode("-",$mv['ondate'])[0];
$m=explode("-",$mv['ondate'])[1];
$d=explode("-",$mv['ondate'])[2];
?>
<div id="mm">
    <div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=tit">網站標題管理</a>| <a href="?do=go">動態文字管理</a>| <a href="?do=posters">預告片海報管理</a>| <a href="?do=movies">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>
    <div class="w100 h300">
        <button onclick="back('add_movie')">新增電影</button>
        <hr>
        <form action="./api/save.php?do=movies" method="post" enctype="multipart/form-data">
            <div class="w100 h400">
                <table class="w100">
                    <tr>
                        <td>影片資料</td>
                        <td>
                            <div>
                                <span>片名:</span><input type="text" name="name" id="" value="<?=$mv['name'];?>">
                            </div>
                            <div>
                                <span>分級:</span>
                                <select name="level" id="">
                                    <option value="普遍級" <?=($mv['level']=='普遍級')?"selected":"";?>>普遍級</option>
                                    <option value="輔導級" <?=($mv['level']=='輔導級')?"selected":"";?>>輔導級</option>
                                    <option value="保護級" <?=($mv['level']=='保護級')?"selected":"";?>>保護級</option>
                                    <option value="限制級" <?=($mv['level']=='限制級')?"selected":"";?>>限制級</option>
                                </select>(請選擇分級)
                            </div>
                            <div>
                                <span>片長:</span><input type="text" name="length" id="" value="<?=$mv['length'];?>">
                            </div>
                            <div>
                                <span>上映日期:</span>
                                <select name="year" id="">
                                    <?php
                                    for ($i=date("Y"); $i <=date("Y",strtotime("+2 years")) ; $i++) { 
                                        ?>
                                        <option value="<?=$i;?>"<?=($i==$y)?"selected":"";?>><?=$i;?></option>
                                        <?php
                                    }
                                    ?>
                                </select>年
                                <select name="month" id="">
                                <?php
                                    for ($i=1; $i <=12 ; $i++) { 
                                        ?>
                                        <option value="<?=$i;?>"<?=($i==$m)?"selected":"";?>><?=$i;?></option>
                                        <?php
                                    }
                                    ?>
                                </select>月
                                <select name="day" id="">
                                <?php
                                    for ($i=1; $i <=31 ; $i++) { 
                                        ?>
                                        <option value="<?=$i;?>"<?=($i==$d)?"selected":"";?>><?=$i;?></option>
                                        <?php
                                    }
                                    ?>
                                </select>日
                            </div>
                            <div>
                                <span>發行商:</span><input type="text" name="publish" id="" value="<?=$mv['publish'];?>">
                            </div>
                            <div>
                                <span>導演:</span><input type="text" name="maker" id="" value="<?=$mv['maker'];?>">
                            </div>
                            <div>
                                <span>預告影片:</span><input type="file" name="film" id="" required>
                            </div>
                            <div>
                                <span>電影海報:</span><input type="file" name="img" id="" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>劇情簡介</td>
                        <td>
                            <textarea name="intro" style="width: 300px;height:50px"><?=$mv['intro'];?></textarea>
                        </td>
                        <input type="hidden" name="id" value="<?=$mv['id'];?>">
                    </tr>
                </table>
            </div>
            <div class="ct">
                <input type="submit" value="編輯">
                <input type="reset" value="重置">
            </div>
        </form>
    </div>
</div>