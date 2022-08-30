<style>
    .left{
        border-top: 10px solid transparent;
        border-right: 20px solid #000;
        border-bottom: 10px solid transparent;
        border-left: 10px solid transparent;
    }
    .right{
        border-top: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid transparent;
        border-left: 20px solid #000;
    }
</style>
<div id="mm">
    <div class="half" style="vertical-align:top;">
        <h1>預告片介紹</h1>
        <div class="rb tab" style="width:95%;">
            <div id="abgne-block-20111227">
                <div class="w100 h250 pos_r">
                    <?php
                        $countN=$posters->math('count','id',$sh,$rank);
                        foreach ($posters->all($sh,$rank) as $key => $pt) {
                            ?>
                            <div class="pos_a pos_ct dpn up_pt" data-ani="<?=$pt['ani'];?>" id="t<?=$key;?>">
                                <img src="./img/<?=$pt['img'];?>" width="210px" height="230px">
                                <div class="w100 ct"><?=$pt['name'];?></div>                            
                            </div>
                            <?php
                        }
                    ?>
                </div>
                <div class="w100 h150 flex flex_jb flex_ac bpt_box">
                    <div class="w5 left" onclick="pp(1)"></div>
                        <?php
                        foreach ($posters->all($sh,$rank) as $key => $pt){
                            ?>
                            <div class="w20 im" id="ssaa<?=$key;?>">
                            <img src="./img/<?=$pt['img'];?>" width="70px" height="100px">
                            <div class="w100 ct"><?=$pt['name'];?></div> 
                            </div>
                            <?php
                        }
                        ?>
                    <div class="w5 right" onclick="pp(2)"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="half">
        <h1>院線片清單</h1>
        <div class="rb tab" style="width:95%;">
            <div class="w100 flex flex_w flex_jb">
                <?php
                $p=$_GET['p']??1;
                $countM=$movies->math('count','id'," WHERE `sh`=1 && `ondate` between '$start_day' AND '$today'");
                $div=4;
                $pages=ceil($countM/$div);
                $start=($p-1)*$div;
                $pre=($p-1>0)?$p-1:1;
                $next=($p+1<=$pages)?$p+1:$pages;
                foreach ($movies->all(" WHERE `sh`=1 && `ondate` between '$start_day' AND '$today' order by `rank` limit $start,$div") as $key => $mv) {
                   ?>
                    <div class="w45 flex flex_w">
                        <div class="w100">
                        <span><?=$mv['name'];?>
                        </div>
                        <div class="w100 flex">
                        <div class="w50 flex flex_jc flex_ac">
                        <a href="?do=intro&id=<?=$mv['id'];?>" class="blo"><img src="./img/<?=$mv['img'];?>" width="60px" height="80px"></span></a>
                        </div>
                        <div class="w50">
                                <div class="w100 fs12">分級:</div>
                                <div class="w100 fs12"><img src="./icon/<?=$level_icon[$mv['level']];?>" ><?=$mv['level'];?></div>
                                <div class="w100 fs12">上映日期:</div>
                                <div class="w100 fs12"><?=$mv['ondate'];?></div>
                        </div>
                        </div>
                        <div class="w100 flex flex_jb">
                            <a href="?do=intro&id=<?=$mv['id'];?>" class="blo">劇情簡介</a>
                            <a href="?do=orders&id=<?=$mv['id'];?>" class="blo">線上訂票</a>
                        </div>
                    </div>
                   <?php
                }
                ?>
            </div>
            <div class="ct">
                <a href="?p=<?=$pre;?>"><</a>
                <?php
                for ($i=1; $i<=$pages ; $i++) { 
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
$('.up_pt').eq(0).show();
let slilder=setInterval(() => {
    let now=$('.up_pt:visible').index();
    let len=$('.up_pt').length;
    let next=(now+1<len)?(now+1):0;
    let ani=$('.up_pt:visible').data('ani');
    switch (ani) {
        case 1:
            $('.up_pt').eq(now).fadeOut(500,function(){
                $('.up_pt').eq(next).fadeIn(1500);
            });
            break;
        case 2:
            $('.up_pt').eq(now).hide(500,function(){
                $('.up_pt').eq(next).show(1500);
            });
            break;
        case 3:
            $('.up_pt').eq(now).slideUp(500,function(){
                $('.up_pt').eq(next).slideDown(1500);
            });
            break;
    
        default:
            break;
    }
}, 3000);


var nowpage=0,num=<?=$countN;?>;
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

$('.bpt_box').mouseenter(function(){
    clearInterval(slilder);
})
$('.bpt_box').mouseleave(function(){
    slilder=setInterval(() => {
    let now=$('.up_pt:visible').index();
    let len=$('.up_pt').length;
    let next=(now+1<len)?(now+1):0;
    let ani=$('.up_pt:visible').data('ani');
    switch (ani) {
        case 1:
            $('.up_pt').eq(now).fadeOut(500,function(){
                $('.up_pt').eq(next).fadeIn(1500);
            });
            break;
        case 2:
            $('.up_pt').eq(now).hide(500,function(){
                $('.up_pt').eq(next).show(1500);
            });
            break;
        case 3:
            $('.up_pt').eq(now).slideUp(500,function(){
                $('.up_pt').eq(next).slideDown(1500);
            });
            break;
    
        default:
            break;
    }
}, 3000)
})

$('.im').on('click',function(){
    let id=$(this).prop('id').replace('ssaa','t');
    $('.up_pt:visible').hide(500,function(){
        $('#'+id).show(1500)
    })
})
</script>