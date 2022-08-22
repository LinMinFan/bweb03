<?php
include "../base.php";

$do=$_GET['do'];

$$do->del($_POST);

to("../back.php?do=$do");