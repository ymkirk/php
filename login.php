<?php
include 'config.php';
if(!$conn)  {
   echo "Failed to connect to MySQL: ".mysqli_connect_error();
}

$pageTitle = "Login";
$pageContent = NULL;
$msg = NULL;
$invalidUser = NULL;
$invalidPass = NULL;

if (filter_has_var(INPUT_POST, 'login')) {
   // Get info
   $username = strip_tags(filter_input(INPUT_POST, 'username'));
   $password = password_hash($password, PASSWORD_DEFAULT);
	$passwordSubmit = trim(filter_input(INPUT_POST, 'password'));
	$valid = TRUE;

   if ($username == NULL) {
      //If a field is empty, set an error message for that field and load the form
      $invalidUser = '<span class="error">Required field</span>';
      $valid = FALSE;
   }

   if ($passwordSubmit == NULL) {
      //If a field is empty, set an error message for that field and load the form
      $invalidPass = '<span class="error">Required field</span>';
      $valid = FALSE;
   }

   if ($valid) {
      //as long as the data in the form is valid then do this
      $stmt = $conn->stmt_init(); // create the database connection

      if ($stmt->prepare("SELECT `memberID`, `password` FROM `membership` WHERE `username` = ?")) { // prepare the db query
         $stmt->bind_param("s", $username); // lookup this user
         $stmt->execute();
         $stmt->store_result();
         $stmt->bind_result($memberID, $password); // bind the stored password from the db record to a variable
         $stmt->fetch();
         $stmt->free_result();
         $stmt->close();

      }/*EO valid if*/  else {
         $msg = <<<HERE
         <h3 class="error">We could not find you in the system. New ysers must register before gaining access to the site. If you forgot your Login, please use the Password Recover tool.</h3>
HERE;
      }//EO error else
      if (password_verify($passwordSubmit, $password)) { // checks submitted password against stored password for a match

         $stmt = $conn->stmt_init();
         if ($stmt->prepare("SELECT `firstname`, `lastname`, `email` FROM `membership` WHERE `memberID` = ?")) {
            $stmt->bind_param("i", $memberID);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($firstname, $lastname, $email); // get authenticated member record
            
            if($stmt->num_rows == 1){

               $stmt->fetch();

               $_SESSION['memberID'] = $memberID;
                $_SESSION['firstname'] = $firstname;
               // $_SESSION['lastname'] = $lastname;
               // $_SESSION['username'] = $username
               // $_SESSION['email'] = $email;
               $_SESSION['loggedIn'] = TRUE;
               
               setcookie("firstname", $firstname, time()+(3600*3));
               // setcookie("lastname", $lastname, time()+(3600*3));
               $stmt->close();
               
               header("Location: profile.php?&msg=You are logged in.");
               exit;
         }/*EO if*/ else   {
            $msg = <<<HERE
            <h3 class="error">We could not access the login records.</h3>
HERE;
         }//EO record error else

      }/*EO stmt prep*/ else  {
         $msg = <<<HERE
         <h3 class="error">We could not find your information.</h3>
HERE;
         }
      }  else {
         $msg = <<<HERE
         <h3 class="error">We could not find you in the system. New users must register before gaining access to the site. If you forgot your login, please use the Password Recover tool.</h3>
HERE;
      }//EO else
   }// EO Valid if
}
$pageContent .=<<<HERE
<section class="container-fluid">
$msg
<form action="login.php" method="post">
   <div class="form-group">
      <label>Username</label>
      <input type="text" class="form-control" id="username" name="username" required />
      $invalidUser
   </div>
   <div class="form-group">
      <label>Password</label>
      <input type="password" class="form-control" id="password" name="password" required />
      $invalidPass
   </div>
   <input type="submit" name="login" value="Login" class="btn btn-secondary">
</form>
</section>
HERE;

//superglobals
// $pageContent .= "<pre>";
// $pageContent .= print_r($_POST, true);
// $pageContent .= "</pre>";

include "template.php";
?>