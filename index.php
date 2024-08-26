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
    <link rel="icon" type="image/x-icon" href="assets/icons/fileShare.png">
</head>

<body id='theme' class="theme-dark body">
    <div class="navbar">
        <?php
        require "includes/navbar.php"
        ?>
    </div>
    <div class="body flex flex-col min-h-[calc(100%-50px)]">
        <div class="homeTop w-full h-full grid grid-cols-1 md:grid-cols-2 mb-[75px]">
            <div class="left h-full p-4 flex items-center justify-center w-full">
                <div class="leftSection w-fit flex flex-col gap-4 items-start justify-center leading-relaxed font-extrabold text-3xl lg:text-5xl text-white">
                    <span>Reimagine</span> <span>Your Approach</span> <span>to File</span> <span>Management</span>
                    <div class="text-xl lg:text-2xl font-semibold font-mono mt-2">
                        Share files with ease ...
                    </div>
                    <div class="fileDispatchTitle text-white text-center text-lg lg:text-2xl mt-5">File Dispatch Management System - <span class="text-base font-semibold text-gray-500"> @anmol</span></div>
                </div>
            </div>
            <div class="right flex md:block items-center justify-center w-full h-full">
                <div class="h-full">
                    <div class="outer relative circle top-[50%] flex items-center justify-center w-[300px] md:w-full">
                        <img class="absolute w-full  lg:w-fit" src="assets/images/round3.png" alt="">
                    </div>
                    <div class="middle relative circle top-[50%] flex items-center justify-center w-[300px] md:w-full">
                        <img class="absolute w-[80%] lg:w-fit" src="assets/images/round2.png" alt="">
                    </div>
                    <div class="inner relative circle top-[50%] flex items-center justify-center w-[300px] md:w-full">
                        <img class="absolute w-[60%]  lg:w-fit" src="assets/images/round.png" alt="">
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
<?php
require "includes/footer.php"
?>

</html>