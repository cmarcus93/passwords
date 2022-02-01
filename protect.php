<?php
if (basename($_SERVER['SCRIPT_NAME'])==="protect.php") { unauthed(); }
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    if (isset($_GET['mode'])) {
        unauthed();
    }
    header("location: login.php");
    die();
}

function unauthed() {
    header("HTTP/1.1 401 Unauthorized");
    die();
}