<div id="mm">
    <div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=tit">網站標題管理</a>| <a href="?do=go">動態文字管理</a>| <a href="?do=posters">預告片海報管理</a>| <a href="?do=movies">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>
    <form action="./api/save.php?do=movies" method="post" enctype="multipart/form-data">
    <table class="w100">
        <tr>
            <td>影片資料</td>
            <td>
                <div class="w100">
                    <label for="">片名:</label>
                    <input type="text" name="name" id="">
                </div>
                <div class="w100">
                <label for="">分級:</label>
                <select name="level" id="">
                    <option value="普遍級">普遍級</option>
                    <option value="輔導級">輔導級</option>
                    <option value="保護級">保護級</option>
                    <option value="限制級">限制級</option>
                </select>
                </div>
                <div class="w100">
                <label for="">片長:</label>
                <input type="text" name="length" id="">
                </div>
                <div class="w100">
                <label for="">上映日期:</label>
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
                    <option value="<?=$i;?>"><?=$i;?></option>
                    <?php
                }
                ?>
                </select>月
                <select name="day" id="">
                <?php
                for ($i=1; $i <= 31 ; $i++) { 
                    ?>
                    <option value="<?=$i;?>"><?=$i;?></option>
                    <?php
                }
                ?>
                </select>日
                </div>
                <div class="w100">
                <label for="">發行商:</label>
                <input type="text" name="publish" id="">
                </div>
                <div class="w100">
                <label for="">導演:</label>
                <input type="text" name="maker" id="">
                </div>
                <div class="w100">
                <label for="">預告影片:</label>
                <input type="file" name="film" id="" required>
                </div>
                <div class="w100">
                <label for="">電影海報:</label>
                <input type="file" name="img" id="" required>
                </div>
            </td>
        </tr>
        <tr>
            <td>劇情簡介</td>
            <td>
                <textarea name="intro" style="width:300px;height:50px"></textarea>
            </td>
        </tr>
    </table>
    
    <div class="ct">
            <input type="submit" value="新增">
            <input type="reset" value="重置">
        </div>
    </form>
</div>