<?php
//this is for hash value or auth k liye
// require('./app/classes/Hash.php');
// echo Hash::make('abcd1234');
// if(Hash::verify('abcd1234','$2y$10$.vDUNc9HFFZfDUp39usphOM.VEwbYqiB9rFxS.31LMm/eiAvY/kzi')){
//     echo ('Matched');
// }
// else{
//     echo('not matched');
// }

//mail jaarha ki nahi
// require('./app/classes/MailConfigHelper.php');
//     $mail = MailConfigHelper::getMailer();
//     $mail->Subject = 'Authetication'; 
//     $mail->addAddress('potter@gmail.com'); 
//     $mail->Body    = 'This is first authecation backend mail</b>';
//     $mail->send();
//     echo 'Message has been sent';



//database connection
// require('./app/classes/Database.php');
// $database = new Database();
// $rows = $database->table('contacts')
//         ->where('email', 'like','%study%')
//         ->get();
// var_dump($rows);


require('./app/classes/Database.php');
$database = new Database();
//insert
$data['fname'] = "yash";
$data['lname'] = "motta";
$data['email'] = "yash@gmail.com";
echo "<br>INSERTED DATA IS:             ";
$inserted = $database->table('users')
            ->insert($data);
var_dump($inserted);

//deleted
echo "<br>NO OF DELETED ROWS:           ";
$deleted = $database->table('users')
           ->deleteWhere("email", "yash@gmail.com")
           ->count();

var_dump($deleted);
