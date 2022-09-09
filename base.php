<?php
session_start();
date_default_timezone_set("Asia/Taipei");

class Db{
    protected $table;
    protected $pdo;
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=bweb03";

    function __construct($table)
    {
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,"root","");
    }

    function to_str($array){
        $tmp=[];
        foreach ($array as $key => $value) {
            $tmp[]="`$key`='$value'";
        }
        return $tmp;
    }
    function find($id){
        $sql="SELECT * FROM $this->table WHERE ";
        if (is_array($id)) {
            $tmp=$this->to_str($id);
            $sql.=join(" && ",$tmp);
        }else{
            $sql.="`id`={$id}";
        }
        //echo $sql;
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    function all(...$arg){
        $sql="SELECT * FROM $this->table ";
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp=$this->to_str($arg[0]);
                $sql.="WHERE ".join(" && ",$tmp);
            }else{
                $sql.=$arg[0];
            }
        }
        if (isset($arg[1])) {
            $sql.=$arg[1];
        }
        //echo $sql;
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    function del($id){
        $sql="DELETE FROM $this->table WHERE ";
        if (is_array($id)) {
            $tmp=$this->to_str($id);
            $sql.=join(" && ",$tmp);
        }else{
            $sql.="`id`={$id}";
        }
        //echo $sql;
        return $this->pdo->exec($sql);
    }
    function save($array){
        if (isset($array['id'])) {
            $tmp=$this->to_str($array);
            $sql="UPDATE $this->table SET ".join(",",$tmp)." WHERE `id`={$array['id']}";
        }else{
            $sql="INSERT INTO $this->table (`".join("`, `",array_keys($array))."`) VALUES ('".join("','",$array)."')";
        }
        //echo $sql;
        return $this->pdo->exec($sql);
    }
    function math($math,$col,...$arg){
        $sql="SELECT $math($col) FROM $this->table ";
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp=$this->to_str($arg[0]);
                $sql.="WHERE ".join(" && ",$tmp);
            }else{
                $sql.=$arg[0];
            }
        }
        if (isset($arg[1])) {
            $sql.=$arg[1];
        }
        //echo $sql;
        return $this->pdo->query($sql)->fetchColumn();
    }
}

class Str{
    protected $table;
    public $hd;
    public $td;
    public $abt;
    public $ahd;
    public $atd;
    public $ubt;
    public $uhd;
    public $utd;
    function __construct($table)
    {
        $this->table=$table;
        switch ($this->table) {
            case 'title':
                    $this->hd="網站標題管理";
                    $this->td=['網站標題','替代文字'];
                    $this->abt="新增網站標題圖片";
                    $this->ahd="新增標題區圖片";
                    $this->atd=['標題區圖片:','標題區替代文字:'];
                    $this->ubt="更新圖片";
                    $this->uhd="更新圖片";
                    $this->utd="圖片:";
                break;
            case 'ad':
                    $this->hd="動態文字廣告管理";
                    $this->td="動態文字廣告";
                    $this->abt="新增動態文字廣告";
                    $this->ahd="新增動態文字廣告";
                    $this->atd="動態文字廣告:";
                    $this->ubt="";
                    $this->uhd="";
                    $this->utd="";
                break;
            case 'mvim':
                    $this->hd="動畫圖片管理";
                    $this->td="動畫圖片";
                    $this->abt="新增動畫圖片";
                    $this->ahd="新增動畫圖片";
                    $this->atd="動畫圖片";
                    $this->ubt="更換動畫";
                    $this->uhd="更換動畫";
                    $this->utd="動畫:";
                break;
            case 'image':
                    $this->hd="校園映像資料管理";
                    $this->td="校園映像資料圖片";
                    $this->abt="新增校園映像圖片";
                    $this->ahd="新增校園映像圖片";
                    $this->atd="校園映像圖片:";
                    $this->ubt="更換圖片";
                    $this->uhd="更換圖片";
                    $this->utd="圖片:";
                break;
            case 'total':
                    $this->hd="進站總人數管理";
                    $this->td="進站總人數:";
                    $this->abt="";
                    $this->ahd="";
                    $this->atd="";
                    $this->ubt="";
                    $this->uhd="";
                    $this->utd="";
                break;
            case 'bottom':
                    $this->hd="頁尾版權資料管理";
                    $this->td="頁尾版權資料:";
                    $this->abt="";
                    $this->ahd="";
                    $this->atd="";
                    $this->ubt="";
                    $this->uhd="";
                    $this->utd="";
                break;
            case 'news':
                    $this->hd="最新消息資料管理";
                    $this->td="最新消息資料內容";
                    $this->abt="新增最新消息資料";
                    $this->ahd="新增最新消息資料";
                    $this->atd="最新消息資料:";
                    $this->ubt="";
                    $this->uhd="";
                    $this->utd="";
                break;
            case 'admin':
                    $this->hd="管理者帳號管理";
                    $this->td=['帳號','密碼'];
                    $this->abt="新增管理者帳號";
                    $this->ahd="新增管理者帳號";
                    $this->atd=['帳號:','密碼:','確認密碼:'];
                    $this->ubt="";
                    $this->uhd="";
                    $this->utd="";
                break;
            case 'menu':
                    $this->hd="選單管理";
                    $this->td=['主選單名稱','選單連結網址','次選單數'];
                    $this->abt="新增主選單";
                    $this->ahd="新增主選單";
                    $this->atd=['主選單名稱','選單連結網址'];
                    $this->ubt="編輯次選單";
                    $this->uhd="編輯次選單";
                    $this->utd=['次選單名稱','次選單連結網址'];
                break;
            
            
            default:
                break;
        }
    }
}

function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
function to($url){
    header("location:".$url);
}

$posters=new Db('posters');
$movies=new Db('movies');
$orders=new Db('orders');


$sh=['sh'=>1];
$rank=" order by `rank`";
$today=date("Y-m-d");
$start_day=date("Y-m-d",strtotime("-2 days"));
$level_icon=['普遍級'=>'03C01.png','輔導級'=>'03C02.png','保護級'=>'03C03.png','限制級'=>'03C04.png'];
$ss_times=['1'=>'14:00~16:00','2'=>'16:00~18:00','3'=>'18:00~20:00','4'=>'20:00~22:00','5'=>'22:00~24:00'];
$pr_href=['1'=>'prds','2'=>'orders','3'=>'mem','4'=>'bot','5'=>'news'];
$pr_text=['1'=>'商品分類與管理','2'=>'訂單管理','3'=>'會員管理','4'=>'頁尾版權管理','5'=>'最新消息管理'];
//echo serialize([1,2,3,4,5])."<br>";
//echo serialize([0,1,2,3])."<br>";
//echo serialize([1=>1])."<br>";

?>
