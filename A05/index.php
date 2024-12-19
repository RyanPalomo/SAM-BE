<?php
include("connect.php");
include("personalities.php");

$personalities = array();

$personalityQuery = "SELECT * FROM `islandsofpersonality`";
$personalityResult = executeQuery($personalityQuery);

while ($personalityRow = mysqli_fetch_assoc($personalityResult)) {
  $a = new Personality($personalityRow['islandOfPersonalityID'], $personalityRow['name'], $personalityRow['shortDescription'], $personalityRow['longDescription'], $personalityRow['color'], $personalityRow['image']);

  array_push($personalities, $a);
}

  ?>
<!DOCTYPE html>
<html>

<head>
  <title>Core Memories</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-family: "Lato", sans-serif;
    }

    body,
    html {
      height: 100%;
      color: #777;
    }

    /* First image (Logo. Full height) */
    .bgimg-1 {
      min-height: 100%;
    }

    /* Second image (Portfolio) */
    .bgimg-2 {
      min-height: 400px;
    }

    /* Third image (Contact) */
    .bgimg-3 {
      min-height: 400px;
    }

    .w3-wide {
      letter-spacing: 10px;
    }

    .w3-hover-opacity {
      cursor: pointer;
    }

    /* Turn off parallax scrolling for tablets and phones */
    @media only screen and (max-device-width: 1600px) {

      .bgimg-1,
      .bgimg-2,
      .bgimg-3 {
        min-height: 400px;
      }
    }
    @media (min-width: 601px) and (max-width: 900px) {
      .card{
        min-height: 500px;
      }
    }
  </style>
</head>

<body>

  <div class="container bgimg-1 d-flex align-items-center justify-content-center" id="home">
    <div class="text-center">
      <div class="custom-span p-3 mx-2 display-5" style="color: white; background-color: #655c9e">WELCOME TO MY CORE MEMORIES</div>
    </div>
  </div>

  <div class="container px-3" id="about">
    <h3 class="text-center mb-5">MY ISLANDS OF PERSONALITY</h3>

    <div class="row" id="personality">
    <?php
      foreach ($personalities as $personality) {
        echo $personality->generateCard();
      }
      ?>
      </div>

  </div>

  <!-- Modal for full size images on click-->
  <div id="modal01" class="w3-modal w3-black" onclick="this.style.display='none'">
    <span class="w3-button w3-large w3-black w3-display-topright" title="Close Modal Image"><i
        class="fa fa-remove"></i></span>
    <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
      <img id="img01" class="w3-image">
      <p id="caption" class="w3-opacity w3-large"></p>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</body>

</html>