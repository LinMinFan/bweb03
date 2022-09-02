<style>
.left{
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    border-right: 20px solid #000;
    border-left: 10px solid transparent;
}
.right{
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    border-left: 20px solid #000;
    border-right: 10px solid transparent;
}
</style>
<div id="mm">
    <div class="half" style="vertical-align:top;">
        <h1>預告片介紹</h1>
        <div class="rb tab" style="width:95%;">
            <div id="abgne-block-20111227">
                <div class="w100 h250 pos_r">
                    <?php
                    $countP=$posters->math('count','id',$sh);
                    foreach ($posters->all($sh," $rank") as $key => $pt) {
                       ?>
                        <div class="pos_a pos_ct t_pt flex flex_w flex_jc flex_ac dpn" data-ani="<?=$pt['ani'];?>" id="t<?=$key;?>">
                            <img src="./img/<?=$pt['img'];?>" height="220px">
                            <div class="w100 ct"><?=$pt['name'];?></div>
                        </div>
                       <?php
                    }
                    ?>
                </div>
                <div class="w100 h150 flex flex_bt flex_ac">
                    <div class="w10 left" onclick="pp(1)"></div>
                    <?php
                    foreach ($posters->all($sh," $rank") as $key => $pt) {
                        ?>
                         <div class="b_pt flex flex_jc flex_ac flex_w w25 im" id="ssaa<?=$key;?>">
                             <img src="./img/<?=$pt['img'];?>" height="80px">
                             <div class="w100 ct"><?=$pt['name'];?></div>
                         </div>
                        <?php
                     }
                    ?>
                    <div class="w10 right" onclick="pp(2)"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="half">
        <h1>院線片清單</h1>
        <div class="rb tab" style="width:95%;">
            <div class="w100 flex flex_w flex_jb">
                <?php
                $countM=$movies->math('count','id',$sh," && `ondate` between '$start_day' AND '$today'");
                $p=$_GET['p']??1;
                $div=4;
                $pages=ceil($countM/$div);
                $start=($p-1)*$div;
                $pre=($p-1>0)?$p-1:1;
                $next=($p+1<=$pages)?$p+1:$pages;
                foreach ($movies->all($sh,"&& `ondate` between '$start_day' AND '$today' $rank limit $start,$div") as $key => $mv) {
                    ?>
                    <div class="w45 flex flex_w">
                        <div class="w100">
                            片名:<?=$mv['name'];?>
                        </div>
                        <div class="w100 flex">
                            <div class="w45">
                                <a href="?do=intro&id=<?=$mv['id'];?>">
                                    <img src="./img/<?=$mv['img'];?>" width="60px">
                                </a>
                            </div>
                            <div class="w45 fs12">
                                <div class="w100">分級:</div>
                                <div class="w100">
                                    <img src="./icon/<?=$level_icon[$mv['level']];?>"><?=$mv['level'];?>
                                </div>
                                <div class="w100">上映日期:</div>
                                <div class="w100">
                                    <?=$mv['ondate'];?>
                                </div>
                            </div>
                        </div>
                        <div class="w100">
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
$('.t_pt').eq(0).show();
let slider=setInterval(function(){
    let len=$('.t_pt').length;
    let now=$('.t_pt:visible').index();
    let next=(now+1<len)?now+1:0;
    let ani=$('.t_pt:visible').data('ani');
    switch (ani) {
        case 1:
            $('.t_pt:visible').fadeOut(500,function(){
                $('.t_pt').eq(next).fadeIn(1500);
            })
        case 2:
            $('.t_pt:visible').hide(500,function(){
                $('.t_pt').eq(next).show(1500);
            })
        case 3:
            $('.t_pt:visible').slideUp(500,function(){
                $('.t_pt').eq(next).slideDown(1500);
            })
            break;
    
        default:
            break;
    }
},3000)

$('.b_pt').mouseenter(function(){
    clearInterval(slider);
})
$('.b_pt').mouseleave(function(){
    slider=setInterval(function(){
    let len=$('.t_pt').length;
    let now=$('.t_pt:visible').index();
    let next=(now+1<len)?now+1:0;
    let ani=$('.t_pt:visible').data('ani');
    switch (ani) {
        case 1:
            $('.t_pt:visible').fadeOut(500,function(){
                $('.t_pt').eq(next).fadeIn(1500);
            })
        case 2:
            $('.t_pt:visible').hide(500,function(){
                $('.t_pt').eq(next).show(1500);
            })
        case 3:
            $('.t_pt:visible').slideUp(500,function(){
                $('.t_pt').eq(next).slideDown(1500);
            })
            break;
    
        default:
            break;
    }
},3000)
})
$('.im').on('click',function(){
    let id=$(this).prop('id').replace('ssaa','t');
    $('.t_pt:visible').hide(500,function(){
        $("#"+id).show(1500);
    })
})

var nowpage=0,num=<?=$countP;?>;
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