<?php
include "../base.php";

$c_sh=${$_POST['table']}->find($_POST['id']);
$c_sh['sh']=($c_sh['sh']+1)%2;
${$_POST['table']}->save($c_sh);