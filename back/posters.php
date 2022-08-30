<div id="mm">
<div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=admin&redo=tit">網站標題管理</a>| <a href="?do=go">動態文字管理</a>| <a href="?do=posters">預告片海報管理</a>| <a href="?do=movies">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>
<form action="./api/edit.php?do=<?=$do;?>" method="post">
<div class="w100 h250 oy_s">
    <h3 class="ct">預告片清單</h3>
    <table class="w100">
        <tr>
            <td class="ct">預告片海報</td>
            <td class="ct">預告片片名</td>
            <td class="ct">預告片排序</td>
            <td class="ct">操作</td>
        </tr>
        <?php
        foreach ($$do->all(" order by `rank`") as $key => $data) {
            ?>
                <tr>
                    <td class="ct">
                    <img src="./img/<?=$data['img'];?>" width="60px" height="80px">
                    </td>
                    <td class="ct">
                        <input type="text" name="name[]" value="<?=$data['name'];?>">
                    </td>
                    <td class="ct">
                    <input type="text" name="rank[]" value="<?=$data['rank'];?>">
                    </td>
                    <td class="ct">
                        <input type="checkbox" name="sh[]" value="<?=$data['id'];?>" <?=($data['sh']==1)?"checked":"";?>>
                        <input type="checkbox" name="del[]" value="<?=$data['id'];?>">
                        <select name="ani[]">
                            <option value="1"<?=($data['ani']==1)?"selected":"";?>>淡出</option>
                            <option value="2"<?=($data['ani']==2)?"selected":"";?>>縮放</option>
                            <option value="3"<?=($data['ani']==3)?"selected":"";?>>滑出</option>
                        </select>
                    </td>
                </tr>
                <input type="hidden" name="id[]" value="<?=$data['id'];?>">
            <?php
        }
        ?>
    </table>
</div>
    <div class="ct">
        <input type="submit" value="確定">
        <input type="reset" value="重置">
    </div>
</form>
<hr>
<form action="./api/add.php?do=<?=$do;?>" method="post" enctype="multipart/form-data">
    <div class="w100 h150">
    <h3 class="ct">新增預告片海報</h3>
    <div class="w100">
        <label for="">預告片海報</label>
        <input type="file" name="img" id="" required>
        <label for="">預告片片名</label>
        <input type="text" name="name" id="">
    </div>
    <div class="w100 ct">
        <input type="submit" value="新增">
        <input type="reset" value="重置">
    </div>
    </div>
</form>
</div>