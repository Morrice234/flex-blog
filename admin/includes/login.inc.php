<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  if ($_SESSION["type"] === "admin") {
    header("location: ../admin_index.php");
  }else {
    header("location: ../index.php");
    exit;
  }

}else {

// Include config file
require_once "dbh.inc.php";

// Define variables and initialize with empty values
$username = $password = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
      echo "
        <script>alert('Please enter your username.')</script>
        <script>window.location = '../login.php?'</script>";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
      echo "
        <script>alert('Please fill in the password field.')</script>
        <script>window.location = '../login.php?'</script>";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(!empty($username) && !empty($password)){
        // Prepare a select statement
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT author_id, type, email, phone, username, password FROM flex_authors WHERE username = :username";

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
                        $id = $row["author_id"];
                        $username = $row["username"];
                        $email = $row["email"];
                        $phone = $row["phone"];
                        $hashed_password = $row["password"];
                        $user_type = $row['type'];
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["email"] = $email;
                            $_SESSION["phone"] = $phone;
                            $_SESSION["type"] = $user_type;

                            // Redirect user to welcome page
                            if ($_SESSION["type"] === "admin") {
                              //echo $_SESSION["type"];
                              header("location: ../admin_index.php");
                              exit;
                            }else {
                              //echo $_SESSION["type"];
                              header("location: ../index.php");
                              exit;
                            }

                        } else{
                            // Password is not valid, display a generic error message
                            echo "
                              <script>alert('Invalid password or username, Please check and try again.')</script>
                              <script>window.location = '../login.php?'</script>";
                              exit();
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    echo "
                      <script>alert('Username does not exist.')</script>
                      <script>window.location = '../login.php?'</script>";
                      exit();
                }
            } else{
              echo "
                <script>alert('OOps, Something went wrong, Please try again.')</script>
                <script>window.location = '../login.php?'</script>";
                exit();
            }

            // Close statement
            unset($stmt);
        }
    }

    // Close connection
    Database::disconnect();
}
}
?>
