<?php
include "../base.php";
$do=$_GET['do'];

if (!empty($_FILES['img'])) {
    $_POST['img']=$_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/{$_POST['img']}");
    switch ($do) {
        case 'posters':
            $_POST['rank']=$$do->math('max','id')+1;
            $_POST['ani']=1;
            $_POST['sh']=1;
            break;
        case 'movies':
            $_POST['film']=$_FILES['film']['name'];
            move_uploaded_file($_FILES['film']['tmp_name'],"../img/{$_POST['film']}");
            $_POST['date']=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
            unset($_POST['year'],$_POST['month'],$_POST['day']);
            if (!isset($_POST['id'])) {
                $_POST['rank']=$$do->math('max','id')+1;
                $_POST['sh']=1;
            }
            break;
        
        default:
            
            break;
    }
    $$do->save($_POST);
}

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
to("../back.php?do=$do");