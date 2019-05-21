<?php require_once('../private/initialize.php'); ?>

<?php
require_login();
include('loops.php');
include('../private/shared/header.php'); ?>

<?php 

$current_page = $_GET['page'] ?? 1;
$per_page =  5;
$total_count = Wine::count_all();


$pagination = new Pagination($current_page, $per_page, $total_count);


$sql = "SELECT * FROM wines ORDER BY id DESC ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";
$wine = Wine::find_by_sql($sql);

$star = new Star;

?>


<div class="uk-width-1-1 maindiv" uk-grid>

<div class="uk-width-1-4">

  <div class="comment-section">
  <div class="all-comments">


</div>

<div class="make_comment">
  <?php foreach($wine as $wines) { }; ?>
  <input type="hidden" class="wineid" name="wineid" value="<?= $wines->wineid; ?>">
  <input type="hidden" class="users_userid" name="users_userid" value="<?= $_SESSION['user_id'] ?>">
  <input id="usercomment" type="text" name="comment" placeholder="Press Enter">
</div>

</div>

</div>

<div class="uk-width-1-2@m zzss ">

<?php 
 $url = '../public/index.php';
 echo $pagination->page_links($url);
?>

<?php foreach($wine as $wines) {?>
<div class="feed-wines">
    <?php if($wines->users_userid == $_SESSION['user_id']) {
      echo "<div class='edit'><a href='editwine.php?wineid=". $wines->id. "'><i class='fas fa-edit'></i></a></div>";
    } else {} ?>
    <div class="comments" id="<?= $wines->id ?>"><i class="fas fa-comments"></i></div>
    <div id="<?= $wines->id ?>" class="feed-wines-box uk-flex uk-flex-wrap">
          <div class="uk-width-1-2@l">
            <div class="wine-left">
            <span class="wineinfo">Title: </span>
            <h3><?= $wines->wine_name ?></h3>
            <i class="fas fa-globe-africa"></i> <span class="wineinfo">Region & Country: </span>
            <p><a href="https://www.google.com/maps/search/<?= $wines->wine_region_country ?>/"><?= $wines->wine_region_country ?></a></p>
            <i class="fas fa-wine-glass-alt"></i> <span class="wineinfo">Wine Grape(s) </span>
            <p><?= $wines->wine_grapes ?></p>

            <span class="wineinfo">Wine year</span>
            <p><?= $wines->wine_year ?></p>

            <div class="uk-width-1-1 uk-flex uk-flex-wrap">

            <div class="uk-width-1-2">
              <span class="wineinfo">Volume % </span>
              <p><?= $wines->wine_volume ?> %</p>
            </div>

            <div class="uk-width-1-2">
              <span class="wineinfo">Size cl </span>
              <p><?= $wines->wine_size ?> cl</p>
            </div>

            </div>

            <div class="uk-width-1-1 uk-flex uk-flex-wrap">

            <div class="uk-width-1-2">
              <i class="fas fa-money-bill"></i> <span class="wineinfo">Price </span>
              <p><?= $wines->wine_price ?> Kr</p>
            </div>

            <div class="uk-width-1-2">
              <i class="fas fa-money-bill"></i> <span class="wineinfo">Real Price </span>
              <p><?= $wines->wine_real_price ?> Kr</p>
            </div>

            </div>

            <div class="uk-width-1-1 uk-flex uk-flex-wrap">

            <div class="uk-width-1-2">
              <span class="wineinfo">Rating</span>
              <p><div id="ydd<?= $wines->id ?>"><?php $star->starscalc($wines->id); ?></span></div></p>
            </div>

            <div class="uk-width-1-2">
              <span class="wineinfo">Value</span>
              <p><div id="allratinga" class="<?= $wines->id ?>"><?= $star->value($wines->id, $wines->wine_price) ?></div></p>
            </div>

          </div>

            </div>
            </div>
          <div class="uk-width-1-2@l">
            <div class="wine-right">

              <div class="uk-width-1-1 uk-flex uk-flex-wrap">

              <div class="uk-width-1-2 winedate">
                <span class="wineinfo"><i class="fas fa-shopping-cart"></i> Bought By: <?= $wines->wine_boughtby ?></span>
              </div>

              <div class="uk-width-1-2 winedate">
                <span class="wineinfo"><i class="far fa-calendar"></i> <?= $wines->wine_date ?> </span>
              </div>

              </div>
              <img src="img/<?= $wines->wine_img ?>" alt="Vin">






            </div>
          </div>
          <div class="uk-width-1-1">
            <div class="ratebutton">
            <div class="rate">
              <p>
                Rate <i class="fas fa-star-half-alt"></i>
              </p>


              <div class="starsdiv">
                <div class="uk-width-1-1 uk-flex uk-flex-wrap givestars" clicked="false">
                      <div class="wine-rating-input ">
                        <input id="focus" class="uk-input userstars_<?= $wines->id ?>" type="text" data-validation="number" data-validation-allowing="range[0;6]">
                      </div>
                      <div id="<?= $wines->id ?>" class="wine-rating-submit">
                        <input type="hidden" id="userid" value="<?= $_SESSION['user_id']; ?>">
                        <input type="hidden" id="wineid" value="<?= $wines->id ?>">
                        <button class="uk-button uk-button-primary submitstars">Rate</button>
                      </div>
                </div>
              </div>
              </div>
            </div>
          </div>
      </div>
    </div>
    <?php } ?>
</div>


<?php include('../private/shared/sidebar.php'); ?>

</div>








<script type="text/javascript">



$('.make_comment').keypress(function (e) {
  var key = e.which;
  if (key == 13) {

var comment = $("#usercomment").val();
var users_userid = $(this).find(".users_userid").val();

  $.ajax({
    type: "POST",
    url: "post_comment.php",
    data: {comment: comment, wineid: wineid, users_userid: users_userid},
    cache: false,
    success: function(result){
    $(".all-comments").html(result);
    $("#usercomment").val('');
}
  });
}

});


$('.comments').click(function(global) {
  var clicks = $(this).data('clicks');
  wineid = $(this).attr('id');
  $.ajax({url: "getcomments.php?id="+wineid, success: function(result) {
  $(".all-comments").html(result);   }});
  if (clicks) {
    $(".comment-section").css("cssText", "display: none");
  } else {
   // $(".comment-section").css("cssText", "display: none");
    $(".comment-section").css("cssText", "display: block");
  }
  $(this).data("clicks", !clicks);
});

function getstars() {

var parent = this.parentElement;
var userid = parent.querySelector('#userid').value;
var wineid = parent.querySelector('#wineid').value;
var userstars = $(".userstars_" + wineid).val();
var target = document.getElementById('ydd' + wineid);

var xhr = new XMLHttpRequest();
xhr.open('POST', 'givenstars.php?stars='+ userstars + '&userid=' + userid + '&wineid=' + wineid, true);
xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
xhr.onreadystatechange  = function() {
  if(xhr.readyState == 4 && xhr.status == 200) {
   var result = xhr.responseText;
    target.innerHTML = result;
    console.log(result);
  }
}
xhr.send();
};
var button = document.getElementsByClassName("submitstars");
for (var i = 0; i < button.length; i++) {
  button.item(i).addEventListener("click", getstars);
}

setInterval( function() {
    console.log(wineid);
    $.ajax({url: "getcomments.php?id="+wineid, success: function(result) {
    $(".all-comments").html(result);   }});
}, 5000);

</script>

<?php include("../private/shared/footer.php"); ?>
