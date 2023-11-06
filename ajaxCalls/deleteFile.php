<?php

require '../includes/db.php';
if (isset($_GET['fileID']) && isset($_GET['fileName'])) {

    $fileID = $_GET['fileID'];
    $fileName = $_GET['fileName'];
    $success = false;
    $currentDestination = '../userFolders/' . $_SESSION['currentPath'];

    $sqlFiles = "DELETE FROM files WHERE fileID='$fileID'";
    $resultFiles = mysqli_query($con, $sqlFiles);

    if ($resultFiles) {
        unlink($currentDestination . '/' . $fileName);
        echo "File Deleted Successfully";
    } else {
        echo " Error Deleting file!";
    }
}

?>