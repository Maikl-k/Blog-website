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


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/home.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home page</title>
</head>
<body>
<?php include 'externalphp/header.php' ?>

    <div class="main-s">
        <div class="header-in-m-s">

        
        <a href="profile.php" class="a-atr">profile</a>
        <a href="index.php" class="a-atr">main page</a>
        <a href="logout.php" class="a-atr">logout</a>
        </div>

		<p class="welcome-output">Welcome, <?=htmlspecialchars($_SESSION['username'], ENT_QUOTES)?>!</p>

        <div class="links-for-posts">
            <p><a href="createPost.php">create post</a></p>
            <p><a href="allUsersPosts.php">show my posts</a></p>
        </div>
        

    </div>
</body>
</html>