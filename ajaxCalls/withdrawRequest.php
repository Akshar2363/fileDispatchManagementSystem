<?php
include '../includes/db.php';
if (isset($_POST['userID'])) {

    $friendID = $_POST['userID'];
    $userID = $_SESSION['userID'];
    $query = "DELETE FROM friends WHERE (userID='$userID' and friendID='$friendID') OR (friendID='$userID' and userID='$friendID') AND status='Pending'";
    $result = mysqli_query($con, $query);

    if($result){
        $msg = "Request Withdrawn";
    }else{
        $msg = "Some error occured. Try again later!!";
    }
    echo $msg;
}
?>