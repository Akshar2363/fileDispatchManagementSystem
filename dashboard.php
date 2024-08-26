<?php
include "includes/db.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Dispatch | Dashboard</title>
    <script src="assets/js/tailwind.js"></script>
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/leftbar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/c97f0fb9ac.js" crossorigin="anonymous"></script>
</head>


<body id='theme' class="theme-dark flex min-h-[100vh] flex-col">

    <?php
    if (!isset($_SESSION['userID'])) {
    ?>
        <script>
            alert("Please login to view your Files...");
            location.href = 'login.php';
        </script>
    <?php

    }
    ?>

    <div class="navbar w-full">
        <?php
        require "includes/navbar.php"
        ?>
    </div>

    <div class="body dashboardBody flex flex-col lg:flex-row w-full">
        <?php
        require "includes/leftbar.php"
        ?>
        <div class="bodyContent w-full overflow-y-scroll p-2 flex flex-col gap-3">
            <div class="navigation flex flex-row items-center justify-start gap-2 border-b ">
                <button class="backBtn rounded-lg" <?php echo $_SESSION['currentFolderIndex'] == 0 ? 'disabled' : ''; ?> onclick="prevFolder()"><i class="fa fa-angle-left text-3xl px-2"></i></button>
                <div class="currentPath text-lg w-full p-4 overflow-x-scroll">
                    <?php echo $_SESSION['currentPath'] ?>
                </div>
            </div>
            <div class="filesAndFolders grid grid-cols-1 lg:grid-cols-2 w-full gap-4">
                <div class="folders text-center ">
                    <button class="createFolderBtn py-1 px-4 lg:p-4 text-lg flex flex-row items-center justify-start gap-2" onclick="addFolder()"><i class="fa-solid fa-folder-plus text-lg"></i>
                        <p>Create Folder</p>
                    </button>
                    <?php include "folders.php"; ?>
                </div>
                <div class="files text-center">
                    <button class="createFileBtn uploadFile py-1 px-4 lg:p-4 text-lg flex flex-row items-center justify-start gap-2" onclick="toggleFileUploadModal()"><i class="fa-solid fa-file-arrow-up text-lg"></i>
                        <p>Upload File</p>
                    </button>
                    <?php include "files.php"; ?>
                </div>
                <!-- //CREATE ENDPOINTS FOR FETCH FOLDER, FETCH FILES ADD FOLDER, ADD FILE, USING A DYNAMIC URL  -->
            </div>
        </div>
    </div>

    

<div id="fileUploadModal" class="hidden absolute top-0 left-0 flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div id="fileUploadOverlay" class="hidden fixed top-0 left-0 h-full w-full bg-[#00000080] z-30 h-[100vh] w-[100vw]" onclick="toggleFileUploadModal()"></div>
    <div class="relative w-full max-w-md max-h-full z-40">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" id="fileUploadModalCloseBtn" onclick="toggleFileUploadModal()" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">Upload your file</h3>
                <div class="uploadForm flex flex-col items-center justify-center gap-3">

                    <form class="flex items-center justify-center w-full" id='fileUploadForm'>
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover-bg-gray-100 dark:border-gray-600 dark:hover-border-gray-500 dark:hover-bg-gray-600" ondrop="handleFileDrop(event)" ondragover="handleDragOver(event)">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400" id='fileUploadName' name="fileUploadName"></p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" id='fileupload' name='fileupload' onchange="displayFileName()" />
                        </label>
                    </form>
                    <button onclick="addFile()" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

                </div>
            </div>
        </div>
    </div>
</div>


</body>

<script>
    function prevFolder(folderID, folderName) {
        $.ajax({
            url: 'ajaxCalls/prevFolder.php',
            success: function(response) {
                location.reload();
            }
        });
    }
    function addFolder() {
        let folderName = prompt('Folder Name');
        if (folderName != null) {
            $.ajax({
                type: 'GET',
                url: `ajaxCalls/addFolder.php?folderName=${folderName}`,
                success: function(response) {
                    alert(response);
                    location.reload();
                }
            });
        }
    }

    function addFile() {
        const formData = new FormData(document.getElementById("fileUploadForm"));
        $.ajax({
            type: 'POST',
            url: 'ajaxCalls/addFile.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response);
                location.reload();
            }
        });
    }

    function toggleFileUploadModal() {
        // const closeBtn = document.getElementById('fileUploadModalCloseBtn');
        const overlay = document.getElementById('fileUploadOverlay');
        const modal = document.getElementById('fileUploadModal');

        overlay.classList.toggle('hidden');
        modal.classList.toggle('hidden');
    }



    function displayFileName() {
        const fileInput = document.getElementById('dropzone-file');
        const fileNameParagraph = document.getElementById('fileUploadName');
        if (fileInput.files.length > 0) {
            fileNameParagraph.textContent = "Selected file: " + fileInput.files[0].name;
        } else {
            fileNameParagraph.textContent = "";
        }
    }

    function handleFileDrop(event) {
        event.preventDefault();
        const fileInput = document.getElementById('dropzone-file');
        fileInput.files = event.dataTransfer.files;
        displayFileName();
    }

    function handleDragOver(event) {
        event.preventDefault();
    }
</script>

</html>