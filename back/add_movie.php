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
                                <span>片名:</span><input type="text" name="name" id="">
                            </div>
                            <div>
                                <span>分級:</span>
                                <select name="level" id="">
                                    <option value="普遍級">普遍級</option>
                                    <option value="輔導級">輔導級</option>
                                    <option value="保護級">保護級</option>
                                    <option value="限制級">限制級</option>
                                </select>(請選擇分級)
                            </div>
                            <div>
                                <span>片長:</span><input type="text" name="length" id="">
                            </div>
                            <div>
                                <span>上映日期:</span>
                                <select name="year" id="">
                                    <?php
                                    for ($i=date("Y"); $i <=date("Y",strtotime("+2 years")) ; $i++) { 
                                        ?>
                                        <option value="<?=$i;?>"><?=$i;?></option>
                                        <?php
                                    }
                                    ?>
                                </select>年
                                <select name="month" id="">
                                <?php
                                    for ($i=1; $i <=12 ; $i++) { 
                                        ?>
                                        <option value="<?=$i;?>"><?=$i;?></option>
                                        <?php
                                    }
                                    ?>
                                </select>月
                                <select name="day" id="">
                                <?php
                                    for ($i=1; $i <=31 ; $i++) { 
                                        ?>
                                        <option value="<?=$i;?>"><?=$i;?></option>
                                        <?php
                                    }
                                    ?>
                                </select>日
                            </div>
                            <div>
                                <span>發行商:</span><input type="text" name="publish" id="">
                            </div>
                            <div>
                                <span>導演:</span><input type="text" name="maker" id="">
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
                            <textarea name="intro" style="width: 300px;height:50px"></textarea>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="ct">
                <input type="submit" value="新增">
                <input type="reset" value="重置">
            </div>
        </form>
    </div>
</div>