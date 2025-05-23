
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/index.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
</head>
<body>
    <?php include 'externalphp/header.php' ?>
    <div class="main-s">
        <div class="links-s">
            <p class="links"><a href="createPost.php">create post</a></p>
            <p class="links"><a href="allUsersPosts.php">show my posts</a></p>
        </div>
       
        <?php
        showPostsAllusersInMP()
        ?>
    
    </div>
    <script src="js/index.js"></script>
</body>
</html>

<?php



function showPostsAllusersInMP(){


        // show latest posts of all user latest 10 posts
        //postCreatorID, postTitle, postContent, createdPostTime
        $limitOfShowindPosts = 10;
        include 'database/connectToDatabase.php';

       

        $showLatestPostsSql = 'SELECT Posts.*, Users.userName FROM Posts INNER JOIN Users ON Posts.postCreatorID = Users.UserID ORDER BY Posts.createdPostTime DESC LIMIT ?';
        $stmt = $conn->prepare($showLatestPostsSql);
        $stmt->bind_param('i', $limitOfShowindPosts);
        $stmt->execute();
        $posts = $stmt->get_result();



        if($posts->num_rows > 0){

           
        
            while($postsRow = $posts->fetch_assoc()){
                echo '<div class="item-post"><h2 class="postOwner">created by '.$postsRow['userName'].'</h2><h2 class="postTitle">' . $postsRow['postTitle'] . '</h2><br><p class="postContent">' . $postsRow['postContent'] . '</p><p class"createTime">' . '<p class"descr-ab-t">time of creating</p>' . $postsRow['createdPostTime'] . '</p></div>';
               

            }

        
        


        }else{
            echo "<p class='output'>no posts</p>";
        }

        
       
        $conn->close();

}


?>