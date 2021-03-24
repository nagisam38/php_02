<?php
//データベースコネクト（関数保存場所）

function dbConnect(){

$dsn="mysql:host=localhost;dbname=contact_book;charset=utf8";
$username="contact_user";
$password="010308"; 

try{
    $dbh = new PDO($dsn,$username,$password,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
}catch(PDOException $e){
    echo "接続できません" . $e->getMessage();
    exit();
};
return $dbh;
}



// 関数２ー１＝mysqlデータベースからデータを取得する
// 引数：なし
// 返り値：取得データ
function getAllContact(){
    //データベース接続
 $dbh = dbConnect();

$sql ="SELECT * FROM contact";
// sql実行
$stmt =$dbh->query($sql);
// sql結果受け取り
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $result;
$dbh=null;

}
// データベースから取得したデータを表示する
$contactData =getAllContact();




// INTでデータベースに格納したカテゴリを、文字でかえす関数
// 関数３＝カテゴリ表示
// 引数：数字
// 戻り値：;カテゴリー名の文字列

function setCategoryName($category){
    if($category=="1"){
        return "欠席連絡";
    }elseif($category=="2"){
        return "遅刻・早退連絡";

    }elseif($category=="3"){
        return "面談予約";

    }elseif($category=="4"){
        return "その他連絡";

    // }elseif($category=="5"){
    //     return "";
    }
}


// IDを取得したときの結果の関数
// 引数：id
// 戻り値：$result
function getContact($id){
if(empty($id)){
    exit('IDが不正です.');
}
//データ接続 
$dbh = dbConnect();

// SQL準備(プレースホルダーの記載＝悪意のある攻撃から守る)
$stmt = $dbh->prepare('SELECT * FROM contact Where id =:id');
$stmt->bindValue(':id' , (int)$id , PDO::PARAM_INT);

// SQL実行
$stmt->execute();
// 結果取得
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$result){
    exit('投稿はありません。');
}
return $result;
// var_dump($result);
}    

?>
