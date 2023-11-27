<script>
function acceptFile(dispatchID, fileID) {
    $.ajax({
        type: 'POST',
        url: 'ajaxCalls/acceptSharedFile.php',
        data: { dispatchID: dispatchID, fileID: fileID },
        success: function(response) {
            alert(response);
            location.reload();
        }
    });
}
function rejectFile(dispatchID, fileID) {
    $.ajax({
        type: 'POST',
        url: 'ajaxCalls/rejectSharedFile.php',
        data: { dispatchID: dispatchID, fileID: fileID },
        success: function(response) {
            location.reload();
        }
    });
}
function deleteFile(dispatchID, fileID) {
    if(confirm('Are you sure and want to delete the file ?')){
        $.ajax({
            type: 'POST',
            url: 'ajaxCalls/deleteSharedFile.php',
            data: { dispatchID: dispatchID, fileID: fileID },
            success: function(response) {
                alert(response);
                location.reload();
            }
        });
    }
}
function sendFile(fileID){
    let receiver = prompt('Enter username of receiver : ');
    if(receiver!=null){
        location.href=`endpoints/shareFile.php?fileID=${fileID}&receiver=${receiver}`
    }
}
function sendFile(fileID){
    let receiver = prompt('Enter username of receiver : ');
    if(receiver!=null){
        $.ajax({
            type: 'GET',
            url: `ajaxCalls/shareFile.php?fileID=${fileID}&receiver=${receiver}`,
            success: function(response) {
                alert(response);
                location.reload();
            }
        });
    }
}

function downloadFile(filePath){
    $.ajax({
        type: 'POST',
        url: `ajaxCalls/downloadFile.php`,
        data: { filePath: filePath},
        success: function(response) {
            alert(response);
            location.reload();
        }
    });
}

</script>

<?php


if (isset($_SESSION['userName'])) {
    $userID = $_SESSION['userID'];
    $folderID = -2;
    $sql = "SELECT * FROM dispatch, files, user WHERE dispatch.dispatchTo='$userID' AND user.userID=dispatch.dispatchBy AND files.fileID=dispatch.fileID AND status='Pending'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) != 0) {
?>

        <div>Pending Files to be Approved</div>
        <table class="receivedFileTable w-full">
            <thead>
                <th class="p-2">File ID</th>
                <th class="p-2">File Name</th>
                <th class="p-2">File Type</th>
                <th class="p-2">Sent By</th>
                <th class="p-2">TimeStamp</th>
                <th class="p-2" colspan="2">Actions</th>
            </thead>
            <tbody>
                <?php
                foreach ($result as $file) {
                ?>
                    <tr>
                        <td class="p-2"><?php echo $file['fileID']; ?></td>
                        <td class="p-2"><?php echo $file['fileName']; ?></td>
                        <td class="p-2"><?php echo $file['fileType']; ?></td>
                        <td class="p-2"><?php echo $file['Name'] . ' ( ' . $file['userName'] . ' )'; ?></td>
                        <td class="p-2"><?php echo $file['dispatchTimestamp']; ?></td>
                        <td class="p-2"><button onclick="acceptFile('<?php echo $file['dispatchID'] ?>', '<?php echo $file['fileID']?>')"><i class="fa fa-check p-2 rounded-full border text-green-500 hover:bg-gray-300"></i></button></td>
                        <td class="p-2"><button onclick="rejectFile('<?php echo $file['dispatchID'] ?>', '<?php echo $file['fileID']?>')"><i class="fa fa-close p-2 rounded-full border text-red-500 hover:bg-gray-300"></i></button> </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

    <?php
    } else {

    ?>
        <div>No Files Pending to be received</div>

    <?php

    }
    $sql = "SELECT * FROM dispatch, files, user WHERE dispatch.dispatchTo='$userID' AND user.userID=dispatch.dispatchBy AND files.fileID=dispatch.fileID AND status='Accepted'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) != 0) {
    ?>
    <div>Received Files</div>
        <table class="receivedFileTable w-full">
            <thead>
                <th class="p-2">File ID</th>
                <th class="p-2">File Name</th>
                <th class="p-2">File Type</th>
                <th class="p-2">Sent By</th>
                <th class="p-2">Time Stamp</th>
                <th class="p-2" colspan="3">Actions</th>
            </thead>
            <tbody>
                <?php
                foreach ($result as $file) {
                    $sender = $file['userID'].$file['userName'].$file['contactNo'];
                    $rootDirectory = $_SESSION['userID'].$_SESSION['userName'].$_SESSION['contactNo'];
                ?>
                    <tr>
                        <td class="p-2"><?php echo $file['fileID']; ?></td>
                        <td class="p-2"><?php echo $file['fileName']; ?></td>
                        <td class="p-2"><?php echo $file['fileType']; ?></td>
                        <td class="p-2"><?php echo $file['Name'] . ' ( ' . $file['userName'] . ' )'; ?></td>
                        <td class="p-2"><?php echo $file['dispatchTimestamp']; ?></td>
                        <td class="p-2"><button onclick="deleteFile('<?php echo $file['dispatchID']; ?>', '<?php echo $file['fileID']; ?>')"><i class="fas fa-trash text-red-600 text-lg"></i></button></td>
                        <td class="p-2"> <a href="<?php echo 'userFolders/'.$rootDirectory.'/Received'.'/'.$sender.'/'.$file['fileName'] ?>" download><i class="fas fa-download text-orange-600 text-lg"></i></a> </td>
                        <!-- <td><button onclick="sendFile('<?php echo $file['fileID'] ?>')"><i class="fas fa-share"></i></button></td> -->
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

    <?php
    } 
}

?>