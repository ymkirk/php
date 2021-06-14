<?php
$pageTitle = "File Handling and Uploads";
include "header.php";

$firstName = NULL;
$lastName = NULL;
$email = NULL;
$password = NULL;
$pageContent = NULL;
$filetype = NULL;
$username = NULL;
$photo = NULL;
$data_entry = NULL;
$filename = "membership.txt";


$filetype = pathinfo($_FILES['photo']['name'],pathinfo_extension);
if ((($filetype == "gif") or ($filetype == "jpg") or ($filetype == "png")) and $_FILES['profilePic']['size'] < 100000)

$data_entry = $firstname . "," . $lastname . "," . $email . "," . $username . "\n";

// open the txt file ($filename) to append (a) and assign it to a file handle ($fp)
$fp = fopen($filename, "a") or die ("Couldn't open file, sorry.");
// write (fwrite) the data ($data_entry) to the file using the file handle ($fp)
if (fwrite($fp, $data_entry) > 0) { // successful write operation returns 1, failure returns 0
	// do this on success
	$logged_in = TRUE; // sets a login trigger for the program to switch from form display to content display
} else {
	// do this on failure
	echo "Your information was not saved. Please try again at another time.";
}
$fp = fclose($fp); // close the file

//form submission
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // echo 'checked = "Checked"';

// }// end main submission if
echo <<<EOD
<legend>New Memeber Registration</legend>
<selection class="form-group">
   <form action="file-upload-handle.php" enctype="multipart/form-data" method="post">
      <div class="form-group">
         <label for="first">First Name</label>
         <input type="text" name="first" id="firstname" value="$firstName" class="form-control">
      </div>
      <div class="form-group">
         <label for="last">Last Name</label>
         <input type="text" name="last" id="lastname" value="$lastName" class="form-control">
      </div>
      <div class="form-group">
         <label for="email">What's your Email?</label>
         <input type="text" name="email" id="email" value="$email"  class="form-control">
      </div>
      <div class="form-group">
         <label for="password">Create a Password</label>
         <input type="text" name="password" id="password" value="$password" class="form-control">
      </div>
      <div class="form-group">
         <input type="hidden" name="MAX_FILE_SIZE" value="100000">
         <label for="photo">Upload a photo</label>
         <input type="file" name="photo" id="photo" class="form-control">
         </div>
      <div class="form-group">
      <input type="submit" name="submit" value="Submit"class="btn btn-dark">
      </div>
   </form>
</section>\n
EOD;
include "footer.php";
?>