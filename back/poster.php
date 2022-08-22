
<div class="w100 mg " style="height:320px;">
    <h3 class="ct mg">預告片清單</h3>
    <form action="./api/edit.php?do=<?=$do;?>" method="post">
        <div class="w100 os" style="height:250px;">
            <table class="w100">
                <tr>
                    <td class="ct">預告片海報</td>
                    <td class="ct">預告片片名</td>
                    <td class="ct">預告片排序</td>
                    <td class="ct">操作</td>
                </tr>
                <?php
                $datas = $poster->all(" order by `rank`");
                foreach ($datas as $key => $data) {
                ?>
                    <tr>
                        <td class="ct"><img src="./upload/<?= $data['img']; ?>" height="100px"></td>
                        <td class="ct"><input type="text" name="name[]" value="<?= $data['name']; ?>"></td>
                        <td class="ct"><input type="number" name="rank[]" value="<?= $data['rank']; ?>"></td>
                        <td class="ct">
                            <input type="checkbox" name="sh[]" value="<?= $data['id']; ?>" <?= ($data['sh'] == 1) ? "checked" : ""; ?>>
                            <label for="">顯示</label>
                            <input type="checkbox" name="del[]" value="<?= $data['id']; ?>">
                            <label for="">刪除</label>
                            <select name="ani[]">
                                <option value="1" <?= ($data['ani'] == 1) ? "selected" : ""; ?>>淡入</option>
                                <option value="2" <?= ($data['ani'] == 2) ? "selected" : ""; ?>>縮放</option>
                                <option value="3" <?= ($data['ani'] == 3) ? "selected" : ""; ?>>滑出</option>
                            </select>
                        </td>
                        <input type="hidden" name="id[]" value="<?= $data['id']; ?>">
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
</div>
<hr>
<div class="w100 mg" style="height:160px;">
    <h3 class="ct mg">新增預告片海報</h3>
    <form action="./api/add.php?do=<?=$do;?>" method="post" enctype="multipart/form-data">
        <table class="w100">
            <tr>
                <td>
                    <label for="">預告片海報</label>
                    <input type="file" name="img" required>
                </td>
                <td>
                    <label for="">預告片片名</label>
                    <input type="text" name="name">
                </td>
            </tr>
        </table>
        <div class="ct">
            <input type="submit" value="新增">
            <input type="reset" value="重置">
        </div>
    </form>
</div>