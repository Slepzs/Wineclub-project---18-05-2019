<?php include('../private/initialize.php');

if(!empty($_GET['token'])) {
$_SESSION["token"] = $_GET['token'];
}

if(!empty($_SESSION["token"]) && preg_match('/^[0-9a-zA-Z]{70}$/', $_SESSION['token'])) {
  $user = new User;
  $result = User::find_by_token($_SESSION["token"]);  
} else {
  echo 'empty and exit';
  // exit;
}

if(is_post_request()) {

  $password = $_POST['password'];

  if($_SESSION["token"] === $result->token) {
  $results = User::update_password($password, $result->token);
  
};

  
  if($results === true) {
    // $session->message('The Wine was updated successfully.');
    redirect_to(url_for('/login'));
  } else {


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

  <?php // echo display_errors($errors); ?>
 <p class="white"><?php $session->message(); ?></p>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">

  <h1>Make new password</h1>

    <div class="uk-margin">
        <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input" type="text" name="password" placeholder="Password">
        </div>  
    </div>


    <button class="uk-button uk-button-default" type="submit" name="submit">Change</button>
    <p class="signup"><a href="login.php">Login</a> </p>
    <a class="link" href="/login.php">Go Back</a>
</form>



</div>

</div>
</div>


<script src="js/uikit.js"></script>
<script src="js/uikit-icons.js"></script>
</body>
</html>
