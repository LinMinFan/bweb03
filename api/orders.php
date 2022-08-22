<?php
include "../base.php";


$row=[];
$row['no']=date("Ymd").sprintf("%04d",($orders->math('max','id')+1));
$row['movie']=$_POST['chk_movie'];
$row['date']=$_POST['chk_date'];
$row['session']=$_POST['chk_session'];
$row['qt']=count($_POST['set']);
sort($_POST['set']);
$row['set']=serialize($_POST['set']);
$orders->save($row);

echo $orders->find($row)['id'];