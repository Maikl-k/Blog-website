<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();

// if the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/createPost.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['username']; ?>`s creating post</title>
</head>

<body>
    <?php include 'externalphp/header.php' ?>


    <div class="main-s">

        <div class="create-post-s">
            <h3 class="create-post-s-title">Creating <?php echo $_SESSION['username']; ?>`s post</h3>
            <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="POST" id="createPostsForm">

                <label for="postTitle">Post title</label>
                <input type="text" id="postTitle" name="postTitle">
               
                <label for="postContent">post content</label>
                <textarea name="postContent" id="postContent" rows="10" cols="70"
                    placeholder="enter text..."></textarea>
               
                <button type="submit" id="create-post-btn" name="create-post-btn">create post now</button>

            </form>
            <p id="error-title"></p>
            <p id="error-content"></p>
        </div>
    </div>


    <script src="js/createPost.js"></script>
</body>

</html>

<?php

include 'database/connectToDatabase.php';





if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //grab data
    $postTitle = $_POST['postTitle'];
    $postContent = $_POST['postContent'];

    $errors = false;

    if (empty($postTitle) || empty($postContent)) {
        $errors = true;
        echo '<p class="errors-output">add data to all fields!</p>';
    }

    if (strlen($postTitle) > 50) {
        $errors = true;
        echo '<p class="errors-output">max length for title is 50</p>';
    }

    if (strlen($postContent) > 900) {
        $errors = true;
        echo '<p class="errors-output">max length for content is 900</p>';
    }

    if (!$errors) {

        // add create post logic

        // check if title and content is all is exist and the same for same users
        $checkIfPostIsExistSql = 'SELECT postTitle, postContent FROM Posts WHERE postCreatorID = ? AND postTitle = ? AND postContent = ?';
        $stmt = $conn->prepare($checkIfPostIsExistSql);
        $stmt->bind_param('iss', $_SESSION['userID'], $postTitle, $postContent);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            echo '<p class="errors">post already exist!!</p>';
            $stmt->free_result();
            $stmt->close();



        } else {

            // add post logic
            $addPostSql = 'INSERT INTO Posts (postCreatorID, postTitle, postContent) VALUES (?, ?, ?)';
            $statement = $conn->prepare($addPostSql);
            $statement->bind_param('iss', $_SESSION['userID'], $postTitle, $postContent);
            $statement->execute();

            echo '<a href="index.php">main page</a>';

            $statement->close();
            $conn->close();

            



        }


    }



}


?>