<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to index page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: index.php");
  exit;
}

// Include config file
//require_once "includes/config.php";
require_once "includes/class.crud.php";
 
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

    $login_details = new User();
    $stmt = $login_details->loginUser($username,$password);

    // print_r($stmt->rowCount() );
    // die();

    // Check if username exists, if yes then verify password
    if($stmt->rowCount() == 1){
      if($row = $stmt->fetch()){
        $id = $row["id"];
        $username = $row["username"];
        $display_name = $row["display_name"];
        $hashed_password = $row["password"];
        if(password_verify($password, $hashed_password)){
          // Password is correct, so start a new session
          session_start();
          // Store data in session variables
          $_SESSION["loggedin"] = true;
          $_SESSION["id"] = $id;
          $_SESSION["username"] = $username;  
          $_SESSION["display_name"] = $display_name;              
          // Redirect index page
          header("location: index.php");               
        } else {
          // Display an error message if password is not valid
          $password_err = "The password you entered was not valid.";
        }
      }
    } else {
      // Display an error message if username doesn't exist
      $username_err = "No account found with that username.";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include('header.php'); ?>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">

                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>

                  <!-- Login Form -->
                  <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                      <input type="email" name="username" class="form-control form-control-user" id="username" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                      <span class="help-block"><?php echo $username_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                      <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password">
                      <span class="help-block"><?php echo $password_err; ?></span>
                    </div>
                   
                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Login">
                  </form>
                  <!-- End Login Form -->
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <?php include('footer.php'); ?>

</body>

</html>
