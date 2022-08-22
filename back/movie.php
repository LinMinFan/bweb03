<div class="w100 os" style="height:480px;">
    <button onclick="location.href='?do=add_movie'">新增電影</button>
    <hr>
    <?php
    $datas = $$do->all();
    foreach ($datas as $key => $data) {
    ?>
        <div class="flex pa5 border" style="height:140px;">
            <div class="w15">
                <img src="./upload/<?=$data['poster'];?>" height="140px">
            </div>
            <div class="w15 flex flex_ac">
                <span>分級：<img src="./icon/<?=$arylevel[$data['level']];?>"></span>
            </div>
            <div class="w70">
                <table class="w100">
                    <tr>
                        <td>
                            片名:<?=$data['name'];?>
                        </td>
                        <td>
                            片長:<?=$data['length'];?>分
                        </td>
                        <td class="ct">
                            上映時間:<?=$data['ondate'];?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="ct">
                            <button onclick="location.href='?do=edit_movie&id=<?=$data['id'];?>'">編輯電影</button>
                            <button onclick="del(<?=$data['id'];?>)">刪除電影</button>
                        </td>
                    </tr>
                </table>
                <div class="w100">
                    <?=$data['intro'];?>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
 
</div>
<script>
    function del(id){
        $.post("./api/del.php?do=<?=$do;?>",{id},()=>{
            location.reload();
        })
    }
</script>