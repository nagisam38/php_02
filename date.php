<?php

// 登録済み連絡（２）
$id= $_GET['id'];


if(empty($id)){
    exit('IDが不正です.');
}


function dbConnect(){
$dsn="mysql:host=localhost;dbname=contact_book;charset=utf8";
$username="contact_user";
$password="010308"; 

try{
    $dbh = new PDO($dsn,$username,$password,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
}catch(PDOException $e){
    echo "接続できません" . $e->getMessage();
    exit();
};
return $dbh;
}
$dbh= dbConnect();



// SQL準備(プレースホルダーの記載＝悪意のある攻撃から守る)
$stmt = $dbh->prepare('SELECT * FROM contact Where id =:id');
$stmt->bindValue(':id' , (int)$id , PDO::PARAM_INT);

// SQL実行
$stmt->execute();
// 結果。選択したIDのデータのみを取得するのでfetchAllではなくfetch
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$result){
    exit('投稿はありません。');
}
// return $result;

// var_dump($result);
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

function setTeamName($team){
    if($team=="5"){
        return "１年１組";
    }elseif($team=="6"){
        return "１年２組";

    }elseif($team=="7"){
        return "２年１組";

    }elseif($team=="8"){
        return "２年２組";

    }elseif($team=="9"){
        return "３年１組";
    }elseif($team=="10"){
        return "３年２組";

    }elseif($team=="11"){
        return "４年１組";

    }elseif($team=="12"){
        return "４年２組";

    }elseif($team=="13"){
        return "５年１組";
    }elseif($team=="14"){
        return "５年２組";

    }elseif($team=="15"){
        return "６年１組";

    }elseif($team=="16"){
        return "６年２組";
}
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録内容詳細</title>
</head>
<body>
     <h2>連絡事項 （ 詳細 ）</h2>
   <hr>
<p>【年月日】<?php echo $result['ymd']; ?></p>
<p>【所属】<?php echo setTeamName($result['team']); ?></p>
<p>【名前】<?php echo $result['username']; ?></p>
<p>【カテゴリ】<?php echo setCategoryName($result['category']); ?></p>
 <hr>
<p>【コメント】<br><?php echo $result['comment']; ?></p>
 <hr>
<p>投稿日時：<?php echo $result['post_at']; ?></p>
   
<input type="button" name="backcalendar" value="カレンダーに戻る" onClick="location.href='/contact_book/index.php'">


<!-- <p><a href="/contact_book/calendar.php">カレンダーに戻る</a></p> -->
</body>
</html>