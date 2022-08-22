<?php
include "../base.php";
$data=[];
$data['no']=date("Ymd") . sprintf("%04d",($orders->math('max','id')+1));
$data['movie']=$_POST['movieName'];
$data['date']=$_POST['date'];
$data['session']=$_POST['session'];
$data['qt']=count($_POST['seats']);
sort($_POST['seats']);
$data['set']=serialize($_POST['seats']);
$orders->save($data);

echo $data['no'];
?>