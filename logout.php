<?php

require ('includes/db.php');

if(isset($_SESSION['userID'])){
    session_destroy();
    header('location: index.php');
}
?>
