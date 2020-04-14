    <?php
    /* Menu also manage user logon It is only included in index.php, does not work separetly */
if (realpath(__FILE__) == realpath($_SERVER['DOCUMENT_ROOT'].$_SERVER['SCRIPT_NAME'])) {
echo "File can't be called separately, it is part of other script";
}else{    
if ($_GET['login']=="no") {
        session_destroy();
     $menu .=  "<div class='w3-card w3-round ".$card_color." w3-margin-right w3-margin-bottom' style='max-width:570px'><div class='w3-bar-item'>User logged out.</div></div>";
    }
    if ($_GET['login']=="yes") {
         if (isset($_POST['log'])) {
             $username = mysqli_real_escape_string($dbcon, $_POST['username']);
             $password = mysqli_real_escape_string($dbcon, $_POST['password']);
             $sql = "SELECT * FROM admin WHERE username = '$username'";
             $result = $dbcon->query($sql);
             $rows = $result->num_rows;
             $row = $result->fetch_assoc();
             if ($rows == 1 && password_verify($password, $row['password'])) {
                 $_SESSION['username'] = $row['username'];
             } else {
                $menu .=  "<div class='w3-card w3-round ".$card_color." w3-margin-right w3-margin-bottom' style='max-width:570px'><div class='w3-bar-item'>incorrect details</div></div>";
             }
         } else {
 $menu .= "<div class='w3-card w3-round ".$card_color." w3-margin-right w3-margin-bottom' style='max-width:570px'>
             <form action='index.php?login=yes' method='POST' class='w3-card'>
             <div class='w3-bar-item'>User:
                 <input type='text' name='username' class='w3-bar-item'>
                 Password: <input type='password' name='password' class='w3-bar-item'>
                 <input type='submit' name='log' value='Login' class='w3-btn'></div>
             </form>
             </div>";
         }
     }
     if ($_SESSION['username'] && $_GET['login']!=="no") {
        $user = $_SESSION['username'];
        $menu = "<a href='new.php' class='w3-bar-item w3-round w3-btn w3-margin-right w3-margin-bottom ".$bck_color[0]."'> <i class='fa fa-file w3-margin-right'></i>New Post</a>";
    }
        if ($_SESSION['username'] && $_GET['login']!=="no") {
        $menu .= "<a href='cat.php' class='w3-bar-item w3-round w3-btn w3-margin-right w3-margin-bottom ".$bck_color[0]."'><i class='fa fa-list-alt w3-margin-right'></i>Categories</a>";
    }
    if ($_SESSION['username'] && $_GET['login']!=="no") {
        $menu .=  "<a href='index.php?login=no' class='w3-bar-item w3-round w3-btn w3-margin-right w3-margin-bottom ".$bck_color[0]."'><i class='fa fa-sign-out w3-margin-right'></i>Sign out</a>";
    }
}
    ?>
