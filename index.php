<!DOCTYPE HTML>
<html lang="ja">

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <title>ホームページ</title>
</head>

<body>
    <div class="menu_var">
        <ul>
            <li>単語を<a href='insert.php'>追加</a></li>
            <li><a href='sentence.php'>英文一覧</a></li>
            <li><a href='wordTest.php'>単語テスト</a></li>
            <li>英文テスト</li>
            <li><a href='search.php'>検索</a></li>
            <li><a href='movie.php'>動画</a></li>
        </ul>
    </div>
    <div class="main">
        <div class="left_list">
            <?php
            require_once('dbConnection.php');
            $dbc = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
            $query_left = "SELECT `id`,`en_word`,`ja_word`,`mistake_counter` FROM `en` order by `mistake_counter` desc LIMIT 20";
            $result_for_left = mysqli_query($dbc, $query_left);
            $rowJaWord = [];
            ?>
            <div class="english_words">
                <?php
                while ($row = mysqli_fetch_array($result_for_left)) {
                    ?>
                    <div class='en_word'>
                        <label>
                            <?= $row['en_word'] ?>
                        </label>
                    </div>
                    <?php
                    $rowJaWord[] = $row['ja_word'];
                    $rowid[] = $row['id'];
                }
                ?>
            </div>
            <div class="japanese_words">
                <?php
                $sumOfWords = count($rowJaWord);
                $sumOfWords = $sumOfWords - 1;
                for ($i = 0; $i <= $sumOfWords; $i++) {
                    ?>
                    <div class='en_word'>
                        <label>
                            <?= $rowJaWord[$i] ?>
                        </label>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="right_list">
            <?php
            $query_right = "SELECT `id`,`en_word`,`ja_word`,`mistake_counter` FROM `en` order by `mistake_counter` desc LIMIT 20, 20";
            $result_for_right = mysqli_query($dbc, $query_right);
            $rowJaWord_right = [];
            ?>
            <div class="english_words">
                <?php
                while ($row = mysqli_fetch_array($result_for_right)) {
                    ?>
                    <div class='en_word'>
                        <label>
                            <?= $row['en_word'] ?>
                        </label>
                    </div>
                    <?php
                    $rowJaWord_right[] = $row['ja_word'];
                }
                ?>
            </div>
            <div class="japanese_words">
                <?php
                $sumOfWords = count($rowJaWord_right);
                $sumOfWords = $sumOfWords - 1;
                for ($i = 0; $i <= $sumOfWords; $i++) {
                    ?>
                    <div class='en_word'>
                        <label>
                            <?= $rowJaWord_right[$i] ?>
                        </label>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>