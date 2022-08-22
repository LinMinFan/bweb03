<?php
include "../base.php";

if (isset($_FILES['img'])) {
    $data['img']=$_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'],"../upload/".$_FILES['img']['name']);
}

$data['name']=$_POST['name'];
$data['sh']=1;
$data['ani']=rand(1,3);
$data['rank']=$poster->math('max','id')+1;
$poster->save($data);

to("../back.php?do=poster");
?>