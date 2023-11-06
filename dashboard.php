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
    if (!isset($_SESSION['userName'])) {
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

    <div class="dashboardBody flex flex-col lg:flex-row w-full">
        <div class="leftbar">
            <?php
            require "includes/leftbar.php"
            ?>
        </div>
        <div class="bodyContent w-full overflow-y-scroll">
            <div class="currentPath">
                <?php echo $_SESSION['currentPath'] ?>
            </div>
            <button class="bg-red-500 " <?php echo $_SESSION['currentFolderIndex'] == 0 ? 'disabled' : ''; ?> onclick="prevFolder()">Go Back</button>
            <div class="grid grid-cols-2 w-full gap-4">
                <div class="folders text-center ">
                    <?php include "folders.php"; ?>
                </div>
                <div class="files text-center">
                    <?php include "files.php"; ?>
                </div>
                <!-- //CREATE ENDPOINTS FOR FETCH FOLDER, FETCH FILES ADD FOLDER, ADD FILE, USING A DYNAMIC URL  -->
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
</script>

</html>