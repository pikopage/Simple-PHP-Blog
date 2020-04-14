<?php
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
