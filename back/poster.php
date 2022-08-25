<style>
    .top_box{
        height: 250px;
    }
    .bottom_box{
        height: 100px;
    }
</style>
<div id="mm">
<div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=tit">網站標題管理</a>| <a href="?do=go">動態文字管理</a>| <a href="?do=poster">預告片海報管理</a>| <a href="?do=movie">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>

<h3 class="ct">預告片清單</h3>
<form action="./api/edit.php?do=poster" method="post">
<div class="w100 top_box oys">
<table class="w100">
    <tr>
        <td class="ct">預告片海報</td>
        <td class="ct">預告片片名</td>
        <td class="ct">預告片排序</td>
        <td class="ct">操作</td>
    </tr>
    <?php
       $datas=$$do->all(" order by `rank`");
       foreach ($datas as $key => $data) {
        ?>
            <tr>
                <td class="ct">
                    <img src="./upload/<?=$data['img'];?>" height="80px">
                </td>
                <td class="ct">
                    <input type="text" name="name[]" value="<?=$data['name'];?>">
                </td>
                <td class="ct">
                    <input type="text" name="rank[]" value="<?=$data['rank'];?>">
                </td>
                <td class="ct">
                    <input type="checkbox" name="sh[]" value="<?=$data['id'];?>" <?=($data['sh']==1)?"checked":"";?>><span>顯示</span>
                    <input type="checkbox" name="del[]" value="<?=$data['id'];?>"><span>刪除</span>
                    <select name="ani[]" >
                        <option value="1" <?=($data['ani']==1)?"selected":"";?>>淡入</option>
                        <option value="2" <?=($data['ani']==2)?"selected":"";?>>縮放</option>
                        <option value="3" <?=($data['ani']==3)?"selected":"";?>>滑出</option>
                    </select>
                </td>
                <input type="hidden" name="id[]" value="<?=$data['id'];?>">
            </tr>
        <?php
       }
    ?>
</table>
</div>
<div class="ct">
       <input type="submit" value="編輯">
       <input type="reset" value="重置">
</div>
</form>
<div class="bottom_box w100">
<h3 class="ct">新增預告片海報</h3>
<form action="./api/add.php?do=<?=$do?>" method="post" enctype="multipart/form-data">
<table class="w100">
    <tr>
        <td>
            <input type="file" name="img" required>
        </td>
        <td>
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
</div>
