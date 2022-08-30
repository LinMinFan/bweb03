<?php
include "../base.php";
$do=$_POST['table'];
unset($_POST['table']);
$$do->save($_POST);