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
          <div class="w100 h250 pos_r">
          <?php
          foreach ($posters->all($sh,$rank) as $key => $pt) {
            ?>
            <div class="pos_a pos_ct dpn top_pt" data-ani="<?=$pt['ani'];?>" id="top<?=$key;?>">
              <img src="./img/<?=$pt['img'];?>" width="210px">
              <div class="w100 ct"><?=$pt['name'];?></div>
            </div>
            <?php
          }
          ?>
          </div>
          <div class="w100 h150 flex flex_ac flex_jb bot_box">
            <div class="w5 left" onclick="pp(1)"></div>
            <?php
            $countP=$posters->math('count','id',$sh);
            foreach ($posters->all($sh,$rank) as $key => $pt){
              ?>
            <div class="bottom_pt im flex flex_jb flex_ac flex_w w20" id="ssaa<?=$key;?>">
              <img src="./img/<?=$pt['img'];?>" width="70px">
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
        <div class="w100 flex flex_w flex_ac flex_jb">
          <?php
          $p=$_GET['p']??1;
          $div=4;
          $countM=$movies->math('count','id',$sh," && `date` between '$start_day' AND '$today'");
          $pages=ceil($countM/$div);
          $start=($p-1)*$div;
          $pre=($p-1>0)?$p-1:1;
          $next=($p+1<=$pages)?$p+1:$pages;
          foreach ($movies->all($sh," && `date` between '$start_day' AND '$today' order by `rank` limit $start,$div") as $key => $mv) {
            ?>
            <div class="w45 flex flex_w">
              <div class="w100"><?=$mv['name'];?></div>
              <table>
                <tr>
                  <td class="w45">
                    <a href="?do=intro&id=<?=$mv['id'];?>"><img src="./img/<?=$mv['img'];?>" height="80px"></a>
                  </td>
                  <td class="w45 fs12">
                    <div>分級:</div>
                    <div><img src="./icon/<?=$level_icon[$mv['level']];?>"><?=$mv['level'];?></div>
                    <div>上映日期:</div>
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
  $('.top_pt').eq(0).show();

  let slider=setInterval(function(){
  let now=$('.top_pt:visible').index();
  let len=$('.top_pt').length;
  let next=(now+1<len)?now+1:0;
  let ani=$('.top_pt:visible').data('ani');
  switch (ani) {
    case 1:
      $('.top_pt').eq(now).fadeOut(500,function(){
      $('.top_pt').eq(next).fadeIn(1500);
      })
    case 2:
      $('.top_pt').eq(now).hide(500,function(){
      $('.top_pt').eq(next).show(1500);
      })
    case 3:
      $('.top_pt').eq(now).slideUp(500,function(){
      $('.top_pt').eq(next).slideDown(1500);
      })
      break;
  
    default:
      break;
  }
  },3000)
$('.bot_box').mouseenter(function(){
  clearInterval(slider);
})

$('.bottom_pt').on('click',function(){
  let id=$(this).prop('id').replace('ssaa','top');
  $('.top_pt:visible').hide(500,function(){
    $("#"+id).show(1500);
  })
})
$('.bot_box').mouseleave(function(){
  slider=setInterval(function(){
let now=$('.top_pt:visible').index();
let len=$('.top_pt').length;
let next=(now+1<len)?now+1:0;
let ani=$('.top_pt:visible').data('ani');
switch (ani) {
  case 1:
    $('.top_pt').eq(now).fadeOut(500,function(){
    $('.top_pt').eq(next).fadeIn(1500);
    })
  case 2:
    $('.top_pt').eq(now).hide(500,function(){
    $('.top_pt').eq(next).show(1500);
    })
  case 3:
    $('.top_pt').eq(now).slideUp(500,function(){
    $('.top_pt').eq(next).slideDown(1500);
    })
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