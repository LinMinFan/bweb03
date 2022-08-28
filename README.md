# 題組三解題步驟

## 共同項目

### 預備時間

* 鍵盤、滑鼠、螢幕設備檢查
* xmpp安裝
* vscode安裝
* 題組資料備份
* 建立資料夾
* 測試localhost
* 建立base檔
* 資料庫連線測試
* 建立css資料夾
* 建立js資料夾
* 建立api資料夾

### 解題順序

* 整理檔案
    * 建立icon資料夾
    * 建立upload資料夾
    * 建立index.php
    * 修改css、js連結路徑
    * 修改名稱"03P01"建立index.php
    * 修改名稱"03P03"建立back.php
    * 建立front資料夾抽出03P02區塊並給予一個名稱"intro"
        * class"mm"抽出為main.php
    * 建立back資料夾
        * class"mm"目錄外抽出為main.php

    * 建立back資料夾
        * 建立main.php

    * 建立sql資料表

        * poster預告片海報

        |名稱|類型|屬性|預設值|額外資訊|備註|
        |--|--|--|--|--|--|
        |id|int|UNSIGNED|--|AI|--|
        |img|varchar|--|--|--|--|
        |name|varchar|--|--|--|--|
        |rank|int|--|--|--|--|
        |sh|int|--|--|--|--|
        |ani|int|--|--|--|--|

        * movie 電影清單

        |名稱|類型|屬性|預設值|額外資訊|備註|
        |--|--|--|--|--|--|
        |id|int|UNSIGNED|--|AI|--|
        |name|text|--|--|--|--|
        |level|text|--|--|--|--|
        |length|int|--|--|--|--|
        |ondate|date|--|--|--|--|
        |publish|text|--|--|--|--|
        |maker|text|--|--|--|--|
        |film|text|--|--|--|--|
        |img|text|--|--|--|--|
        |intro|text|--|--|--|--|
        |sh|int|--|--|--|--|
        |rank|int|--|--|--|--|

        * orders 訂單

        |名稱|類型|屬性|預設值|額外資訊|備註|
        |--|--|--|--|--|--|
        |id|int|UNSIGNED|--|AI|--|
        |no|text|--|--|--|--|
        |name|text|--|--|--|--|
        |date|date|--|--|--|--|
        |session|text|--|--|--|--|
        |qt|int|--|--|--|--|
        |seat|text|--|--|--|--|


* 資料庫寫入語法 (加快建立資料庫速度)
    * ```php
        include "./base.php";
        $mme=['院線片01','院線片02','院線片03','院線片04'];
        $ssn=['1'=>'14:00~16:00','2'=>'16:00~18:00','3'=>'18:00~20:00','4'=>'20:00~22:00','5'=>'22:00~24:00'];
        for ($i=0; $i < 10; $i++) { 
            $data=[];
            $data['no']=date("Ymd").sprintf("%04d",($orders->math('max','id')+1));
            $data['movie']=$mme[rand(0,3)];
            $data['date']=date("Y-m-d",strtotime("+".rand(0,3)." days"));
            $data['session']=$ssn[rand(1,5)];
            $data['qt']=rand(1,4);
            $seats=[];
            while(count($seats)<=$data['qt']){
                $s=rand(0,19);
                if (!in_array($s,$seats)) {
                    $seats[]=$s;
                }
            }
            $data['set']=serialize($seats);
            //$orders->save($data);
        }
        ```

* 建置會員登入
    * 第三題並未建立會員資料庫故不須另寫api 僅需比對輸入是否為 admin 1234即可
        * ```php
            if (!empty($_POST['acc'])) {
                if ($_POST['acc']=='admin' && $_POST['pw']==1234) {
                    $_SESSION['acc']=1;
                    to("back.php");
                }else {
                    $error="帳號或密碼錯誤";
                }
            }
            ```

* 建立poster頁面
    * 使用form表單新增功能

    * 建立後臺海報管理poster add api  
        * ```php
            include "../base.php";
            if (isset($_FILES['img'])) {
            $data['img']=$_FILES['img']['name'];
            move_uploaded_file($_FILES['img']['tmp_name'],"../upload/".$_FILES['img']['name']);
            }
            $data['name']=$_POST['name'];
            $data['sh']=1;
            $data['ani']=rand(1,3);
            $data['rank']=$poster->math('max','id')+1;
            $poster->save($data);
            to("../back.php?do=poster");
            ```

    * 建立poster edit api
        * ```php
            include "../base.php";
            foreach ($_POST['id'] as $key => $id) {
            if (isset($_POST['del']) && in_array($id,$_POST['del'])) {
            $poster->del($id);  
            }else {
            $data=$poster->find($id);
            $data['name']=$_POST['name'][$key];
            $data['ani']=$_POST['ani'][$key];
            $data['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;
            $poster->save($data);
            }
            }
            to("../back.php?do=poster");
            ```

    * 建立poster rank api
        * ```js
            $('.rank_btn').on("click",function(){
            let id =$(this).data('id').split("-");
            $.post("./api/switch.php",{table:'poster',id},()=>{
            location.reload();
            })
            })
            ```

        * ```php
            $pre=(isset($dataall[($key-1)]))?$dataall[($key-1)]['id']:$data['id'];
            $next=(isset($dataall[($key+1)]))?$dataall[($key+1)]['id']:$data['id'];
            ```

        * ```php
            include "../base.php";
            $table=$_POST['table'];
            $ids=$_POST['id'];
            $rank0=$$table->find($ids[0]);
            $rank1=$$table->find($ids[1]);
            $rank=$rank0['rank'];
            $rank0['rank']=$rank1['rank'];
            $rank1['rank']=$rank;
            $$table->save($rank0);
            $$table->save($rank1);
            ```

* 建立後臺院線片管理 /back/movie.php / /back/add_movie.php (使用form表單) /back/edit_movie.php (使用form表單) 畫面

    * 建立 add_movie.php api
    * ```php
        include "../base.php";
        if (isset($_FILES['trailer']['name'])) {
            $_POST['trailer']=$_FILES['trailer']['name'];
            move_uploaded_file($_FILES['trailer']['tmp_name'],"../upload/".$_FILES['trailer']['name']);
        }
        if (isset($_FILES['poster']['name'])) {
            $_POST['poster']=$_FILES['poster']['name'];
            move_uploaded_file($_FILES['poster']['tmp_name'],"../upload/".$_FILES['poster']['name']);
        }
        $_POST['ondate']=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
        unset($_POST['year'],$_POST['month'],$_POST['day']);
        $_POST['sh']=1;
        $_POST['rank']=$movie->math('max','id')+1;
        $movie->save($_POST);
        to("./back.php?do=movie");
        ```

    * 完成各 /back/movie.php 各button 功能
        * 顯示
            * ```js
                function sw(table,id){
                $.post("./api/switch.php",{table,id},()=>{
                location.reload();
                })
                }
            ```
        * 排序前後 使用input方式節省時間

        * 刪除
            * ```js
                function del(table,id){
                $.post("./api/del.php",{table,id},()=>{
                location.reload();
                })
                }
                ```

        * 編輯 大致同 back/api add_movie.php
            * ```php
                include "../base.php";
                $data=$movie->find($_POST['id']);
                if (!empty($_FILES['trailer']['name'])) {
                    $_POST['trailer']=$_FILES['trailer']['name'];
                    move_uploaded_file($_FILES['trailer']['tmp_name'],"../upload/".$_FILES['trailer']['name']);
                }else {
                    $_POST['trailer']=$data['trailer'];
                }
                if (!empty($_FILES['poster']['name'])) {
                    $_POST['poster']=$_FILES['poster']['name'];
                    move_uploaded_file($_FILES['poster']['tmp_name'],"../upload/".$_FILES['poster']['name']);
                }else {
                    $_POST['poster']=$data['poster'];
                }
                $_POST['ondate']=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
                unset($_POST['year'],$_POST['month'],$_POST['day']);
                $_POST['sh']=$data['sh'];
                $_POST['rank']=$data['rank'];
                $movie->save($_POST);
                to("../back.php?do=add_movie");
                ```

* 建立後臺訂單管理 ./back.orders.php
    * 建立畫面
        * 各別刪除功能
        ```js
            function del(id){
            $.post("./api/del.php?do=<?=$do;?>",{id},()=>{
                location.reload();
            })
            }
        ```
        * del() api
        ```php
            include "../base.php";
            $do=$_GET['do'];
            $$do->del($_POST['id']);
            to("../back.php?do=$do");
        ```

        * 快速刪除功能
        ```js
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
        ```
        * fast_del() api
        ```php
            include "../base.php";
            $do=$_GET['do'];
            $$do->del($_POST);
            to("../back.php?do=$do");
        ```

* 製作前台功能
    * 院線片清單區版面配置
        * 上映中sql語法
        ```sql
            (" WHERE `sh`=1 && `ondate` BETWEEN '$start_day' AND '$today' order by `rank` limit $start,$div")
        ```
        * 分頁功能

    * 劇情簡介區 ./front/intro.php 再撈一次資料填入 font-size 可刪除

    * 預告片海報區 先完成畫面後製作動畫功能

        * 下方左右按鈕使用題組一製作
        ```js
        var nowpage = 0,
        num = <?=$pp_counts;?>;
        function pp(x) {
            var s, t;
            if (x == 1 && nowpage - 1 >= 0) {
                nowpage--;
            }
            if (x == 2 && (nowpage + 1) <= num - 4) {
                nowpage++;
            }
            $(".im").hide()
            for (s = 0; s <= 3; s++) {
                t = s * 1 + nowpage * 1;
                $("#ssaa" + t).show()
            }
        }
        pp(1)
        ```
        * 上方動畫
        ```js
        $('.top_img').eq(0).show();
        let slider=setInterval(function(){
            transform();
        },3000)
        function transform(){
            let now=$('.top_img:visible').index();
            let length=$('.top_img').length;
            let next=(now+1<length)?now+1:0;
            let ani=$('.top_img:visible').data('ani');
            switch (ani) {
                case 1:
                    $('.top_img').eq(now).fadeOut(500,function(){
                        $('.top_img').eq(next).fadeIn(1500);
                    });
                    break;
                case 2:
                    $('.top_img').eq(now).hide(500,function(){
                        $('.top_img').eq(next).show(1500);
                    });
                    break;
                case 3:
                    $('.top_img').eq(now).slideUp(500,function(){
                        $('.top_img').eq(next).slideDown(1500);
                    });
                    break;
                default:
                    break;
            }
        }
        ```
        * 點擊小圖切換功能
        ```js
            $('.bottom_bnt').mouseenter(function(){
            clearInterval(slider);
            })
            $('.bottom_bnt').mouseleave(function(){
            slider=setInterval(function(){
            transform();
            },3000)
            })
            $('.im').on('click',function(){
            $('.top_img:visible').hide(500);
            let id =$(this).attr('id').replace('ssaa','t');
            $("#"+id).show(1500);
            })
            ```
    * 建立訂票功能頁面 $_get['id']取得電影 建立聯動選單
        * date session
            ```js
            let id =$('#movie').val();
            get_date(id);
            function get_date(id){
            $('#date').load("./api/get_date.php",{id},()=>{
            let date = $("#date").val()
                getsession(date, id);
            })
            }
            function getsession(date, id) {
            $('#session').load("./api/get_session.php", {date,id},()=>{
            })
            }
            ```
        * get_date    
            ```php
                $mv=$movie->find($_POST['id']);
                $now=strtotime($today);
                $ondate=strtotime($mv['ondate']);
                $days=3-($now-$ondate)/(60*60*24);
                for ($i=0; $i < $days; $i++) { 
                $mmtimes=date("Y-m-d",strtotime("+$i days"));
                $mtime=date("m 月 d 日 l",strtotime("+$i days"));
                ?>
                <option value="<?=$mmtimes;?>"><?=$mtime;?></option>
                <?php
                }
                ```
        * get_session
            ```php
                $mv=$movie->find($_POST['id']);
                $date=$_POST['date'];
                $now=floor(((date("H")-12)/2<0)?0:(date("H")-12)/2);
                for($i=($now+1);$i<=5;$i++){
                $lave=20-$orders->math('sum','qt',['movie'=>"{$mv['name']}",'date'=>"{$date}",'session'=>"{$session[$i]}"]);?>
                <option value="<?=$i;?>"><?=$session[$i];?>剩餘座位(<?=$lave;?>)</option>
                <?php
                }
                ```
        * on('change')
            ```js
                $('#movie').on('change', function() {
                id = $(this).val();
                get_date(id);
                })
                $('#date').on('change', function() {
                id = $('#movie').val();
                date = $(this).val();
                getsession(date, id);
                })
                ```
    * 建立訂票座位頁面Ajax載入 get_booking.php
        * ```html
            <div class="ct">
            <button type="button" onclick="booking($('#movie').val(),$('#date').val(),$('#session').val())">確定</button>
            <button type="button" onclick="$('#movie').val(<?=$select_id;?>),get_date(<?=$select_id;?>)">重置</button>
            </div>
            ```
        * ```js
            function booking(movie, date, session) {
            $('#order').hide();
            $('#booking').show();
            $('#booking').load("./api/booking.php", {movie,date,session},()=>{
            })
            }
            ```
        * 先比對資料庫座位計算剩餘座位
         ```php
                <?php
                   for ($i = 0; $i < 20; $i++) {
                       if (in_array($i, $seats)) {
                   ?>
                           <div class="seat pos_r active">
                               <span>
                                   <?= (floor($i / 5) + 1); ?>排
                                   <?= ($i % 5 + 1); ?>號</span>
                           </div>
                       <?php
                       } else {
                       ?>
                           <div class="seat pos_r">
                               <span>
                                   <?= (floor($i / 5) + 1); ?>排
                                   <?= ($i % 5 + 1); ?>號</span>
                               <input class="pos_a chk_seat" type="checkbox"  value="<?=$i;?>">
                           </div>
                   <?php
                       }
                   }
                   ?>
         ```
        * 計算當前勾選票數
         ```js
            let seats=new Array;
            $('.chk_seat').on('change',function(){
                let seat=$(this).val();
                let len=seats.length;
                if ($(this).prop('checked')) {
                    if (len>=4) {
                        alert('最多只能勾選四個座位');
                        $(this).prop('checked',false);
                    }else {
                        seats.push(seat);
                        $(this).parent('.seat').toggleClass('active');
                    }
                }else {
                    seats.splice(seats.indexOf(seat),1);
                    $(this).parent('.seat').toggleClass('active');
                }
                $('.ticket_num').text(seats.length);
                $('#checkout').data('text',seats);
            }) 
         ```
        * 確定訂票
         ```js
            function checkout(){
            let chk_movie=$('#chk_movie').text();
            let chk_date=$('#chk_date').text();
            let chk_session=$('#chk_session').text();
            let set=$('#checkout').data('text');
            console.log(chk_movie,chk_date,chk_session);
            $.post("./api/orders.php",{chk_movie,chk_date,chk_session,set},(no)=>{
            
            })
            }
         ```
        * 完成訂票畫面並存入資料庫
         ```php
            $row=[];
            $row['no']=date("Ymd").sprintf("%04d",($orders->math('max','id')+1));
            $row['movie']=$_POST['chk_movie'];
            $row['date']=$_POST['chk_date'];
            $row['session']=$_POST['chk_session'];
            $row['qt']=count($_POST['set']);
            sort($_POST['set']);
            $row['set']=serialize($_POST['set']);
            $orders->save($row);
         ```