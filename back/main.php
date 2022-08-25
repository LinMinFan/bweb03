<div id="mm">
  <?php
  if (!empty($_GET['acc'])) {
    if ($_GET['acc']=='admin' && $_GET['pw']=='1234') {
      $_SESSION['acc']=1;
      to("back.php");
    }else{
      ?>
      <script>
        alert("帳號或密碼錯誤");
        location.href='back.php';
      </script>
      <?php
    }
  }
  if (!isset($_SESSION['acc'])) {
  ?>
    <div class="w60 mg">
      <table class="w100">
        <tr>
          <td>帳號</td>
          <td>
            <input type="text" name="" id="acc">
          </td>
        </tr>
        <tr>
          <td>密碼</td>
          <td>
            <input type="password" name="" id="pw">
          </td>
        </tr>
      </table>
      <div class="ct">
        <button onclick="location.href='?acc='+$('#acc').val()+'&pw='+$('#pw').val()">登入</button>
        <button onclick="location.reload()">重置</button>
      </div>
    </div>
  <?php
  } else {
  ?>
    <div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=tit">網站標題管理</a>| <a href="?do=go">動態文字管理</a>| <a href="?do=poster">預告片海報管理</a>| <a href="?do=movie">院線片管理</a>| <a href="?do=orders">電影訂票管理</a> </div>
    <div class="rb tab">
      <h2 class="ct">請選擇所需功能</h2>
    </div>
  <?php
  }
  ?>
</div>
