<?php
include "../base.php";

$selectId=$_POST['id'];
$startDate=date("Y-m-d",strtotime("-2 days"));
$today=date("Y-m-d");
$mms=$movie->all(" Where `sh`='1' && ondate between '$startDate' AND '$today'");

foreach($mms as $mm){
    $selected=($selectId==$mm['id'])?'selected':'';
    echo "<option value='{$mm['id']}' $selected>{$mm['name']}</option>";
}