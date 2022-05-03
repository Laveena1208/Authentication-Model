<?php
require('./app/init.php');
$tokenData = isset($_COOKIE['remember']) ? $token->verify($_COOKIE['remember'], 1) : null;
if($tokenData !=null)
{
    $_SESSION[User::$sessionKey] = $tokenData['user_id'];
}
if(isset($_POST['login']))
{
    $rememberMe = isset($_POST['remember']);
    $loggedIn = $user->signIn($_POST);

    if($loggedIn)
    {
        if($rememberMe)
        {
            $userId = $_SESSION[User::$sessionKey];
            $tokenData = $token->createRememberMeToken($userId);

            setcookie("remember", $tokenData['token'], time() + Token::$REMEMBER_EXPIRY_TIME_FOR_COOKIE);
        }
        header('Location: index.php');
    }
    else
    {
        echo "Error in username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="POST">
        <div>
            <label for ="username"> Username/Email</label>
            <br>
            <input type = "text" name = "username" placeholder="Username or Registered email id">
        </div>
        <div>
            <label for ="password">Password</label>
            <br>
            <input type = "password" name = "password" placeholder="Password">
        </div>
        <div>
            <label>
            <br>
            <input type = "checkbox" name = "remember" value="1">Remember Me
            </label>
        </div>
        <div>
            <input type = "submit" name = "login" value = "Login">
        </div>
    </form>
</body>
</html>