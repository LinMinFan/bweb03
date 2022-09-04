<?php
$do=$_GET['do'];
include "../base.php";

if (!empty($_POST['id'])) {
    foreach ($_POST['id'] as $key => $id) {
        if (isset($_POST['del']) && in_array($id,$_POST['del'])) {
            $$do->del($id);
        }else{
            $data=$$do->find($id);
            switch ($do) {
                case 'posters':
                    $data['name']=$_POST['name'][$key];
                    $data['rank']=$_POST['rank'][$key];
                    $data['ani']=$_POST['ani'][$key];
                    $data['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;
                    break;
                case 'movies':
                    $data['rank']=$_POST['rank'][$key];
                    break;
                
                default:
                    
                    break;
            }
            $$do->save($data);
        }
    }
}


to("../back.php?do={$do}");