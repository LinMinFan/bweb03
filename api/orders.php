<?php
include "../base.php";

$_POST['no']=date("Ymd").sprintf("%04d",$orders->math('max','id')+1);
$_POST['seat']=serialize($_POST['seat']);
$orders->save($_POST);
echo $_POST['no'];