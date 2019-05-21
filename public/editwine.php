<?php include('../private/shared/header.php');

require_once('../private/initialize.php');
?>
<?php include('loops.php'); ?>


<?php

if(!isset($_GET['wineid'])) {
  redirect_to(url_for('index.php'));
}

$id = $_GET['wineid'];

  // display the form
  $wine = Wine::find_by_id($id);
  if($wine == false) {
    redirect_to(url_for('index.php'));

  }

if(is_post_request()) {

  // Save record using post parameters
  $args = $_POST['wine'];

  $wine_img = basename($_FILES['wine_img']['name']);
  
  if(empty($wine_img)) {
    $wine_img = $wine->wine_img;
  }

  $target = "img/".basename($_FILES['wine_img']['name']);
  move_uploaded_file($_FILES['wine_img']['tmp_name'], $target);

  $img_array = array("wine_img"=>$wine_img);
  $output = array_slice($args, 0, 10, true);
  $output_2 = array_slice($args, 10);

  $result_img = array_merge($output, $img_array, $output_2);

  $wine->merge_attributes($result_img);
  $result = $wine->save();

  if($result === true) {

    // $session->message('The Wine was updated successfully.');
    // redirect_to(url_for('/show.php?wineid=' . $id));

  } else {

    // show errors
    echo 'Error';

  }

} else {



}

?>

<?php // echo display_errors($wine->errors); ?>

<div class="uk-width-1-1" uk-grid>


  <div class="uk-width-1-3">
    <div class="leftside">
      <img src="img/<?= $wine->wine_img ?>" />
    </div>
  </div>

  <div class="uk-width-1-3">

  <form action="<?php echo url_for('editwine.php?wineid=' . h(u($id))); ?>" method="post" enctype="multipart/form-data">
   
    <?php include('../public/wines/form_fields.php'); ?>

  </form>
  
  </div>


<?php include('../private/shared/sidebar.php');?>
</div>









<?php include("../private/shared/footer.php"); ?>
