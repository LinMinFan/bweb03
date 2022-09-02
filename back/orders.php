<div id="mm">
    <div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=tit">網站標題管理</a>| <a href="?do=go">動態文字管理</a>| <a href="?do=posters">預告片海報管理</a>| <a href="?do=movies">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>
    <div class="w100 h450">
        <h4 class="ct">訂單清單</h4>
        <div class="w100">
            <span>快速刪除:</span>
            <input type="radio" name="way" value="date">
            <span>依日期</span>
            <input type="text" name="date" id="date">
            <input type="radio" name="way" value="name">
            <span>依電影</span>
            <select name="name" id="name">
                <?php
                foreach ($$do->all(" GROUP BY `name`") as $key => $value) {
                    ?>
                    <option value="<?=$value['name'];?>"><?=$value['name'];?></option>
                    <?php
                }
                ?>
            </select>
            <button type="button" onclick="q_del()">快速刪除</button>
        </div>
        <form action="./api/edit.php?do=<?= $do; ?>" method="post">
            <div class="w100 h400 oy_s">
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
                    foreach ($$do->all(" order by `no` desc") as $key => $ord) {
                        ?>
                        <tr>
                            <td><?=$ord['no'];?></td>
                            <td><?=$ord['name'];?></td>
                            <td><?=$ord['date'];?></td>
                            <td><?=$ord['session'];?></td>
                            <td><?=$ord['qt'];?></td>
                            <td>
                                <?php
                                foreach (unserialize($ord['seats']) as $key => $i) {
                                    ?>
                                    <p><?=floor($i/5)+1;?>排<?=$i%5+1;?>號</p>
                                    <?php
                                }
                                ?>
                            </td>
                            <td>
                                <button type="button" onclick="del('orders',<?=$ord['id'];?>)">刪除</button>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </form>
    </div>
</div>