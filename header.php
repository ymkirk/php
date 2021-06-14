<?php
if(isset ($_SESSION['memberID']))  {
$loginButton = <<<HERE
<form class="form-inline" action="index.php" method="post" >
<button class="btn btn-light" name="logout" type="submit">Log Out</button>
</form>
HERE;
} else  {
  $loginButton = <<<HERE
<form class="form-inline" action="login.php" method="post" >
<button class="btn btn-light" type="submit">Login</button>
</form>
HERE;
}

if (isset($_SESSION['firstname'])) {
  $welcome = <<<HERE
  <span style='color:lightblue;'>Hello $firstname
HERE;
} else {
  $welcome = <<<HERE
  <span style='color:lightblue;'>Hello Guest</span>
HERE;
}

echo <<<HERE
<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>$pageTitle</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	  <link rel="stylesheet" href="style.css">
  </head>

  <body>
  <main class="container-fluid">
    <header>
      <h1>$pageTitle</h1>
    </header>
    <nav class="navbar navbar-expand-sm bg-dark justify-content-center">
      $welcome
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home</a>
        </li> 
        <li class="nav-item active">
          <a class="nav-link" href="form.php">Order Form</a>
        </li> 
        <li class="nav-item active">
          <a class="nav-link" href="invoice.php">Invoice</a>
        </li>
        <li class="nav-item active">
        <a class="nav-link" href="form-validation.php">Form Validation</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="file-uploads.php">File handling & Uploads</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="calendar.php">Calendar</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="register.php">Register</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="profile.php">Profile</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="blog.php">Blog</a>
        </li>
      </ul>
        $loginButton
    </nav>
HERE;
?>