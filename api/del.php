<?php
$do=$_GET['do'];
include "../base.php";
${$_POST['table']}->del($_POST['id']);