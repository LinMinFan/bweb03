function del(table,id) {
    $.post("./api/del.php",{table,id},()=>{
        location.reload();
    })
}
function sh(table,id) {
    $.post("./api/sh.php",{table,id},()=>{
        location.reload();
    })
}

