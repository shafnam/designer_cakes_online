<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to add-event page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 
// Include config file
require_once "includes/config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to all-events page
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}
?>
<!DOCTYPE html>
<html lang="en">

	<head>
      <?php include 'header.php'; ?>
	</head>

	<body>

    <!-- Page Content -->
    <div class="container inner-page award-s h-100">

		<div class="row h-100 justify-content-center align-items-center">
			
			<div class="col-md-6 pb-5">
			
				<h2 class="mt-5 mb-5 text-center"> Login </h2>
				
				<div class="card" style="margin-bottom: 100px;">
					<div class="card-body">		
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
							<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
								<label>Username</label>
								<input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
								<span class="help-block"><?php echo $username_err; ?></span>
							</div>    
							<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
								<label>Password</label>
								<input type="password" name="password" class="form-control">
								<span class="help-block"><?php echo $password_err; ?></span>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-primary" value="Login">
							</div>
							<!--<p>Don't have an account? <a href="register.php">Sign up now</a>.</p>-->
						</form>
					</div>
				</div>
			</div>
		</div>

    </div>


    <!-- Footer -->
    <?php include 'footer.php'; ?>

	</body>

</html>
