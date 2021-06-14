<?php
include "config.php";
if(!$conn)  {
   echo "Failed to connect to MySQL: ".mysqli_connect_error();
}
if(isset($_SESSION['memberID'])) {
   $memberID = $_SESSION['memberID'];
} else {
   header("Location: register.php");
   exit();
}

$pageTitle = "Delete Verify";
$firstName = Null;
$lastName = Null;
$email = Null;
$userName = Null;
$image = NULL;
$pageContent = NULL;
$msg = NULL;

if (isset($_POST['delete-profile']))   {
   $query = "DELETE FROM `membership` WHERE `memberID` = $memberID LIMIT 1;";
   $result = mysqli_query($conn, $query);
   if (!$result)  {
      $msg = "<p>Delete Failed</p>";
   }else {
      $row_count = mysqli_affected_rows($conn);
      if($row_count == 1)  {
         unlink("uploads/".$_POST['image']);
         header("Location: index.php?action=delete&logout");
         exit();
      }else {
         $msg = "<p>Insert Failed</p>";
      }
   }
}

   $query = "SELECT * FROM `membership` WHERE `memberID` = $memberID;";
   $result = mysqli_query($conn, $query);
   if (!$result)  {
      die(mysqli_error($conn));
   }
   if ($row = mysqli_fetch_assoc($result))   {
      $firstName = $row['firstname'];
      $lastName = $row['lastname'];
      $userName = $row['username'];
      $email = $row['email'];
      $image = $row['image'];
   }else {
      $msg = "Sorry, we couldn't find your record.";
   }
$pageContent .= <<<HERE
<section class="container-fluid">
$msg
<figure><img src="uploads/$image" alt= "Profile image" class="profilePic" />
   <figcaption>Member: $firstName $lastName</figcaption>
</figure>
<h1>Delete User Account</h1>
<p class='bg-warning'>Are you sure you want to delete this member account? This cannot be undone.</p>
<p>Email: $email</p>
<p>Username: <strong>$userName</strong></p>
<form action ="profile.php" method="post">
   <div class="form-group">
      <input type="submit" name="profile" value="cancel" class="btn btn-success">
   </div>
</form>
<form action="delete-verify.php" method="post">
<div class="form-group">
   <input type="submit" name="delete-profile" value="Verify Delete" class="btn btn-danger">
</div>
</form>
</section>\n
HERE;

// $pageContent .= "<pre>";
// $pageContent .= print_r($_POST, true);
// $pageContent .= "</pre>";

include 'template.php';
?>