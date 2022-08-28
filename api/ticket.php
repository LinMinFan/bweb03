<?php
include "../base.php";
$_POST['qt']=count($_POST['seats']);
$_POST['seats']=serialize($_POST['seats']);
$_POST['no']=date("Ymd").sprintf("%04d",$orders->math('max','id')+1);

$orders->save($_POST);
echo $_POST['no'];