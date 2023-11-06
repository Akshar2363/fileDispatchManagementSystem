<?php
include "includes/db.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Dispatch | Home</title>
    <link href="assets/css/index.css" rel="stylesheet">
    <link href="assets/css/navbar.css" rel="stylesheet">
    <script src="assets/js/tailwind.js"></script>
    <script src="https://kit.fontawesome.com/c97f0fb9ac.js" crossorigin="anonymous"></script>
</head>

<body id='theme' class="theme-dark body">
    <div class="navbar">
        <?php
        require "includes/navbar.php"
        ?>
    </div>
    <div class="body flex flex-col items-center justify-center">
        FILE DISPATCH MANAGEMENT SYSTEM
    </div>
</body>

</html>