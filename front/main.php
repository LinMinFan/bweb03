<?php
$countP=$posters->math('count','id',$sh);
$countM=$movies->math('count','id',$sh," && `date` between '$start_day' AND '$today'");
?>
<style>
  .left{
    height: 0;
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    border-right: 20px solid #000;
    border-left: 10px solid transparent;
  }
  .right{
    height: 0;
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
          <div class="w100 h250 pos_r box_t">
            <?php
            foreach ($posters->all($sh,$rank) as $key => $pt) {
              ?>
              <div class="pos_a pos_ct dpn pt_t" data-ani="<?=$pt['ani'];?>" id="t<?=$key;?>">
              <img src="./img/<?=$pt['img'];?>" height="200px">
              <div class="ct"><?=$pt['name'];?></div>
            </div>
              <?php
            }
            ?>
          </div>
          <div class="w100 h100 pos_r box_b flex flex_jb flex_ac">
            <div class="left w5" onclick="pp(1)"></div>
            <?php
            foreach ($posters->all($sh,$rank) as $key => $pt) {
              ?>
              <div class="pt_b im" id="ssaa<?=$key;?>">
              <img src="./img/<?=$pt['img'];?>" height="70px">
              <div class="ct"><?=$pt['name'];?></div>
            </div>
              <?php
            }
            ?>
            <div class="right w5" onclick="pp(2)"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="half">
      <h1>院線片清單</h1>
      <div class="rb tab" style="width:95%;">
        <div class="w100 flex flex_w flex_jb flex ac">
          <?php
          $p=$_GET['p']??1;
          $div=4;
          $pages=ceil($countM/$div);
          $start=($p-1)*$div;
          $pre=($p-1>0)?$p-1:1;
          $next=($p+1<=$pages)?$p+1:$pages;
          foreach ($movies->all($sh," && `date` between '$start_day' AND '$today' $rank limit $start,$div") as $key => $mv) {
            ?>
            <div class="w45">
              <div>片名:<?=$mv['name'];?></div>
              <table class="w100">
                <tr>
                  <td>
                    <a href="?do=intro&id=<?=$mv['id'];?>"><img src="./img/<?=$mv['img'];?>" height="80px"></a>
                  </td>
                  <td class="fs12">
                    <div>分級:</div>
                    <div><img src="./icon/<?=$level_icon[$mv['level']];?>"><?=$mv['level'];?></div>
                    <div>上映日期</div>
                    <div><?=$mv['date'];?></div>
                  </td>
                </tr>
              </table>
              <div class="ct">
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
$('.pt_t').eq(0).show();
let slider=setInterval(function(){
let now=$('.pt_t:visible').index();
let len=$('.pt_t').length;
let next=(now+1<len)?now+1:0;
let ani=$('.pt_t:visible').data('ani');
switch (ani) {
  case 1:
    $('.pt_t').eq(now).fadeOut(500,function(){
      $('.pt_t').eq(next).fadeIn(1500)
    })
  case 2:
    $('.pt_t').eq(now).hide(500,function(){
      $('.pt_t').eq(next).show(1500)
    })
  case 3:
    $('.pt_t').eq(now).slideUp(500,function(){
      $('.pt_t').eq(next).slideDown(1500)
    })
    break;

  default:
    break;
}
},3000)
$('.box_b').mouseenter(function(){
  clearInterval(slider);
})
$('.box_b').mouseleave(function(){
  slider=setInterval(function(){
let now=$('.pt_t:visible').index();
let len=$('.pt_t').length;
let next=(now+1<len)?now+1:0;
let ani=$('.pt_t:visible').data('ani');
switch (ani) {
  case 1:
    $('.pt_t').eq(now).fadeOut(500,function(){
      $('.pt_t').eq(next).fadeIn(1500)
    })
  case 2:
    $('.pt_t').eq(now).hide(500,function(){
      $('.pt_t').eq(next).show(1500)
    })
  case 3:
    $('.pt_t').eq(now).slideUp(500,function(){
      $('.pt_t').eq(next).slideDown(1500)
    })
    break;

  default:
    break;
}
},3000)
})

$('.pt_b').on('click',function(){
  let id=$(this).prop('id').replace('ssaa','t');
  $('.pt_t:visible').hide(500,function(){
    $('#'+id).show(1000);
  })
})

let nowpage=0,num=<?=$countP;?>;
function pp(x)
{
	let s,t;
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