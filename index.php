<?php
if ($_SERVER['REQUEST_METHOD']==="POST"){
    if (empty($_POST['email'])){
        $emailError="Email is empty";
    }
    else{
        $email = $_POST['email'];
    
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailError = "Invalid email";
        }
    }
    if (empty($_POST['name'])){
        $nameError = "Name is empty";
    }else{
        $name = $_POST['name'];
    }
    if (empty($_POST['phone'])){
        $phoneError = "Phone number is empty";
    }else{
        $phone = $_POST['phone'];
    }
    if (empty($_POST['message'])){
        $messageError = "Message box is empty";
    }else{
        $message = $_POST['message'];
    }
    if (empty($emailError) || empty($nameError)|| empty($phoneError) || empty($messageError)){
        $date = date("d:m:Y, h:i:sa");
        $emailBody ="
        <html>
        <head>
        <title> $email is contacting you </title>
        </head>
        <body style=\"backgroung-color:#fafafa;\">
        <div style =\"padding: 20px;\">
        Date: <span style =\"color: #888;\">$date</span>
        Email: <span style =\"color: #888;\">$email</span>
        Phone Number: <span style =\"color: #888;\">$phone</span>
        Message: <span style =\"color: #888;\">$message</span>
        </div>
        </body>
        </html>
        ";
        $myemail = 'teejohnson356@gmail.com';
        $headers = 'From: '.$myemail."\r\n".
        "Reply-To: $email". "\r\n" . 
        "MIME-version: 1.0\r\n" .
        "Content-Type:text/html; charset=iso-8859-1\r\n";
        $to = $myemail;
        $subject = 'Contacting you';
        if (mail($to, $subject, $emailBody, $headers)){
            $sent = true;
        }else { 
        $error = "Unable to submit your response, please try again";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .label{
        display: block;
        margin-bottom:2px;
    }
    .submit-button{
        padding:10px;
    }
    textarea{
        height:200px;
        resize:none;
    }
    input,textarea{
        border: 1px solid black;
        padding:6px;
        border-radius:3px;
        width: 100%;
    }
    .input-wrap{
        padding: 20px 0px;
    }
    form{
        width: 50%;
        margin:auto;
    }
    </style>
</head>
<body>
    <form action="" method="post">
    <div class="input-wrap">
        <span class="label">Name:</span>
        <input type="text" name="name">
    </div>
    <div class="input-wrap">
        <span class="label">Email:</span>
        <input type="text" name="email">
    </div>
    <div class="input-wrap">
        <span class="label">Phone Number:</span>
        <input type="text" name="phone">
    </div>
    <div class="input-wrap">
        <span class="label">Message:</span>
        <textarea name="message"></textarea>
    </div>
    <div class="input-wrap">
        <input type="submit" name="email" value="submit" class="submit-button">
    </div>
    </form>
</body>
</html>


    <?php 
    if (isset($emailError) && isset($nameError) && isset($messageError) && isset($phoneError)):?>
    <div id = "error-message">
    <?php
        echo  $emailError;
        echo  $nameError;
        echo $phoneError;
        echo $messageError;
    ?>
    </div>
    <?php endif;?>
    <?php 
    echo $error;
    if (isset($sent)&& $sent ===true):?>
    <div id = "done-message">
    Your data was succesfully submitted
    </div>
    <?php endif;?>
</body>
</html>
