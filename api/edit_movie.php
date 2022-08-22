<?php
include "../base.php";
$data=$movie->find($_POST['id']);

if (!empty($_FILES['trailer']['name'])) {
    $_POST['trailer']=$_FILES['trailer']['name'];
    move_uploaded_file($_FILES['trailer']['tmp_name'],"../upload/".$_FILES['trailer']['name']);
}else {
    $_POST['trailer']=$data['trailer'];
}
if (!empty($_FILES['poster']['name'])) {
    $_POST['poster']=$_FILES['poster']['name'];
    move_uploaded_file($_FILES['poster']['tmp_name'],"../upload/".$_FILES['poster']['name']);
}else {
    $_POST['poster']=$data['poster'];
}

$_POST['ondate']=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
unset($_POST['year'],$_POST['month'],$_POST['day']);

$_POST['sh']=$data['sh'];
$_POST['rank']=$data['rank'];

dd($data);
dd($_POST);

$movie->save($_POST);

to("../back.php?do=add_movie");


