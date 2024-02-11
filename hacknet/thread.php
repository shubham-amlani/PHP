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
    <?php 
    $thread_id = $_GET['thread_id'];
    $sql = "SELECT * FROM `threads` WHERE `thread_id`='$thread_id'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $thread_title = $row['thread_title'];
        $thread_description = $row['thread_description'];
        $thread_user_id = $row['thread_user_id'];
    }
    ?>

    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        // Insert comment into db
        $comment = $_POST['comment'];
        $user_id = $_SESSION['userid'];

        $sql = "INSERT INTO `comments` (`comment_id`, `comment_content`, `comment_thread_id`, `comment_user_id`, `comment_time`) VALUES (NULL, '$comment', '$thread_id', '$user_id', current_timestamp())";
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

    <div class="container my-3 text-dark p-4 rounded-3 bg-light-gray">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo "$thread_title";?></h1>
            <p class="lead"><?php
            echo "$thread_description";
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
            <p>Posted by: <b><?php
                    $sql2 = "SELECT `user_email` FROM `users` WHERE `user_id`='$thread_user_id'";
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                    $user_email = $row2['user_email'];
                    echo $user_email;
            ?></b></p>
        </div>
    </div>

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '    <div class="container">
    <h1 class="py-2">Post a Comment</h1>
    <form action="'. $_SERVER['REQUEST_URI'].'" method="post">
        <label for="description" class="my-1">Type your Comment</label>
        <div>
            <textarea class="form-control" id="comment" name="comment" style="height: 100px"></textarea>
        </div>
        <button type="submit" class="btn btn-success my-2">Post Comment</button>
    </form>
</div>';
    }
    else{
        echo '<div class="container lead">
        <p class="my-0">You are not logged in. Please login to able to post comments</p>
            </div>';
    }
    ?>

    <div class="container" id="ques">
        <h1 class="py-2">Comments</h1>
        <table class="table">
            <tbody>
                <!-- We will use a loop to fetch all the threads about a category -->
                <?php 
            $id = $_GET['thread_id'];
            $sql = "SELECT * FROM `comments` WHERE `comment_thread_id`='$id'";
            $result = mysqli_query($conn, $sql);
            $noResult = true;
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
                $id = $row['comment_id'];
                $content = $row['comment_content'];
                $timestamp = strtotime($row['comment_time']);
                $comment_time = date("jS M o", $timestamp);
                $comment_user_id = $row['comment_user_id'];
                $sql2 = "SELECT `user_email` FROM `users` WHERE `user_id`='$comment_user_id'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                
        echo '
        <tr>
        <td>
        <div class="media my-3">
                <div class="media-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0"><img src="images/userdefault.jpeg" width="44px" class="mr-3"
                                alt="userdefault_image">
                        </div>
                        <div class="flex-grow-1 ms-3 weight-bold">
                        <p class="my-0"><b>'.$row2['user_email'].'</b> at <b>'.$comment_time.'</b></p>
                            '.$content.'
                        </div>
                    </div>
                </div>
            </div>
            </td>
            </tr>
            ';
            }

            if($noResult){
                echo '<div class="bg-light-gray p-2 rounded">
                        <div class="container ">
                            <h4>No Comments found</h4>
                            <p class="lead mb-0">Be the first person to answer this question</p>
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