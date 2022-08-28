<div id="mm">
    <div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=tit">網站標題管理</a>| <a href="?do=go">動態文字管理</a>| <a href="?do=posters">預告片海報管理</a>| <a href="?do=movies">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>
    <div class="w100 h400 ofy_s">
        <h3 class="ct">訂單清單</h3>
        <div class="w100">
            <span>快速刪除</span>
            <input type="radio" name="qdel" value="date">
            <label for="">依日期:</label>
            <input type="text" name="date" id="sd">
            <input type="radio" name="qdel" value="name">
            <label for="">依電影:</label>
            <select name="name" id="sn">
                <?php
                foreach ($$do->all(" GROUP BY `name`") as $key => $ord) {
                    ?>
                    <option value="<?=$ord['name'];?>"><?=$ord['name'];?></option>
                    <?php
                }
                ?>
            </select>
            <button onclick="qdel($('input[type=radio]:checked').val())">刪除</button>
        </div>
            <table class="w100">
                <tr class="clo">
                    <td>訂單編號</td>
                    <td>電影名稱</td>
                    <td>觀看日期</td>
                    <td>場次時間</td>
                    <td>訂購數量</td>
                    <td>訂購位置及</td>
                    <td>操作</td>
                </tr>
                <?php
                foreach ($$do->all(" order by`no` desc") as $key => $data) {
                ?>
                    <tr class="clo">
                        <td><?=$data['no'];?></td>
                        <td><?=$data['name'];?></td>
                        <td><?=$data['date'];?></td>
                        <td><?=$data['session'];?></td>
                        <td><?=$data['qt'];?></td>
                        <td>
                            <?php
                            $seats=unserialize($data['seats']);
                            foreach ($seats as $key => $seat) {
                                ?>
                                <p><?=floor(($seat/5))+1;?>排<?=($seat%5)+1;?>號</p>
                                <?php
                            }
                            ?>
                        </td>
                        <td>
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
    function qdel(type){
        let chk_d;
        switch (type) {
            case 'date':
                chk_d=$('#sd').val();
                break;
            case 'name':
                chk_d=$('#sn').val();
                break;
        
            default:
                break;
        }
        if (confirm("你確定刪除"+chk_d+"全部的資料嗎?")) {
            $.post("./api/qdel.php",{type,chk_d},()=>{
                location.reload();
            })
        }
    }
</script>