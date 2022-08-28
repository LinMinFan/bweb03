function del(table,id){
    $.post("./api/del.php",{table,id},()=>{
        location.reload();
    })
}
function sh(table,id,sh){
    $.post("./api/sh.php",{table,id,sh},()=>{
        location.reload();
    })
}