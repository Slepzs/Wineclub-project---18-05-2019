<?php
function newMembers() {
  $sql = ("SELECT username FROM users ORDER BY id DESC LIMIT 8");
  $user = User::find_by_sql($sql);
  foreach($user as $users) { ?>
    <li><i class="fas fa-user"></i> <?= $users->username ?></li>
<?php  }
}

function Online() {
  $sql = ("SELECT username FROM users WHERE online=1");
  $user = User::find_by_sql($sql);
  foreach($user as $users) { ?>
    <li><i class="fas fa-signal"></i> <?= $users->username ?> (Online) </li>
<?php  }
}



function sidebarWines() {
  $sql = ("SELECT id, wine_name, wine_date FROM wines ORDER BY id DESC LIMIT 5");
  $wine = Wine::find_by_sql($sql);
  foreach($wine as $wines) { ?>
    <li><i class="fas fa-wine-bottle"></i> <?= $wines->wine_name ?><br/><span class="wine_date"><?= $wines->wine_date ?></span></li>
<?php  }
};


function topWines() {
  include('conn.php');
  $sql = ("SELECT wine_name, stars FROM wines, stars WHERE id = wines_wineid");
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $stmt->bind_result($wineid, $wine_name, $wine_date);
  while($stmt->fetch()) { ?>
    <li><?= $wine_name ?><br/><?= $wine_date ?></li>
<?php  }
}




?>
