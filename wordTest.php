<!DOCTYPE HTML>
<html lang="ja">

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <title>単語テスト</title>
</head>

<body>
    <div class="menu_var">
        <ul>
            <li><a href='index.php'>ホームページ</a></li>
            <li>単語を<a href='insert.php'>追加</a></li>
            <li><a href='sentence.php'>英文一覧</a></li>
            <li>英文テスト</li>
        </ul>
    </div>
    <?php
    require_once('dbConnection.php');
    $dbc = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (isset($_POST['submit'])) {
        $en_word = $_POST['en_word'];
        $query = "SELECT * FROM `en` WHERE `en_word` = '$en_word'";
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($result);
        if ($_POST['answer']) {
            $answer = $_POST['answer'];
            $correct_answer = explode("　", $row['ja_word']);
            if (in_array($answer, $correct_answer)) {
                $mistake_counter = $row['mistake_counter'];
                if ($mistake_counter >= 1) {
                    $mistake_counter = $mistake_counter - 1;
                }
                $set_query = "UPDATE `en` SET `mistake_counter` = '$mistake_counter' WHERE `en_word` = '$en_word'";
                if ($set_done = mysqli_query($dbc, $set_query)) {
                    ?>
                    <div class="form_test">
                        <label>正解</label>
                        <div class="test_answer_en_word">
                            <label>
                                <?= $row['en_word'] ?>
                            </label>
                        </div>
                        <div class="test_answer_ja_word">
                            <label>
                                <?= $row['ja_word'] ?>
                            </label>
                        </div>
                        <label class="bottun"><a href="wordTest.php">もう一度</a></label>
                    </div>
                    <?php
                }
            } else {
                ?>
                <?php
                $mistake_counter = $row['mistake_counter'] + 1;
                $set_query = "UPDATE `en` SET `mistake_counter` = '$mistake_counter' WHERE `en_word` = '$en_word'";
                if ($set_done = mysqli_query($dbc, $set_query)) {
                    ?>
                    <div class="form_test">
                        <label>不正解</label>
                        <div class="en_word">
                            <label>
                                <?= $row['en_word'] ?>
                            </label>
                        </div>
                        <div class="ja_word">
                            <label>
                                <?= $row['ja_word'] ?>
                            </label>
                        </div>
                        <?php
                        if ($row['en_sentence']) {
                            ?>
                            <div class="en_sentence">
                                <label>
                                    <?= $row['en_sentence'] ?>
                                </label>
                            </div>
                            <?php
                        }
                        ?>
                        <?php
                        if ($row['ja_sentence']) {
                            ?>
                            <div class="ja_sentence">
                                <label>
                                    <?= $row['ja_sentence'] ?>
                                </label>
                            </div>
                            <?php
                        }
                        ?>
                        <?php
                        if ($row['memo']) {
                            ?>
                            <div class="memo">
                                <label>
                                    <?= $row['memo'] ?>
                                </label>
                            </div>
                            <?php
                        }
                        ?>
                        <label class="bottun"><a href="wordTest.php">もう一度</a></label>
                    </div>
                    <?php
                }

            }
        } else {
            $mistake_counter = $row['mistake_counter'] + 1;
            $set_query = "UPDATE `en` SET `mistake_counter` = '$mistake_counter' WHERE `en_word` = '$en_word'";
            $set_done = mysqli_query($dbc, $set_query);
            echo "<label class='bottun'><a href='wordTest.php'>もう一度</a></label>";
        }

    } else {
        $query = "SELECT `id`,`en_word`,`ja_word` FROM `en`";
        $result = mysqli_query($dbc, $query);
        $ids = [];
        while ($row = mysqli_fetch_array($result)) {
            $ids[] = $row['id'];
        }
        $test = array_rand($ids, 1);
        $id = $ids[$test];
        $test_query = "SELECT `id`,`en_word`,`ja_word` FROM `en` WHERE `id` = '$id'";
        $test_result = mysqli_query($dbc, $test_query);
        ?>
        <form class="form_test" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
            <?php
            $row = mysqli_fetch_array($test_result);
            ?>
            <div class='test_content'>
                <label>
                    <?= $row['en_word'] ?><input type='text' name='answer' autocomplete='off' size="35" >
                </label>
            </div>
            <input type="submit" name="submit">
            <input type="hidden" name="en_word" value="<?= $row['en_word'] ?>">
        </form>
        <?php
    }
    ?>
</body>