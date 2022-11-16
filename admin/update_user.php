<?php
    session_start();
    require 'includes/dbh.inc.php';

    $id = null;
    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if (null === $id) {
        header('Location: admin_index.php');
    }

    if (!empty($_POST)) {
        $usernameError = null;
        $first_nameError = null;
        $last_nameError = null;
        $emailError = null;
        $mobileError = null;

        $username = $_POST['username'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $valid = true;

        if (empty($username)) {
            $usernameError = 'Please enter Username';
            $valid = false;
        }

        if (empty($first_name)) {
          $first_nameError = 'Please enter First Name';
          $valid = false;
        }

        if (empty($last_name)) {
          $last_nameError = 'Please enter Last Name';
          $valid = false;
        }

        if (empty($email)) {
            $emailError = 'Please enter Email Address';
            $valid = false;
        } else if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }

        if (empty($phone)) {
            $mobileError = 'Please enter Mobile Number';
            $valid = false;
        }

        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $q = $pdo->prepare('UPDATE flex_authors SET username = ?, first_name = ?, last_name = ?, email = ?, phone = ? WHERE author_id = ?');
            $q->execute(array($username, $first_name, $last_name, $email, $phone, $id));
            Database::disconnect();
            header('Location: admin_index.php');
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare('SELECT * FROM flex_authors where author_id = ?');
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $username = $data['username'];
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $email = $data['email'];
        $phone = $data['phone'];
        Database::disconnect();
    }

    require 'header.php';
?>

<div class="container">
    <div class="row">
        <h3>Update User Details</h3>
    </div>

    <div class="row">
        <form class="form-horizontal" action="update_user.php?id=<?php echo $id; ?>" method="post">
            <div class="form-group <?php echo !empty($usernameError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 control-label">Username</label>
                <div class="controls col-sm-6">
                    <input class="form-control" name="username" type="text" placeholder="Username" value="<?php echo !empty($username) ? $username : ''; ?>">
                    <?php if (!empty($usernameError)): ?>
                        <span class="help-inline"><?php echo $usernameError;?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group <?php echo !empty($first_nameError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 control-label">First Name</label>
                <div class="controls col-sm-6">
                    <input class="form-control" name="first_name" type="text" placeholder="First Name" value="<?php echo !empty($first_name) ? $first_name : ''; ?>">
                    <?php if (!empty($first_nameError)): ?>
                        <span class="help-inline"><?php echo $first_nameError;?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group <?php echo !empty($last_nameError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 control-label">Last Name</label>
                <div class="controls col-sm-6">
                    <input class="form-control" name="last_name" type="text" placeholder="Last Name" value="<?php echo !empty($last_name) ? $last_name : ''; ?>">
                    <?php if (!empty($last_nameError)): ?>
                        <span class="help-inline"><?php echo $last_nameError;?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group <?php echo !empty($emailError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 control-label">Email Address</label>
                <div class="controls col-sm-6">
                    <input class="form-control" name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email) ? $email : ''; ?>">
                    <?php if (!empty($emailError)): ?>
                        <span class="help-inline"><?php echo $emailError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="form-group <?php echo !empty($mobileError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 control-label">Mobile Number</label>
                <div class="controls col-sm-6">
                    <input class="form-control" name="phone" type="text" placeholder="Mobile Number" value="<?php echo !empty($phone) ? $phone : ''; ?>">
                    <?php if (!empty($mobileError)): ?>
                        <span class="help-inline"><?php echo $mobileError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Update</button>
                    <a class="btn btn-dark" href="authors.php">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require 'footer.php'; ?>
