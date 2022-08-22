<?php
$selevtedmovieid = $_GET['id'] ?? 0;
?>
<style>
    .w80 {
        width: 80%;
    }

    .mg {
        margin: 0 auto;
    }

    .mm {
        height: 520px;
    }
</style>
<div class="mm">
    <div id="order">
        <h2 class="ct">線上訂票</h2>

        <table class="w80 mg">
            <tr>
                <td>電影:</td>
                <td>
                    <select name="movie" id="movie"></select>

                </td>
            </tr>
            <tr>
                <td>日期:</td>
                <td>
                    <select name="date" id="date"></select>

                </td>
            </tr>
            <tr>
                <td>場次</td>
                <td>
                    <select name="session" id="session"></select>

                </td>
            </tr>
        </table>
        <div class="ct">
            <button onclick="booking()">確定</button>
            <button>重置</button>
        </div>
    </div>
    <div id="booking" style="display: none;"></div>
</div>
<script>
    let info={
        movieId:0,
        movieName:'',
        date:'',
        sessionId:0,
        session:'',
    }

    $('#movie').load("./api/movie_list.php", {
        id: <?= $selevtedmovieid; ?>
    }, () => {
        let id = $('#movie').val();
        getdate(id);
    })

    $('#movie').on('change', function() {
        let id = $(this).val();
        getdate(id);
    })

    function getdate(id) {
        $('#date').load("./api/date_list.php", {
            id
        }, () => {
            let date = $("#date").val()
            getsession(date, id);
        })
    }

    $('#date').on('change', function() {
        let id = $('#movie').val();
        let date = $(this).val();
        getsession(date, id);
    })


    function getsession(date, id) {
        $('#session').load("./api/session_list.php", {
            date,
            id
        }, () => {

        })
    }

    function booking() {
        $('#order').hide();
        $('#booking').show();
        updateInfo();
        $.get("./api/get_booking.php",{movie:info.movieName,date:info.date,session:info.session}, (res) => {
            $('#booking').html(res);
            setseatevents()
        })
    }

    function updateInfo(){
        info.movieId=$("#movie").val()
        info.movieName=$("#movie option:selected").text()
        info.date=$("#date").val()
        info.sessionId=$("#session").val()
        info.session=$("#session option:selected").text().split(" ")[0]
    }

    function setseatevents() {
        let seats = new Array;
        $("#chk_mm").text(info.movieName);
        $("#chk_time").text(info.date);
        $("#chk_class").text(info.session);

        $('.chk_box').on('change', function() {
            let num = $(this).val();
            if ($(this).prop('checked')) {
                let len = seats.length;
                if (len >= 4) {
                    alert("做多只能勾選四張票");
                    $(this).prop('checked', false);
                } else {
                    seats.push(num);
                    $(this).parent().toggleClass('active');
                }
            } else {
                seats.splice(seats.indexOf(num), 1)
                $(this).parent().toggleClass('active');
            }
            $('#tickets').text(seats.length);

        })
        $('#chkout').data('text', seats);
    }
</script>