<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
error_reporting(E_ALL);
$app = __DIR__;

require("{$app}/classes/MailConfigHelper.php");
require("{$app}/classes/Util.php");
require("{$app}/classes/Hash.php");
require("{$app}/classes/DataBase.php");
require("{$app}/classes/ErrorHandler.php");
require("{$app}/classes/Validator.php");
require("{$app}/classes/User.php");
require("{$app}/classes/Token.php");

$database = new Database();
$user = new User($database);
$validator = new Validator($database);
$token = new Token($database);

$user->build();
$token->build();