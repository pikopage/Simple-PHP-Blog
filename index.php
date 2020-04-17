<?php
session_start();
/*Check presense of all used subfiles*/
require("connect.php");
require("actions.php");
require("header.php");
require("menu.php");
require("footer.php");

/* First post - Pinned only and only first one is fetched from DB. --START */
$sql = "SELECT description FROM posts where deleted = 0 and visible = 1 and pinned = 1 ORDER BY id DESC";
$result = $dbcon->query($sql);
$maindes = $result->fetch_row();
$mainpost = "
<div class='w3-card w3-round w3-padding-small w3-margin-bottom'>
$maindes[0]
</div>
";
/* First post - Pinned only and only first one is fetched from DB. --END */
/* Posts count - counting moved to DB ---- START */
$sql = "SELECT a.value as value, ceil(count(*)/a.value) as totalpages FROM setting as a join posts as b where a.variable = 'rowsperpage' and b.deleted = 0 and b.visible = 1 and b.pinned = 0";
$result = $dbcon->query($sql);
$row = $result->fetch_assoc();
$totalpages = $row['totalpages'];
$rowsperpage = $row['value'];
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = (INT)$_GET['page'];
}
if ($page > $totalpages) {
    $page = $totalpages;
}
if ($page < 1) {
    $page = 1;
}
$offset = ($page - 1) * $rowsperpage;
/* Posts count ---- END */
/* Preview - Create visible posts preview - START */
$sql = "SELECT id, title, description, DATE_FORMAT(date,'%D %M %Y') as date, char_length(description)-char_length(REPLACE(description, ' ', '')) as words FROM posts where deleted = 0 and visible = 1 AND pinned = 0 ORDER BY id DESC LIMIT $offset, $rowsperpage";
$result = $dbcon->query($sql);
$numrows = $result->num_rows;
if ($numrows < 1) {
    $posts = "<div class='w3-panel w3-pale-red w3-card-2 w3-border w3-round w3-margin-bottom'>Nothing to display. Write first posts please.</div>";
}
while ($row = $result->fetch_assoc()) {
    $id = htmlentities($row['id']);
    $title = htmlentities($row['title']);
    $des = $row['description'];
    $time = htmlentities($row['date']);
    $words = htmlentities($row['words']);
$posts .= "<div id='post_$id'>";

$posts .= "<div class='w3-card w3-round w3-padding-small w3-margin-bottom'>
<h3><a href='#' onclick='return showpost($id)' style='w3-bar-item w3-round w3-button w3-padding-large w3-theme-d4'>$title</a></h3><p>
".substr($des, 0, 100)."<a href='#' onclick='return showpost($id)'>... Read next $words words</a></p> <div class='w3-text-grey'>$time</div></div></div>";
}
/* Preview - END */
/* Presenter - Show HTML Code - START */
echo $head;
echo $menu;
echo $mainpost;
echo $posts;

/* Presenter - Show HTML Code - END */
/* This code still waiting for changes */

echo "<div class='w3-bar w3-center'>";
if ($page > 1) {
    echo "<a href='?page=1'>&laquo;</a>";
    $prevpage = $page - 1;
    echo "<a href='?page=$prevpage' class='w3-btn'><</a>";
}
$range = 5;
for ($x = $page - $range; $x < ($page + $range) + 1; $x++) {
    if (($x > 0) && ($x <= $totalpages)) {
        if ($x == $page) {
            echo "<div class='w3-teal w3-button'>$x</div>";
        } else {
            echo "<a href='?page=$x' class='w3-button w3-border'>$x</a>";
        }
    }
}

if ($page != $totalpages) {
    $nextpage = $page + 1;
    echo "<a href='?page=$nextpage' class='w3-button'>></a>";
    echo "<a href='?page=$totalpages' class='w3-btn'>&raquo;</a>";
}
echo "</div>";
include("categories.php");
echo $footer;
