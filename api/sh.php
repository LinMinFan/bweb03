<?php
include "../base.php";

$show=${$_POST['table']}->find($_POST['id']);
$show['sh']=($show['sh']+1)%2;
${$_POST['table']}->save($show);