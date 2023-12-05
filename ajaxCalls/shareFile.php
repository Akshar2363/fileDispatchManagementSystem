<?php

require '../includes/db.php';


if (isset($_GET['fileID']) && isset($_GET['receiver'])) {
    if ($_GET['receiver'] != $_SESSION['userName']) {

    $receiverUserName = $_GET['receiver'];
    
    $sql =  "SELECT * FROM user WHERE userName='$receiverUserName'";


    $result = mysqli_query($con,$sql);
    $statusMsg='';
    if(mysqli_num_rows($result)>0){

        
        $row = mysqli_fetch_array($result);
        $currentUserID = $_SESSION['userID'];
        $fileID = $_GET['fileID'];
        $receiverID=$row['userID'];
        $sql =  "SELECT * FROM friends WHERE (userID='$currentUserID' AND friendID='$receiverID') OR (friendID='$currentUserID' AND userID='$receiverID')";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
        

            $query = "SELECT * FROM dispatch WHERE fileID = '$fileID' AND dispatchBy='$currentUserID' AND dispatchTo='$receiverID'";
            $result = mysqli_query($con, $query);
        
            if (mysqli_num_rows($result) > 0) {
                $statusMsg=  "File already Shared!";
            } else {
                $query = "SELECT * FROM files WHERE fileID = '$fileID'";
                $sql = mysqli_query($con, $query);
                if (mysqli_num_rows($sql) > 0) {
                    $result = mysqli_fetch_assoc($sql);
                    $fileName = $result['fileName'];
                    $filePath = $result['filePath'];
                    $comments=$_GET['comments'];
                    $query = "INSERT INTO dispatch(fileID, dispatchTo, dispatchBy, comments) VALUES (?,?,?,?)";
                    $stmt = mysqli_prepare($con, $query);
                    mysqli_stmt_bind_param($stmt, "ssss", $fileID, $receiverID, $currentUserID, $comments);
                    mysqli_stmt_execute($stmt);
                    $affected_rows = mysqli_stmt_affected_rows($stmt);
                    if ($affected_rows == 1) {
                        $statusMsg = "File shared successfully!";
                    } else {
                        $statusMsg = "An error occurred. Try again later !";
                    }
                    mysqli_stmt_close($stmt);
                    mysqli_close($con);
                }else{
                    $statusMsg=  "Invalid File!";
                }
            }
        
        
        }
        else{
            $statusMsg=  $receiverUserName." is not your friend. Send a friend request to him, to share files.";
            
        }
        

        } else {
            $statusMsg = "Invalid Username !";
        } 
    } else {
            $statusMsg = "Invalid Username !";
    }
       echo $statusMsg;
}
