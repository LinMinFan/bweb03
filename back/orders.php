<div id="mm">
    <div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=tit">網站標題管理</a>| <a href="?do=go">動態文字管理</a>| <a href="?do=posters">預告片海報管理</a>| <a href="?do=movies">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>
    <h3 class="ct">訂單清單</h3>
    <div class="w100">
    <span>快速刪除:</span>
    <input type="radio" name="way" data-text="date">
    <span>依日期</span>
    <input type="text" name="date" id="date">
    <input type="radio" name="way" data-text="name">
    <span>依電影</span>
    <select name="name" id="name">
        <?php
        foreach ($$do->all($group) as $key => $mv) {
            ?>
            <option value="<?=$mv['name'];?>"><?=$mv['name'];?></option>
            <?php
        }
        ?>
    </select>
    <button type="button" onclick="q_del()">刪除</button>
    </div>
        <div class="w100 h350 oy_s">
            <table class="w100">
                <tr>
                    <td>訂單編號</td>
                    <td>電影名稱</td>
                    <td>日期</td>
                    <td>場次時間</td>
                    <td>訂單數量</td>
                    <td>訂購位置</td>
                    <td>操作</td>
                </tr>
                <?php
                foreach ($$do->all($no) as $key => $ord) {
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
                        <div><?=floor($i/5)+1;?>排<?=($i%5)+1;?>號</div>
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

    