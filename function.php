<?php
function set_null($str)
{
    if (empty($str)) {
        return 'NULL';
    } else {
        return "'$str'";
    }
}
?>