<?php
include "../base.php";

switch ($_GET['do']) {
    case 'poster':
        foreach ($_POST['id'] as $key => $id) {
            $data=${$_GET['do']}->find($id);
            $data['name']=$_POST['name'][$key];
            $data['rank']=$_POST['rank'][$key];
            $data['ani']=$_POST['ani'][$key];
            ${$_GET['do']}->save($data);
        }
        break;
    case 'movie':
        $_POST['poster']=$_FILES['poster']['name'];
        move_uploaded_file($_FILES['poster']['tmp_name'], "../upload/".$_POST['poster']);
        $_POST['film']=$_FILES['film']['name'];
        move_uploaded_file($_FILES['film']['tmp_name'], "../upload/".$_POST['film']);
        $_POST['ondate']=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
        unset($_POST['year'],$_POST['month'],$_POST['day']);
        ${$_GET['do']}->save($_POST);
        break;
    
    default:
        # code...
        break;
}

to("../back.php?do=".$_GET['do']);