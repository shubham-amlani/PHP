<?php
if(isset($_GET['success']) && $_GET['success']==0){
    header('Location: index.php?success=0');
}
if(isset($_GET['success']) && $_GET['success']==1){
    header('Location: index.php?success=1');
}
if(isset($_GET['updateSuccess']) && $_GET['updateSuccess']==1){
    header('Location: index.php?updateSuccess=1');
}
if(isset($_GET['updateSuccess']) && $_GET['updateSuccess']==0){
    header('Location: index.php?updateSuccess=0');
}
if(isset($_GET['deleteSuccess']) && $_GET['deleteSuccess']==1){
    header('Location: index.php?deleteSuccess=1');
}
if(isset($_GET['deleteSuccess']) && $_GET['deleteSuccess']==0){
    header('Location: index.php?deleteSuccess=0');
}
exit();
?>