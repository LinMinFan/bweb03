<?php

?>
<div id="mm">
<div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=tit">網站標題管理</a>| <a href="?do=go">動態文字管理</a>| <a href="?do=posters">預告片海報管理</a>| <a href="?do=movies">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>
<div class="rb tab">
<h3 class="ct">訂單清單</h3>
<div>
    快速刪除:
    <input type="radio" name="way" data-text="date">
    依日期
    <input type="text" name="" id="date">
    <input type="radio" name="way" data-text="name">
    依電影
    <select name="" id="name">
        <?php
        foreach ($orders->all(' GROUP BY `name`') as $key => $ord) {
        ?>
        <option value="<?=$ord['name'];?>"><?=$ord['name'];?></option>
        <?php
        }
        ?>
    </select>
    <button onclick="q_del($('input[type=radio]:checked').data('text'))">刪除</button>
</div>
<div class="w100 h450 oy_s">
<table class="w100">
    <tr>
        <td>訂單編號</td>
        <td>電影名稱</td>
        <td>日期</td>
        <td>場次時間</td>
        <td>訂購數量</td>
        <td>訂購位置</td>
        <td>操作</td>
    </tr>
<?php
foreach ($orders->all(" order by `no`") as $key => $ord) {
?>
    <tr>
        <td><?=$ord['no'];?></td>
        <td><?=$ord['name'];?></td>
        <td><?=$ord['date'];?></td>
        <td><?=$ord['times'];?></td>
        <td><?=$ord['qt'];?></td>
        <td>
            <?php
            foreach (unserialize($ord['seats']) as $key => $i) {
            ?>
            <div><?=floor($i/5)+1;?>排<?=($i%5)+1;?>號</div>
            <?php
            }
            ?>
        </td>
        <td>
            <button onclick="del('orders',<?=$ord['id'];?>)">刪除</button>
        </td>
    </tr>
<?php
}
?>
</table>
</div>
</div>
</div>
<script>
    function q_del(way){
        let data;
        switch (way) {
            case 'date':
                data=$('#date').val();
                break;
            case 'name':
                data=$('#name').val();
                break;
        
            default:
                break;
        }
        if (confirm("您確定要刪除"+data+"全部的資料嗎?")) {
            $.post("./api/q_del.php",{way,data},()=>{
                bb('orders');
            })
        }
    }
</script>
