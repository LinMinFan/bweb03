<?php
include "../base.php";

if (!empty($_POST['id'])) {
    foreach ($_POST['id'] as $key => $id) {
        if (isset($_POST['del']) && in_array($id,$_POST['del'])) {
            ${$_GET['do']}->del($id);
        }else{
            $data=${$_GET['do']}->find($id);
            switch ($_GET['do']) {
                case 'posters':
                    $data['name']=$_POST['name'][$key];
                    $data['rank']=$_POST['rank'][$key];
                    $data['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;
                    $data['ani']=$_POST['ani'][$key];
                    break;
                case 'movies':
                    $data['rank']=$_POST['rank'][$key];
                    break;
                
                default:
                    
                    break;
            }
            ${$_GET['do']}->save($data);
        }
    }
}
to("../back.php?do={$_GET['do']}");
//name rank sh ani