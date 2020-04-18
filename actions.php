<?php
if (realpath(__FILE__) == realpath($_SERVER['DOCUMENT_ROOT'].$_SERVER['SCRIPT_NAME'])) {
echo "File can't be called separately, it is part of other script";
}else{
    /* Action 1 - delete post*/
    if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action']=="1" && $_SESSION['username']) {
        $id = mysqli_real_escape_string($dbcon, (int)$_GET['id']);
        $sql = "Update posts SET deleted = 1 WHERE id = '$id'";
        $result = mysqli_query($dbcon, $sql);
    }
    /* Action 2 - save data to db */
    if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action']=="2" && $_SESSION['username']) {
        $id = mysqli_real_escape_string($dbcon, (int)$_POST['id']);
        $title = mysqli_real_escape_string($dbcon,$_POST['title']);
        $description = mysqli_real_escape_string($dbcon,$_POST['description']);
        $sql = "Update posts SET title = \"$title\", description = \"$description\" WHERE id = '$id'";
        $result = mysqli_query($dbcon, $sql);
    }
    /* Action 3 - create new post*/
    if (isset($_GET['action']) && $_GET['action']=="3" && $_SESSION['username']) {
       $user = $_SESSION['username'];
        $sql = "INSERT INTO posts (title, description, posted_by, post_cat, visible, deleted, pinned) values (\"new\", \"not yet\", \"$user\", \"\", 0, 0, 0)";
        $result = mysqli_query($dbcon, $sql);
    }
    /* Action 4 - change visibility of article */    
    if (isset($_GET['action']) && $_GET['action']=="4" && $_SESSION['username']) {
        $id = mysqli_real_escape_string($dbcon, (int)$_GET['id']);
        $vis = mysqli_real_escape_string($dbcon, (int)$_GET['vis']);
         $sql = "Update posts SET visible = $vis WHERE id = '$id'";
         $result = mysqli_query($dbcon, $sql);
    }
 }
?>
