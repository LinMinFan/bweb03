<?php
$mvs=$orders->all();
$mv_names=$orders->all(" GROUP BY `movie`");
?>
<div id="mm">
<div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=tit">網站標題管理</a>| <a href="?do=go">動態文字管理</a>| <a href="?do=poster">預告片海報管理</a>| <a href="?do=movie">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>
<h3 class="ct">訂單清單</h3>
<div class="w100">
    <label>快速刪除:</label>
    <input type="radio" name="mod" data-text="date">依日期
    <input type="text" name="" id="select_d">
    <input type="radio" name="mod" data-text="movie">依電影
    <select name="" id="select_m">
        <?php
            foreach ($mv_names as $key => $mv_name) {
                ?>
                    <option value="<?=$mv_name['movie'];?>"><?=$mv_name['movie'];?></option>
                <?php
            }
        ?>
    </select>
    <button onclick="q_del()">刪除</button>
</div>
<div class="w100 h400 oys">
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
            foreach ($mvs as $key => $mv) {
                ?>
                    <tr>
                        <td><?=$mv['no'];?></td>
                        <td><?=$mv['movie'];?></td>
                        <td><?=$mv['date'];?></td>
                        <td><?=$mv['session'];?></td>
                        <td><?=$mv['qt'];?></td>
                        <td>
                            <?php
                                $seats=unserialize($mv['set']);
                                foreach ($seats as $key => $seat) {
                                    ?>
                                        <p><?=(floor($seat/5)+1);?>排<?=($seat%5)+1;?>號</p>
                                    <?php
                                }
                            ?>
                        </td>
                        <td>
                            <button type="button" onclick="del('orders',<?=$mv['id'];?>)">刪除</button>
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
        let value;
        let menu=$('input[type=radio]:checked').data('text');
        
        switch (menu) {
            case 'date':
                value=$('#select_d').val();
                break;
            case 'movie':
                value=$('#select_m').val();
                break;
        
            default:
                break;
        }
        if (confirm("你確定要刪除"+value+"全部的資料嗎?")) {
            $.post("./api/q_del.php",{value,menu},()=>{
                location.reload();
            })
        }
    }
</script>