<?php
include '../includes/db.php';

if (isset($_POST['folderID']) && isset($_POST['folderName'])) {
    array_push($_SESSION['folders'], $_POST['folderID']);
    $_SESSION['currentFolderIndex']++;
    $_SESSION['currentPath'] = $_SESSION['currentPath'] . '/' . $_POST['folderName'];
    echo 'success';
} else {
    echo 'error';
}


?>