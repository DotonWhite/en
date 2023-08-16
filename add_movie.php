<?php
$form = true;

if (isset($_POST['submit_movie'])) {
    if (!empty($_POST['url'])) {
        $form = false;
        require_once('dbConnection.php');
        if ($dbc = mysqli_connect(SERVER, USER, PASSWORD, DATABASE)) {
            $query = "INSERT INTO movie(title,url,content,tab) values(,'$url')";
            if ($result = mysqli_query($dbc, $query)) {
                header("Local: /movie.php");
            } else {
                echo 'fail to add';
            }
        } else {
            echo 'something went wrong';
        }
    }
}

if ($form) {
    ?>
    <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
        <fieldset>
            <div class="form_title">
                <label>動画追加フォーム</label>
            </div>
            <ul>
                <li>URL :<input type="url" name="url" size="35" autocomplete='off'></li>
                <li>タイトル :<input type="text" name="title" size="35" autocomplete='off'></li>
                <li>タブ :<input type="text" name="tab" size="35" autocomplete='off'></li>
                <li>概要:<br>
                <textarea class="form_input_textarea" name="memo" cols="70" rows="10" autocomplete='off'></textarea></li>
            </ul>
            <input type="submit" name="submit_movie" value="追加">
        </fieldset>
    </form>
    <?php
}
?>
