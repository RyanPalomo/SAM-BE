<?php
session_start();
include("connect.php");
include("content.php");

// Check if the user is logged in.
if (empty($_SESSION['logged']) || $_SESSION['logged'] != "logged") {
    header('Location: login.php');
    exit();
}

// Check if user ID is set in the session
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


$userId = $_SESSION['user_id'];

// Query the database to get the user's first name
$sql = "SELECT fname FROM users WHERE id = '$userId'";
$result = executeQuery($sql);

// Fetch user data if the query returns a result
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $firstName = $row['fname'];
} else {
    $firstName = "Guest"; // Fallback if the user is not found in the database
}

$eventContents = array();

$contentQuery = "SELECT * FROM event";
$contentResult = executeQuery($contentQuery);

while($contentRow = mysqli_fetch_assoc($contentResult)){
  $a = new Event ($contentRow['id'],$contentRow['image'],$contentRow['content']);

  array_push($eventContents, $a);
}

$trainingContents = array();

$trainingContnentQuery = "SELECT * FROM training";
$trainingContnentResult = executeQuery($trainingContnentQuery);

while($trainingRow = mysqli_fetch_assoc($trainingContnentResult)){
  $a2 = new Training ($trainingRow['id'],$trainingRow['image'],$trainingRow['content']);

  array_push($trainingContents, $a2);
}

?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Olympic Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/homepage.css">
    <link rel="preload" href="OlympicSans.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="OlympicHeadline-Regular.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
    <link rel="icon" type="img/x-icon" href="img/icon.png">

</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow fixed-top">
            <div class="container-fluid">

              <a class="navbar-brand" href="#">
                <img src="img/logo.png" alt="Logo">
              </a>
          
 
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
          

              <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav mx-auto text-center">
                  <li class="nav-item">
                    <a class="nav-link px-4" href="#home">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link px-4" href="#event">Events</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link px-4" href="#training">Training</a>
                  </li>
                </ul>

                <ul class="navbar-nav text-center">
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle profile" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="img/profile.png" alt="Profile" class="rounded-circle" width="30" height="30">
    </a>
    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="profileDropdown">
      <li><h6 class="dropdown-header">Hi, <?php echo $firstName; ?>!</h6></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="#">Profile</a></li>
      <li><a class="dropdown-item" href="#">Settings</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
    </ul>
  </li>
</ul>

              </div>
            </div>
          </nav>
          
          
    </header> 

 
      <div class="container section1 d-flex justify-content-center align-items-center border-bottom" id="home">
         <div class="row">
            <div class="col-lg-5 col-sm-12 col-xs-12 pt-5 mt-5 d-flex flex-column align-items-center">
               <div class="imgContainer pb-5">
                  <img class="img-fluid" src="img/bigLogo.png">
               </div>
               <h1 class="mb-0 display-3 text-center">Welcome <?php echo $firstName ?>!</h1>
               <p class="text-center" style="font-family: Olympic Sans;">Meet and Train with our Filipino Olympians</p>
            </div>
   
            <div class="col-lg-7 col-sm-12 col-xs-12 mt-5">
              <img class="d-none d-lg-block img-fluid" src="img/homepagePic.png" alt="">
            </div>
         </div>
      </div>
   </div>


    <div class="container border-bottom py-5 my-5" id="event">
      <div class="row">
        <h1 class="py-4">Featured Event</h1>
        
        <?php
          foreach ($eventContents as $eventContent) {
          echo $eventContent->generateCard();
          }
        ?>

      </div>
    </div>

   
   <div class="container py-5 my-5" id="training">
    <div class="row pt-5 d-flex justify-content-center">
      <h1 class="py-2">Training Sessions</h1>

      <?php
          foreach ($trainingContents as $trainingContent) {
          echo $trainingContent->generateTrainCard();
          }
        ?>

    </div>
   </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>