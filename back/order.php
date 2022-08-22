<h2 class="ct">訂單清單</h2>
<div class="outbox">
    <div>
        <span>快速刪除</span>
        <input type="radio" name="type" value="date"><span>依日期</span>
        <input type="text" name="date" >
        <input type="radio" name="type" value="movie"><span>電影</span>
        <select name="movie" >
            <?php
                $opts=$orders->q("SELECT `movie` FROM `orders` GROUP BY `movie`");
                foreach ($opts as  $opt) {
                    ?>
                        <option value="<?=$opt['movie'];?>"><?=$opt['movie'];?></option>
                    <?php
                }
            ?>
        </select>
        <button onclick="qdel()">刪除</button>
    </div>
    <table class="w100">
        <tr>
            <td class="ct w15">訂單編號</td>
            <td class="ct w10">電影名稱</td>
            <td class="ct w15">日期</td>
            <td class="ct w15">場次時間</td>
            <td class="ct w10">訂購數量</td>
            <td class="ct w15">訂購位置</td>
            <td class="ct w10">操作</td>
        </tr>
        <?php
            $ods=$orders->all(" order by `no` desc");
            foreach ($ods as $key => $od) {
                $setrows=unserialize($od['set']);
                sort($setrows);
                ?>
                    <tr>
                        <td class="ct"><?=$od['no'];?></td>
                        <td class="ct"><?=$od['movie'];?></td>
                        <td class="ct"><?=$od['date'];?></td>
                        <td class="ct"><?=$od['session'];?></td>
                        <td class="ct"><?=$od['qt'];?></td>
                        <td class="ct">
                            <?php
                                foreach ($setrows as  $setrow) {
                                    echo (($setrow)%4+1)."排".(($setrow)%5+1)."位";
                                    echo "<br>";
                                }
                            ?>
                        </td>
                        <td class="ct"><button onclick="del('orders',<?=$od['id'];?>)">刪除</button></td>
                    </tr>
                <?php
            }
        ?>
        
    </table>
</div>
<script>
    function del(table,id){
    $.post("./api/del.php",{table,id},()=>{
        location.reload();
    })
}

    function qdel(){
    let type=$("input[name='type']:checked").val();
    let target;
    //console.log(type);
        switch (type) {
            case 'date':
                target=$("input[name='date']").val();
                break;
            case 'movie':
                target=$("select[name='movie']").val();
                break;
        
            default:
                break;
        }
        if (confirm("你確定要刪除全部"+target+"的資料嗎?")) {
            $.post("./api/q_del.php",{type,target},()=>{
                location.reload();
            })
        }


}
</script>