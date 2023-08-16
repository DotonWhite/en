<!DOCTYPE HTML>
<html lang="ja">

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <title>追加フォーム</title>
</head>

<body>
    <div class="menu_var">
        <ul>
            <li><a href='index.php'>ホームページ</a></li>
            <li><a href='sentence.php'>英文一覧</a></li>
            <li><a href='wordTest.php'>単語テスト</a></li>
            <li>英文テスト</li>
        </ul>
    </div>
    
    <?php
    $form = true;
    require_once('function.php');

    if (isset($_POST['submit'])) {
        if (!empty($_POST['en_word']) && !empty($_POST['ja_word'])) {
            $form = false;

            $en_word = $_POST['en_word'];

            require_once('dbConnection.php');
            $dbc = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
            $query = "SELECT en_word FROM en where en_word = '$en_word'";
            $check = mysqli_query($dbc, $query);

            if (mysqli_num_rows($check) == 0) {

                $ja_word = $_POST['ja_word'];
                $en_sentence = $_POST['en_sentence'];
                $ja_sentence = $_POST['ja_sentence'];
                $memo = $_POST['memo'];

                $query = "INSERT INTO en (en_word,ja_word,en_sentence,ja_sentence,memo) values(" . set_null($en_word) . "," . set_null($ja_word) . "," . set_null($en_sentence) . "," . set_null($ja_sentence) . "," . set_null($memo) . ")";

                if ($result = mysqli_query($dbc, $query)) {
                    mysqli_close($dbc);
                    ?>
                    <fieldset class="insert_form" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                        <div>
                            <label class="form_title">追加しました。</label>
                        </div>
                        <ul>
                            <li><label class="word">英単語</label><input class="form_input" type="text" name="en_word" size="35"
                                    value="<?= $en_word ?>"></li>
                            <li><label class="word">日本語</label><input class="form_input" type="text" name="ja_word" size="35"
                                    value="<?= $ja_word ?>"></li>
                            <li><label class="sentence">英文</label><input class="form_input" type="text" name="en_sentence" size="80"
                                    value="<?= $en_sentence ?>">
                            </li>
                            <li><label class="sentence">邦文</label><input class="form_input" type="text" name="ja_sentence" size="80"
                                    value="<?= $ja_sentence ?>">
                            </li>
                            <li><label class="memo">メモ</label><textarea class="form_input_textarea" name="memo" cols="70" rows="10"
                                    value="<?= $memo ?>"></textarea>
                            </li>
                        </ul>
                        <label><a href='insert.php'>戻る</a></label>
                    </fieldset>
                    <?php
                } else {
                    echo "Failed to add";
                }
            } else {
                echo "It's been already in the database";
            }
        } else {
            header('Location: /en/insert.php');
            exit;
        }
    }

    if($form) {
        ?>
            <form class="insert_form" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                <div>
                    <label class="form_title">追加フォーム</label>
                </div>
                <ul>
                    <li>
                        <label class="word">英単語</label>
                        <input class="form_input" type="text" name="en_word" size="35" autocomplete='off'>
                    </li>
                    <li>
                        <label class="word">日本語</label>
                        <input class="form_input" type="text" name="ja_word" size="35" autocomplete='off'>
                    </li>
                    <li>
                        <label class="sentence">英文</label>
                        <input class="form_input" type="text" name="en_sentence" size="80" autocomplete='off'>
                    </li>
                    <li>
                        <label class="sentence">邦文</label>
                        <input class="form_input" type="text" name="ja_sentence" size="80" autocomplete='off'>
                    </li>
                    <li>
                        <label class="memo">メモ</label>
                        <textarea class="form_input_textarea" name="memo" cols="70" rows="10" autocomplete='off'></textarea>
                    </li>
                </ul>
                <input class="submit_bottun" value="追加" type='submit' name='submit'>
            </form>
            <?php
    }
    ?>
</body>

</html>