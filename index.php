<?php
spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});

session_start();
$command = "";
if (isset($_GET["command"]))
    $command = $_GET["command"];

if (!isset($_SESSION["email"]) && $command!=="login" && $command!=="sign-up") {
    $command = "home";
}

$style = new CyberStyleController($command);
$style->run();