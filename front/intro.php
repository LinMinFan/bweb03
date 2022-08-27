<?php
$mv=$movie->find($_GET['id']);
?>
<div id="mm">
    <div class="tab rb" style="width:87%;">
      <div style="background:#FFF; width:100%; color:#333; text-align:left">
        <video src="./upload/<?=$mv['film'];?>" width="300px" height="250px" controls="" style="float:right;"></video>
        <font style="font-size:24px"> <img src="./upload/<?=$mv['poster'];?>" width="200px" height="250px" style="margin:10px; float:left">
        <p style="margin:3px">影片名稱 ：
          <input type="button" value="線上訂票" onclick="location.href='?do=orders&id=<?=$mv['id'];?>'" style="margin-left:50px; padding:2px 4px" class="b2_btu">
        </p>
        <p style="margin:3px">影片分級 ： <img src="./icon/<?=$level_icon[$mv['level']];?>" style="display:inline-block;"><?=$mv['level'];?> </p>
        <p style="margin:3px">影片片長 ： <?=$mv['length'];?></p>
        <p style="margin:3px">上映日期 <?=$mv['ondate'];?></p>
        <p style="margin:3px">發行商 ： <?=$mv['publish'];?></p>
        <p style="margin:3px">導演 ： <?=$mv['director'];?></p>
        <br>
        <br>
        <p style="margin:10px 3px 3px 3px; word-break:break-all"> 劇情簡介：<?=$mv['intro'];?><br>
        </p>
        </font>
        <table width="100%" border="0">
          <tbody>
            <tr>
              <td align="center"><input type="button" value="院線片清單" onclick="location.href='./index.php'"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>