<?php
include "../base.php";

switch ($_GET['do']) {
    case 'poster':
        $_POST['img']=$_FILES['img']['name'];
        move_uploaded_file($_FILES['img']['tmp_name'],"../upload/".$data['img']);
        $_POST['rank']=${$_GET['do']}->math('max','id')+1;
        $_POST['sh']=1;
        $_POST['ani']=1;
        break;
    case 'movie':
        $_POST['poster']=$_FILES['poster']['name'];
        move_uploaded_file($_FILES['poster']['tmp_name'],"../upload/".$_POST['poster']);
        $_POST['trailer']=$_FILES['trailer']['name'];
        move_uploaded_file($_FILES['trailer']['tmp_name'],"../upload/".$_POST['trailer']);
        $_POST['ondate']=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
        unset($_POST['year'],$_POST['month'],$_POST['day']);
        $_POST['rank']=${$_GET['do']}->math('max','id')+1;
        $_POST['sh']=1;
        break;
    
    default:
        
        break;
}


${$_GET['do']}->save($_POST);
to("../back.php?do=".$_GET['do']);