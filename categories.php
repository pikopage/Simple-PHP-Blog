<?php
   if (realpath(__FILE__) == realpath($_SERVER['DOCUMENT_ROOT'].$_SERVER['SCRIPT_NAME'])) {
    echo "File can't be called separately, it is part of other script";
    }else{
$cat .= "<div class='w3-container w3-round w3-center $card_color'><h3>Categories</div>";
$sql = "SELECT * FROM category";
$result = mysqli_query($dbcon, $sql);
if (mysqli_num_rows($result) < 1) {
    $cat .= "<div class='w3-panel w3-pale-red'>No Category found.</a>";
}else{
$cat .= "<div class='w3-container w3-center w3-round'>";
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $catname = $row['catname'];
    $description = $row['description'];
    $cat .= "<div class='w3-panel w3-round w3-btn'><a href='cat.php?id=$id'>$catname</a><br>$description</div>";
}
}
$cat .= "</div>";
}
?>
