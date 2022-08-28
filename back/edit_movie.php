<?php
$mv=$movies->find($_GET['id']);
$y=(int)explode("-",$mv['ondate'])[0];
$m=(int)explode("-",$mv['ondate'])[1];
$d=(int)explode("-",$mv['ondate'])[2];
?>
<div id="mm">
<h3 class="ct">新增院線片</h3>
<form action="./api/edit_movie.php?do=movies" method="post" enctype="multipart/form-data">
<div class="w100 h400">
<div class="w100 flex h300">
    <div class="w20">影片資料</div>
    <div class="w80">
        <table class="w100">
            <tr>
                <td>片名:</td>
                <td>
                    <input type="text" name="name" id="" value="<?=$mv['name'];?>">
                </td>
            </tr>
            <tr>
                <td>分級:</td>
                <td>
                    <select name="level" id="">
                        <option value="普遍級" <?=($mv['level']=='普遍級')?"selected":"";?>>普遍級</option>
                        <option value="輔導級" <?=($mv['level']=='輔導級')?"selected":"";?>>輔導級</option>
                        <option value="保護級" <?=($mv['level']=='保護級')?"selected":"";?>>保護級</option>
                        <option value="限制級" <?=($mv['level']=='限制級')?"selected":"";?>>限制級</option>
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
                    <input type="text" name="publish" id="" value="<?=$mv['publish'];?>">
                </td>
            </tr>
            <tr>
                <td>導演:</td>
                <td>
                    <input type="text" name="maker" id="" value="<?=$mv['maker'];?>">
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
                    <input type="file" name="img" id="" required>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="w100 flex h100">
    <div class="w20">劇情簡介</div>
    <div class="w80">
        <table class="w100">
            <tr>
                <td>
                    <textarea name="intro" style="width:300px;height:50px"><?=$mv['intro'];?></textarea>
                </td>
                <input type="hidden" name="id" value="<?=$mv['id'];?>">
            </tr>
        </table>
    </div>
</div>
<hr>
<div class="ct">
    <input type="submit" value="編輯">
    <input type="reset" value="重置">
</div>
</div>
</form>


</div>