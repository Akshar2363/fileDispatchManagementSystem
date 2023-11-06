<script>
    function deleteFile(fileID, filename){
        if(confirm('Are you sure and want to delete the file ?')){
            $.ajax({
                type: 'GET',
                url: `ajaxCalls/deleteFile.php?fileID=${fileID}&fileName=${filename}`,
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
</script>

<?php
$dirPath = 'userFolders/' . $_SESSION['currentPath'];
$userID = $_SESSION['userID'];
$folderID = $_SESSION['folders'][$_SESSION['currentFolderIndex']];
$files = scandir($dirPath);
?>

<?php
$sql = "SELECT * FROM files WHERE userID='$userID' and folderID='$folderID'";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) != 0) {
?>
    <table>
        <thead>
            <th>File ID</th>
            <th>File Name</th>
            <th>File Type</th>
            <th colspan="3">Actions</th>
        </thead>
        <tbody>
            <?php
            foreach ($result as $file) {
            ?>
                <tr>
                    <td> <?php echo $file['fileID']; ?></td>
                    <td> <?php echo $file['fileName']; ?></td>
                    <td> <?php echo $file['fileType']; ?></td>
                    <td><button onclick="deleteFile('<?php echo $file['fileID']; ?>', '<?php echo $file['fileName']; ?>')"><i class="fas fa-trash"></i></button></td>
                    <td> <a href="<?php echo 'userFolders/'.$_SESSION['currentPath'].'/'.$file['fileName'] ?>" download><i class="fas fa-download"></i></a> </td>
                    <td><button onclick="sendFile('<?php echo $file['fileID'] ?>')"><i class="fas fa-share"></i></button></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

<?php
} else {

?>
    <div>No Files Found</div>

<?php

}

?>