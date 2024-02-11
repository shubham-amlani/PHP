<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>hacknet - Hacking forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
    .bg-light-gray {
        background: rgb(82, 92, 122, 0.3);
    }

    #ques {
        min-height: 430px;
    }
    </style>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_validateUserInput.php'; ?>
    <?php 
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE `category_id`='$id'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    ?>

    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        // Insert thread into db
        $thread_title = validateUserInput($_POST['title']);
        $thread_description = validateUserInput($_POST['description']);
        $user_id = $_SESSION['userid'];

        $sql2 = "SELECT `user_email` FROM `users` WHERE `user_id`='$user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $user_email = $row2['user_email'];
        
        $sql = "INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_description`, `thread_category_id`, `thread_user_id`, `timestamp`) VALUES (NULL, '$thread_title', '$thread_description', '$id', '$user_id', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your thread has been added! Please wait for community to respond.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }
    ?>

    <div class="container my-3 text-dark p-4 rounded-3 bg-light-gray">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo "$catname";?> forums</h1>
            <p class="lead"><?php
            echo "$catdesc";
            ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge with each other.</p>
            <ul>
                <li>Be civil. Don't post anything that a reasonable person would consider offensive, abusive, or hate
                    speech.</li>
                <li>Keep it clean. Don't post anything obscene or sexually explicit.
                    Respect each other.</li>
                <li>Don't harass or grief anyone, impersonate people, or expose their private information.</li>
                <li>Respect our forum.</li>
            </ul>
            <a href="#" class="btn btn-success btn-lg" role="button">Learn more</a>
        </div>
    </div>
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '<div class="container">
            <h1 class="py-2">Start a Discussion</h1>
            <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                <div class="mb-3">
                <label for="title" class="form-label">Problem title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="titleHelp">
            <div id="titleHelp" class="form-text">Keep your title as short and crisp as possible.</div>
            </div>
                <label for="description" class="my-1">Elaborate your problem</label>
            <div>
                <textarea class="form-control" id="description" name="description"
            style="height: 100px"></textarea>
            </div>
                <button type="submit" class="btn btn-primary my-2">Submit</button>
            </form>
    </div>';
    }
    else{
        echo '<div class="container lead">
        <p class="my-0">You are not logged in. Please login to able to start a Discussion.</p>
            </div>';
    }
    ?>

    <div class="container" id="ques">
        <h1 class="py-2">Browse Questions</h1>
        <!-- We will use a loop to fetch all the threads about a category -->
        <table class="table table-striped">
            <tbody>
                <?php 
            $id = $_GET['catid'];
            $sql = "SELECT * FROM `threads` WHERE `thread_category_id`='$id'";
            $result = mysqli_query($conn, $sql);
            $noResult = true;
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
                $thread_id = $row['thread_id'];
                $thread_title = $row['thread_title'];
                $thread_description = $row['thread_description'];
                $timestamp = strtotime($row['timestamp']);
                $thread_time = date("jS M o", $timestamp);
                $thread_user_id = $row['thread_user_id'];
                $sql2 = "SELECT `user_email` FROM `users` WHERE `user_id`='$thread_user_id'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                
        echo '<tr>
                <td>
                <div class="media my-4">
                    <div class="media-body">
                    <div class="d-flex">
                    <div class="flex-shrink-0"><img src="images/userdefault.jpeg" width="44px" class="mr-3"
                    alt="userdefault_image">
                    </div>
                    <div class="flex-grow-1 ms-3 weight-bold">
                            <a href="thread.php?thread_id='.$thread_id.'">
                                <h5 class="mt-0">'.$thread_title.'</h5>
                                </a>
                                '.$thread_description.'
                            </div><p class="mb-2">Asked by:&nbsp;<b>'.$row2['user_email'].'</b> at <b>'.$thread_time.'</b></p>
                        </div>
                    </div>
                </div>
                </td>
            </tr>';
            }
            
            if ($noResult){
                echo '<div class="bg-light-gray p-2 rounded">
                        <div class="container ">
                            <h4>No questions found</h4>
                            <p class="lead mb-0">Be the first person to ask a question</p>
                        </div>
                </div>';
            } 

        ?>
            </tbody>
        </table>
    </div>

    </div>
    <?php include 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>