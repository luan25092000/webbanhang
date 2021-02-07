<?php
function add_backslash($str) {
    return $str.Replace("\'", "\\\'").Replace("\"", "\\\"").Replace("\`", "\\\`");
}
?>