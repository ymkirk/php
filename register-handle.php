<?php
$msg = NULL;
$firstName = NULL;
$lastName = NULL;
$image = NULL;
$email = NULL;
$userName = NULL;
$pageContent= NULL;

$pageContent .= <<<HERE
<section class="container-fluid">
$msg
<p>Thank you, $firstName  $lastName.</p>
<figure>
   <img src="uploads/$image" alt= "Profile Image" class = profilePic" />
   <figcaption>Member: $firstName $lastName</figcaption>
</figure>
<p>Email: $email</p>
<p>You are now logged into the system. We hope you enjoy the site.</p>
<p>Your information has been saved. Please use the username below for future login.</p>
<p>Username: <strong>$userName</strong></p>
<p><a href="register.php">Reload Page</a></p>
</section>\n
HERE;
$pageTitle= "Register";
include 'template.php';
?>