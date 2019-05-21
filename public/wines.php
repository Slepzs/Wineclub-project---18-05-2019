<?php include('../private/initialize.php');

require_login();

?>
<?php include('loops.php'); ?>
<?php include('../private/shared/header.php'); ?>



<?php 
$errors = [];

if(is_post_request()) {

  $args = $_POST['wine'];
  
  $wine_img = basename($_FILES['wine_img']['name']);
  $target = "img/".basename($_FILES['wine_img']['name']);
  move_uploaded_file($_FILES['wine_img']['tmp_name'], $target);

  $img_array = array("wine_img"=>$wine_img);
  $output = array_slice($args, 0, 10, true);
  $output_2 = array_slice($args, 10);

  $result = array_merge($output, $img_array, $output_2);
  $wine = new Wine($result);

  unset($wine->id);
  $result = $wine->save();

  if($result == true) {
    $new_id = $wine->id;
   
    $session->message('The Wine was succesfully created.');
    // redirect_to(url_for('index?id=' . $new_id));
  } else {
    echo 'Not working';
  }
} else {
  echo 'Not working 2';
}


?>




<div class="uk-width-1-1" uk-grid>



  <div class="uk-width-1-3">
    <div class="leftside">
      <h3>Information</h3>
      <p>Be sure to add all the necessary information..</p>
    </div>
  </div>

  <div class="uk-width-1-3">


  <form  action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">

    <?php include("wines/form_fields.php"); ?>
    <input type="hidden" name="wine[users_userid]" value="<?= $_SESSION['user_id']; ?>">
</form>
  </div>


<?php include('../private/shared/sidebar.php'); ?>
</div>









<?php include("../private/shared/footer.php"); ?>
