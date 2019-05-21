<?php
include('conn.php');
include('loops.php');

function is_ajax_request() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

if(!is_ajax_request()) { exit; }

$stars = $_GET['stars'];
$userid = $_GET['userid'];
$wineid = filter_input(INPUT_GET, 'wineid', FILTER_SANITIZE_NUMBER_INT);

$re = "~^-?[0-6]+(\.[0-6]+)?$~xD";

$stars = str_replace(',', '.', $stars);

if(!preg_match($re, $stars) ) {
  echo 'Above or under 6 or not a number';
  exit();
}

$sqluserid = ("SELECT wines_wineid, users_userid FROM stars WHERE wines_wineid=$wineid AND users_userid=$userid");
$stmtuserid = $conn->prepare($sqluserid);
$stmtuserid->execute();
$stmtuserid->bind_result($wines_wineid, $users_userid);
while($stmtuserid->fetch()) {};

if($wineid == $wines_wineid || $userid == $users_userid) {
  $sqld = ("UPDATE stars SET stars=? WHERE users_userid = $userid AND wines_wineid = $wineid");
  $stmtd = $conn->prepare($sqld);
  $stmtd->bind_param("d", $stars);
  $stmtd->execute();
} else {
  $sql = ("INSERT INTO stars(wines_wineid, users_userid, stars) values(?, ?, ?)");
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("iid", $wineid, $userid, $stars);
  $stmt->execute();
};


sleep(1);





$sqlc = ("SELECT * FROM stars where wines_wineid = $wineid");
$stmtc = $conn->prepare($sqlc);
$stmtc->execute();
$stmtc->bind_result($suerid, $swineid, $stars);


while($stmtc->fetch()) {
  $arraystars[] = $stars;
};

$allstars = array_sum($arraystars);
$dived = $allstars / count($arraystars);
echo round($dived, 2);


    if($dived > 1 && $dived < 2) {
      $ss = '<i class="fas fa-star"></i>';
      echo $ss;
    } elseif($dived >= 2 && $dived < 3 ) {
      $ss = '<i class="fas fa-star"></i><i class="fas fa-star"></i>';
          echo $ss;
    } elseif($dived >= 3 && $dived < 4) {
      $ss = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
          echo $ss;
    } elseif($dived >= 4 && $dived < 5) {
      $ss = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
          echo $ss;
    } elseif($dived >= 5 && $dived < 6) {
      $ss = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
      echo $ss;
    } elseif($dived >= 6) {
      $ss = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
      echo $ss;
    } else {
      $ss = '';
      echo $ss;
    }
