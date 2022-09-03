<?php
$id=$_GET['id']??0;
?>
<div id="mm">
    <div id="orders">
      <table class="w60 mg">
        <tr>
          <td>電影:</td>
          <td>
            <select name="name" id="name">
              <?php
              foreach ($movies->all($sh," && `ondate` between '$start_day' AND '$today' $rank") as $key => $mv) {
                ?>
                <option value="<?=$mv['id'];?>" <?=($id==$mv['id'])?"selected":"";?>><?=$mv['name'];?></option>
                <?php
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>日期:</td>
          <td>
          <select name="date" id="date">

          </select>
          </td>
        </tr>
        <tr>
          <td>場次:</td>
          <td>
          <select name="session" id="session">

          </select>
          </td>
        </tr>
      </table>
      <div class="w60 mg ct">
        <button onclick="booking()">確定</button>
        <button onclick="location.reload()">重置</button>
      </div>
    </div>
    <div id="booking" class="dpn"></div>
  </div>
  <script>
    let id=$('#name').val();
    get_date(id);
    $('#name').on('change',function(){
      id=$('#name').val();
      get_date(id);
    })
    $('#date').on('change',function(){
      id=$('#name').val();
      let date=$('#date').val();
      get_session(id,date);
    })
    function get_date(id){
        $('#date').load("./front/get_date.php",{id},()=>{
          let date=$('#date').val();
          get_session(id,date)
        })
    }
    function get_session(id,date){
      $('#session').load("./front/get_session.php",{id,date},()=>{
          
        })
    }

    function booking(){
      $('#orders').hide();
      $('#booking').show();
      let name=$('#name option:selected').text();
      let date=$('#date').val();
      let session=$('#session').val();
      $('#booking').load("./front/booking.php",{name,date,session},()=>{

      })
    }
  </script>