<?php
include '../includes/db.php';

if(isset($_POST['dispatchID']) && isset($_POST['fileID'])){
    $dispatchID = $_POST['dispatchID'];
    $query = "UPDATE dispatch SET status='Deleted' WHERE dispatchID='$dispatchID'";
    $res = mysqli_query($con, $query);

    if($res){
        $query = "SELECT * FROM dispatch, files, user WHERE dispatchID='$dispatchID' AND dispatch.fileID=files.fileID AND dispatchBy=user.userID";
        $result = mysqli_query($con, $query);
        if($result){
            $row = mysqli_fetch_assoc($result);
            $senderRootDirectory = $row['userID'].$row['Name'].$row['contactNo'];
            $dest = '../userFolders/'.$_SESSION['userID'].$_SESSION['Name'].$_SESSION['contactNo'].'/Received'.'/'.$senderRootDirectory;
            unlink($dest . '/' .$row['fileName']);
        }
        echo "success";
    }else{
        echo "error";
    }

}
else{
    echo "error";
}

?> 