<?php
$do=$_POST['table'];
include "../base.php";
unset($_POST['table']);
$$do->save($_POST);