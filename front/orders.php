<?php
$id=$_GET['id']??0;
?>
<div id="mm">
    <div id="orders">
        <h3 class="ct">線上訂票</h3>
        <table class="w60 mg">
            <tr>
                <td>電影:</td>
                <td>
                    <select name="" id="name">
                        <?php
                        foreach ($movies->all(" WHERE `sh`=1 && `ondate` between '$start_day' AND '$today'") as $key => $mv) {
                            ?>
                            <option value="<?=$mv['id'];?>" <?=($mv['id']==$id)?"selected":"";?>><?=$mv['name'];?></option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>日期:</td>
                <td>
                    <select name="" id="date">
                        <?php

                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>場次:</td>
                <td>
                    <select name="" id="session">
                        <?php

                        ?>
                    </select>
                </td>
            </tr>
        </table>
        <div class="ct">
            <button onclick="booking()">確定</button>
            <button onclick="reset()">重製</button>
        </div>
    </div>
    <div class="dpn" id="booking">

    </div>
</div>
<script>
let id=$('#name').val();
get_date(id);
function get_date(id){
    $('#date').load("./api/get_date.php",{id},function(){
        let date=$('#date').val();
        get_session(id,date);
    })
}

function get_session(id,date){
    $('#session').load("./api/get_session.php",{id,date},function(){

    })
}
$('#name').on('change',function(){
     id=$('#name option:selected').val();
     get_date(id)
})
$('#date').on('change',function(){
    id=$('#name option:selected').val();
    let date=$('#date option:selected').val();
        get_session(id,date);
})

function booking(){
    id=$('#name option:selected').val();
    let date=$('#date option:selected').val();
    let session=$('#session option:selected').val();
    $('#booking').show();
    $('#orders').hide();
    $('#booking').load("./front/booking.php",{id,date,session},function(){

    })
}
</script>