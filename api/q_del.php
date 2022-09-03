<?php
include "../base.php";

${$_POST['table']}->del([$_POST['way']=>$_POST['data']]);