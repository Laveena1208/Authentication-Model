<?php
require('./app/classes/DataBase.php');
require('./app/classes/ErrorHandler.php');
require('./app/classes/Validator.php');
if(!empty($_POST))
{
    $database = new Database();
    $errorHandler = new ErrorHandler();
    $validator = new Validator($database, $errorHandler);
    // die(var_dump($_POST));
    $validator->validate($_POST,[
        'email' => [
            'required' => true,
            'maxlength' => 255,
            'unique' =>'users.email',
            'email' =>true
        ],
        'password' => [
            'required' => true,
            'minlength' => 4,
        ],
        'username' => [
            'required' => true,
            'minlength' => 2,
            'maxlength' => 255,
            'unique' =>'users.username',
        ]

    ]);

    die(var_dump($validator->errors()->errors));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp Page</title>
</head>
<body>
    <h1>Sign Up</h1>
    <form action="signup.php" method ="POST">
        <div>
            <label for="email"> Username</label>
            <input type = "text" name ="username">
        </div>
        <div>
            <label for="email"> email</label>
            <input type = "text" name ="email">
        </div>
        <div>
            <label for="email"> Password</label>
            <input type = "text" name ="password">
        </div>
        <div>
            <input type = "submit" value ="Sign Up">
        </div>
    </form>
</body>
</html>