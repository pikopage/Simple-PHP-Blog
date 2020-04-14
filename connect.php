<?php
if (realpath(__FILE__) == realpath($_SERVER['DOCUMENT_ROOT'].$_SERVER['SCRIPT_NAME'])) {
echo "File can't be called separately, it is part of other script";
}else{
$dbhost 	= "localhost";
$dbuser 	= "root";
$dbpass 	= "";
$dbname 	= "newblog";
$charset 	= "utf8"

$dbcon = new mysqli($dbhost, $dbuser, $dbpass,$dbname);
if(mysqli_connect_errno())
{
	print_f("Connection Failed: %s\n",mysqli_connect_error());
}
mysqli_set_charset($dbcon,$charset);
}
