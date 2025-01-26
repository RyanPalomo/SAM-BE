<?php
session_start();
session_destroy();
session_start();

include("connect.php");

$showModal = false;

if (isset($_POST['btnLogin'])) {
    $username = $_POST['username'];
    $logPass = $_POST['password'];

    // Fetch user data based on username (email or phone number)
    $logQuery = "SELECT * FROM users WHERE (email='$username' OR number='$username')";
    $result = executeQuery($logQuery);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassWord = $row['password'];

        // Verify password
        if (password_verify($logPass, $hashedPassWord)) {
            // Store user data in session variables
            $_SESSION['user_id'] = $row['id'];       // User ID
            $_SESSION['emailAddress'] = $row['email']; // User email
            $_SESSION['firstName'] = $row['fname'];   // First name
            $_SESSION['role'] = $row['role'];        // User role (admin or user)
            $_SESSION['logged'] = "logged";          // Login status

            // Redirect based on role
            if ($row['role'] === 'admin') {
                header("Location: admin/dashboard.php"); // Admin dashboard
            } else {
                header("Location: homepage.php");       // User homepage
            }
            exit();
        } else {
            // Invalid password
            $showModal = true;
        }
    } else {
        // No such user found
        $showModal = true;
    }
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
    <link rel="stylesheet" href="styles/login.css">
    <link rel="preload" href="OlympicSans.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="OlympicHeadline-Regular.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
    <link rel="icon" type="img/x-icon" href="img/icon.png">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-12 py-5 mt-5 mx-auto">
                <div class="logoContainer d-flex justify-content-center">
                    <img src="img/bigLogo.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="col-12 mt-4 d-flex justify-content-center">
            <div class="loginContainer shadow rounded-4 py-4">
                <h1 class="text-center pt-4" style="font-family: Olympic Sans;">Login</h1>

                <form method="post">
                <div class="input-group pt-3 my-3 username mx-auto">
                    <span class="input-group-text bg-white" ><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control py-2 " placeholder="Email or Number" name="username" style="font-family: Olympic Sans;">
                  </div>
                  
                  <div class="input-group mb-3 password mx-auto">
                    <span class="input-group-text bg-white"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" class="form-control py-2" placeholder="Password" name="password" style="font-family: Olympic Sans;">
                  </div>

                  <div class="mt-4 d-flex justify-content-center">
                    <button type="submit" value="login" class="btn btn-primary px-4 py-2" name="btnLogin" style="font-family: Olympic Sans;">Login</button>
                  </div>
                </form>
                <p class="p text-center mt-3" style="font-family: Olympic Sans; font-size: 12px;"> Don't have an account? <a href="register.php" class=""> Sign up</a></p>

            </div>
        </div>
    </div>


    <!-- error modal -->
    <?php if ($showModal): ?>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h1 class="modal-title fs-5 " id="staticBackdropLabel" style="color: Red;">Error</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center" style="color: Red;">
                Wrong Email or Password!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>