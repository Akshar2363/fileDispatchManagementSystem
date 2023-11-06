<?php
include '../includes/db.php';

if($_SESSION['currentFolderIndex'] == 0){
    echo "Cannot go Back";
}
else if (isset($_SESSION['userName'])) {
    array_pop($_SESSION['folders']);
    $_SESSION['currentFolderIndex']--;
    $currentPath = $_SESSION['currentPath'];
    $pathParts = explode('/', $currentPath);
    array_pop($pathParts);
    $newPath = implode('/', $pathParts);
    $_SESSION['currentPath'] = $newPath;
    echo "success";
}
else{
    echo "error";
}

?> 