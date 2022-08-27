<?php
$ords=$orders->all(" order by `no` desc");
$q_names=$orders->all(" group by `name`");
?>
<div id="mm">
<div class="w100">
    <span>快速刪除:</span>
    <input type="radio" name="type" value="date">
    <label >依日期</label>
    <input type="text" name="" id="dd">
    <input type="radio" name="type" value="name">
    <label >依電影</label>
    <select name="" id="nn">
        <?php
        foreach ($q_names as $key => $q_name) {
            ?>
            <option value="<?=$q_name['name'];?>"><?=$q_name['name'];?></option>
            <?php
        }
        ?>
    </select>
    <button onclick="q_del()">刪除</button>
</div>
<div class="w100 h400 oy_s">
    <table class="w100">
        <tr>
            <td class="ct">訂單編號</td>
            <td class="ct">電影名稱</td>
            <td class="ct">日期</td>
            <td class="ct">場次時間</td>
            <td class="ct">訂購數量</td>
            <td class="ct">訂購位置</td>
            <td class="ct">操作</td>
        </tr>
        <?php
           foreach ($ords as $key => $ord) {
            ?>
            <tr>
            <td class="ct"><?=$ord['no'];?></td>
            <td class="ct"><?=$ord['name'];?></td>
            <td class="ct"><?=$ord['date'];?></td>
            <td class="ct"><?=$ord['session'];?></td>
            <td class="ct"><?=$ord['qt'];?></td>
            <td class="ct">
                <?php
                 $seats=unserialize($ord['seat']);
                 foreach ($seats as $key => $seat) {
                    ?>
                    <p><?=floor(($seat/5))+1;?>排<?=($seat%5)+1;?>號</p>
                    <?php
                 }
                ?>
            </td>
            <td class="ct">
                <button type="button" onclick="del('orders',<?=$ord['id'];?>)">刪除</button>
            </td>
        </tr>
            <?php
           } 
        ?>
    </table>
</div>
</div>
<script>
    function q_del(){
        let type=$('input[type=radio]:checked').val();
        let value;
        switch (type) {
            case 'date':
                value=$('#dd').val();
                break;
            case 'name':
                value=$('#nn').val();
                break;
        
            default:
                break;
        }
        if (confirm("您確定要刪除"+value+"的全部資料嗎?")) {
            $.post("./api/q_del.php",{type,value},()=>{
            location.reload();
        })
        }
    }
</script>