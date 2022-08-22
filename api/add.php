<?php
include "../base.php";

$do=$_GET['do'];

    $row=[];
    switch ($do) {
        case 'poster':
            $name=$_FILES['img']['name'];
            move_uploaded_file($_FILES['img']['tmp_name'],"../upload/$name");
            $_POST['img']=$name;
            $_POST['rank']=$$do->math('max','id')+1;
            $_POST['sh']=1;
            $_POST['ani']=rand(1,3);
            break;
        case 'movie':
            $name=$_FILES['img']['name'];
            move_uploaded_file($_FILES['img']['tmp_name'],"../upload/$name");
            $mov=$_FILES['mov']['name'];
            move_uploaded_file($_FILES['mov']['tmp_name'],"../upload/$mov");
            $_POST['poster']=$name;
            $_POST['trailer']=$mov;
            $_POST['ondate']=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
            unset($_POST['year'],$_POST['month'],$_POST['day']);
            $_POST['rank']=$$do->math('max','id')+1;
            $_POST['sh']=1;
            break;
        
        default:
            # code...
            break;
    }
    $$do->save($_POST);

to("../back.php?do=$do");