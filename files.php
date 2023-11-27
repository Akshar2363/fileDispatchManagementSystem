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
    <table class="fileTable w-full">
        <thead class="p-2 ">
            <th class="p-2"></th>
            <th class="p-2">File Name</th>
            <th class="p-2">File Type</th>
            <th class="p-2" colspan="3">Actions</th>
        </thead>
        <tbody class="p-2">
            <?php
            foreach ($result as $file) {
            ?>
                <tr class="p-2">
                    <td class="p-2"><i class="fa fa-file text-sky-400 text-lg"></i></td>
                    <td class="p-2"> <?php echo $file['fileName']; ?></td>
                    <td class="p-2"> <?php echo $file['fileType']; ?></td>
                    <td class="p-2"><button onclick="deleteFile('<?php echo $file['fileID']; ?>', '<?php echo $file['fileName']; ?>')"><i class="fas fa-trash text-red-500 text-lg"></i></button></td>
                    <td class="p-2"> <a href="<?php echo 'userFolders/'.$_SESSION['currentPath'].'/'.$file['fileName'] ?>" download><i class="fas fa-download text-orange-600 text-lg"></i></a> </td>
                    <td class="p-2"><button onclick="sendFile('<?php echo $file['fileID'] ?>')"><i class="fas fa-share text-green-500 text-lg"></i></button></td>
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