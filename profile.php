<?php
include 'config.php';
if(!$conn)  {
   echo "Failed to connect to MySQL: ".mysqli_connect_error();
}
if(isset($_SESSION['memberID'])) {
   $memberID = $_SESSION['memberID'];
// } elseif(isset($_GET['memberID'])) {
//    $memberID = $_GET['memberID'];
} else {
   header("Location: register.php");
   exit();
}
$pageTitle = "Profile";
$firstname = Null;
$lastname = Null;
$email = Null;
$username = Null;
$password = Null;
$password2 = Null;
$invalidFirst = Null;
$invalidLast = Null;
$invalidEmail = Null;
$invalidEformat = Null;
$invalidPass = Null;
$mismatchPass = Null;
$invalidPhoto = Null;
$fileInfo = Null;
$imageName = Null;
$valid = TRUE;
$loggedIn = FALSE;
$update = FALSE;
$pageContent = Null;

// ini_set('display_errors', 1);

if(isset($_GET['msg'])) {
   $msg = "<p class='error'>Record " . $_GET['msg'] . "</p>";
} else {
   $msg = NULL;
}
if(isset($_GET['action'])) {
   $msg = "<p class='error'>Record " . $_GET['action'] . "</p>";
} else {
   $msg = NULL;
}

if(isset($_GET['update'])) {
   $update = TRUE;
}

if (isset($_POST['update'])) {
   $firstname = mysqli_real_escape_string($conn, ucwords(trim($_POST['firstname'])));
   
   if (empty($firstname))  {
      $invalidFirst = '<span class="error">Required</span>';
      $valid = FALSE;
   }
   $lastname = mysqli_real_escape_string($conn, ucwords(trim($_POST['lastname'])));
   if (empty($lastname))  {
      $invalidLast = '<span class="error">Required</span>';
      $valid = FALSE;
   }

   $email = htmlspecialchars($_POST['email']);
   if (empty($email))   {
      // check for missing email
      $invalidEmail = '<span class= "error">You must enter a valid Email</span>';
      $valid = FALSE;
   }

   if (!preg_match('/[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}/', $email)) {
      // returns 1 (true) for match, 0 (false) for no match
      $invalidEformat = "<span class='error'>Invalid email format</span>";
      $valid = FALSE;
   }
   
   if($valid)  {
      $query = "UPDATE `membership` SET `firstname` = '$firstname', `lastname`= '$lastname', `email` = '$email' WHERE `memberID`=  $memberID;";
      $result = mysqli_query($conn, $query);
      if (!$result)  {
         die(mysqli_error($conn));
      }
   }

   $password = trim($_POST['password']);
   if ( !empty($password))   {
      $password2 = trim($_POST['password2']);
      if (strcmp($password, $password2))  {
         $mismatchPass = "<span class='error'> Passwords do not match</span>";
         $valid = FALSE;
      }else {
         $password = password_hash($password, PASSWORD_DEFAULT);
         $query = "UPDATE `membership` SET `password` = '$password' WHERE `memberID`=  $memberID;";
         $result = mysqli_query($conn, $query);
         if (!$result)  {
            die(mysqli_error($conn));
         }  else {
            $row_count = mysqli_affected_rows($conn);
            if($row_count == 1)  {
               echo "<p class='text-success'>Record Updated</p>";
            }else {
               echo "<p class='error'>Password update Failed</p>";
            }
         }
      }
   } //EO password 

   if (!empty($_FILES['ProfilePic']['name'])) {
      unlink("uploads/" . $_POST['imageName']);
      $filetype = pathinfo($_FILES['profilePic']['name'], PATHINFO_EXTENSION);
      if((($filetype == "gif") or ($filetype == "jpg") or ($filetype == "png")) and $_FILES['profilePic']['size'] < 300000) {
         if ($_FILES["profilePic"]["error"] > 0)  {
            $valid = FALSE;
            $fileError = $_FILES['profilePic']['error'];
            $invalidPhoto= '<p class= "error"> Return Code: $fileError<br>';
               switch ($fileError)  {
                  case 1:
                     $invalidPhoto .= 'The file exceeds upload max size in php.ini.</p>';
                     break;
                  case 2:
                     $invalidPhoto .= 'The file exceeds upload max size in HTML form</p>';
                     break;
                  case 3:
                     $invalidPhoto .= 'The file was partially uploaded</p>';
                     break;
                  case 4:
                     $invalidPhoto .= 'File was NOT uploaded</p>';
                     break;
                  case 5:
                     $invalidPhoto .= 'Temporary folder does not exist</p>';
                     break;
                  default:
                     $invalidPhoto .= 'Something Unexpected happened.</p>';
                     break;
               }//EO Switch
            } else {
               $imageName = $_FILES["profilePic"]["name"];
               $file = "uploads/$imageName";
               $fileInfo = "<p>Upload: $imageName<br>";
               $fileInfo .= "Type: " . $_FILES["profilePic"]["type"] . "<br>";
               $fileInfo .= "Size: " . ($_FILES["profilePic"]["size"] / 1024) . " KB<br>";
               $fileInfo .= "Temp File: " . $_FILES["profilePic"]["tmp_name"] . "</p>";
               
               if (file_exists("$file"))  {
                  $invalidPhoto = "<span class ='error'>$imageName already exists.</span>";
                  $valid = FALSE; 
               }else {
                  if (move_uploaded_file($_FILES["profilePic"]['tmp_name'], "$file")) {
                     $fileInfo .= "<p class='text-success'>Your file has been uploaded. Stored as: $file</p>";

                     $query = "UPDATE `membership` SET `image` = '$imageName' WHERE `memberID` = $memberID;";
                     $result = mysqli_query($conn, $query);
                     if (!$result)  {
                        die(mysqli_error($conn));
                     }else {
                        $row_count = mysqli_affected_rows($conn);
                        if($row_count == 1)  {
                           $msg = "<p class='text-success'>Record Updated</p>";
                        }else {
                           $msg = '<p class="error">Image Update Failed</p>';
                        }//EO row msg else
                     }//EO row else
                  }/*EO move IF*/ else {
                  $invalidPhoto .='<p><span class="error">Your File could not be uploaded. ';
               }//EO invalid photo else
            }//EO File exist else
         }//EO img if
      }/*EO file ext if*/ else {
            $invalidPhoto = '<span class= "error">Invalid File. This is not an image.</span>';
            $valid = FALSE;
         }//EO invalid file else
   }//EO valid if
}//EO if Submit

   $query = "SELECT * FROM `membership` WHERE `memberID` = $memberID;";
   $result = mysqli_query($conn, $query);
   if (!$result)  {
      die($query); //mysqli_error($conn));
   }//EO if !result
   if ($row = mysqli_fetch_assoc($result))   {
      $firstname = $row['firstname'];
      $lastname = $row['lastname'];
      $username = $row['username'];
      $email = $row['email'];
      $image = $row['image'];
   }/*EO if results*/ else {
      $msg = "<p>Sorry, We couldn't find your record.</p>";
   }//EO else query
if(!$update)  {
$pageContent .= <<<HERE
<section class="container-fluid">
$msg
<figure><img src="uploads/$image" alt="Profile Image" class ="profilePic" />
   <figcaption>Member: $firstname $lastname</figcaption>
</figure>
<h1>Thank You, $firstname $lastname.</h1>
<p><a href="profile.php?update">Update Profile</a></p>
<p>Email: $email</p>
<p>You are now logged into the system. We hope you enjoy the site.</p>
<p>Your information has been saved. Please use the username below for future login.</p>
<p>Username: <strong>$username</strong></p>
<p><a href="register.php">Reload Page</a></p>
</section>\n
HERE;

}/*EO if not updated*/else {
$pageContent .= <<<HERE
<section class="container-fluid">
   $msg
   <p>Please update your information.</p>
   <form action="profile.php" enctype="multipart/form-data" method = "post">
      <div class="form-group">
         <label for="firstname">First Name</label>
         <input type="text" name="firstname" id="firstname" value="$firstname" placeholder="First Name" class = "form-control">$invalidFirst
      </div>
      <div class="form-group">
         <label for="lastname">Last Name</label>
         <input type="text" name="lastname" id="lastname" value="$lastname" placeholder="Last Name" class = "form-control">$invalidLast
      </div>
      <div class="form-group">
         <label for="email">Email</label>
         <input type="text" name="email" id="email" value="$email" placeholder="email" class = "form-control">$invalidEformat
      </div>
      <div>
      <label><span class="error">*</span> Password:</label>
      <input type="password" id="regPassword1" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
      title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" 
      placeholder="Password" onkeyup="strongPW()"/>
      <span class="error">$invalidPass</span>
      
      <label class="registrationLabel"><span class="error">*</span> Re-type Password: </label>
      <input type="password" id="regPassword2" name="password2" placeholder="Confirm Password" onkeyup="checkPW()" />
      <span id="match"></span>
      
      <p>Password must contain these characters:</p>
      <p id="capital" class="invalid">An <b>uppercase</b> letter</p>
      <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
      <p id="number" class="invalid">A <b>number</b></p>
      <p id="length" class="invalid">Minimum <b>8 characters</b></p>control">$mismatchPass
      </div>
      <figure><img src="uploads/$image" alt="Profile Image" class="ProfilePic" />
         <figcaption>Member: $firstname $lastname</figcaption>
      </figure>
      <p> Please select an image for your profile.</p>
      <div class="form-group">
         <input type="hidden" name="MAX_FILE_SIZE" value="300000">
         <label for="profilePic">File to Uploads</label> $invalidPhoto
         <input type="file" name="profilePic" id="profilePic" class="form">
      </div>
      <div class="form-group">
         <input type="hidden" name="imageName" value="$image" class="btn btn-info">
         <input type="submit" name="update" value="Update Profile" class="btn btn-info">
      </div>
   </form>
   <form action="delete-verify.php" method="post">
      <div class="form-group">
         <input type="submit" name="deleteProfile" value="Delete Profile" class="btn btn-danger">
      </div>
   </form>
</section>\n
HERE;
}//EO else form
//superglobals
// $pageContent .= "<pre>";
// $pageContent .= print_r($_SESSION);
// $pageContent .= "</pre>";

include 'template.php';
?>