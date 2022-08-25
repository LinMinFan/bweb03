<?php
include "../base.php";

$_POST['no']=date("Ymd").sprintf("%04d",$orders->math('max','id')+1);
sort($_POST['set']);
$_POST['set']=serialize($_POST['set']);
$orders->save($_POST);
echo $_POST['no'];