<?php
include "../base.php";

if (isset($_FILES['trailer']['name'])) {
    $_POST['trailer']=$_FILES['trailer']['name'];
    move_uploaded_file($_FILES['trailer']['tmp_name'],"../upload/".$_FILES['trailer']['name']);
}
if (isset($_FILES['poster']['name'])) {
    $_POST['poster']=$_FILES['poster']['name'];
    move_uploaded_file($_FILES['poster']['tmp_name'],"../upload/".$_FILES['poster']['name']);
}

$_POST['ondate']=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
unset($_POST['year'],$_POST['month'],$_POST['day']);

$_POST['sh']=1;
$_POST['rank']=$movie->math('max','id')+1;

$movie->save($_POST);

to("../back.php?do=add_movie");

