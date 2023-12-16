<script>
    function deleteFile(fileID, filename) {
        if (confirm('Are you sure and want to delete the file ?')) {
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

    function sendFile() {
        const formData = new FormData(document.getElementById("shareFileForm"));
        $.ajax({
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            url: `ajaxCalls/shareFile.php`,
            success: function(response) {
                alert(response);
                location.reload();
            }
        });
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
            <th class="p-2">File</th>
            <th class="p-2">File Type</th>
            <th class="p-2" colspan="3">Actions</th>
        </thead>
        <tbody class="p-2">
            <?php
            foreach ($result as $file) {
            ?>
                <tr class="p-2">
                    <td class="p-2 w-[10%]"><i class="fa fa-file text-sky-400 text-lg"></i></td>
                    <td class="p-2 text-start overflow-x-scroll"> <?php echo $file['fileName']; ?></td>
                    <td class="p-2"> <?php echo $file['fileType']; ?></td>

                    <td class="p-2 relative">
                        <button onclick="toggleFileActionDropdown(this)" data-dropdown-toggle="dropdownDotsHorizontal" class="fileActionDropdownBtn hover:bg-gray-300 p-2 rounded-xl" type="button">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                            </svg>
                        </button>

                        <div class=" fileActionDropdown z-10 absolute top-[100%] right-0 hidden text-start text-lg bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <div class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="fileActionDropdown">
                                <button class="p-2 w-full text-start" onclick="deleteFile('<?php echo $file['fileID']; ?>', '<?php echo $file['fileName']; ?>')"><i class="fas fa-trash text-gray-100 text-lg"></i> Delete</button>
                                 <a class="p-2 w-full text-start block" href="<?php echo 'userFolders/' . $_SESSION['currentPath'] . '/' . $file['fileName'] ?>" download><i class="fas fa-download text-gray-100 text-lg"></i> Download</a> 
                                <button class="p-2 w-full text-start " onclick="toggleShareFileModal()"><i class="fas fa-share text-gray-100 text-lg"></i> Share</button>
                            </div>
                        </div>
                    </td>
                </tr>



                <div id="shareFileModal" class="hidden absolute top-0 left-0 flex items-center justify-center w-full p-1 lg:p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100vh-80px)]">
                    <div id="shareFileOverlay" class="hidden fixed top-0 left-0 h-full w-full bg-[#00000080] z-30 h-[100vh] w-[100vw]" onclick="toggleShareFileModal()"></div>
                    <div class="relative w-full max-w-md max-h-full z-40">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button type="button" id="shareFileModalCloseBtn" onclick="toggleShareFileModal()" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-3 lg:p-6">
                                <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">Share your file</h3>
                                <div class="uploadForm flex flex-col items-center justify-center gap-3">
                                    <form class="flex items-center justify-center w-full" id='shareFileForm'>
                                        <div class="flex w-full rounded-lg">
                                            <span class="rounded-l-lg inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <input required type="text" id="receiverID" name="receiverID" class="rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="User ID">
                                        </div>
                                        <div class="flex w-full rounded-lg">
                                            <input required type="text" id="comments" name="comments" class="rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Comments">
                                        </div>
                                        <input type="number" name="fileID" id="fileID" class="hidden" value="<?php echo $file['fileID']; ?>">
                                    </form>
                                    <button type="submit" name="submit" onclick="sendFile()" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


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


<script>
   

    function toggleFileActionDropdown(button) {
        var parentTd = button.parentNode;
        var dropdown = parentTd.querySelector('.fileActionDropdown');
        if (dropdown) {
            dropdown.classList.toggle('hidden');
        }
    }

    function toggleShareFileModal() {
        // const closeBtn = document.getElementById('shareFileModalCloseBtn');
        const overlay = document.getElementById('shareFileOverlay');
        const modal = document.getElementById('shareFileModal');

        overlay.classList.toggle('hidden');
        modal.classList.toggle('hidden');
    }
</script>