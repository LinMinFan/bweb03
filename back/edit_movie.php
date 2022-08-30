<?php
$mv=$movies->find($_GET['id']);
$y=(int)explode("-",$mv['ondate'])[0];
$m=(int)explode("-",$mv['ondate'])[1];
$d=(int)explode("-",$mv['ondate'])[2];
?>
<div id="mm">
<div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=admin&redo=tit">網站標題管理</a>| <a href="?do=go">動態文字管理</a>| <a href="?do=posters">預告片海報管理</a>| <a href="?do=movies">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>

<form action="./api/save_movie.php" method="post" enctype="multipart/form-data">
<div class="w100 h350 flex">
    <div class="w10">影片資料</div>
    <div class="w80">
        <table class="w100">
            <tr>
                <td>片名:</td>
                <td>
                    <input type="text" name="name"  value="<?=$mv['name'];?>">
                </td>
            </tr>
            <tr>
                <td>分級:</td>
                <td>
                    <select name="level" id="">
                        <option value="普遍級" <?=($mv['name']=='普遍級')?"selected":"";?>>普遍級</option>
                        <option value="輔導級" <?=($mv['name']=='輔導級')?"selected":"";?>>輔導級</option>
                        <option value="保護級" <?=($mv['name']=='保護級')?"selected":"";?>>保護級</option>
                        <option value="限制級" <?=($mv['name']=='限制級')?"selected":"";?>>限制級</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>片長:</td>
                <td>
                    <input type="text" name="length" value="<?=$mv['length'];?>">
                </td>
            </tr>
            <tr>
                <td>上映日期:</td>
                <td>
                    <select name="year" id="">
                        <?php
                        for ($i=date("Y"); $i <= date("Y",strtotime("+2 years")) ; $i++) { 
                            ?>
                            <option value="<?=$i;?>" <?=($i==$y)?"selected":"";?>><?=$i;?></option>
                            <?php
                        }
                        ?>
                    </select>年
                    <select name="month" id="">
                    <?php
                        for ($i=1; $i <= 12 ; $i++) { 
                            ?>
                            <option value="<?=$i;?>" <?=($i==$m)?"selected":"";?>><?=$i;?></option>
                            <?php
                        }
                        ?>
                    </select>月
                    <select name="day" id="">
                    <?php
                        for ($i=1; $i <= 31 ; $i++) { 
                            ?>
                            <option value="<?=$i;?>" <?=($i==$d)?"selected":"";?>><?=$i;?></option>
                            <?php
                        }
                        ?>
                    </select>日
                </td>
            </tr>
            <tr>
                <td>發行商:</td>
                <td>
                    <input type="text" name="publish" value="<?=$mv['publish'];?>">
                </td>
            </tr>
            <tr>
                <td>導演:</td>
                <td>
                    <input type="text" name="maker" value="<?=$mv['maker'];?>">
                </td>
            </tr>
            <tr>
                <td>預告影片:</td>
                <td>
                    <input type="file" name="film" id="" required>
                </td>
            </tr>
            <tr>
                <td>電影海報:</td>
                <td>
                <input type="file" name="img" id="">
                </td>
            </tr>
            <input type="hidden" name="id" value="<?=$mv['id'];?>" required>
        </table>
    </div>
</div>
<div class="w100 h100 flex">
    <div class="w10">劇情簡介</div>
    <div class="w80">
        <textarea name="intro" style="width: 350px;height:60px"><?=$mv['intro'];?></textarea>
    </div>
</div>
<div class="ct w100">
    <input type="submit" value="編輯">
    <input type="reset" value="重置">
</div>
</form>
</div>