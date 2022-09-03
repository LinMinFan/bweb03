<?php
include "../base.php";
$do=$_GET['do'];
$_POST['img']=$_FILES['img']['name'];
move_uploaded_file($_FILES['img']['tmp_name'],"../img/{$_POST['img']}");
$_POST['film']=$_FILES['film']['name'];
move_uploaded_file($_FILES['film']['tmp_name'],"../img/{$_POST['film']}");
$_POST['ondate']=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
unset($_POST['year'],$_POST['month'],$_POST['day']);
if (!isset($_POST['id'])) {
    $_POST['rank']=$$do->math('max','id')+1;
    $_POST['sh']=1;
}
$movies->save($_POST);
to("../back.php?do={$do}");