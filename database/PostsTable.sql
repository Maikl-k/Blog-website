CREATE TABLE IF NOT EXISTS Posts(
    postID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    postCreatorID INT UNSIGNED,
    FOREIGN KEY (postCreatorID) REFERENCES Users(UserID),
    postTitle varchar(255) NOT NULL,
    postContent varchar(1000) NOT NULL,
    createdPostTime timestamp default current_timestamp,
    updatePostTime timestamp default current_timestamp on update current_timestamp
    

);