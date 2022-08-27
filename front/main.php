<div id="mm">
    <div class="half" style="vertical-align:top;">
        <h1>預告片介紹</h1>
        <div class="rb tab" style="width:95%;">
        <div class="w100 h400">
        <div class="w100 h300 pos_r">
        <?php
           $pots=$poster->all($sh," order by `rank`"); 
           $countp=$poster->math('count','id',$sh);
           foreach ($pots as $key => $pot) {
            ?>
            <div class="flex flex_jc flex_ac flex_w pos_a pos_ct bg_pots" id="b<?=$key;?>" style="display:none;" data-text="<?=$pot['ani'];?>">
                <img src="./upload/<?=$pot['img'];?>" width="210px" height="250px">
                <div class="w100 ct"><?=$pot['name'];?></div>
            </div>
            <?php
           }
        ?>
        </div>
        <div class="w100 h100 pos_r flex flex_jc flex_ac sz_pots">
           <div onclick="pp(1)" class="w10 flex flex_jc flex_ac">
            <span class="left blo" style="height:0px;"></span>
           </div>
           <div class="w80 flex flex_jb">
           <?php
            foreach ($pots as $key => $pot){
                ?>
            <div class="w20 im" id="ssaa<?=$key;?>">
                <img src="./upload/<?=$pot['img'];?>" width="60px" height="80px">
                <div class="w100"><?=$pot['name'];?></div>
            </div>
                <?php
            }
           ?>
           </div>
           <div onclick="pp(2)" class="w10 flex flex_jc flex_ac">
            <span class="right blo" style="height:0px;"></span>
           </div>
        </div>
        </div>
        </div>
    </div>
    <div class="half">
        <h1>院線片清單</h1>
        <div class="rb tab" style="width:95%;">
            <div class="w100 flex flex_jb flex_w">
                <?php
                $p=$_GET['p']??1;
                $div=4;
                $count=$movie->math('count','id',$sh," && `ondate` between '$start_day' AND '$today'");
                $pages=ceil($count/$div);
                $start=($p-1)*$div;
                $pre=($p-1>0)?($p-1):1;
                $next=($p+1<=$pages)?($p+1):$pages;
                $mvs=$movie->all($sh," && `ondate` between '$start_day' AND '$today' order by `rank` limit $start,$div");
                foreach ($mvs as $key => $mv) {
                   ?>
                    <div class="w40 flex flex_w">
                        <div class="w100"><?=$mv['name'];?></div>
                        <div class="w50">
                            <img src="./upload/<?=$mv['poster'];?>" width="80px" height="100px">
                        </div>
                        <div class="w50" style="font-size:14px;">
                            <p>分級: <img src="./icon/<?=$level_icon[$mv['level']];?>" width="18px" height="18px"></p>
                            <p>上映日期</p>
                            <p><?=$mv['ondate'];?></p>
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
            <div class="w100 ct">
                <a href="?p=<?=$pre;?>"><</a>
                <?php
                for ($i=1; $i <= $pages ; $i++) { 
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
$('.bg_pots').eq(0).show();
let slider=setInterval(function(){
    let now=$('.bg_pots:visible').index();
    let len=$('.bg_pots').length;
    let next=(now+1<len)?(now+1):0;
    let ani=$('.bg_pots:visible').data('text');
    switch (ani) {
        case 1:
            $('.bg_pots').eq(now).fadeOut(500,function(){
                $('.bg_pots').eq(next).fadeIn(1500);
            })
            break;
        case 2:
            $('.bg_pots').eq(now).hide(500,function(){
                $('.bg_pots').eq(next).show(1500);
            })
            break;
        case 3:
            $('.bg_pots').eq(now).slideUp(500,function(){
                $('.bg_pots').eq(next).slideDown(1500);
            })
            break;
    
        default:
            break;
    }
},3000)

$('.sz_pots').mouseenter(function(){
    clearInterval(slider);
})
$('.sz_pots').mouseleave(function(){
    slider=setInterval(function(){
    let now=$('.bg_pots:visible').index();
    let len=$('.bg_pots').length;
    let next=(now+1<len)?(now+1):0;
    let ani=$('.bg_pots:visible').data('text');
    switch (ani) {
        case 1:
            $('.bg_pots').eq(now).fadeOut(500,function(){
                $('.bg_pots').eq(next).fadeIn(1500);
            })
            break;
        case 2:
            $('.bg_pots').eq(now).hide(500,function(){
                $('.bg_pots').eq(next).show(1500);
            })
            break;
        case 3:
            $('.bg_pots').eq(now).slideUp(500,function(){
                $('.bg_pots').eq(next).slideDown(1500);
            })
            break;
    
        default:
            break;
    }
},3000)
})

$('.im').on('click',function(){
    let id=$(this).prop('id').replace('ssaa','b');
    $('.bg_pots:visible').hide(500,()=>{
        $("#"+id).show(1500);
    })
})


    var nowpage=0,num=<?=$countp;?>;
							function pp(x)
							{
								var s,t;
								if(x==1&&nowpage-1>=0)
								{nowpage--;}
								if(x==2&&(nowpage+1)<=num-4)
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