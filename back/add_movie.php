
<div class="w100 mg " style="height:320px;">
    <h3 class="ct mg">新增院線片</h3>
    <form action="./api/add.php?do=movie" method="post" enctype="multipart/form-data">
        <div class="w100 " style="height:480px;">
            <table class="w80 mg">
                <tr>
                    <td>影片資料</td>
                    <td>
                        <label>片&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名:</label>
                        <input type="text" name="name" style="width:600px">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <label>分&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;級:</label>
                        <select name="level">
                            <option value="普遍級">普遍級</option>
                            <option value="輔導級">輔導級</option>
                            <option value="保護級">保護級</option>
                            <option value="限制級">限制級</option>
                        </select>
                        <span>(請選擇分級)</span>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <label>片&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;長:</label>
                        <input type="text" name="length" style="width:600px">
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
                                        <option value="<?=($year+$i);?>" ><?=($year+$i);?></option>
                                    <?php
                                }
                            ?>
                        </select>
                        <span>年</span>
                        <select name="month">
                            <?php
                                for ($i=1; $i <= 12 ; $i++) { 
                                    ?>
                                        <option value="<?=$i;?>" <?=($i==$month)?"selected":"";?>><?=$i;?></option>
                                    <?php
                                }
                            ?>
                        </select>
                        <span>月</span>
                        <select name="day">
                            <?php
                                for ($i=1; $i <= 31 ; $i++) { 
                                    ?>
                                        <option value="<?=$i;?>" <?=($i==$day)?"selected":"";?>><?=$i;?></option>
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
                        <input type="text" name="publish" style="width:600px">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <label>導&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;演:</label>
                        <input type="text" name="director" style="width:600px">
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
                        <textarea name="intro" style="width:700px;height:100px"></textarea>
                    </td>
                </tr>
            </table>
            <div class="ct">
                <input type="submit" value="新增">
                <input type="reset" value="重置">
            </div>
        </div>
    </form>
</div>
