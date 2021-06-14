<?php
session_start();
/* Contents of config.php */
$conn = mysqli_connect("localhost","KevinKline","WGXa5yg5","KevinKline");
// where $conn is the name you assign to the connection,
// user is the authorized user name (your avatar name),
// password is the password for the user (your server password), and
// database is the default database (your avatar name).
// Set up debug mode
function debug_data() { // called in template to print arrays at top of any page.
   echo '<div id="debug" class="w3-container">';
   echo '<pre class="w3-container w3-third">SESSION is ';
   echo print_r($_SESSION);
   echo "</pre>";
   echo '<pre class="w3-container w3-third">POST is ';
   echo print_r($_POST);
   echo "</pre>";
   echo '<pre class="w3-container w3-third">GET is ';
   echo print_r($_GET);
   echo "</pre>";
   echo "</div>";
  }
  
 //debug_data(); // Comment this out to hide debug information
?>