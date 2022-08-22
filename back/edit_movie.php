<?php
$mm=$movie->find($_GET['id']);
$mm_year=(int)explode("-",$mm['ondate'])[0];
$mm_month=(int)explode("-",$mm['ondate'])[1];
$mm_day=(int)explode("-",$mm['ondate'])[2];
?>

<div class="w100 mg " style="height:320px;">
    <h3 class="ct mg">新增院線片</h3>
    <form action="./api/edit.php?do=movie" method="post" enctype="multipart/form-data">
        <div class="w100 " style="height:480px;">
            <table class="w80 mg">
                <tr>
                    <td>影片資料</td>
                    <td>
                        <label>片&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名:</label>
                        <input type="text" name="name" style="width:600px" value="<?=$mm['name'];?>">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                    <label>分&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;級:</label>
                        <select name="level">
                            <option value="普遍級"<?=($mm['level']=="普遍級")?"selected":"";?>>普遍級</option>
                            <option value="輔導級"<?=($mm['level']=="輔導級")?"selected":"";?>>輔導級</option>
                            <option value="保護級"<?=($mm['level']=="保護級")?"selected":"";?>>保護級</option>
                            <option value="限制級"<?=($mm['level']=="限制級")?"selected":"";?>>限制級</option>
                        </select>
                        <span>(請選擇分級)</span>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <label>片&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;長:</label>
                        <input type="text" name="length" style="width:600px" value="<?=$mm['length'];?>">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <label>上映日期:</label>
                        <select name="year">
                            <?php
                                $year=date("Y",strtotime($today));
                                $month=date("m",strtotime($today));
                                $day=date("d",strtotime($today));
                                for ($i=0; $i < 3; $i++) { 
                                    ?>
                                        <option value="<?=($year+$i);?>" <?=($mm_year==($year+$i))?"selected":"";?>><?=($year+$i);?></option>
                                    <?php
                                }
                            ?>
                        </select>
                        <span>年</span>
                        <select name="month">
                            <?php
                                for ($i=1; $i <= 12 ; $i++) { 
                                    ?>
                                        <option value="<?=$i;?>" <?=($i==$mm_month)?"selected":"";?>><?=$i;?></option>
                                    <?php
                                }
                            ?>
                        </select>
                        <span>月</span>
                        <select name="day">
                            <?php
                                for ($i=1; $i <= 31 ; $i++) { 
                                    ?>
                                        <option value="<?=$i;?>" <?=($i==$mm_day)?"selected":"";?>><?=$i;?></option>
                                    <?php
                                }
                            ?>
                        </select>
                        <span>日</span>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <label>發&nbsp;&nbsp;行&nbsp;&nbsp;商:</label>
                        <input type="text" name="publish" style="width:600px" value="<?=$mm['publish'];?>">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <label>導&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;演:</label>
                        <input type="text" name="director" style="width:600px" value="<?=$mm['director'];?>">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <label>預告影片:</label>
                        <input type="file" name="mov" required>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <label>電影海報:</label>
                        <input type="file" name="img" required>
                    </td>
                </tr>
                <tr>
                    <td>劇情簡介</td>
                    <td>
                        <textarea name="intro" style="width:700px;height:100px"><?=$mm['intro'];?></textarea>
                    </td>
                </tr>
                <input type="hidden" name="id" value="<?=$mm['id'];?>">
            </table>
            <div class="ct">
                <input type="submit" value="修改">
                <input type="reset" value="重置">
            </div>
        </div>
    </form>
</div>
