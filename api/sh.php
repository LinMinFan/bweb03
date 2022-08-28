<?php
include "../base.php";

$data=${$_POST['table']}->find($_POST['id']);
$data['sh']=$_POST['sh'];
${$_POST['table']}->save($data);