<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="partials\_style.css">

    <title>AllinOne</title>
</head>

<body>

    <?php include 'partials\_dbconnect.php'; ?>
    <?php include 'partials\_header.php'; ?>
   
    <?php
    $id = $_GET['threadid']; 
    $sql = "SELECT * FROM threads WHERE thread_id= $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $descrip = $row['thread_desc'];
        $post_by = $row['sno'];
            
        $sqls = "SELECT user_name FROM users WHERE sno='$post_by'";
        $results = mysqli_query($conn, $sqls);
        $rows = mysqli_fetch_array($results);
        $posted_by = $rows['user_name'];

    }
    ?>
    <?php

    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $user = $_SESSION['useremail'];
        $get_user = "select * from users where user_email='$user'";
        $run_user = mysqli_query($conn, $get_user);
        $row = mysqli_fetch_array($run_user);
        $user_id = $row['sno'];
    }
   
    $showAlert = false;
    if(isset($_POST['pos'])){
        global $conn;
        global $user_id;

        $comment = $_POST['comment']; 
        $comment = str_replace("<", "&lt;", $comment);
        $comment = str_replace(">", "&gt;", $comment);

        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `sno`, `comment_time`) VALUES ('$comment', '$id', '$user_id', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your comment has been added!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }

    }

    ?>

    <!-- Categorie container start here -->
    <div class="container my-4" id="jumb">
        <div class="jumbotron">
            <h1 class="display-3"><?php echo $title; ?></h1>
            <p class="lead"><?php echo $descrip; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not
                post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times.</p>
            <p><b>Posted by :</b> <em><?php echo $posted_by; ?></em></p>
        </div>
    </div>

    <div class="container">
        <h1 class="py-2">Post a Comment</h1>

        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="form-group my-2">
                <label for="exampleFormControlTextarea1" class="form-label">Type Your Comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <!-- <input type="hidden" name="sno" value="</?php $_SESSION['sno']?>"> -->
                <!-- <input type="hidden" name="sno" value="'. $_SESSION["sno"].'"> -->
            </div>
            <button type="submit" name="pos" class="btn btn-success">Post</button>
        </form>
    </div>


    <div class="container mb-5" id="browse">
        <h1 class="py-2">Discussions</h1>
        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM comments WHERE thread_id= $id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $time = $row['comment_time'];
            $comment_sno = $row['sno'];
            
            $sql2 = "SELECT user_name FROM users WHERE sno='$comment_sno'";
            $result2 = mysqli_query($conn, $sql2);
            $rows = mysqli_fetch_array($result2);

            echo '<div class="d-flex">
                <div class="flex-shrink-0">
                <img src="image/user1.png" width="54px" class="mr-3" alt="...">
                </div>
                <div class="flex-grow-1 ms-2">
                <p class="fw-bold my-0">'. $rows['user_name'] .' at '.$time.' </p>
                ' . $content . '
                </div>
            </div>';
        }
        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid" id="fluid-jumbo">
                    <div class="container">
                     <p class="display-5">No Comments Found</p>
                     <p class="lead">Be the first person to comment</p>
                    </div>
                 </div>';
        }
        ?>
    </div>

    <?php include 'partials\_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>