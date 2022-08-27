<?php
include "../base.php";

switch ($_GET['do']) {
    case 'poster':
        $_POST['img']=$_FILES['img']['name'];
        move_uploaded_file($_FILES['img']['tmp_name'], "../upload/".$_POST['img']);
        $_POST['ani']=1;
        break;
    case 'movie':
        $_POST['poster']=$_FILES['poster']['name'];
        move_uploaded_file($_FILES['poster']['tmp_name'], "../upload/".$_POST['poster']);
        $_POST['film']=$_FILES['film']['name'];
        move_uploaded_file($_FILES['film']['tmp_name'], "../upload/".$_POST['film']);
        $_POST['ondate']=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
        unset($_POST['year'],$_POST['month'],$_POST['day']);
        break;
    
    default:
        # code...
        break;
}
$_POST['rank']=${$_GET['do']}->math('max','id')+1;
$_POST['sh']=1;
${$_GET['do']}->save($_POST);
to("../back.php?do=".$_GET['do']);