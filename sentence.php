<!DOCTYPE HTML>
<html lang="ja">

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <title>英文一覧</title>
</head>

<body>
    <div class="menu_var">
        <ul>
            <li><a href='index.php'>ホームページ</a></li>
            <li>単語を<a href='insert.php'>追加</a></li>
            <li><a href='wordTest.php'>単語テスト</a></li>
            <li>英文テスト</li>
        </ul>
    </div>
    <?php
    require_once('dbConnection.php');
    $dbc = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
    $query = "SELECT `en_sentence`,`ja_sentence`,`mistake_counter` FROM en WHERE en_sentence IS NOT NULL order by `mistake_counter` desc limit 20";
    $result = mysqli_query($dbc, $query);
    $ja_sentences = [];
    ?>
    <div class="sentence_main">
        <div class="en_line">
            <?php
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <div class='en_sentence'>
                    <label>
                        <?= $row['en_sentence'] ?>
                    </label>
                </div>
                <?php
                $ja_sentences[] = $row['ja_sentence'];
            }
            mysqli_close($dbc);
            ?>
        </div>
        <div class="ja_line">
            <?php
            $sumOfWords = count($ja_sentences);
            $sumOfWords = $sumOfWords - 1;
            for ($i = 0; $i <= $sumOfWords; $i++) {
                ?>
                <div class='ja_sentence'>
                    <label>
                        <?= $ja_sentences[$i] ?>
                    </label>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</body>

</html>