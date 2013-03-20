<?php
if(!empty($_GET["theme"])) {
    setcookie('theme', $_GET["theme"], time() + 3600 * 24 * 365 * 10 /* expire in 10 years */, '/');
    setcookie('css', '', time() - 3600, '/');
    header("Location: themes.html");
}
