<?php
if (!empty($_POST)) {
  if ($_POST==['acc'=>'admin','pw'=>1234]) {
    $_SESSION['acc']=1;
  }else{
    ?>
    <script>
      alert("帳號或密碼錯誤");
    </script>
    <?php
  }
}
?>
<div id="mm">
<?php
if (!isset($_SESSION['acc'])) {
  ?>
  <form action="?" method="post">
    <table class="w60 mg">
      <tr>
        <td>帳號</td>
        <td>
          <input type="text" name="acc" id="">
        </td>
      </tr>
      <tr>
        <td>密碼</td>
        <td>
          <input type="password" name="pw" id="">
        </td>
      </tr>
    </table>
    <div class="ct">
      <input type="submit" value="登入">
      <input type="reset" value="重置">
    </div>
  </form>
  <?php
}else{
  ?>
    <div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=tit">網站標題管理</a>| <a href="?do=go">動態文字管理</a>| <a href="?do=posters">預告片海報管理</a>| <a href="?do=movies">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>
    <div class="rb tab">
      <h2 class="ct">請選擇所需功能</h2>
    </div>
  <?php
}
?>
  </div>