<?php
include('../conn.php');



if(isset($_POST['submit'])) {

  $wine_name = filter_input(INPUT_POST, 'wine_name', FILTER_SANITIZE_STRING) or die('Name wrong');
  $wine_region_country = filter_input(INPUT_POST, 'wine_region_country', FILTER_SANITIZE_STRING) or die('Name region & Country');
  $wine_grapes = filter_input(INPUT_POST, 'wine_grapes', FILTER_SANITIZE_STRING) or die('Name grapes');
  $wine_year = filter_input(INPUT_POST, 'wine_year', FILTER_SANITIZE_NUMBER_INT) or die('Name year');
  $wine_volume = filter_input(INPUT_POST, 'wine_volume') or die('Name volume');
  $wine_size = filter_input(INPUT_POST, 'wine_size', FILTER_SANITIZE_NUMBER_INT) or die('Name size');
  $wine_price = filter_input(INPUT_POST, 'wine_price', FILTER_SANITIZE_NUMBER_FLOAT) or die('Name price');
  $wine_real_price = filter_input(INPUT_POST, 'wine_real_price', FILTER_SANITIZE_NUMBER_FLOAT) or die('Name real price');
  $wine_date = filter_input(INPUT_POST, 'wine_date') or die('Name date');
  $wine_boughtby = filter_input(INPUT_POST, 'wine_boughtby') or die('Name date');
  $users_userid = filter_input(INPUT_POST, 'users_userid', FILTER_SANITIZE_STRING) or die('UserID broken');


  $wine_img = $_FILES['wine_img']['name'];
  $temp_name = $_FILES['wine_img']['tmp_name'];

  if(isset($wine_img)){
      if(!empty($wine_img)){
          $location = 'img/';
          if(move_uploaded_file($temp_name, $location. $wine_img)){
              echo 'File uploaded successfully';
          }
      }
  }  else {
      echo 'You should select a file to upload !!';
  }

if(empty($wine_name) || empty($wine_region_country) || empty($wine_grapes) || empty($wine_year) || empty($wine_volume) || empty($wine_size) || empty($wine_price)
 || empty($wine_real_price) || empty($wine_date) || empty($users_userid)) {
  echo "Info missing information somewhere. Check if all infomation has been entered and try again";
  exit();
} else {
  $wineins = ("INSERT INTO wines(wine_name, wine_region_country, wine_grapes, wine_year, wine_volume, wine_size, wine_price, wine_real_price, wine_date, wine_boughtby, wine_img, users_userid)
  VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt = $conn->prepare($wineins);
  $stmt->bind_param('sssididdsssi', $wine_name, $wine_region_country, $wine_grapes, $wine_year, $wine_volume, $wine_size,
  $wine_price, $wine_real_price, $wine_date, $wine_boughtby, $wine_img, $users_userid);
  $stmt->execute();
  header('Refresh: 1; URL=index.php');
}

}




 ?>
