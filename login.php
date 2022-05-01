<?php
require('./app/init.php');
if(isset($_POST['login']))
{
    $loggedIn = $user->signIn($_POST);

    if($loggedIn)
    {
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
            <input type = "submit" name = "login" value = "Login">
        </div>
    </form>
</body>
</html>