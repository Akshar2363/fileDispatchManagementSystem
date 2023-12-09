<?php
include "../includes/db.php";

if (isset($_GET['folderName'])) {
    $foldername = $_GET['folderName'];
    $disallowedCharacters = ['.', '/', ',', '<', '>', '(', ')', '&', '$', '@', '#', '%', '!', '^'];
    $statusMsg = '';
    if(empty($foldername)){
        $statusMsg = "Folder Name must not be empty!";
        exit;
    }
    if($foldername == 'Received'){
        $statusMsg = "Received is a reserved name. Please select a different name !";
        exit;
    }
    if (strpos($foldername, ' ') !== false) {
        $statusMsg = "Folder name cannot contain spaces";
        exit; // Exit the script if the folder name contains a disallowed character
    }
foreach ($disallowedCharacters as $char) {
    if (strpos($foldername, $char) !== false) {
        $statusMsg = "Folder name cannot contain disallowed characters: <?= implode(', ', $disallowedCharacters) ?>";
        exit; // Exit the script if the folder name contains a disallowed character
    }
}
    $userID = $_SESSION['userID'];
    $parentID = $_SESSION['folders'][$_SESSION['currentFolderIndex']];
    $currentPath = $_SESSION['currentPath'];

    mysqli_autocommit($con, false); // Disable auto-commit

    $sql = "SELECT * FROM folders WHERE folderName='$foldername' AND userID='$userID' AND parentID=$parentID FOR UPDATE";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 0) {
        $destination = '../userFolders/' . $currentPath . '/' . $foldername;

        if (mkdir($destination)) {
            $query = "INSERT INTO folders (folderName, parentID, userID) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "sss", $foldername, $parentID, $_SESSION["userID"]);
            mysqli_stmt_execute($stmt);

            if (mysqli_commit($con)) {
                mysqli_autocommit($con, true); // Enable auto-commit
                    $statusMsg = "Folder Created Successfully!";
            } else {
                mysqli_rollback($con); // Rollback in case of failure
                mysqli_autocommit($con, true); // Enable auto-commit
                    $statusMsg = "An error occurred while creating the folder. Please try again.";
            }
        }
    } else {
            $statusMsg = "Folder with this name already exists";
    }

    echo $statusMsg;
}
?>
