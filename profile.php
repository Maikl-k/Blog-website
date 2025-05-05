<?php

// We need to use sessions, so you should always start sessions using the below code.
session_start();

// if the user is not logged in redirect to the login page...
if(!isset($_SESSION['loggedin']))
{
    header('Location: login.php');
    exit;
}

?>


<?php


    include 'database/connectToDatabase.php';

    $showAccountInfSql = $conn->prepare('SELECT userName, userEmail, loginName FROM Users WHERE UserID = ?');
    $showAccountInfSql->bind_param('i', $_SESSION['userID']);
    $showAccountInfSql->execute();
    $showAccountInfSql->bind_result($username, $userEmail, $userLoginName);
    $showAccountInfSql->fetch();
    $showAccountInfSql->close();

    





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/profile.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION["username"] ;?>`s profile</title>
</head>
<body>
<?php include 'externalphp/header.php' ?>

<div class="main-s">
    <div class="inf-s">
            <h2>Your account details</h2>
            <h3>Username:</h3>
            <?php  echo '<p class="info">'.$username.'</p>'; ?>
            <h3>Email</h3>
            <?php echo '<p class"info">' .$userEmail .'</p>'; ?>
            <h3>login name</h3>
            <?php echo '<p class"info">' .$userLoginName .'</p>'; ?>
            
    </div>
    <br>
    <p><a href="createPost.php">create post</a></p>
    <p><a href="allUsersPosts.php">show my posts</a></p>
</div>

</body>
</html>