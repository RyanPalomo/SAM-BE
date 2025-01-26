<?php
    session_start();
    include("connect.php");


    //set modal to false
    $showModal = false;


    if(empty($_SESSION['emailAddress']))
	{
		$_SESSION['emailAddress']="";
	}
	
	if(empty($_SESSION['logged']))
	{
		$_SESSION['logged']="";
	}
	
	if($_SESSION['logged'] != "logged")
	{
		$_SESSION['logged']="";
	}
	else
	{
		header('Location: login.php'); 

	}

	$_SESSION['varerror'] = " ";

    if(isset($_POST['createBtn'])) {

		$fName = $_POST['firstName'];
		$lName = $_POST['lastName'];
        $email = $_POST['email'];
		$number = $_POST['phoneNumber'];
		$password = $_POST['password'];
       
		$checkQuery = "SELECT * FROM users WHERE email='".$email."'";
		$checkResult = mysqli_query($conn, $checkQuery);
		$checkCount = mysqli_num_rows($checkResult);
		

		if($checkCount > 0)
		{
            $showModal = true;
		}
		else {
            header('location: register.php');
           
            //hashing of password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);


            //inserting data to db
			$saveSql = "INSERT INTO users(`fname`,`lname`,`email`,`number`,`password`) VALUES('$fName','$lName','$email','$number','$hashedPassword')";
			$saveQuery = mysqli_query($conn,$saveSql);
            header('Location: login.php?created=1?');
        }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Olympic Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="styles/register.css" />
    <link rel="preload" href="OlympicSans.woff2" as="font" type="font/woff2" crossorigin />
    <link rel="preload" href="OlympicHeadline-Regular.woff2" as="font" type="font/woff2" crossorigin />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="icon" type="img/x-icon" href="img/icon.png" />
</head>

<body>
    <div class="section d-flex align-items-center">
        <div class="container shadow rounded-4">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-xs-12 py-5 my-5">
                    <h1 class="text-center" style="font-family: Olympic Sans;">Sign Up</h1>
    
                    <form method="POST" class="d-flex flex-column align-items-center"> 
                        <div class="mb-3"> 
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="number" name="phoneNumber" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required> 
                        </div>
    
                        <div class="buttonContainer d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-primary" name="createBtn" style="font-family: Olympic Sans;">Create Account</button>
                        </div>
                    </form>
                </div>
    
                <div class="col-lg-6 col-sm-12 col-xs-12 pt-5 mt-5">
                    <div class="imgContainer d-flex justify-content-center mt-5 pt-5">
                        <img class="img-fluid d-none d-lg-block" src="img/registerLogo.png" alt="">
                    </div>
                    <h1 class="text-center d-none d-lg-block" style="font-family: Olympic Sans;">Kumusta, Kabayan!</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- error modal -->
    <?php if ($showModal): ?>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h1 class="modal-title fs-5 " id="staticBackdropLabel">Email Already Taken!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center" style="color: Red;">
                Your email is already taken!
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