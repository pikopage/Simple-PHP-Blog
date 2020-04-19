<?php
/*This file provide post for reading via json request to index.php
ID of post is required in request*/
session_start();
require("connect.php");
$id = (INT)$_GET['q'];
$edit = (INT)$_GET['e'];

$hsql = "UPDATE posts SET hits = hits +1 WHERE id = $id";
$r = mysqli_query($dbcon, $hsql);
if (isset($_SESSION['username'])){
    $visible = "";
}else{
    $visible = "and b.visible = 1";
}
$hsql = "SELECT id,title,description,posted_by, hits,DATE_FORMAT(date,'%D %M %Y') as date, visible FROM posts as b WHERE id = '$id' AND deleted = 0 $visible AND pinned = 0";
$res = mysqli_query($dbcon, $hsql);
$row = mysqli_fetch_assoc($res);
$id = $row['id'];
$title = $row['title'];
$description = $row['description'];
$by = $row['posted_by'];
$hits = $row['hits'];
$time = $row['date'];
$visible = $row['visible'];
if ($visible == 0){
    $vis_color = "w3-pale-blue";
}else{
    $vis_color = "w3-sand";        
}
/*If it is requested, prepare edit window*/
if ($edit == 1 and isset($_SESSION['username'])){
    $posts .= "<form action='index.php?id=$id&action=2' method='POST' class='w3-container w3-round w3-green'>
    <input type='hidden' name='id' value='$id'>
    <label>Title</label>
    <input type='text' class='w3-input w3-round w3-border' name='title' value='$title'>

    <label>Description</label>
    <textarea class='w3-input w3-round w3-border' id='description' name='description' style='height: 400px;'>$description</textarea>

    <button class='w3-round w3-btn w3-margin ".$bck_color."' name='upd'><i class='fa fa-save w3-margin-right'></i>Save</button>
    <a href='index.php' class='w3-round w3-btn w3-margin ".$bck_color."'><i class='fa fa-close w3-margin-right'></i>Cancel</a>
    </form>";
/*else only post for view*/
}else{
$posts .= "<div class='w3-card w3-round w3-padding-small w3-margin-bottom $vis_color'><h3>$title</h3>
<div>$description<br>
<div class='w3-text-grey'>
The article was posted by $by on $time<br>
It was read $hits times.<br>";
/* Show edit, visibility and delete option, when user is logged on*/
if (isset($_SESSION['username'])) {
    if ($visible == 1){
        $VisHTML = "w3-text-green' href='index.php?id=$id&action=4&vis=0#post_$id'><i class='fa fa-unlock w3-margin-right'></i>Visible";
    }else{
        $VisHTML = "w3-text-red' href='index.php?id=$id&action=4&vis=1#post_$id'><i class='fa fa-lock w3-margin-right'></i>Invisible";
    }
    $posts .= "<a class='w3-bar-item w3-round w3-btn w3-margin-right w3-margin-bottom ".$bck_color." w3-text-green' href='#post_$id' onclick='return editpost($id)'><i class='fa fa-edit w3-margin-right'></i>Edit</a>
    <a class='w3-bar-item w3-round w3-btn w3-margin-right w3-margin-bottom ".$bck_color." w3-text-red' href='index.php?id=$id&action=1#post_$id'><i class='fa fa-close w3-margin-right'></i>Delete</a>
    <a class='w3-bar-item w3-round w3-btn w3-margin-right w3-margin-bottom ".$bck_color." $VisHTML</a>";
}
$posts .= "</div></div>";
}
echo $posts;
?>
