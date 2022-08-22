<?php
include "../base.php";

$table=$_POST['table'];

$id=$_POST['id'];

$$table->del($id);