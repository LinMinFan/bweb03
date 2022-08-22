<?php
include "../base.php";

$table=$_POST['table'];

$ids=$_POST['id'];

$rank0=$$table->find($ids[0]);
$rank1=$$table->find($ids[1]);

$rank=$rank0['rank'];

$rank0['rank']=$rank1['rank'];
$rank1['rank']=$rank;

$$table->save($rank0);
$$table->save($rank1);