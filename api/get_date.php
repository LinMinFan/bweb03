<?php
include "../base.php";

$d=date("d",strtotime($today))-date("d",strtotime($movies->find($_POST['id'])['ondate']));

for ($i=0; $i <(3-$d) ; $i++) { 
    ?>
    <option value="<?=date("Y-m-d",strtotime("+$i days"));?>"><?=date("m 月d 日 l",strtotime("+$i days"));?></option>
    <?php
}