<style>
    .out_box {
        height: 400px;
    }

    .top_img {
        top: 0;
        width: 210px;
        height: 250px;
        /* background: #f00; */
        left: 50%;
        transform: translateX(-50%);
    }

    .bottom_bnt {
        bottom: 0;
        width: 420px;
        height: 150px;
        /* background: #fff; */
        left: 50%;
        transform: translateX(-50%);
    }

    .left,
    .right {
        width: 30px;
        height: 150px;
    }

    .s_img {
        width: 360px;
        height: 150px;
    }
    .im img{
        transition: 0.5s;
    }
    .im:hover img{
        transform: scale(1.1);
        border: 3px solid #fff;
    }

    .left span {
        border-top: 10px solid transparent;
        border-right: 20px solid #000;
        border-bottom: 10px solid transparent;
        border-left: 10px solid transparent;
    }

    .right span {
        border-top: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid transparent;
        border-left: 20px solid #000;
    }
</style>
<div id="mm">
    <div class="half" style="vertical-align:top;">
        <h1>預告片介紹</h1>
        <div class="rb tab" style="width:100%;">
            <div class="w100 pos_r out_box">
                <?php
                $pp_counts=$poster->math('count','id',['sh'=>1]);
                $pps = $poster->all(['sh' => 1], " order by rank");
                foreach ($pps as $key => $pp) {
                ?>
                    <div class="top_img pos_a" style="display:none;" data-ani="<?=$pp['ani'];?>" id="t<?=$key;?>">
                        <div class="w100 flex flex_jc">
                            <img src="./upload/<?= $pp['img']; ?>" height="220px">
                        </div>
                        <div class="ct"><?= $pp['name']; ?></div>
                    </div>
                <?php
                }
                ?>
                <div class="bottom_bnt pos_a">
                    <div class="w100 flex">
                        <div class="left flex flex_ac" onclick="pp(1)">
                            <span></span>
                        </div>
                        <div class="s_img flex flex_ac">
                            <?php
                            foreach ($pps as $key => $pp) {
                            ?>
                                <div class="im flex flex_jc flex_w" id="ssaa<?=$key;?>" style="width:90px;">
                                    <img src="./upload/<?= $pp['img']; ?>" width="70px">
                                    <div class="w100 ct"><?= $pp['name']; ?></div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="right flex flex_ac" onclick="pp(2)">
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="half">
        <h1>院線片清單</h1>
        <div class="rb tab" style="width:95%;">
            <div class="w100 pa5 flex flex_w flex_ac flex_jb">
                <?php
                $start_day = date("Y-m-d", strtotime("-2 days"));
                $p = $_GET['p'] ?? 1;
                $div = 4;
                $mv_counts = $movie->math('count', 'id', " WHERE `sh`=1 && `ondate` BETWEEN '$start_day' AND '$today'");
                $pages = ceil(($mv_counts / $div));
                $start = ($p - 1) * $div;
                $pre = (($p - 1) > 0) ? ($p - 1) : 1;
                $next = (($p + 1) <= $pages) ? ($p + 1) : $pages;
                $mvs = $movie->all(" WHERE `sh`=1 && `ondate` BETWEEN '$start_day' AND '$today' order by `rank` limit $start,$div");
                foreach ($mvs as $key => $mv) {
                ?>
                    <div class="flex flex_w" style="width:200px;">
                        <div class="w40">
                            <a href="?do=intro&id=<?= $mv['id']; ?>">
                                <img src="./upload/<?= $mv['poster']; ?>" width="80px">
                            </a>
                        </div>
                        <div class="w60">
                            <div class="w100">
                                片名:<?= $mv['name']; ?>
                            </div>
                            <div class="w100">分級: <img src="./icon/<?= $arylevel[$mv['level']]; ?>"><?= $mv['level']; ?></div>
                            <div class="w100">上映日期:</div>
                            <div class="w100"><?= $mv['ondate']; ?></div>
                        </div>
                        <div class="w100">
                            <a class="t_d" href="?do=intro&id=<?= $mv['id']; ?>">劇情簡介</a>
                            <a class="t_d" href="?do=orders&id=<?= $mv['id']; ?>">線上訂票</a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="ct">
                <a href="?do=<?= $do; ?>&p=<?= $pre; ?>">
                    <</a>
                        <?php
                        for ($i = 1; $i <= $pages; $i++) {
                        ?>
                            <a href="?do=<?= $do; ?>&p=<?= $i; ?>" <?= ($i == $p) ? "style='font-size:24px'" : ""; ?>><?= $i; ?></a>
                        <?php
                        }
                        ?>
                        <a href="?do=<?= $do; ?>&p=<?= $next; ?>">></a>
            </div>
        </div>
    </div>
</div>


<script>
    /*--------------*/
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
     /*--------------*/
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


    /*--------------*/
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
    /*--------------*/
</script>