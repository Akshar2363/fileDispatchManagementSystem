<?php
include '../includes/db.php';
if (isset($_POST['userID'])) {

    $friendID = $_POST['userID'];
    $userID = $_SESSION['userID'];
    $query = "UPDATE friends SET status='Accepted' WHERE (userID='$userID' and friendID='$friendID') OR (friendID='$userID' and userID='$friendID')";
    $result = mysqli_query($con, $query);

    if($result){
        $msg = "Request accepted";
    }else{
        $msg = "Some error occured. Try again later!!";
    }
    echo $msg;
}
?>