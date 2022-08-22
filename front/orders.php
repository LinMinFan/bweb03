<?php
$start_day = date("Y-m-d", strtotime("-2 days"));
$mvs = $movie->all(" WHERE `sh`=1 && `ondate` BETWEEN '$start_day' AND '$today' order by `rank`");
$select_id = $_GET['id'] ?? $mvs[0]['id'];
?>

<div id="mm">
    <div class="w80 mg" id="order">
        <table class="w100">
            <tr>
                <td>電影:</td>
                <td>
                    <select name="" id="movie">
                        <?php
                        foreach ($mvs as $key => $mv) {
                        ?>
                            <option value="<?= $mv['id']; ?>" <?= ($select_id == $mv['id']) ? "selected" : ""; ?>><?= $mv['name']; ?></option>
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

                    </select>
                </td>
            </tr>
            <tr>
                <td>場次:</td>
                <td>
                    <select name="" id="session">

                    </select>
                </td>
            </tr>
        </table>
        <div class="ct">
            <button type="button" onclick="booking($('#movie option:selected').text(),$('#date').val(),$('#session').val())">確定</button>
            <button type="button" onclick="$('#movie').val(<?=$select_id;?>),get_date(<?=$select_id;?>)">重置</button>
        </div>
    </div>
    <div id="booking" style="display: none;"></div>
</div>

<script>
    /*--------------------*/
    let id = $('#movie').val();
    get_date(id);

    function get_date(id) {
        $('#date').load("./api/get_date.php", {
            id
        }, () => {
            let date = $('#date').val()
            getsession(date, id);
        })
    }

    function getsession(date, id) {
        $('#session').load("./api/get_session.php", {
            date,
            id
        }, () => {

        })
    }
    /*---------------------*/
    $('#movie').on('change', function() {
        id = $(this).val();
        get_date(id);
    })
    $('#date').on('change', function() {
        id = $('#movie').val();
        date = $(this).val();
        getsession(date, id);
    })
    /*---------------------*/

    function booking(movie, date, session) {
        $('#order').hide();
        $('#booking').show();
        $('#booking').load("./api/booking.php", {
            movie,
            date,
            session
        }, () => {

        })
    }
</script>