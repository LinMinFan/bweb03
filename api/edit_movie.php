<?php
include "../base.php";

$_POST['img'] = $_FILES['img']['name'];
move_uploaded_file($_FILES['img']['tmp_name'], "../upload/{$_POST['img']}");
$_POST['film'] = $_FILES['film']['name'];
move_uploaded_file($_FILES['film']['tmp_name'], "../upload/{$_POST['film']}");
$_POST['ondate']=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
unset($_POST['year'],$_POST['month'],$_POST['day']);
${$_GET['do']}->save($_POST);
to("../back.php?do={$_GET['do']}");