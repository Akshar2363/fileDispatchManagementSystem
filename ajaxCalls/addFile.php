<?php

include "../includes/db.php";

if (isset($_FILES['fileupload'])) {
    $statusMsg = '';
    $userID = $_SESSION['userID'];
    $folderID = $_SESSION['folders'][$_SESSION['currentFolderIndex']];
    $department = $_SESSION['department'];
    $targetDir = '../userFolders/' . $_SESSION['currentPath'];
    $fileName = basename($_FILES["fileupload"]["name"]);
    $targetFilePath = $targetDir . '/' . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if (empty($_FILES["fileupload"]["name"])) {
    $statusMsg = 'Please select a file to upload.';
} else {
        $sql = "SELECT * FROM files WHERE fileName='$fileName' AND userID='$userID' AND folderID = '$folderID'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            $statusMsg = "File Already Exists! ";
            mysqli_close($con);
        }
        else{
        if (!move_uploaded_file($_FILES["fileupload"]["tmp_name"], $targetFilePath)) {
            $statusMsg = "Sorry, there was an error uploading your file.";
        } else {
            $filePath = 'userFolders/' . $_SESSION['currentPath'].'/'.$fileName;
            $query = "INSERT INTO files (fileName, fileType, filePath, department, userID, folderID) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "ssssss", $fileName, $fileType,  $filePath, $department, $userID, $folderID);
            mysqli_stmt_execute($stmt);
            $affected_rows = mysqli_stmt_affected_rows($stmt);
            if ($affected_rows == 1) {
                $statusMsg = "Form submitted successfully!";
            } else {
                $statusMsg = "An error occurred. Try again later !";
            }mysqli_stmt_close($stmt);
            mysqli_close($con);
        }
    }
}
    echo $statusMsg;
}else{
    echo $_FILES['fileUpload'];
}
?>




