<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();

// if the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

?>

<?php

function showUsersPosts()
{

    include 'database/connectToDatabase.php';
    $getAllUsersPostsSql = 'SELECT postTitle, postContent,createdPostTime FROM Posts WHERE postCreatorID = ? ORDER BY createdPostTime DESC';
    $stmt = $conn->prepare($getAllUsersPostsSql);
    $stmt->bind_param('i', $_SESSION['userID']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="post-item"><h2 class="postTitle">' . $row['postTitle'] . '</h2><br><p class="postContent">' . $row['postContent'] . '</p><p class"createTime">' . '<p class"descr-ab-t">time of creating</p>' . $row['createdPostTime'] . '</p></div>';
        }


    } else {
        echo "<p class='output'>no your posts</p>";
    }

}


?>



<?php


?>





<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/allUsersPosts.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['username']; ?>`s posts</title>
</head>

<body>
    <?php include 'externalphp/header.php' ?>


    <div class="main-s">
        
        <h2>My posts</h2>
        <div class="posts-s">

            <?php showUsersPosts(); ?>

            <div class="delete-post-s">
                <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="POST" id="delete-post-form"
                    name="delete-post-form">
                    <input type="text" placeholder="type title of post to delete" name="title-post-to-delete-input-f"
                        id="title-post-to-delete-input-f">
                    <button type="submit" id="delete-btn" name="delete-btn">delete post now</button>
                </form>
                <p id="delete-errors"></p>
                <?php deletePost() ?>
            </div>
        </div>

        <p><a href="createPost.php">create post</a></p>
    </div>

    <script src="js/allUsersPosts.js"></script>
</body>

</html>




<?php


function deletePost()
{
    include 'database/connectToDatabase.php';

    

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $toDeletePostTitle = $_POST['title-post-to-delete-input-f'];

        $errors = false;
        if (empty($toDeletePostTitle)) {
            $errors = true;
            echo '<p class="error">add title to delete post!</p>';

        }

        if (strlen($toDeletePostTitle) > 50) {
            $errors = true;
            echo '<p class="error">max length is 50</p>';
        }

        if(!$errors){

            // check if post is exist
            $checkIfPostIsExistSql = 'SELECT postTitle FROM Posts WHERE postTitle = ? AND postCreatorID = ?';
            $stmt = $conn->prepare($checkIfPostIsExistSql);
            $stmt->bind_param('si', $toDeletePostTitle, $_SESSION['userID']);
            $stmt->execute();
            $stmt->store_result();

            if($stmt->num_rows > 0){

                $deletePostSql = 'DELETE FROM Posts WHERE postTitle = ? AND postCreatorID = ?';

                $stmt = $conn->prepare($deletePostSql);
                $stmt->bind_param('si', $toDeletePostTitle, $_SESSION['userID']);
                $stmt->execute();


                $stmt->close();
                $conn->close();

                header("Location: " . $_SERVER['PHP_SELF']);
                exit;


            }else{
                echo '<p class="errors"> post does not exist!!</p>';
                $stmt->free_result();
                $stmt->close();
            }


        }

    }

}



?>