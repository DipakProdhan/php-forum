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
    
    <!-- carousel slide -->
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <!-- <img src="https://source.unsplash.com/2400x700/?apple,code" class="d-block w-100" alt="..."> -->
                <img src="image/S1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="image/S2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="image/S4.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Categorie container start here -->
    <div class="container my-3" id="browse">
        <h5 class="text-center">AllinOne - Browse Categories</h5><br>

        <div class="row">
            <!-- Fetch all the categories and Use a loop to iterate through categories -->
            <?php
        $sql = "SELECT * FROM categories";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
          // echo $row['category_id'];
          // echo $row['category_name'];
          $id = $row['category_id'];
          $category = $row['category_name'];
          $descrip = $row['category_descrip'];
          echo '<div class="col-md-3 my-2">
                    <div class="card" style="width: 12rem;">
                        <img src="image/'.$category.'.png" height="110px" class="card-img-top" alt="...">
                        <div class="card-body">';
                        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
                            echo '<h5 class="card-title"><a href="threadlist.php?catid=' .$id. '">' .$category. '</a></h5>';
                        }
                        else{
                            echo '<h5 class="card-title"><a href="login.php">' .$category. '</a></h5>';
                        }  
                        echo '<p class="card-text">' .substr($descrip, 0, 90).'...</p>';
                        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
                            echo '<a href="threadlist.php?catid=' .$id. '" class="btn btn-primary">View Threads</a>';
                        }
                        else{
                            echo '<a href="login.php" class="btn btn-primary">View Threads</a>';
                        }
                            
                    echo'</div>
                    </div>
                </div>';
        }

        ?>

        </div>
    </div>

    <?php include 'partials\_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>