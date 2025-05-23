<head>
    <link rel="stylesheet" href="css/header.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<div class="header">
    <div class="logo">
    <a href="index.php"><img src="images/Elogo.png" alt="E logo"></a>
    <h2>Blog Everywhere</h2>
    </div>
   
    

    <div class="header-links">
        
        <a class="links" href="index.php"><h2>Home</h2></a>
        <a class="links" href="posts.php"><h2>Posts</h2></a>
        <a class="links" href="about.php"><h2>About</h2></a>

    </div>

    <div class="account-info">
    <?php
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



    if(isset($_SESSION['loggedin']))
    {
        echo '<a href="profile.php" class="a-atr1" ><h2>' .$_SESSION['username'] . '</h2></a>';
        echo'<a href="logout.php" class="a-atr1" ><h2>logout</h2></a>'; 
    }
    else
    {
        echo '<a href="signup.php" class="a-atr1" ><h2>Sign up</h2></a>';
        echo '<a href="login.php" class="a-atr1" ><h2>Login</h2></a>';

    }
    ?>
    </div>
</div>