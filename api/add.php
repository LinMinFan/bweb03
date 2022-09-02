<?php
include "../base.php";

$do=$_GET['do'];

$_POST['img']=$_FILES['img']['name'];
move_uploaded_file($_FILES['img']['tmp_name'],"../img/{$_POST['img']}");
$_POST['rank']=$$do->math('max','id')+1;
$_POST['sh']=1;
$_POST['ani']=1;

$$do->save($_POST);
to("../back.php?do={$do}");