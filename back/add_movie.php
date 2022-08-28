<div id="mm">
<h3 class="ct">新增院線片</h3>
<form action="./api/add.php?do=movies" method="post" enctype="multipart/form-data">
<div class="w100 h400">
<div class="w100 flex h300">
    <div class="w20">影片資料</div>
    <div class="w80">
        <table class="w100">
            <tr>
                <td>片名:</td>
                <td>
                    <input type="text" name="name" id="">
                </td>
            </tr>
            <tr>
                <td>分級:</td>
                <td>
                    <select name="level" id="">
                        <option value="普遍級">普遍級</option>
                        <option value="輔導級">輔導級</option>
                        <option value="保護級">保護級</option>
                        <option value="限制級">限制級</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>片長:</td>
                <td>
                    <input type="text" name="length" id="">
                </td>
            </tr>
            <tr>
                <td>上映日期:</td>
                <td>
                    <select name="year" id="">
                        <?php
                        for ($i=date("Y"); $i <= date("Y",strtotime("+2 years")) ; $i++) { 
                            ?>
                            <option value="<?=$i;?>"><?=$i;?></option>
                            <?php
                        }
                        ?>
                    </select>年
                    <select name="month" id="">
                        <?php
                        for ($i=1; $i <= 12 ; $i++) { 
                            ?>
                            <option value="<?=$i;?>" <?=(date("m")==$i)?"selected":"";?>><?=$i;?></option>
                            <?php
                        }
                        ?>
                    </select>月
                    <select name="day" id="">
                        <?php
                        for ($i=1; $i <= 31 ; $i++) { 
                            ?>
                            <option value="<?=$i;?>" <?=(date("d")==$i)?"selected":"";?>><?=$i;?></option>
                            <?php
                        }
                        ?>
                    </select>日
                </td>
            </tr>
            <tr>
                <td>發行商:</td>
                <td>
                    <input type="text" name="publish" id="">
                </td>
            </tr>
            <tr>
                <td>導演:</td>
                <td>
                    <input type="text" name="maker" id="">
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
                    <textarea name="intro" style="width:300px;height:50px"></textarea>
                </td>
            </tr>
        </table>
    </div>
</div>
<hr>
<div class="ct">
    <input type="submit" value="新增">
    <input type="reset" value="重置">
</div>
</div>
</form>


</div>