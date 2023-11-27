<?php
include "includes/db.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Dispatch | Received Files</title>
    <script src="assets/js/tailwind.js"></script>
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/receivedFiles.css">
    <link rel="stylesheet" href="assets/css/leftbar.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/c97f0fb9ac.js" crossorigin="anonymous"></script>
</head>

<body id='theme' class="theme-dark flex min-h-[100vh] flex-col">

    <?php
    if (!isset($_SESSION['userName'])) {
    ?>
        <script>
            alert("Please login to view your Received Files...");
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
                <div class="receivedFiles text-center ">
                    <?php include "getReceivedFiles.php"; ?>
                </div>
        </div>
    </div>

</body>


</html>