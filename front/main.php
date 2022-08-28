<div id="mm">
    <div class="half" style="vertical-align:top;">
        <h1>預告片介紹</h1>
        <div class="rb tab" style="width:95%;">
            <div id="abgne-block-20111227">
                <div class="w100 h250 pos_r">
                <?php
                $countP = $movies->math('count', 'id', $sh);
                foreach ($posters->all($sh," order by `rank`") as $key => $ps) {
                    ?>
                <div class="pos_a pos_ct b_ps dpn" data-ani="<?=$ps['ani'];?>" id="b<?=$key;?>">
                    <img src="./upload/<?=$ps['img'];?>" width="200px" height="230px">
                    <div class="ct"><?=$ps['name'];?></div>
                </div>
                <?php
                }
                ?>
               </div>
               <div class="w100 h150 flex s_box">
               <div class="w10  flex flex_jc flex_ac" onclick="pp(1)">
                        <span class="left"></span>
                    </div>
               <?php
                foreach ($posters->all($sh," order by `rank`") as $key => $ps) {
                    ?>
                    
                    <div class="w80 flex flex_jb flex_ac im s_ps" id="ssaa<?=$key;?>">
                        <div>
                            <img src="./upload/<?=$ps['img'];?>" width="80px" height="100px">
                            <div class="ct"><?=$ps['name'];?></div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="w10 flex flex_jc flex_ac" onclick="pp(2)">
                    <span class="right"></span>
                    </div>
               </div>
            </div>
        </div>
    </div>
    <div class="half">
        <h1>院線片清單</h1>
        <div class="rb tab" style="width:95%;">
            <div class="w100 flex flex_w flex_jb">
                <?php
                $p = $_GET['p'] ?? 1;
                $countM = $movies->math('count', 'id', $sh, " &&  `ondate` BETWEEN '$start_day' AND '$today'");
                $div = 4;
                $pages = ceil($countM / $div);
                $start = ($p - 1) * $div;
                $pre = ($p - 1 > 0) ? $p - 1 : 1;
                $next = ($p + 1 <= $pages) ? $p + 1 : $pages;
                foreach ($movies->all($sh, " &&  `ondate` BETWEEN '$start_day' AND '$today' order by `rank` limit $start,$div") as $key => $mv) {
                ?>
                    <div class="45">
                        <div class="w100"><?=$mv['name'];?></div>
                        <div class="w100 flex">
                            <div class="w40">
                                <a href="?do=intro&id=<?=$mv['id'];?>"><img src="./upload/<?=$mv['img'];?>" width="60px" height="80px"></a>
                            </div>
                            <div class="w50">
                                <span class="blo fs12">分級: <img src="./icon/<?=$level_icon[$mv['level']];?>"><?=$mv['level'];?></span>
                                <span class="blo fs12">上映日期:<?=$mv['ondate'];?></span>
                            </div>
                        </div>
                        <div class="w100 ct">
                            <a href="?do=intro&id=<?=$mv['id'];?>">劇情簡介</a>
                            <a href="?do=orders&id=<?=$mv['id'];?>">線上訂票</a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="ct">
                <a href="?p=<?=$pre;?>"><</a>
                <?php
                for ($i=1; $i <=$pages ; $i++) { 
                    ?>
                    <a href="?p=<?=$i;?>"><?=$i;?></a>
                    <?php
                }
                ?>
                <a href="?p=<?=$next;?>">></a>
            </div>
        </div>
    </div>
</div>

<script>
$('.b_ps').eq(0).show();
let slider=setInterval(function(){
    let now=$('.b_ps:visible').index();
    let len=$('.b_ps').length;
    let next=(now+1<len)?now+1:0;
    let ani=$('.b_ps:visible').data('ani');
    switch (ani) {
        case 1:
            $('.b_ps').eq(now).fadeOut(500,function(){
                $('.b_ps').eq(next).fadeIn(1500);
            });
            break;
        case 2:
            $('.b_ps').eq(now).hide(500,function(){
                $('.b_ps').eq(next).show(1500);
            });
            break;
        case 3:
            $('.b_ps').eq(now).slideUp(500,function(){
                $('.b_ps').eq(next).slideDown(1500);
            });
            break;
    
        default:
            break;
    }
},3000)

$('.im').on('click',function(){
    let id=$(this).prop('id').replace('ssaa','b');
    $('.b_ps:visible').hide(500,function(){
        $("#"+id).show(1500);
    })
})

$('.s_box').mouseenter(function(){
    clearInterval(slider);
})
$('.s_box').mouseleave(function(){
    slider=setInterval(function(){
    let now=$('.b_ps:visible').index();
    let len=$('.b_ps').length;
    let next=(now+1<len)?now+1:0;
    let ani=$('.b_ps:visible').data('ani');
    switch (ani) {
        case 1:
            $('.b_ps').eq(now).fadeOut(500,function(){
                $('.b_ps').eq(next).fadeIn(1500);
            });
            break;
        case 2:
            $('.b_ps').eq(now).hide(500,function(){
                $('.b_ps').eq(next).show(1500);
            });
            break;
        case 3:
            $('.b_ps').eq(now).slideUp(500,function(){
                $('.b_ps').eq(next).slideDown(1500);
            });
            break;
    
        default:
            break;
    }
},3000)
})


var nowpage=0,num=<?=$countP;?>;
function pp(x)
{
	var s,t;
	if(x==1&&nowpage-1>=0)
	{nowpage--;}
	if(x==2&&(nowpage+1)<num-4)
	{nowpage++;}
	$(".im").hide()
	for(s=0;s<=3;s++)
	{
		t=s*1+nowpage*1;
		$("#ssaa"+t).show()
	}
}
pp(1)
</script>