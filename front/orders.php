<?php
$mvs=$movie->all("  WHERE `sh`= 1 && `ondate` between '$start_day' AND '$today' order by `rank`");
$id=$_GET['id']??$mvs[0]['id'];
?>
<div id="mm">
<div id="menu" class="w60 mg">
<table class="w100">
    <tr>
        <td>電影:</td>
        <td>
        <select name="movie" id="movie">
            <?php
                foreach ($mvs as $key => $mv) {
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
<div class="ct">
    <button type="button" onclick="booking()">確定</button>
    <button type="button" onclick="location.reload()">重置</button>
</div>
</div>
<div id="booking" class="dpn"></div>


</div>
<script>
    let id=$('#movie').val();
    get_date(id);

    function get_date(id){
        $('#date').load("./api/get_date.php",{id},()=>{
            let date=$('#date').val();
            get_session(id,date)
        })
    }
    function get_session(id,date){
        $('#session').load("./api/get_session.php",{id,date},()=>{

        })
    }

    $('#movie').on('change',function(){
        id=$(this).val();
        get_date(id)
    })
    $('#date').on('change',function(){
         id=$('#movie').val();
         date=$(this).val();
        get_session(id,date)
    })

    function booking(){
        let movie=$('#movie option:selected').text();
        let date=$('#date').val();
        let session=$('#session').val();
        $('#menu').hide()
        $('#booking').show()
        $('#booking').load("./front/book_seats.php",{movie,date,session});    
    }
</script>

