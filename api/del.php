<?php
include "../base.php";

$do=$_GET['do'];

$$do->del($_POST['id']);

to("../back.php?do=$do");