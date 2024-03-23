<?php
/* Module Creation
** Author: Karari E.Karari
** Date: 04/03/2024
** Purpose: Training
*/

/* Module Description
** This module defines the conncetion object used to
** establish a connection to the DB. The key attributes
** of the DB are defined hence the server hosting it,  
** login creadetials to the DB (user name & password),
** and DB name. The conncetion is also tested.
*/
$servername = "localhost";
$username = "root";
$password = "";
$db = "school";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error()."</br>");
}
echo "Connection successfully created</br>";
?>