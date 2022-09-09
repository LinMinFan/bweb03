<?php
$mv=$movies->find($_GET['id']);
$y=(int)explode("-",$mv['date'])[0];
$m=(int)explode("-",$mv['date'])[1];
$d=(int)explode("-",$mv['date'])[2];
?>
<div id="mm">

<div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=admin&redo=tit">網站標題管理</a>| <a href="?do=admin&redo=go">動態文字管理</a>| <a href="?do=posters">預告片海報管理</a>| <a href="?do=movies">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>
<div class="rb tab">
<form action="./api/save.php?do=movies&id=<?=$mv['id'];?>" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td class="w20">影片資料</td>
            <td class="w60">
                <div class="w100">片名:
                    <input type="text" name="name" value="<?=$mv['name'];?>">
                </div>
                <div class="w100">分級:
                    <select name="level" >
                        <option value="普遍級" <?=($mv['level']=='普遍級')?"selected":"";?>>普遍級</option>
                        <option value="輔導級" <?=($mv['level']=='輔導級')?"selected":"";?>>輔導級</option>
                        <option value="保護級" <?=($mv['level']=='保護級')?"selected":"";?>>保護級</option>
                        <option value="限制級" <?=($mv['level']=='限制級')?"selected":"";?>>限制級</option>
                    </select>請選擇分級
                </div>
                <div class="w100">片長:
                    <input type="text" name="length" value="<?=$mv['length'];?>">
                </div>
                <div class="w100">上映日期:
                    <select name="year">
                        <?php
                        for ($i=date("Y"); $i <= date("Y",strtotime("+2 years")) ; $i++) { 
                            ?>
                            <option value="<?=$i;?>" <?=($i==$y)?"selected":"";?>><?=$i;?></option>
                            <?php
                        }
                        ?>
                    </select>年
                    <select name="month">
                        <?php
                        for ($i=1; $i <= 12 ; $i++) { 
                            ?>
                            <option value="<?=$i;?>" <?=($i==$m)?"selected":"";?>><?=$i;?></option>
                            <?php
                        }
                        ?>
                    </select>月
                    <select name="day">
                        <?php
                        for ($i=1; $i <= 31 ; $i++) { 
                            ?>
                            <option value="<?=$i;?>" <?=($i==$d)?"selected":"";?>><?=$i;?></option>
                            <?php
                        }
                        ?>
                    </select>日
                </div>
                <div class="w100">發行商:
                    <input type="text" name="publish"value="<?=$mv['publish'];?>">
                </div>
                <div class="w100">導演:
                    <input type="text" name="maker"value="<?=$mv['maker'];?>">
                </div>
                <div class="w100">
                    預告影片:
                    <input type="file" name="film">
                </div>
                <div class="w100">
                    電影海報:
                    <input type="file" name="img">
                </div>
            </td>
        </tr>
        <tr>
            <td class="w30">劇情簡介</td>
            <td class="w50">
                <textarea name="intro" style="width:350px;height:50px"><?=$mv['intro'];?></textarea>
            </td>
        </tr>
    </table>
    <div class="ct">
    <input type="submit" value="編輯">
    <input type="reset" value="重置">
    </div>
</form>
</div>
</div>

