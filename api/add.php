<?php
include "../base.php";

$_POST['img']=$_FILES['img']['name'];
move_uploaded_file($_FILES['img']['tmp_name'],"./img/{$_POST['img']}");
switch ($_GET['do']) {
    case 'posters':
        $_POST['rank']=$posters->math('max','id')+1;
        $_POST['sh']=1;
        $_POST['ani']=1;
        
        break;
    
    default:
        
        break;
}
${$_GET['do']}->save($_POST);
to("../back.php?do={$_GET['do']}");
//name rank sh ani