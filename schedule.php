<!-- ２ -->
<?php
// 年月日を取得する
if (isset($_GET["ymd"])) {
    // 連絡投稿の年月日を取得する
    $ymd = basename($_GET["ymd"]);
    $y = intval(substr($ymd, 0, 4));
    $m = intval(substr($ymd, 4, 2));
    $d = intval(substr($ymd, 6, 2));
    $disp_ymd = "{$y}年{$m}月{$d}日";

    // 連絡データを取得する
    $file_name = "data/{$ymd}.txt";
    if (file_exists($file_name)) {
        $schedule = file_get_contents($file_name);
    } else {
        $schedule = "";
    }
} else {
    // カレンダー画面に強制移動する
    header("Location: index.php");
}



// スケジュールを更新する
if (isset($_POST["action"]) and $_POST["action"] == "送信する") {
    $schedule = htmlspecialchars($_POST["comment"], ENT_QUOTES, "UTF-8");

    // スケジュールが入力されたか調べて処理を分岐
    if (!empty($schedule)) {
        // 入力された内容でスケジュールを更新
        file_put_contents($file_name, $schedule);
    } else {
        // スケジュールが空の場合はファイルを削除
        if (file_exists($file_name)) {
            unlink($file_name);
        }
    }
    // カレンダー画面に移動する
    header("Location: calendar.php");
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact_form</title>
</head>
<body>
    <h2>連絡事項の入力ができます</h2>
   <!-- <form method="POST" action="detail.php"> -->
    <form method="POST" action="create.php">


<table>

<label >日付：<input type ="text" name ="p_date" value="<?php echo $disp_ymd; ?>">
</label>
<br>
<label >所属：
<select name="team">
<option value="5">１年１組</option>
<option value="6">１年２組</option>
<option value="7">２年１組</option>
<option value="8">２年２組</option>
<option value="9">３年１組</option>
<option value="10">３年２組</option>
<option value="11">４年１組</option>
<option value="12">４年２組</option>
<option value="13">５年１組</option>
<option value="14">５年２組</option>
<option value="15">６年１組</option>
<option value="16">６年２組</option>
</select>
</label>

<br>
<label >名前：<input type="text" name ="name">
</label>
<br>
<label >カテゴリ：
<select name="category">
<option value="1">欠席連絡</option>
<option value="2">遅刻・早退連絡</option>
<option value="3">面談予約</option>
<option value="4">その他連絡</option>
<!-- <option value="5">サンプル3</option> -->
</select>
</label>
<br>
<textarea rows="10" cols="50" name="comment"></textarea>

<br>
<input type="submit" value="送信する" id ="btn1"><br>
<input type="button" name="back" onClick="history.back()" value="カレンダーに戻る">

</table>

</form> 

</body>
</html>