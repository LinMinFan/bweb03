<?php
if (!empty($_POST['acc'])) {
  if ($_POST['acc']=='admin' && $_POST['pw']==1234) {
    $_SESSION['acc']=1;
    to("back.php");
  }else {
    $error="帳號或密碼錯誤";
  }
}
?>
<h4 class="ct"><?=($error)??"";?></h4>
<form action="?" method="POST">
<table style="width:50%;margin:auto;">
    <tr>
        <td>帳號：</td>
        <td><input type="text" name="acc"></td>
    </tr>
    <tr>
        <td>密碼：</td>
        <td><input type="password" name="pw"></td>
    </tr>
</table>
<div style="width:30%;margin:20px auto;">
    <input type="submit" value="送出">
</div>
</form>

