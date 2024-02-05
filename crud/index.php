<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>iNotes - Make your notes</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
      />
      <script
      src="https://code.jquery.com/jquery-3.7.1.js"
      integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
      crossorigin="anonymous"></script>
      <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
      <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
      <link rel="shortcut icon" href="icon.png" type="image/x-icon" />
      <script>
        $(document).ready( function () {
          $('#myTable').DataTable();
        })
      </script>
  </head>
  <body>
    <!-- Update modal -->
    <div class="modal" tabindex="-1" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit this note</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="index.php?update=1" method="post">
              <input type="hidden" name="snoEdit" id="snoEdit">
              <div class="mb-3">
                <label for="note-title" class="form-label">Note Title</label>
                <input
                  type="text"
                  class="form-control"
                  id="titleEdit"
                  name="titleEdit"
                  placeholder="Add a title to your note"
                />
              </div>
              <div class="mb-3">
                <label for="note-description" class="form-label"
                  >Note description</label
                >
                <textarea
                  class="form-control"
                  id="descriptionEdit"
                  name="descriptionEdit"
                  rows="3"
                ></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">iNotes</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact Us</a>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button class="btn btn-outline-success" type="submit">
              Search
            </button>
          </form>
        </div>
      </div>
    </nav><?php

    if(isset($_GET['success']) && $_GET['success']==1){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Note added to the notes.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if(isset($_GET['success']) && $_GET['success']==0){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Sorry!</strong> Note cannot be added due to some technical issue.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if(isset($_GET['updateSuccess']) && $_GET['updateSuccess']==1){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Note updated successfully.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if(isset($_GET['updateSuccess']) && $_GET['updateSuccess']==0){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Sorry!</strong> Note cannot be updated due to some technical issue.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if(isset($_GET['deleteSuccess']) && $_GET['deleteSuccess']==1){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Note deleted successfully.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
    if(isset($_GET['deleteSuccess']) && $_GET['deleteSuccess']==0){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Sorry!</strong> Note cannot be deleted due to some technical issue.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }


    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'inotes';
    
    $conn = mysqli_connect($servername, $username, $password, $database);

    if(isset($_GET['update']) && $_GET['update']==1){
      $title_edit = $_POST['titleEdit'];
      $description_edit = $_POST['descriptionEdit'];
      $sno_edit = $_POST['snoEdit'];
      
      $sql = "UPDATE `notes` SET `title`='$title_edit', `description`='$description_edit' WHERE `sno`='$sno_edit'";
      $result = mysqli_query($conn, $sql);
      if($result){
        header('Location:notes.php?updateSuccess=1');
      }
      else{
        header('Location:notes.php?updateSuccess=0');
      }
    }

    if(isset($_GET['delete']) && $_GET['delete']==1){
      $sno_delete = $_POST['snoDelete'];
      $sql = "DELETE FROM `notes` WHERE `notes`.`sno`='$sno_delete'";
      $result = mysqli_query($conn, $sql);
      if($result){
        header('Location: notes.php?deleteSuccess=1');
      }
      else{
        header('Location: notes.php?deleteSuccess=0');
      }
    }

      if($_SERVER['REQUEST_METHOD']=='POST'){
      $note_title = $_POST['note-title'];
      $note_description = $_POST['note-description'];
      $sql = "INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, '$note_title', '$note_description', current_timestamp())";
      $result = mysqli_query($conn, $sql);
      if($result){
        header('Location: notes.php?success=1');
      }
      else{
        header('Location: notes.php?success=0');
      }
    }
    ?>
<!-- Delete modal -->
<div class="modal" tabindex="-1" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="index.php?delete=1" method="post">
          <input type="hidden" name="snoDelete" id="snoDelete">
          <div class="mb-3">
            <label for="note-title" class="form-label">Note Title</label>
            <input
              readonly
              type="text"
              class="form-control"
              id="titleDelete"
              name="titleDelete"
            />
          </div>
          <div class="mb-3">
            <label for="note-description" class="form-label"
              >Note description</label
            >
            <textarea
              readonly
              class="form-control"
              id="descriptionDelete"
              name="descriptionDelete"
              rows="3"
            ></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

    <div class="container my-4">
      <h2>Add a note</h2>
      <form action="index.php" method="post">
        <div class="mb-3">
          <label for="note-title" class="form-label">Note Title</label>
          <input
            type="text"
            class="form-control"
            id="note-title"
            name="note-title"
            placeholder="Add a title to your note"
          />
        </div>
        <div class="mb-3">
          <label for="note-description" class="form-label"
            >Note description</label
          >
          <textarea
            class="form-control"
            id="note-description"
            name="note-description"
            rows="3"
          ></textarea>
          <button type="submit" class="btn btn-primary my-3">Add note</button>
        </div>
      </form>
    </div>
    <div class="container my-5">
    <table id="myTable" class="table">
    <thead>
    <tr>
        <th scope="col">Sr.no</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Actions</th>
      </tr>
      <tbody>
        <?php
          $sql = 'SELECT * FROM `notes`';
          $result = mysqli_query($conn, $sql);
          $no = 1;
          while($row = mysqli_fetch_assoc($result)){
            echo "<tr>
            <th scope='row'>". $no."</th>
            <td>".$row['title']."</td>
            <td>".$row['description']."</td>
            <td> <button name='edit' class='btn btn-sm btn-primary edit' id=".$row['sno'].">Edit</button>&nbsp;&nbsp;&nbsp;&nbsp;<a class='link delete' name='delete' id=".$row['sno'].">Delete</a></td>
            </tr>
            ";
            $no+=1;
          }
        ?>
      </tbody>
    </thead>
    </table>
    </div>
    <!-- Javascript -->
    <script>
      edits = document.getElementsByClassName('edit');
      deletes = document.getElementsByClassName('delete');
      Array.from(edits).forEach(element => {
          element.addEventListener('click', (e)=>{
            tr = e.target.parentNode.parentNode;
            title = tr.getElementsByTagName('td')[0].innerText;
            description = tr.getElementsByTagName('td')[1].innerText;
            titleEdit.value = title;
            descriptionEdit.value = description;
            snoEdit.value = e.target.id;
            console.log(e.target.id);
            $('#myModal').modal('toggle');
          })
      });

      deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach(element => {
        element.addEventListener('click', (e)=>{
          tr = e.target.parentNode.parentNode;
          title = tr.getElementsByTagName('td')[0].innerText;
          description = tr.getElementsByTagName('td')[1].innerText;
          console.log(title, description);
          titleDelete.value = title;
          descriptionDelete.value = description;
          snoDelete.value = e.target.id;
          console.log(e.target.id);
          $('#deleteModal').modal('toggle');
        })
      });
    </script>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
