<?php
$mv=$movie->find($_GET['id']);
$ondate=$mv['ondate'];
$y=explode("-",$ondate)[0];
$m=explode("-",$ondate)[1];
$d=explode("-",$ondate)[2];

?>
<div id="mm">
<div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=tit">網站標題管理</a>| <a href="?do=go">動態文字管理</a>| <a href="?do=poster">預告片海報管理</a>| <a href="?do=movie">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>
<h3 class="ct">編輯院線片</h3>
<form action="./api/edit.php?do=movie" method="post" enctype="multipart/form-data">
<div class="flex flex_w w70 mg">
    <div class="w100 flex">
        <div class="w25">
            影片資料
        </div>
        <div class="w70">
            <table class="w100">
                <tr>
                    <td class="w20">片名:</td>
                    <td class="w70">
                        <input type="text" name="name" value="<?=$mv['name'];?>">
                    </td>
                </tr>
                <tr>
                    <td class="w20">分級:</td>
                    <td class="w70">
                        <select name="level">
                            <option value="普遍級" <?=($mv['level']=="普遍級")?"selected":"";?>>普遍級</option>
                            <option value="輔導級" <?=($mv['level']=="輔導級")?"selected":"";?>>輔導級</option>
                            <option value="保護級" <?=($mv['level']=="保護級")?"selected":"";?>>保護級</option>
                            <option value="限制級" <?=($mv['level']=="限制級")?"selected":"";?>>限制級</option>
                        </select>(請選擇分級)
                    </td>
                </tr>
                <tr>
                    <td class="w20">片長:</td>
                    <td class="w70">
                    <input type="text" name="length" value="<?=$mv['length'];?>">
                    </td>
                </tr>
                <tr>
                    <td class="w20">上映日期:</td>
                    <td class="w70">
                    <select name="year">
                        <?php
                           for ($i=date("Y"); $i<=date("Y")+3  ; $i++) { 
                            ?>
                                <option value="<?=$i;?>" <?=($i==$y?"selected":"");?>><?=$i;?></option>
                            <?php
                           } 
                        ?>
                    </select>年
                    <select name="month">
                    <?php
                           for ($i=1; $i<=12  ; $i++) { 
                            ?>
                                <option value="<?=$i;?>" <?=($i==$m?"selected":"");?>><?=$i;?></option>
                            <?php
                           } 
                        ?>
                    </select>月
                    <select name="day">
                    <?php
                           for ($i=1; $i<=31  ; $i++) { 
                            ?>
                                <option value="<?=$i;?>" <?=($i==$d?"selected":"");?>><?=$i;?></option>
                            <?php
                           } 
                        ?>
                    </select>日
                    </td>
                </tr>
                <tr>
                    <td class="w20">發行商:</td>
                    <td class="w70">
                    <input type="text" name="publish" value="<?=$mv['publish'];?>">
                    </td>
                </tr>
                <tr>
                    <td class="w20">導演:</td>
                    <td class="w70">
                    <input type="text" name="director" value="<?=$mv['director'];?>">
                    </td>
                </tr>
                <tr>
                    <td class="w20">預告影片:</td>
                    <td class="w70">
                        <input type="file" name="trailer" required>
                    </td>
                </tr>
                <tr>
                    <td class="w20">電影海報:</td>
                    <td class="w70">
                    <input type="file" name="poster" required>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="w100 flex">
        <div class="w25">
            劇情簡介
        </div>
        <div class="w70">
            <textarea name="intro"><?=$mv['intro'];?></textarea>
        </div>
        <input type="hidden" name="id" value="<?=$_GET['id'];?>">
    </div>
    <div class="ct w100">
        <input type="submit" value="編輯">
        <input type="reset" value="重置">
    </div>
</div>
</form>
</div>