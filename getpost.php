<?php
/*This file provide post for reading via json request to index.php
ID of post is required in request*/
session_start();
require("connect.php");
$id = (INT)$_GET['q'];

$hsql = "UPDATE posts SET hits = hits +1 WHERE id = $id";
$r = mysqli_query($dbcon, $hsql);

$hsql = "SELECT id,title,description,posted_by, hits,DATE_FORMAT(date,'%D %M %Y') as date FROM posts WHERE id = '$id' AND deleted = 0 and visible = 1 AND pinned = 0";
$res = mysqli_query($dbcon, $hsql);
$row = mysqli_fetch_assoc($res);
$id = $row['id'];
$title = $row['title'];
$des = $row['description'];
$by = $row['posted_by'];
$hits = $row['hits'];
$time = $row['date'];

echo "<div class='w3-card w3-round w3-sand w3-padding-small w3-margin-bottom'>";
echo "<h3>$title</h3>";
echo '<div>';
echo "$des<br>";
echo '<div class="w3-text-grey">';
echo "The article was posted by $by on $time<br>";
echo "It was read $hits times.<br></div></div>";

?>
