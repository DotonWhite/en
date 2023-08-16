<!DOCTYPE HTML>
<html lang="ja">

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <title>勉強用動画</title>
</head>

<body>
    <div class="menu_var">
        <ul>
            <li><a href='index.php'>ホームページ</a></li>
            <li>単語を<a href='insert.php'>追加</a></li>
            <li><a href='sentence.php'>英文一覧</a></li>
            <li><a href='wordTest.php'>単語テスト</a></li>
            <li>英文テスト</li>
            <li>英文テスト</li>
        </ul>
    </div>
    <div class="main">
        <?php
        require_once('dbConnection.php');
        $dbc = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
        $query = "SELECT * FROM `movie`";
        $result = mysqli_query($dbc,$query);
        while($row = mysqli_fetch_array($result)) {
        ?>
        <div class="movie_set">
            <div class="movie_itself">
            </div>
            <div class="movie_deteil">
            </div>
        </div>
        <?php
        }
        mysqli_close($dbc);
        ?>
    </div>

</body>

</html>