<?php
include "../base.php";
$mv=$movie->find($_POST['id']);
$see = 3 - (strtotime($today) - strtotime($mv['ondate'])) / (24 * 60 * 60);
for ($i = 0; $i < $see; $i++) {
?>
    <option value="<?=date("Y-m-d",strtotime("+$i days"));?>"><?= date("m月d日 l", strtotime("+$i days")); ?></option>
<?php
}
?>