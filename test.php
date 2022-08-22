<?php
include "./base.php";
$mme=['院線片01','院線片02','院線片03','院線片04'];
$ssn=['1'=>'14:00~16:00','2'=>'16:00~18:00','3'=>'18:00~20:00','4'=>'20:00~22:00','5'=>'22:00~24:00'];

for ($i=0; $i < 10; $i++) { 
    $data=[];
    $data['no']=date("Ymd").sprintf("%04d",($orders->math('max','id')+1));
    $data['movie']=$mme[rand(0,3)];
    $data['date']=date("Y-m-d",strtotime("+".rand(0,3)." days"));
    $data['session']=$ssn[rand(1,5)];
    $data['qt']=rand(1,4);
    $seats=[];
    while(count($seats)<=$data['qt']){
        $s=rand(0,19);
        if (!in_array($s,$seats)) {
            $seats[]=$s;
        }
    }
    $data['set']=serialize($seats);
    //$orders->save($data);
}