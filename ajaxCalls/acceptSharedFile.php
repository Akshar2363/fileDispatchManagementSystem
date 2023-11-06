<?php
include '../includes/db.php';

if(isset($_POST['dispatchID']) && isset($_POST['fileID'])){
    $dispatchID = $_POST['dispatchID'];
    $query = "UPDATE dispatch SET status='Accepted' WHERE dispatchID='$dispatchID'";
    $res = mysqli_query($con, $query);

    if($res){
        $query = "SELECT * FROM dispatch, files, user WHERE dispatchID='$dispatchID' AND dispatch.fileID=files.fileID AND dispatchBy=user.userID";
        $result = mysqli_query($con, $query);
        if($result){
            $row = mysqli_fetch_assoc($result);
            $src = '../'.$row['filePath'];
            $senderRootDirectory = $row['userID'].$row['userName'].$row['contactNo'];
            $dest = '../userFolders/'.$_SESSION['userID'].$_SESSION['userName'].$_SESSION['contactNo'].'/Received'.'/'.$senderRootDirectory;
            if(!is_dir($dest)){
                mkdir($dest);
            }
            copy($src, $dest . '/' .$row['fileName']);
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