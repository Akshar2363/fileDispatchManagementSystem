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

        <div class="homeTop relative w-full grid grid-cols-1 lg:grid-cols-2">
            <div class="left h-full p-4 flex items-center justify-center w-full">
                <div class="leftSection w-fit flex flex-col gap-4 items-start justify-center leading-relaxed font-extrabold text-3xl lg:text-5xl text-white">
                    <span>Reimagine</span> <span>Your Approach</span> <span>to File</span> <span>Management</span>
                    <div class="text-xl lg:text-2xl font-semibold font-mono mt-2">
                    Share files with ease
                    </div>
                </div>
            </div>
            <div class="right relative top-[300px] h-[1200px] lg:h-[600px] w-full">
                <div class="outer circle top-[50%] flex items-center justify-center">
                    <img class="absolute" src="assets/images/round3.png" alt="">
                </div>
                <div class="middle circle top-[50%] flex items-center justify-center">
                    <img class="absolute" src="assets/images/round2.png" alt="">
                </div>
                <div class="inner circle top-[50%] flex items-center justify-center">
                    <img class="absolute" src="assets/images/round.png" alt="">
                </div>
            </div>
        </div>


    </div>
</body>

</html>