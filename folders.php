<script>
    function nextFolder(folderID, folderName) {
        $.ajax({
            type: 'POST',
            url: 'ajaxCalls/nextFolder.php',
            data: {
                folderID: folderID,
                folderName: folderName
            },
            success: function(response) {
                location.reload();
            }
        });
    }

    function deleteFolder(folderID, folderName) {
        if (confirm('Are you sure and want to delete the folder ?')) {
            $.ajax({
                type: 'GET',
                url: `ajaxCalls/deleteFolder.php?folderID=${folderID}&folder=${folderName}`,
                success: function(response) {
                    location.reload();
                }
            });
        }
    }


    function toggleFolderActionDropdown(button) {
        var parentTd = button.parentNode;
        var dropdown = parentTd.querySelector('.folderActionDropdown');
        if (dropdown) {
            dropdown.classList.toggle('hidden');
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
            <th class="p-2 w-[10%]"></th>
            <th class="p-2 overflow-x-scroll">Folders</th>
            <th class="p-2">Actions</th>
        </thead>
        <tbody class="p-2">
            <?php
            foreach ($result as $folder) {
            ?>
                <tr class="p-2">
                    <td class="p-2"> <i class="fas fa-folder text-yellow-600 text-lg"></i> </td>
                    <td class="p-2 text-start"><button onclick="nextFolder(<?php echo $folder['folderID']; ?>, '<?php echo $folder['folderName']; ?>')"><?php echo $folder['folderName']; ?></button></td>
                    <td class="p-2 relative">
                        <button onclick="toggleFolderActionDropdown(this)" data-dropdown-toggle="dropdownDotsHorizontal" class="folderActionDropdownBtn hover:bg-gray-300 p-2 rounded-xl" type="button">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                            </svg>
                        </button>

                        <div class=" folderActionDropdown z-10 absolute top-[100%] right-0 hidden text-start text-lg bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <div class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="folderActionDropdown">
                                <button class="p-2 w-full text-start " onclick="deleteFolder(<?php echo $folder['folderID']; ?>, '<?php echo $folder['folderName']; ?>')"><i class="fas fa-trash text-gray-100 text-lg"></i> Delete</button>
            
                            </div>
                        </div>
                    </td>
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