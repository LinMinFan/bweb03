function del(table,id){
    $.post("./api/del.php",{table,id},()=>{
        location.reload();
    })
}

function sh($table,id,sh){
    $table.post("./api/sh.php",{$table,id,sh},()=>{
        location.reload();
    })
}
function reset(){
    location.reload();
}
function home(){
    location.href="./index.php";
}
