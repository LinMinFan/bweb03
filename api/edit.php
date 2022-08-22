<?php
include "../base.php";

$do = $_GET['do'];



switch ($do) {
    case 'poster':
        foreach ($_POST['id'] as $key => $id) {
            if (isset($_POST['del']) && in_array($id,$_POST['del'])) {
                $$do->del($id);
            }else{
                $data=$$do->find($id);
                $data['name'] = $_POST['name'][$key];
                $data['rank'] = $_POST['rank'][$key];
                $data['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
                $data['ani'] = $_POST['ani'][$key];
                $$do->save($data);
                }
            }
        break;
    case 'movie':
            $data=$$do->find($_POST['id']);
            $name=$_FILES['img']['name'];
            move_uploaded_file($_FILES['img']['tmp_name'],"../upload/$name");
            $mov=$_FILES['mov']['name'];
            move_uploaded_file($_FILES['mov']['tmp_name'],"../upload/$mov");
            $_POST['trailer']=$mov;
            $_POST['poster']=$name;
            $_POST['ondate']=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
            unset($_POST['year'],$_POST['month'],$_POST['day']);
            $_POST['sh']=$data['sh'];
            $_POST['rank']=$data['rank'];
            $$do->save($_POST);
        break;

    default:
        # code...
        break;
    }

to("../back.php?do=$do");
