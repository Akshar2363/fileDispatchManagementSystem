<script>
function nextFolder(folderID, folderName) {
    $.ajax({
        type: 'POST',
        url: 'ajaxCalls/nextFolder.php',
        data: { folderID: folderID, folderName: folderName },
        success: function(response) {
                location.reload();
        }
    });
}

function deleteFolder(folderID, folderName){
    if(confirm('Are you sure and want to delete the folder ?')){
        $.ajax({
            type: 'GET',
            url: `ajaxCalls/deleteFolder.php?folderID=${folderID}&folder=${folderName}`,
            success: function(response) {
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
$sql = "SELECT * FROM folders WHERE userID='$userID' and parentID='$folderID'";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) != 0) {
?>

<table>

    <thead>
        <th></th>
        <th>Folder ID</th>
        <th>Folder Name</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php
        foreach ($result as $folder) {
            ?>
            <tr>
                <td> <i class="fas fa-folder"></i> </td>
                <td> <?php echo $folder['folderID'] ?></td>
                <td> <button onclick="nextFolder(<?php echo $folder['folderID']; ?>, '<?php echo $folder['folderName']; ?>')"><?php echo $folder['folderName']; ?></button></td>
                <td> <button onclick="deleteFolder(<?php echo $folder['folderID']; ?>, '<?php echo $folder['folderName']; ?>')"><i class="fas fa-trash"></i> </button></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<?php
} else {
?>
    <div>No Folders Found</div>
<?php
}
?>
