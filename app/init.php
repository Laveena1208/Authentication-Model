<?php
session_start();
$app = __DIR__;

require("{$app}/classes/Hash.php");
require("{$app}/classes/DataBase.php");
require("{$app}/classes/ErrorHandler.php");
require("{$app}/classes/Validator.php");
require("{$app}/classes/User.php");

$database = new Database();
$user = new User($database);
$validator = new Validator($database);

$user->build();