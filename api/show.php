<?php
include "../base.php";

$id=$_POST['id'];

$data=$movie->find($id);

$data['sh']=($data['sh']==1)?0:1;

$movie->save($data);