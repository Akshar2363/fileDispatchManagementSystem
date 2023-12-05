<?php
include '../includes/db.php';
if (isset($_POST['userID'])) {

    $friendID = $_POST['userID'];
    $userID = $_SESSION['userID'];
    $query = "SELECT * FROM friends WHERE userID='$userID' AND (userID='$userID' and friendID='$friendID') OR (friendID='$userID' and userID='$friendID')";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result)>0){
        $msg = "Request already sent";
    }else{

        
        $status = 'Pending';
        $insertQuery = "INSERT INTO friends (userID, friendID, status)VALUES (?,?, ?)";
        $stmt = mysqli_prepare($con, $insertQuery);
        mysqli_stmt_bind_param($stmt, "sss", $userID, $friendID, $status);
        $requestFriend = mysqli_stmt_execute($stmt);
        
        if ($requestFriend) {
            $msg = "Request Sent Successfully!!";
        } else {
            $msg = "Some error occured. Try again later!!";
        }
    }
    echo $msg;
}
?>