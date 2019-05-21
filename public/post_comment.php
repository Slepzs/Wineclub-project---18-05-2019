<?php
include('conn.php');
include('loops.php');

$comment = $_POST['comment'];
$wineid = $_POST['wineid'];
$usersid = $_POST['users_userid'];

$inscom = ("INSERT INTO comments_wine(users_userid, wines_wineid, comment) VALUES(?, ?, ?)");
$stmtin = $conn->prepare($inscom);
$stmtin->bind_param('iis', $usersid, $wineid, $comment);
$stmtin->execute();

sleep(1);

$sqlcomment = ("SELECT username, comment FROM users, comments_wine WHERE wines_wineid = $wineid AND users.id = comments_wine.users_userid ORDER BY comments_wine.id ASC");
$stmtsqlcomment = $conn->prepare($sqlcomment);
$stmtsqlcomment->execute();
$stmtsqlcomment->bind_result($username, $comment);
while($stmtsqlcomment->fetch()) {
?>

<div class="comment">
<p><span class="username"><?= $username ?>:</span> <?= $comment ?></p>
</div>

<?php };
