<?php
/*This file provide post for reading via json request to index.php
ID of post is required in request*/
session_start();
require("connect.php");
$id = (INT)$_GET['q'];
$edit = (INT)$_GET['e'];

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
/*show normal post or edit window in case of request*/
if ($edit == 1 and isset($_SESSION['username'])){
    $posts .= "<form action='index.php?id=$id&action=2' method='POST' class='w3-container w3-round w3-green'>
    <input type='hidden' name='id' value='$id'>
    <label>Title</label>
    <input type='text' class='w3-input w3-round w3-border' name='title' value='$title'>

    <label>Description</label>
    <textarea class='w3-input w3-round w3-border' id='description' name='description'>$des</textarea>

    <button class='w3-round w3-btn w3-margin ".$bck_color."' name='upd'><i class='fa fa-save w3-margin-right'></i>Save</button>
    <a href='index.php' class='w3-round w3-btn w3-margin ".$bck_color."'><i class='fa fa-close w3-margin-right'></i>Cancel</a>
    </form>";
}else{
$posts .= "<div class='w3-card w3-round w3-sand w3-padding-small w3-margin-bottom'><h3>$title</h3>
<div>$des<br>
<div class='w3-text-grey'>
The article was posted by $by on $time<br>
It was read $hits times.<br>";
/* Show edit and delete option in case of user*/
if (isset($_SESSION['username'])) {
$posts .= "<a class='w3-bar-item w3-round w3-btn w3-margin-right w3-margin-bottom ".$bck_color." w3-text-green' href='#' onclick='return editpost($id)'><i class='fa fa-edit w3-margin-right'></i>Edit</a>
    <a class='w3-bar-item w3-round w3-btn w3-margin-right w3-margin-bottom ".$bck_color." w3-text-red' href='index.php?id=$id&action=1'><i class='fa fa-close w3-margin-right'></i>Delete</a>";
}
$posts .= "</div></div>";
}
echo $posts;
?>
