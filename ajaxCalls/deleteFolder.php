<?php

require '../includes/db.php';
function pathPop($currentPath){
    $pathParts = explode('/', $currentPath);
    array_pop($pathParts);
    $newPath = implode('/', $pathParts);
    return $newPath;
}

function pathPush($currentPath, $folderName){
    $currentPath = $currentPath . '/' . $folderName;
    return $currentPath;
}

function delete_subfolders_subfiles($con, $folderID, $currentPath) {
    $success = false;
    mysqli_begin_transaction($con); // Start a transaction

    //Select files in current Directory from database
    $sqlFiles = "SELECT * FROM files WHERE folderID='$folderID'";
    $resultFiles = mysqli_query($con, $sqlFiles);

    //If file exists 
    if($resultFiles){
        
        //Delete files in current Directory from database
        $sqlFiles = "DELETE FROM files WHERE folderID='$folderID'";
        $subFiles = mysqli_query($con, $sqlFiles);
        
        //If deletion from database is successful 
        if($subFiles){
        mysqli_commit($con);
        
        //Select subfolders in current directory from database
        $sqlFolders = "SELECT folderID, folderName FROM folders WHERE parentID='$folderID'";
        $resultFolders = mysqli_query($con, $sqlFolders);
        
        //If subfolder exists
        if ($resultFolders) {
            foreach($resultFolders as $subFolder){
                //Get folderID, foldername, and modify current path -- Go to the folder
                $subfolderID = $subFolder['folderID'];
                $subfolderName = $subFolder['folderName'];
                $currentPath = pathPush($currentPath, $subfolderName);
                //Recursively delete subfiles and subfolders from the folder
                $subfolderSuccess = delete_subfolders_subfiles($con, $subfolderID, $currentPath);
                //Get back to current folder
                $currentPath = pathPop($currentPath);
                if (!$subfolderSuccess) {
                    mysqli_rollback($con); // Rollback the transaction if any deletion fails
                    return $success;
                }
            }
        }
        
        //Now delete the current folder from database
        $sqlFolder = "DELETE FROM folders WHERE folderID='$folderID'";
        $resultFolder = mysqli_query($con, $sqlFolder);
        
        //If all deletions from database is successful, delete them from directory
        if ($resultFolder) {
            mysqli_commit($con); // Commit the transaction if all operations are successful
            foreach($resultFiles as $subFile){
                unlink($currentPath . '/' . $subFile['fileName']);
            }
            rmdir($currentPath);
        } else {
            mysqli_rollback($con); // Rollback the transaction if any deletion fails
            return $success;
        }

        }else{
            mysqli_rollback($con);
        }
    }else {
        mysqli_rollback($con); // Rollback the transaction if any deletion fails
        return $success;
    }
    $success = true;
    return $success;
}



if(isset($_GET['folderID'])){
    
    $folderID = $_GET['folderID'];
    $directory = $_SESSION['currentPath'] . '/' . $_GET['folder'];
   
    $currentDestination = '../userFolders/' . $_SESSION['currentPath'] . '/' . $_GET['folder'];
    $success = delete_subfolders_subfiles($con, $folderID, $currentDestination);

    if($success){
        echo "Folder Deleted Successfully";
    }else{
        echo "Error Deleting folder!";
    }

}

?>