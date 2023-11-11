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

<style>
#main-container {
    min-height: 80vh;
}

/* .container{
    min-height: 80vh;
} */
</style>

<body>
    <?php include 'partials\_dbconnect.php'; ?>
    <?php include 'partials\_header.php'; ?>
    <?php

  
    ?>
    <!-- search results -->
    <div class="container my-3" id="main-container">
        <h1 class="py-2">Search results for <em>"<?php echo $_GET['search_query']?>"</em></h1>

        <?php
        // $method = $_SERVER['REQUEST_METHOD'];
        // if ($method == 'GET') {
        //     $query = $_GET['search'];
                    
        //     $sql = "SELECT * FROM threads WHERE MATCH(thread_title, thread_desc) AGAINST ('$query')";
        //     $result = mysqli_query($conn, $sql);
        //     while ($row = mysqli_fetch_assoc($result)) {
        //         $title = $row['thread_title'];
        //         $descrip = $row['thread_desc'];

        //         echo '  <div class="result">
        //             <h3><a href="" class="text-dark">'.$title.'</a></h3>
        //             <p>'.$descrip.'</p>
        //         </div>';
        //     }
        // }
            $noResult = true;
            if(isset($_GET['search'])){
                global $conn;
                $query = $_GET['search_query'];
            }
            
            $sql = "SELECT * FROM threads WHERE MATCH(thread_title, thread_desc) AGAINST('$query')";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $title = $row['thread_title'];
                $descrip = $row['thread_desc'];
                $thread_id = $row['thread_id'];
                $url = "thread.php?threadid=". $thread_id;
                $noResult = false;

                // Display the search result
                echo '  <div class="result">
                    <h3><a href="'.$url.'" class="text-dark">'.$title.'</a></h3>
                    <p>'.$descrip.'</p>
                </div>';
            }
            if($noResult){
                echo '<div class="jumbotron jumbotron-fluid" id="fluid-jumbo">
                        <div class="container">
                            <p class="display-5">No Results Found</p>
                            <p class="lead"> Suggestions: <ul>
                                <li>Make sure that all words are spelled correctly.</li>
                                <li>Try different keywords.</li>
                                <li>Try more general keywords. </li></ul>
                            </p>
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