<?php
  include('dbh.inc.php');

  $username = $email = $phone = $password = $confirm_password = "";
  $username_err = $email_err = $phone_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
      echo "
        <script>alert('Please enter Username.')</script>
        <script>window.location = '../register.php?'</script>";
        exit;
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
      echo "
        <script>alert('Username can only contain letters or _ and numerics.')</script>
        <script>window.location = '../register.php?'</script>";
        exit;
    } else{
        // Prepare a select statement
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT author_id FROM flex_authors WHERE username = :username';

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                  echo "
                    <script>alert('This username is already taken.')</script>
                    <script>window.location = '../register.php?'</script>";
                    exit;
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
              echo "
                <script>alert('Oops, Something went wrong, please try again later.')</script>
                <script>window.location = '../register.php?'</script>";
                exit;
            }

            // Close statement
            Database::disconnect();
        }
    }

    //email validation
    $email = trim($_POST['email']);
    if (empty($email)) {
      echo "
        <script>alert('Please enter your email address.')</script>
        <script>window.location = '../register.php?'</script>";
        exit;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
      echo "
        <script>alert('Please enter a valid email address.')</script>
        <script>window.location = '../register.php?'</script>";
        exit;
    }else {
      $email = trim($_POST['email']);
    }

    //validate phone number
    if (empty(trim($_POST['phone']))) {
      echo "
        <script>alert('Please enter your phone number.')</script>
        <script>window.location = '../register.php?'</script>";
        exit;
    } else {
        // Prepare a select statement
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT author_id FROM flex_authors WHERE phone = :phone';

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":phone", $param_phone, PDO::PARAM_STR);

            // Set parameters
            $param_phone = trim($_POST["phone"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                  echo "
                    <script>alert('Sorry, This phone number is already registered.')</script>
                    <script>window.location = '../register.php?'</script>";
                    exit;
                } else{
                    $phone = trim($_POST["phone"]);
                }
            } else{
              echo "
                <script>alert('Oops, Something went wrong, Please try again later.')</script>
                <script>window.location = '../register.php?'</script>";
                exit;
            }

            // Close statement
            Database::disconnect();
        }
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
      echo "
        <script>alert('Please fill the password field.')</script>
        <script>window.location = '../register.php?'</script>";
        exit;
    } elseif(strlen(trim($_POST["password"])) < 6){
      echo "
        <script>alert('Password must be at least 6 characters.')</script>
        <script>window.location = '../register.php?'</script>";
        exit;
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
      echo "
        <script>alert('Please confirm your password.')</script>
        <script>window.location = '../register.php?'</script>";
        exit;
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
          echo "
            <script>alert('Password didn't match, please try again.')</script>
            <script>window.location = '../register.php?'</script>";
            exit;
        }
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($email_err) && empty($phone_err) && empty($password_err) && empty($confirm_password_err)){

        $date_joined = date('Y/m/d H:i:s');
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare an insert statement

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO flex_authors (username, email, phone, password)
                                VALUES (?, ?, ?, ?)";

        if($stmt = $pdo->prepare($sql)){

            // Attempt to execute the prepared statement
            if($stmt->execute(array($username, $email, $phone, $password))){
              echo "
                <script>alert('Account created successfully.')</script>
                <script>window.location = '../login.php?'</script>";
              }
            } else{
              echo "
                <script>alert('Oops, Something went wrong, Please try again later.')</script>
                <script>window.location = '../register.php?'</script>";
            }

        }
    }


 ?>
