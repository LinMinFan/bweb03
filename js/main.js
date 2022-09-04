function sh(table,id,sh){
    $.post("./api/sh.php",{table,id,sh},()=>{
        location.reload()
    })
}
function del(table,id){
    $.post("./api/del.php",{table,id},()=>{
        location.reload()
    })
}
function q_del(){
    let table="orders";
    let way=$('input[type=radio]:checked').data('text');
    let data;
    switch (way) {
        case 'date':
            data=$('#date').val();
            break;
        case 'name':
            data=$('#name').val();
            break;
    
        default:
            break;
    }
    if (confirm("您確定刪除"+data+"全部的資料嗎?")) {
        $.post("./api/q_del.php",{table,way,data},()=>{
            location.reload()
        })
    }
}
function front(url){
    location.href=`./index.php?do=${url}`;
}
function back(url){
    location.href=`./back.php?do=${url}`;
}