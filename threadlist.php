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
    $id = $_GET['catid'];
    $sql = "SELECT * FROM categories WHERE category_id= $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['category_name'];
        $catdescrip = $row['category_descrip'];
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
    if(isset($_POST['sub'])){
        global $conn;
        global $user_id;

        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];

        $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">", "&gt;", $th_title);

        $th_desc = str_replace("<", "&lt;",$th_desc);
        $th_desc = str_replace(">", "&gt;",$th_desc);

        $sql = "INSERT INTO threads(thread_title, thread_desc, thread_cate_id, sno, time) VALUES('$th_title','$th_desc','$id','$user_id',current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your thread has been added!Please wait for community to respond...
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }    

    }

    ?>   

    <!-- Categorie container start here -->
    <div class="container my-4" id="jumb">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> forums</h1>
            <p class="lead"><?php echo $catdescrip; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not
                post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times.</p>
            
        </div>
        
    </div>

    <div class="container">
        <h1 class="py-2">Start a Discussions</h1>

        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
            <!-- $_SERVER['PHP_SELF'] -- use for same page(url) server(post) request -->
            <!-- $_SERVER['REQUEST_URI'] -- use for same work but add '?' after -->
            <div class="form-group">
                <label for="exampleInputEmail1">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">keep your title as short and crisp as possible</div>
            </div>
            
            <div class="form-group my-2">
                <label for="exampleFormControlTextarea1" class="form-label">Elaborate Your Problem</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                <!-- <input type="hidden" name="sno" value="</?php $_SESSION['sno']?>"> -->
            </div>
            <button type="submit" class="btn btn-success" name="sub">Submit</button>
        </form>
    </div>



    <div class="container mb-5 my-3" id="browse">
        <h1 class="py-2">Browse Questions</h1>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM threads WHERE thread_cate_id= $id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $descrip = $row['thread_desc'];
            $time = $row['time'];
            $thread_sno = $row['sno'];
            
            $sql2 = "SELECT user_name FROM users WHERE sno='$thread_sno'";
            $result2 = mysqli_query($conn, $sql2);
            $rows = mysqli_fetch_assoc($result2);
            
            
            // $user = $rows['user_email'];

            echo '<div class="d-flex">
            <div class="flex-shrink-0">
              <img src="image/user1.png" width="54px" class="mr-3" alt="...">
            </div>
            <div class="flex-grow-1 ms-2">'.           
            '<h5 class="my-0"><a class="text-dark" href="thread.php?threadid=' . $id . '">' . $title. '</a></h5>
            <div class="cantain" style="width: 700px;"> 
            ' . $descrip . '</div></div>'.'<p class="my-0">Asked by '. $rows['user_name'] .' at '.$time.' </p>'.
          '</div>';
        }
        // echo var_dump($noResult);
        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid" id="fluid-jumbo">
                    <div class="container">
                     <p class="display-5">No Threads Found</p>
                     <p class="lead">Be the first person to ask a question</p>
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