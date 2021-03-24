<!-- ３-->

<!-- 入力画面からデータを取得し、データベースに格納する -->

<?php
require_once('dbc.php');


$contact = $_POST;


// var_dump($contact);
//
// ここの[]の中の名前は、schedule.htmlのname属性
if(empty($contact['p_date'])){
    exit('日付を入力してください.');
}

if(mb_strlen($contact['p_date']) > 30){
    exit('日付の文字数が多すぎます.');
}
    if(empty($contact['name'])){
    exit('名前を入力してください.');
}
if(mb_strlen($contact['name']) > 30){
    exit('名前の文字数が多すぎます.');
}
if(empty($contact['category'])){
    exit('カテゴリを選択してください.');
}
if(empty($contact['comment'])){
    exit('コメントを入力してください.');
}



$sql = 'INSERT INTO 
        contact(id ,team ,username, ymd, category, comment, post_at)
        VALUES
        (NULL ,:team ,:username, :p_date, :category, :comment, sysdate())';
        //コロン：が付くものは、formに入力されたものを入れておく変数。

$dbh = dbConnect();
$dbh ->beginTransaction();

//ここの[]の中身に入力するのはschedule.htmlのname属性
try{
     $stmt = $dbh->prepare($sql);
     $stmt ->bindValue(':team' , $contact['team'], PDO::PARAM_INT);
     $stmt ->bindValue(':username' , $contact['name'], PDO::PARAM_STR);
     $stmt ->bindValue(':p_date' , $contact['p_date'], PDO::PARAM_STR);
     $stmt ->bindValue(':category' , $contact['category'], PDO::PARAM_INT);
     $stmt ->bindValue(':comment' , $contact['comment'], PDO::PARAM_STR);
     $status = $stmt->execute();
     $dbh->commit();
     echo '連絡を送信しました。';
}catch(PDOException $e){
    $dbh->rollBack();
    exit($e);
}

//４．データ登録処理後
if ($status==false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
} else {
    //５．index.phpへリダイレクト 書くときにLocation: in この:　のあとは半角スペースがいるので注意！！
    header("Location: index.php");
    exit;
}




?>