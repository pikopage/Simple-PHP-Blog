<?php
if (realpath(__FILE__) == realpath($_SERVER['DOCUMENT_ROOT'].$_SERVER['SCRIPT_NAME'])) {
echo "File can't be called separately, it is part of other script";
}else{
$sql = "SELECT value FROM setting where variable = 'title'";
$result = mysqli_query($dbcon, $sql);
$title = $result->fetch_row();
$sql = "SELECT value FROM setting where variable = 'bck_color'";
$result = mysqli_query($dbcon, $sql);
$bck_color = $result->fetch_row();
$sql = "SELECT value FROM setting where variable = 'card_color'";
$result = mysqli_query($dbcon, $sql);
$card_color = $result->fetch_row();
$head="<!DOCTYPE HTML>
<html>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width' ,initial-scale='1'>
    <title>$title[0]</title>

    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">

    <script src='tinymce/tinymce.min.js'></script>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.19.1/ui/trumbowyg.min.css'>
    <style>
        html, body, h1, h2, h3, h4, h5 {font-family: 'Open Sans', sans-serif}
    </style>
    <script>
function showpost(str) {
    if (str == '') {
        document.getElementById('txtHint').innerHTML = '';
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('post_'+str).innerHTML = this.responseText;
            }
        };
        xmlhttp.open('GET','getpost.php?q='+str,true);
        xmlhttp.send();
    }
}
</script>
</head>
<body class='$bck_color[0]'); background-size: cover; background-position: center;'>
<div class='w3-content w3-margin-top' style='max-width:1400px;'>
<div class='w3-card w3-round $card_color[0] w3-margin-bottom' >
<a href='index.php' class='w3-bar-item w3-round w3-button w3-padding-large w3-theme-d4'><h2><i class='fa fa-home w3-margin-right'></i>$title[0]</h2></a>
</div>
<!-- Head End -->
";
}
?>
