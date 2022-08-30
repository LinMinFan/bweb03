<div id="mm">
<div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=admin&redo=tit">網站標題管理</a>| <a href="?do=go">動態文字管理</a>| <a href="?do=posters">預告片海報管理</a>| <a href="?do=movies">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>
<div class="w100 h500 oy_s">   
<h3 class="ct">訂單清單:</h3>
    <div class="w100">
        <span>快速刪除</span>
        <input type="radio" name="way" data-text="date">
        <label >依日期:</label>
        <input type="text" name="date" id="date">
        <input type="radio" name="way" data-text="name">
        <label >依電影:</label>
        <select name="name" id="name">
            <?php
            foreach ($orders->all(" group by `name`") as $key => $ord) {
                ?>
                    <option value="<?=$ord['name'];?>"><?=$ord['name'];?></option>
                <?php
            }
            ?>
        </select>
        <button onclick="q_del()">刪除</button>
    </div>
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
        foreach ($$do->all(" order by `no` desc") as $key => $data) {
            $seats=unserialize($data['seats']);
            ?>
                <tr>
                    <td class="ct"><?=$data['no'];?></td>
                    <td class="ct"><?=$data['name'];?></td>
                    <td class="ct"><?=$data['date'];?></td>
                    <td class="ct"><?=$data['session'];?></td>
                    <td class="ct"><?=$data['qt'];?></td>
                    <td class="ct">
                        <?php
                        foreach ($seats as $key => $i) {
                            ?>
                            <p><?=floor($i/5)+1;?>排<?=($i%5)+1;?>號</p>
                            <?php
                        }
                        ?>
                    </td>
                    <td class="ct">
                        <button onclick="del('orders',<?=$data['id'];?>)">刪除</button>
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
        let way=$('input[type=radio]:checked').data('text');
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
                location.reload();
            })
        }
    }
</script>