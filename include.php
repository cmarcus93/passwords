<?php
require("config.php");
require("functions.php");

$pageMode = "";
if (isset($_GET['mode'])) {
    $pageMode = $_GET['mode'];
}

session_start();