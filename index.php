<?php
require('./app/init.php');

if(isset($_SESSION[User::$sessionKey]))
{
    $userId = $_SESSION[User::$sessionKey];
    $userObj = $database->table('users')->where('id', '=', $userId)->first();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    if($user->check()):?>
        <p>You are signed in as <?= $userObj->username; ?> <a href="">Sign Out!</a></p>
    <?php 
    else: ?>
        <p>You look new, please either <a href="login.php">Login!</a> or  <a href="">Sign Up!</a></p>
    <?php
    endif; ?>
</body>
</html>