

<?php


function postsPreprocessing()
{
    // limit for 1 page
    // 5
    $postsLimitforOnePage = 5;

    include 'database/connectToDatabase.php';

    // get total number of posts
    $countPostsSql = 'SELECT COUNT(postID) AS total FROM Posts';

    


    //
    $resultCount = mysqli_query($conn, $countPostsSql);
    $totalPosts = mysqli_num_rows($resultCount);

    

    
    $totalPosts = $resultCount->fetch_assoc()['total'];

    

    

    // computing total number of pages
    $totalPages = ceil($totalPosts / $postsLimitforOnePage);

    

    
    
    // definition current page

    if(isset($_GET['page']))
    {
        $currentPage = (int)$_GET['page'];
    }
    else
    {
        $currentPage = 1;
    }

    
    $currentPage = max(1, min($currentPage, $totalPages));



    // defenition of OFFSET
    $offset = ($currentPage - 1) * $postsLimitforOnePage;

    // get posts for current page
    $showLatestPostsSql = 'SELECT Posts.*, Users.UserName FROM Posts INNER JOIN Users ON Posts.postCreatorID = Users.UserID ORDER BY Posts.createdPostTime DESC LIMIT ?, ?';
    $stmt = $conn-> prepare($showLatestPostsSql);
    $stmt->bind_param('ii', $offset, $postsLimitforOnePage);
    $stmt->execute();
    $posts = $stmt->get_result();
    

    return [$totalPosts, $totalPages, $currentPage, $posts];
}



    
    






?>


<?php
            
    $postsAndPagesInf = postsPreprocessing();

    list($totalPosts, $totalPages, $currentPage, $posts) = $postsAndPagesInf; 


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/posts.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page <?php echo $currentPage; ?> from <?php echo $totalPages ?></title>
</head>
<body>
    <?php include  'externalphp/header.php';?>

    <div class="main-s">
        <?php 
        postsPreprocessing();
        
        if($posts->num_rows > 0)
    {
        while ($post = $posts->fetch_assoc())
        {
            echo '<div class="item-post"><h2 class="postOwner">' . $post['userName'] . '</h2>';
            echo '<h2 class="postTitle">'. $post['postTitle']. '</h2><br>';
            echo '<p class="postContent">'. $post['postContent'] .'</p>';
            echo '<p class="createTime"><p class="descr-ab-t">time of creating</p>' . $post['createdPostTime'] . '</p>';
            echo '</div>';
            
        }
    }
    else
    {
        echo '<p class="output-no-posts">no posts on this page</p>';
    }

    ?>

       

    </div>

    <div class="pagination">
            

            <?php if($currentPage > 1){ ?>
                <a class="pages-btn" href="?page=<?php echo $_GET['page'] - 1;?>">&laquo; Prev</a>
                
                
            <?php  } ?>

            <?php echo "page " . $currentPage; ?>

            <?php if($currentPage < $totalPages){ ?>
                <a class="pages-btn" href="?page=<?php echo $_GET['page'] + 1;?>">Next &raquo;</a>
                
                
            <?php  } ?>

            

        <?php
       
        ?>
    </div>



</body>
</html>







<?php
include 'database/connectToDatabase.php';
$conn->close();
?>