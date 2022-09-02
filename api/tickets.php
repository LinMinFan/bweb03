<?php
include "../base.php";

$_POST['no']=date("Ymd").$orders->math('max','id')+1;
$_POST['qt']=count($_POST['seats']);
$_POST['seats']=serialize($_POST['seats']);
$orders->save($_POST);
echo $_POST['no'];