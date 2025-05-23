<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/login.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <?php include 'externalphp/header.php' ?>

    <div class="main-s">
        <div class="login-s">
            <h2>Login</h2>
            <form method="POST" name="loginForm" id="login-form"
                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                <label for="loginName">Login name</label>
                <input type="text" id="loginName" name="loginName">

                <label for="password">Password</label>
                    <input type="password" id="password" name="password">

                    <button type="submit" id="login-btn" name="login-btn">login now</button>
            </form>
            <p id="output-error-login-form-loginName"></p>
            <p id="output-error-login-form-password"></p>
        </div>

    </div>



    <script src="js/login.js"></script>
</body>

</html>


<?php
include 'database/connectToDatabase.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // grab data from form
    $loginName = $_POST['loginName'];
    $password = $_POST["password"];

    $errors = false;

    


    // validation
    if (empty($loginName) || empty($password)) {
        $errors = true;
        echo '<p class="errors-output">add data to all fields!</p>';
    }

    if (strlen($loginName) > 50 || strlen($password) > 50) {
        $errors = true;
        echo '<p class="errors-output">max length is 50</p>';
    }

    if (strlen($password) < 8) {
        $errors = true;
        echo '<p class="errors-output">minimum length of password is 8</p>';
    }


    if (!$errors) {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $statement = $conn->prepare('SELECT UserID ,userName, userEmail, loginName, userPassword FROM Users WHERE loginName = ? ');
        $statement->bind_param('s', $_POST['loginName']);
        $statement->execute();

        $statement->store_result();

        if ($statement->num_rows > 0) {
            
            $statement->bind_result($userID,$username, $email, $loginName, $Password);
            $statement->fetch();


            // Account exists, now we verify the password.
            // Note: remember to use password_hash in your registration file to store the hashed passwords.
            if (password_verify($password, $Password)) {

                // Verification success! User has logged-in!
                // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $loginName;
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $id;
                $_SESSION['userID'] = $userID;


                header('Location: home.php');
                 exit;
                //echo "<a href='home.php'><h3>home page</h3></a>";



            } else {
                echo '<p class="errors">Incorrect username and/or password!</p>';
            }



        }



        $statement->close();

    }
}


//todo add good database table for posts to DB2 and create posts create read delete logic!

?>