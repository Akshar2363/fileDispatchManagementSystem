<?php

require ('includes/db.php');

if(isset($_SESSION['userName'])){
    session_destroy();
    header('location: index.php');
}
?>
