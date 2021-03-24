<?php
//登録済み連絡（１）
require_once('dbc.php');
//データベースコネクト

// 関数１＝データベース接続機能
// 関数２＝データ取得機能
// 関数3＝カテゴリ名表示


// function dbConnect(){

// $dsn="mysql:host=localhost;dbname=contact_book;charset=utf8";
// $username="contact_user";
// $password="010308"; 

// try{
//     $dbh = new PDO($dsn,$username,$password,[
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//     ]);
// }catch(PDOException $e){
//     echo "接続できません" . $e->getMessage();
//     exit();
// };
// return $dbh;
// }



// 関数２ー１＝mysqlデータベースからデータを取得する
// 引数：なし
// 返り値：取得データ

// function getAllContact(){
//     //データベース接続
//  $dbh = dbConnect();

// $sql ="SELECT * FROM contact";
// // sql実行
// $stmt =$dbh->query($sql);
// // sql結果受け取り
// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//  return $result;
// $dbh=null;

// }
// // データベースから取得したデータを表示する
// $contactData =getAllContact();




// INTでデータベースに格納したカテゴリを、文字でかえす関数
// 関数３＝カテゴリ表示
// 引数：数字
// 戻り値：;カテゴリー名の文字列

// function setCategoryName($category){
//     if($category=="1"){
//         return "欠席連絡";
//     }elseif($category=="2"){
//         return "遅刻・早退連絡";

//     }elseif($category=="3"){
//         return "面談予約";

//     }elseif($category=="4"){
//         return "その他連絡";

//     // }elseif($category=="5"){
//     //     return "";
//     }
// }

   

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>登録済み連絡一覧</title>
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">

<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <h2>登録済み連絡一覧</h2>
      </div>
    </div>
  </nav>
 </header> 

 <body> 
   <table>
     <tr>
    <th>年月日</th>
    <th>名前</th>
    <th>カテゴリ</th>
    </tr>
    <?php foreach($contactData as $column):?>
  
    <tr>
     <td><?php echo $column['ymd']; ?>&emsp;</td>
     <td><?php echo $column['username']; ?>&emsp;</td>
     <td><?php echo setCategoryName($column['category']); ?>&emsp;</td>
     <td><input type="button" name="godetail" value="詳細" onclick="location.href='/contact_book/date.php?id=<?php echo $column['id']; ?>'"></td>  
     <!-- <td><a href ="/contact_book/date.php?id=<?php echo $column['id']; ?>">詳細を確認する</a></td> -->
    </tr>
    
  <?php endforeach; ?>


    
</table>
 <!-- <tr><?=$view?></tr>  -->
 </body>
</html>