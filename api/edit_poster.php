<?php
include "../base.php";

foreach ($_POST['id'] as $key => $id) {
    if (isset($_POST['del']) && in_array($id,$_POST['del'])) {
        $poster->del($id);
    }else {
        $data=$poster->find($id);
        $data['name']=$_POST['name'][$key];
        $data['ani']=$_POST['ani'][$key];
        $data['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;
        $poster->save($data);
    }
}

to("../back.php?do=poster");