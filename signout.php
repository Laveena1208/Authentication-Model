<?php
require('./app/init.php');
$token->delete($_SESSION[User::$sessionKey],1);
$user->signOut();
unset($_COOKIE['remember']);
setcookie('remember', '', time()-3600);
header('Location: index.php');

