<?php
include "../base.php";

$_POST['no']=date("Ymd").sprintf("%04d",$orders->math('max','id',['date'=>date("Y-m-d")])+1);
$_POST['qt']=count($_POST['seats']);
$_POST['seats']=serialize($_POST['seats']);
$orders->save($_POST);
echo $_POST['no'];