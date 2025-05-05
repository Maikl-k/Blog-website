<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/signup.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>
<body>
    <?php include 'externalphp/header.php' ?>

    <div class="main-s">
        <div class="signup">
            <h3>Sign up</h3>
            <form method="POST" name="signupForm" id="sign-up-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                
            <label for="username">Username</label>
            <input type="text" id="username" name="username" >

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" >

            <label for="loginName">Login name</label>
            <input type="text" id="loginName" name="loginName" >

            <label for="password">Password</label>
            <input type="password" id="password" name="password" >

            <label for="conf-password">confirm password</label>
            <input type="password" id="conf-password" name="conf-password" >
            <button type="submit" id="signUp-btn" name="sbmt-btn" >sign up now</button>

            </form>
            <p id="output-errors-signup-form-username"></p>
            <p id="output-errors-signup-form-email"></p>
            <p id="output-errors-signup-form-loginName"></p>
            <p id="output-errors-signup-form-password"></p>
            <p id="output-errors-signup-form-conf-password"></p>
        </div>
    </div>


    <script src="js/signup.js"></script>
</body>
</html>

<?php

//
// 
//





include 'database/connectToDatabase.php';
// get data
$username = $_POST["username"];
$email = $_POST["email"];
$loginName = $_POST['loginName'];
$password = $_POST["password"];
$confPassword = $_POST["conf-password"];


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $errors = false;

    if(trim($username) == ""|| trim($email) == ""|| trim($loginName) == "" || trim($password) == "")
    {
        $errors = true;
        echo '<p class="errors-output">add data to all fields!</p>';
    }

    if($password != $confPassword)
    {
        $errors = true;
        echo '<p class="errors-output">passwords must be the same</p>';
    }

    if(strlen($username) > 50 || strlen($eamil) > 50 || strlen($loginName) > 50)
    {
        $errors = true;
        echo '<p class="errors-output">max legth is 50</p>';
    }

    if(strlen($password) < 8 )
    {
        $errors = true;
        echo '<p class="minumum length of password is 8</p>';
    }


    if(!$errors)
    {
        
        
        //
        try 
        {
            // search if user already exits
            $searchIfUserIsExistSql = "SELECT loginName FROM Users WHERE loginName=?";
            $statement = $conn->prepare($searchIfUserIsExistSql);
            $statement->bind_param("s", $loginName);
            $statement->execute();
            $statement->store_result();

            if($statement->num_rows == 0)
            {
                // User not exist

                // hash password to store pasword in database more securely
                $password = password_hash($password, PASSWORD_DEFAULT);

                // registration logic for user
                $registationOfUserSql = "INSERT INTO Users (userName, userEmail,loginName, userPassword) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($registationOfUserSql);
                $stmt->bind_param("ssss", $username, $email, $loginName, $password);
                $stmt->execute();

                echo "<a href='login.php'><h3>you can login now</h3></a>";
                $stmt->close();
                $conn->close();

            }
            else
            {
                // email does exist - tell user
                echo '<p class="errors"> User does exist!!</p>';
                $statement->free_result();
                $statement->close();
            }





        } 
        catch (mysqli_sql_exception $e) 
        {
            exit($e->getMessage());
        }
    }

}




?>