<?php
$pos=$poster->all($sh," order by `rank`");
?>
<style>
  .list_pos{
    left: 50%;
    transform: translateX(-50%);
  }
</style>
<div id="mm">
    <div class="half" style="vertical-align:top;">
      <h1>預告片介紹</h1>
      <div class="rb tab" style="width:95%;">
        <div class="w100 flex flex_w">
          <div class="w100 h300 pos_r" id="b_pos">
            <?php
              foreach ($pos as $key => $po) {
                ?>
                <div class="pos_a list_pos" style="display:none;" data-ani="<?=$po['ani'];?>" id="ss<?=$key;?>">
                  <img  src="./upload/<?=$po['img'];?>" width="210px">
                  <div class="ct"><?=$po['name'];?></div>
                </div>
                <?php
              }
            ?>
          </div>
          <div class="w100 h100 pos_r" id="s_pos">
            <div class="w100 flex flex_jc h100">
              <div class="w10 flex flex_jc flex_ac" onclick="pp(1)"><span class="left blo"></span></div>
              <?php
              foreach ($pos as $key => $po) {
                ?>
                <div class="w20 im" id="ssaa<?=$key;?>">
                  <img  src="./upload/<?=$po['img'];?>" width="70px">
                  <div class="ct"><?=$po['name'];?></div>
                </div>
                <?php
              }
            ?>
              <div class="w10 flex flex_jc flex_ac" onclick="pp(2)"><span class="right blo"></span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="half">
      <h1>院線片清單</h1>
      <div class="rb tab" style="width:95%;">
        <div class="w100 flex flex_w p5 flex_jc">
            <?php
            $all_mvs=$movie->math('count','id'," WHERE `sh`= 1 && `ondate` between '$start_day' AND '$today'");
            $p=$_GET['p']??1;
            $div=4;
            $pages=ceil($all_mvs/$div);
            $start=($p-1)*$div;
            $pre=(($p-1)>0)?($p-1):1;
            $next=(($p+1)<=$pages)?($p+1):$pages;
            $mvs=$movie->all("  WHERE `sh`= 1 && `ondate` between '$start_day' AND '$today' order by `rank` limit $start,$div");
            foreach ($mvs as $key => $mv) {
              ?>
                <div class="w45 flex flex_w">
                  <div class="w100 fs14">片名:<?=$mv['name'];?></div>
                  <div class="w100 flex">
                    <div class="w40">
                    <a href="?do=intro&id=<?=$mv['id'];?>">
                      <img src="./upload/<?=$mv['poster'];?>" height="80px">
                      </a>
                    </div>
                    <div class="w60">
                      <div class="w100 fs12">分級: 
                      <img src="./icon/<?=$arraystr[$mv['level']];?>" width="20px"><?=$mv['level'];?>
                      </div>
                      <div class="w100 fs12">上映日期:<?=$mv['ondate'];?></div>
                      <div class="w100">
                        <a class="fs12" style="background:#333;color:#fff;border: radios 3px;" href="?do=intro&id=<?=$mv['id'];?>">劇情簡介</a>
                        <a class="fs12" style="background:#333;color:#fff;border: radios 3px;" href="?do=orders&id=<?=$mv['id'];?>">線上訂票</a>
                      </div>
                    </div>
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
$('.list_pos').eq(0).show();
let slider=setInterval(function(){
let now=$('.list_pos:visible').index();
let len=$('.list_pos').length;
let next=(now+1<len)?(now+1):0;
let ani=$('.list_pos:visible').data('ani');
  switch (ani) {
    case 1:
      $('.list_pos').eq(now).fadeOut(500,function(){
        $('.list_pos').eq(next).fadeIn(1500)
      })
      break;
    case 2:
      $('.list_pos').eq(now).hide(500,function(){
        $('.list_pos').eq(next).show(1500)
      })
      break;
    case 3:
      $('.list_pos').eq(now).slideUp(500,function(){
        $('.list_pos').eq(next).slideDown(1500)
      })
      break;
  
    default:
      break;
  }
},3000)

$('#s_pos').mouseenter(function(){
  clearInterval(slider)
})
$('#s_pos').mouseleave(function(){
 slider=setInterval(function(){
let now=$('.list_pos:visible').index();
let len=$('.list_pos').length;
let next=(now+1<len)?(now+1):0;
let ani=$('.list_pos:visible').data('ani');
  switch (ani) {
    case 1:
      $('.list_pos').eq(now).fadeOut(500,function(){
        $('.list_pos').eq(next).fadeIn(1500)
      })
      break;
    case 2:
      $('.list_pos').eq(now).hide(500,function(){
        $('.list_pos').eq(next).show(1500)
      })
      break;
    case 3:
      $('.list_pos').eq(now).slideUp(500,function(){
        $('.list_pos').eq(next).slideDown(1500)
      })
      break;
  
    default:
      break;
  }
},3000)
})

$('.im').on('click',function(){
  $('.list_pos:visible').hide(500);
  let id=$(this).prop('id').replace('ssaa','ss');
  $('#'+id).show(1500);
})

var nowpage=0,num=<?=$all_mvs;?>;
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