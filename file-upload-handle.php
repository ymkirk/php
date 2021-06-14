<?php
$firstError = NULL;
$lastError = NULL;
$invalidEmail = NULL;
$invalidPass = NULL;

//flag
$valid = false;

if (isset($_POST['submit'])) {
   $valid = true;
	$firstName =htmlspecialchars( $_POST['first']);
   if (empty($firstName)) {
		$firstError = "<span class='error'>You must enter your name</span>";
		$valid = false;
	}
	$lastName = htmlspecialchars($_POST['last']);
   if (empty($lastName)) {
		$lastError = "<span class='error'>You must enter your last name</span>";
		$valid = false;
	}
   if (empty($_POST['email'])){
      // check for missing email
      $invalidEmail = '<span class="text-danger">You must enter a valid Email</span>';
      $valid = false;
   } else {
      $email = trim($_POST['email']);
      // validate email using a regular expression
      if (!preg_match('/[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}/', $email)) {
         // returns 1 (true) for match, 0 (false) for no match
         $invalidEmail = "<p class='error'>Invalid email address</p>";
         $valid = false;
      }
   }
	$password = htmlspecialchars($_POST['password']);
   if (empty($password)) {
		$invalidPass = "<span class='error'>You must enter a password</span>";
		$valid = false;
	}
   if ($_FILES["photo"]["error"] > 0) {
		echo "Return Code: " . $_FILES["photo"]["error"] . "<br>";
	} else {
		// display information about the file 
		echo "Upload: " . $_FILES["photo"]["name"] . "<br>";
		echo "Type: " . $_FILES["photo"]["type"] . "<br>";
		echo "Size: " . ($_FILES["photo"]["size"] / 1024) . " Kb<br>";
		echo "Temp file: " . $_FILES["photo"]["tmp_name"] . "<br>";
		
		// if the file already exists in the upload directory, give an error
		if (file_exists("upload/" . $_FILES["photo"]["name"])) {
			echo $_FILES["photo"]["name"] . " already exists. ";
		} else {
			// move the file to a permanent location
			move_uploaded_file($_FILES["photo"]["tmp_name"],"upload/" . $_FILES["photo"]["name"]);
			echo "Stored in: " . "upload/" . $_FILES["photo"]["name"];
		}
	}


	// display them on the page content below 3 indent
   // echo "<p>You entered the following values:</p>";
   // echo "<p>Artist: $artist</p>";
   // echo "<p>Album: $album</p>";
   // echo "<p>Release date: $rdate</p>";
   // echo "<p>Type: $type</p>";
}
// if ($valid) {
   $pageContent = <<<HERE
         <p>random</p>;
   HERE;
// }
// }else {
echo <<<EOD
$firstError <br>
$lastError <br>
$invalidEmail <br>
$invalidPass <br>
"Invalid File"<br>
EOD;
//}//end of else
include "footer.php";
?>