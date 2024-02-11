<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>hacknet - Hacking forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
    #ques {
        min-height: 430px;
    }
    </style>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    <?php 
        if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']==1){
            echo '<div class="alert alert-success mb-0 alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Account created successfully. You can login now.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
            if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']==0 && isset($_GET['error'])){
            echo '<div class="alert alert-danger mb-0 alert-dismissible fade show" role="alert">
                <strong>Sorry!</strong> '.$_GET['error'].'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
            if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']==1){
                echo '<div class="alert alert-success mb-0 alert-dismissible fade show" role="alert">
                <strong>Success!</strong> You\'re logged in now.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
            if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']==0){
                echo '<div class="alert alert-danger mb-0 alert-dismissible fade show" role="alert">
                <strong>Sorry!</strong> Invalid credentials.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
    ?>
    <!-- Slider Component starts here-->
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
                <img src="images/carousel/carousel1.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/carousel/carousel2.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/carousel/carousel3.jpeg" class="d-block w-100" alt="...">
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
    <!-- Category container starts here -->
    <div class="container my-3" id="ques">
        <h2 class="text-center my-3">hacknet - Browse Categories</h2>
        <div class="row display-flex flex-wrap">
            <!-- Fetch all the categories -->
            <?php
        $sql = "SELECT * FROM `categories`";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['category_id'];
            $cat = $row['category_name'];
            $cat_description = substr($row['category_description'],0, 90);
            echo '<div class="col-md-4 my-2">
            <div class="card" style="width: 18rem;">
                <img src="https://source.unsplash.com/500x400/?'.$cat.'" card="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><a href="threadlist.php?catid='.$id.'">'.$cat.'</a></h5>
                    <p class="card-text">'.$cat_description.'...</p>
                    <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">View Threads</a>
                </div>
            </div>
        </div>';
        }

        ?>
            <!-- Use a for loop to itereate through categories -->

        </div>

    </div>
    <?php include 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>