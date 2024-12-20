<?php
// Include your database connection
include('connect.php');
include('personalities.php');

$islandContents = array();

// Get the `id` from the URL and fetch the personality
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM islandsofpersonality WHERE islandOfPersonalityID = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $personality = mysqli_fetch_assoc($result);
    } else {
        echo "Personality not found.";
        exit;
    }

    // Fetch contents of the `islandcontents` table
    $contentQuery = "SELECT * FROM islandcontents WHERE islandOfPersonalityID = $id";
    $contentResult = mysqli_query($conn, $contentQuery);

    while ($contentRow = mysqli_fetch_assoc($contentResult)) {
        $a = new IslandContent($contentRow['islandContentID'], $contentRow['islandOfPersonalityID'], $contentRow['image'], $contentRow['content'], $contentRow['color']);

        array_push($islandContents, $a);
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($personality['name']); ?> Island</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="personality-details container">
        <h1 class="text-center py-5" style="color: <?php echo htmlspecialchars($personality['color']); ?>;">
            <?php echo htmlspecialchars($personality['name']); ?>
        </h1>
        <div class="container d-flex justify-content-center">
            <div class="row">
                <div class="col-12">
                    <img src="<?php echo htmlspecialchars($personality['image']); ?>"
                        alt="<?php echo htmlspecialchars($personality['name']); ?>"
                        class="img-fluid rounded shadow mb-5">
                </div>
            </div>
        </div>
        <div class="container text-center border-bottom">
            <div class="row">
                <div class="col-12">
                    <p class="mx-auto"
                        style="color: <?php echo htmlspecialchars($personality['color']); ?>; width:80%;">
                        <?php echo nl2br(htmlspecialchars($personality['longDescription'])); ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Island Contents Section -->
        <div class="container mt-5">
            <h2 class="text-center py-3" style="color: <?php echo htmlspecialchars($personality['color']); ?>;">Island Contents</h2>
            <?php if (!empty($islandContents)): ?>
                <div class="row" id="islandcontent">
                    <?php
                    foreach ($islandContents as $islandcontent) {
                        echo $islandcontent->generateContent();
                    }
                    ?>
                </div>
            <?php else: ?>
                <p class="text-center">No contents available for this island.</p>
            <?php endif; ?>
        </div>



        <div class="container text-center my-4">
            <a href="index.php" class="btn btn-primary">Back to Personalities</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>