<?php
$do=$_GET['do'];
include "../base.php";
unset($_SESSION['acc']);
to("./index.php?do=${$do}");