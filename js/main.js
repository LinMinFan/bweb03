function del(table,id){
    $.post("./api/del.php",{table,id},()=>{
        location.reload()
    })
}
function q_del(){
    let way=$('input[type=radio]:checked').val();
    let data;
    switch (way) {
        case 'date':
            data=$('#date').val()
            break;
        case 'name':
            data=$('#name').val()
            break;
    
        default:
            break;
    }
    if (confirm("您確定要刪除"+data+"全部的資料嗎?")) {
        $.post("./api/q_del.php",{way,data},()=>{
            location.reload()
        })
    }
}
function sh(table,id,sh){
    $.post("./api/sh.php",{table,id,sh},()=>{
        location.reload()
    })

}
function front(table){
    location.href="./index.php?do="+table;
}
function back(table){
    location.href="./back.php?do="+table;
}