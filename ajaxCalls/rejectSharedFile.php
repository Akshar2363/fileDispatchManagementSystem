<?php
include '../includes/db.php';

if(isset($_POST['dispatchID']) && isset($_POST['fileID'])){

    $dispatchID = $_POST['dispatchID'];
    $query = "UPDATE dispatch SET status='Rejected' WHERE dispatchID='$dispatchID'";
    $res = mysqli_query($con, $query);
    if($res){
        echo "success";
    }else{
        echo "error";
    }
}
else{
    echo "error";
}

?> 