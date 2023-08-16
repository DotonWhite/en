<!DOCTYPE HTML>
<html lang="ja">

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <title>検索</title>
</head>

<body>
    <div class="menu_var">
        <ul>
            <li>単語を<a href='insert.php'>追加</a></li>
            <li><a href='sentence.php'>英文一覧</a></li>
            <li><a href='wordTest.php'>単語テスト</a></li>
            <li>英文テスト</li>
            <li><a href='movie.php'>動画</a></li>
        </ul>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        require_once('dbConnection.php');
        $dbc = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
        $key = $_POST['key'];

        if (preg_match("/[ぁ-ん]+|[ァ-ヴー]+|[一-龠]/u", $key)) {
            $query = "SELECT * FROM `en` WHERE `ja_word` LIKE '%$key%'";
        } else {
            $query = "SELECT * FROM `en` WHERE `en_word` LIKE '%$key%'";
        }

        if ($result = mysqli_query($dbc, $query)) {
            while($row = mysqli_fetch_array($result)) {
            ?>
            <ul>
                <li><label class="word">英単語</label><input class="form_input" type="text" name="en_word" size="35"
                        value="<?= $row['en_word'] ?>"></li>
                <li><label class="word">日本語</label><input class="form_input" type="text" name="ja_word" size="35"
                        value="<?= $row['ja_word'] ?>"></li>
                <li><label class="sentence">英文</label><input class="form_input" type="text" name="en_sentence" size="80"
                        value="<?= $row['en_sentence'] ?>">
                </li>
                <li><label class="sentence">邦文</label><input class="form_input" type="text" name="ja_sentence" size="80"
                        value="<?= $row['ja_sentence'] ?>">
                </li>
                <li><label class="memo">メモ</label><textarea class="form_input_textarea" name="memo" cols="70" rows="10"
                        value="<?= $row['memo'] ?>"></textarea>
                </li>
            </ul>
            <?php
            }
            mysqli_close($dbc);
        } else {

        }
    }
    ?>
    <form class="search_form" action="post" method="<?= $_SERVER['PHP_SELF'] ?>">
        <div class='search_word'>
            <label>🔎<input class="text_box" type="text" name="key" placeholder="検索欄" autocomplete="off"></label>
            <input class="submit_button" type="submit" name="submit" value="検索" />
        </div>
    </form>
</body>