<?php
include "../base.php";

$orders->del([$_POST['type']=>$_POST['chk_d']]);