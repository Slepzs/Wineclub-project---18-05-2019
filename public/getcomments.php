<?php include("../private/initialize.php");
include('loops.php');

$wineid = $_GET['id'] ?? '';

$comment = new Comment;

$comment->get_comment($wineid);
