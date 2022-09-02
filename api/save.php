<?php
include "../base.php";

$do=$_GET['do'];

$_POST['img']=$_FILES['img']['name'];
move_uploaded_file($_FILES['img']['tmp_name'],"../img/{$_POST['img']}");
$_POST['film']=$_FILES['film']['name'];
$_POST['ondate']=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
unset($_POST['year'],$_POST['month'],$_POST['day']);
move_uploaded_file($_FILES['film']['tmp_name'],"../img/{$_POST['film']}");
if (empty($_POST['id'])) {
    $_POST['rank']=$$do->math('max','id')+1;
    $_POST['sh']=1;
}

$$do->save($_POST);
to("../back.php?do={$do}");