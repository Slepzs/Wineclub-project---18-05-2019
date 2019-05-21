<?php include('../private/initialize.php');

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require './vendor/autoload.php';

if(is_post_request()) {

$email = $_POST['email'];

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

$length = 35;
$token = bin2hex(random_bytes($length));

$user = New User;

$result = $user->update_token($token, $email);

try {
    //Server settings

    $mail->isSMTP();
    $mail->Timeout = 60;                                      // Set mailer to use SMTP
    $mail->Host = 'mailout.one.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'slepzs@heidework.com';                 // SMTP username
    $mail->Password = 'Px4z2n5h6s1.';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = '465';                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('slepzs@heidework.com', 'Wineclub master');
    $mail->addAddress($email);     // Add a recipient




    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Password Reset';
    $mail->Body    = 'Follow this link to reset your password <a href="http://heidework.com/public/recover.php?token=' . $token . '">link</a>';
    $mail->AltBody = 'Follow this link to reset your password <a href="http://heidework.com/public/recover.php?token=' . $token . '"></a>';

    $mail->send();
    $sucess = 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Wine Club 41</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/master.css">
  </head>
  <body>



<div class="uk-width-1-1 user-login">

<div class="wrapper">
  <div class="uk-container">
 <p class="white"><?= $sucess ?? ''; ?></p> 
  <?php // echo display_errors($errors); ?>
 <p class="white"><?php // $session->message(); ?></p>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">

  <h1>Send Recovery email</h1>

    <div class="uk-margin">
        <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input" type="text" name="email" placeholder="E-mail">
        </div>  
    </div>

    <button class="uk-button uk-button-default" type="submit" name="submit">Send Email</button>
    <p class="signup"><a href="signup.php">Sign up</a> || <a href="forgot.php">Forgot password?</a> </p>
    <a class="link" href="login.php">Go Back</a>
</form>



</div>

</div>
</div>


<script src="js/uikit.js"></script>
<script src="js/uikit-icons.js"></script>
</body>
</html>
