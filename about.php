<?php
include "includes/db.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Dispatch | About</title>
    <script src="assets/js/tailwind.js"></script>
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/c97f0fb9ac.js" crossorigin="anonymous"></script>
</head>

<body id='theme' class="theme-dark flex min-h-[100vh] flex-col">

    <div class="navbar w-full">
        <?php
        require "includes/navbar.php"
        ?>
    </div>

    <div class="dashboardBody flex flex-row w-full">
        
        <div class="bodyContent body">
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores perferendis qui iure debitis magnam, possimus voluptatem, deleniti earum perspiciatis neque ratione dolor hic, expedita quisquam adipisci cupiditate ducimus cumque. Impedit?
        </div>
    </div>

</body>
</html>
