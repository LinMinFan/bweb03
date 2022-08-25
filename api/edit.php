<?php
include "../base.php";

switch ($_GET['do']) {
    case 'poster':
        if (!empty($_POST['id'])) {
            foreach ($_POST['id'] as $key => $id) {
                if (isset($_POST['del']) && in_array($id,$_POST['del'])) {
                    ${$_GET['do']}->del($id);
                }else {
                    $pt=${$_GET['do']}->find($id);
                    $pt['name']=$_POST['name'][$key];
                    $pt['rank']=$_POST['rank'][$key];
                    $pt['ani']=$_POST['ani'][$key];
                    $pt['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;
                    ${$_GET['do']}->save($pt);
                }
            }
        }
        break;
    case 'movie':
        $_POST['poster']=$_FILES['poster']['name'];
        move_uploaded_file($_FILES['poster']['tmp_name'],"../upload/".$_POST['poster']);
        $_POST['trailer']=$_FILES['trailer']['name'];
        move_uploaded_file($_FILES['trailer']['tmp_name'],"../upload/".$_POST['trailer']);
        $_POST['ondate']=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
        unset($_POST['year'],$_POST['month'],$_POST['day']);
        ${$_GET['do']}->save($_POST);
        break;
    
    default:
        # code...
        break;
}

to("../back.php?do=".$_GET['do']);