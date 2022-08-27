<div id="mm">
    <div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=admin&redo=tit">網站標題管理</a>| <a href="?do=admin&redo=go">動態文字管理</a>| <a href="?do=poster">預告片海報管理</a>| <a href="?do=movie">院線片管理</a>| <a href="./back.php?do=orders">電影訂票管理</a> </div>
    <form action="./api/edit.php?do=poster" method="post">
        <div class="w100 h300 oy_s">
            <h4 class="ct">預告片清單</h4>
            <table class="w100">
                <tr>
                    <td class="ct">預告片海報:</td>
                    <td class="ct">預告片片名:</td>
                    <td class="ct">預告片排序:</td>
                    <td class="ct">操作</td>
                </tr>
                <?php
                $pts = $poster->all(" order by `rank`");
                foreach ($pts as $key => $pt) {
                ?>
                    <tr>
                        <td class="ct">
                            <img src="./upload/<?= $pt['img']; ?>" height="100px">
                        </td>
                        <td class="ct">
                            <input type="text" name="name[]" value="<?= $pt['name']; ?>">
                        </td>
                        <td class="ct">
                            <input type="text" name="rank[]" value="<?= $pt['rank']; ?>">
                        </td>
                        <td class="ct">
                            <?php
                            if ($pt['sh'] == 1) {
                            ?>
                                <button type="button" onclick="sh('poster',<?= $pt['id']; ?>)">不顯示</button>
                            <?php
                            } else {
                            ?>
                                <button type="button" onclick="sh('poster',<?= $pt['id']; ?>)">顯示</button>
                            <?php
                            }
                            ?>
                            <button type="button" onclick="del('poster',<?= $pt['id']; ?>)">刪除</button>
                            <select name="ani[]">
                                <option value="1" <?= ($pt['ani'] == 1) ? "selected" : "" ?>>淡出</option>
                                <option value="2" <?= ($pt['ani'] == 2) ? "selected" : "" ?>>縮放</option>
                                <option value="3" <?= ($pt['ani'] == 3) ? "selected" : "" ?>>滑出</option>
                            </select>
                        </td>
                        <input type="hidden" name="id[]" value="<?= $pt['id']; ?>">
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
        <div class="ct">
            <input type="submit" value="編輯確定">
            <input type="reset" value="重置">
        </div>
    </form>
    <form action="./api/add.php?do=poster" method="post" enctype="multipart/form-data">
        <div class="w100 h100">
            <h4 class="ct">新增預告片海報</h4>
            <table class="w100">
                <tr>
                    <td>
                        <label>預告片海報:</label>
                        <input type="file" name="img" required>
                    </td>
                    <td>
                        <label>預告片片名:</label>
                        <input type="text" name="name">
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