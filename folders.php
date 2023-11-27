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

<table class="folderTable w-full">

    <thead class="p-2">
        <th class="p-2"></th>
        <th class="p-2">Folder Name</th>
        <th class="p-2">Actions</th>
    </thead>
    <tbody class="p-2">
        <?php
        foreach ($result as $folder) {
            ?>
            <tr class="p-2">
                <td class="p-2" > <i class="fas fa-folder text-yellow-600 text-lg"></i> </td>
                <td class="p-2" ><button onclick="nextFolder(<?php echo $folder['folderID']; ?>, '<?php echo $folder['folderName']; ?>')"><?php echo $folder['folderName']; ?></button></td>
                <td class="p-2" ><button onclick="deleteFolder(<?php echo $folder['folderID']; ?>, '<?php echo $folder['folderName']; ?>')"><i class="fas fa-trash text-red-500 text-lg"></i> </button></td>
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
