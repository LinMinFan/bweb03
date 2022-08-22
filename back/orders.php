
<div class="w100 mg " style="height:480px;">
    <h3 class="ct mg">訂單清單</h3>
    <form action="./api/edit.php?do=<?=$do;?>" method="post">
    <div>
        <label>快速刪除：</label>
        <input type="radio" name="fastdel" value="1">
        <span>依日期</span>
        <input type="date"  id="datedel">
        <input type="radio" name="fastdel" value="2">
        <span>依電影</span>
        <input type="text"  id="namedel">
        <button type="button" onclick="fast_del($('input[type=radio]:checked').val())">刪除</button>
    </div>
        <div class="w100 os" style="height:380px;">
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
                $datas = $$do->all();
                foreach ($datas as $key => $data) {
                ?>
                    <tr>
                        <td class="ct"><?= $data['no']; ?></td>
                        <td class="ct"><?= $data['movie']; ?></td>
                        <td class="ct"><?= $data['date']; ?></td>
                        <td class="ct"><?= $data['session']; ?></td>
                        <td class="ct"><?= $data['qt']; ?></td>
                        <td class="ct">
                            <?php
                                $sets=unserialize($data['set']);
                                foreach ($sets as $key => $set) {
                                    $row=($set%4)+1;
                                    $num=($set%5)+1;
                                    ?>
                                        <span class="blo"><?=$row;?>排<?=$num;?>號</span>
                                    <?php
                                }
                            ?>
                        </td>
                        <td class="ct">
                            <button type="button" onclick="del(<?=$data['id'];?>)">刪除</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
        
    </form>
</div>
<script>

    function del(id){
            $.post("./api/del.php?do=<?=$do;?>",{id},()=>{
                location.reload();
            })
        }
    
    function fast_del(mode){
        let date;
        let movie;
        switch (mode) {
            case "1":
                date=$('#datedel').val();
                if (confirm("你確定要刪除全部"+date+"的資料嗎?")) {
                    $.post("./api/fast_del.php?do=orders",{date},()=>{
                    location.reload();
                })
                }
                break;
            case "2":
                movie=$('#namedel').val();
                if (confirm("你確定要刪除全部"+movie+"的資料嗎?")) {
                    $.post("./api/fast_del.php?do=orders",{movie},()=>{
                    location.reload();
                })
                }
                break;
        
            default:
                break;
        }
        
    }
</script>