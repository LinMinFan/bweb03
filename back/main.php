<div class="rb tab">
   
<?php
        if (!isset($_SESSION['acc'])) {
          ?>
            <table>
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
            <div>
              <button onclick="login($('#acc').val(),$('#pw').val())">登入</button>
              <button onclick="$('#acc').val(''),$('#pw').val('')">清除</button>
            </div>
          <?php
        }else {
          ?>
              <h2 class="ct">請選擇所需功能</h2>
          <?php
        }
      ?>
</div>
<script>

function login(acc,pw){
  if (acc=='admin' && pw=='1234') {
    $.post("./api/login.php",()=>{
      location.reload();
    })
  }else {
    alert("帳號密碼錯誤");
  }
}


</script>