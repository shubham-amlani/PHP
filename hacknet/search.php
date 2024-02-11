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
        min-height: 85vh;
    }
    </style>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    <!-- Search Results starts here -->
    <div class="container" id="ques">
        <?php 
        $search = $_GET['search'];
        ?>

        <h1 class="py-2">Search results for: <?php echo "&ldquo;<em>".$search."</em>&rdquo;";?></h1>
        <!-- We will use a loop to fetch all the threads about a category -->
        <table class="table table-striped">
            <tbody>
                <?php
                $sql = "SELECT * FROM `threads` WHERE MATCH (`thread_title`, `thread_description`) AGAINST ('$search')";
                $result = mysqli_query($conn, $sql);
                $noResults = true;
                $numRows = mysqli_num_rows($result);
                while(($row = mysqli_fetch_assoc($result)) && $numRows!=0){
                    $noResults = false;
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
                if($noResults){
                    echo '<div class="bg-light-gray p-2 rounded">
                    <div class="container ">
                        <h4>No threads found containing: &ldquo;<em>'.$search.'</em>&rdquo;</h4>
                    </div>
                    <ul>
                <li>Make sure that all words are spelled correctly</li>
                <li>Try different keywords</li>
                <li>Try more general keywords</li>
                </ul>
                </div>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>