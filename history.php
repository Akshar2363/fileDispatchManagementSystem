<?php
include "includes/db.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Dispatch | History</title>
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
    <?php
    require "includes/navbar.php"
    ?>

    <div class="body dashboardBody flex flex-col lg:flex-row w-full">
    <?php
        require "includes/leftbar.php"
        ?>
        <div class="bodyContent w-full h-full overflow-y-scroll p-2 flex flex-col gap-3">
            <?php
            $userID = $_SESSION['userID'];
            $query = "  SELECT * FROM dispatch, user, files 
                        WHERE ((dispatchTo='$userID' AND user.userID=dispatchBy) OR (dispatchBy='$userID' AND user.userID=dispatchTo)) AND dispatch.fileID=files.fileID 
                        GROUP BY dispatchTimeStamp 
                        ORDER BY dispatchTimestamp DESC
                    ";

            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                $groupedResults = array();

                foreach ($result as $row) {
                    $timestamp = strtotime($row['dispatchTimestamp'])-16200;
                    $currentTime = time();
                    $differenceInMinutes = round(($currentTime - $timestamp) / 60);

                    // Determine the date format
                    if (date("Y-m-d", $timestamp) == date("Y-m-d")) {
                        $date = "Today";
                    } elseif (date("Y-m-d", $timestamp) == date("Y-m-d", strtotime("-1 day"))) {
                        $date = "Yesterday";
                    } else {
                        $date = date("jS F Y", $timestamp);
                    }

                    if (!isset($groupedResults[$date])) {
                        $groupedResults[$date] = array();
                    }

                    // Convert minutes into hours, days, weeks, or years
                    if ($differenceInMinutes <= 0) {
                        $timeAgo = "now";
                    }
                    else if ($differenceInMinutes < 60) {
                        $timeAgo = $differenceInMinutes . " minutes ago";
                    } elseif ($differenceInMinutes < 1440) {
                        $timeAgo = round($differenceInMinutes / 60) . " hours ago";
                    } elseif ($differenceInMinutes < 10080) {
                        $timeAgo = round($differenceInMinutes / 1440) . " days ago";
                    } elseif ($differenceInMinutes < 525600) {
                        $timeAgo = round($differenceInMinutes / 10080) . " weeks ago";
                    } else {
                        $timeAgo = round($differenceInMinutes / 525600) . " years ago";
                    }

                    if ($row['dispatchTo'] == $_SESSION['userID']) {
                        $groupedResults[$date][] = "<div class='receivedEntry px-4 flex flex-row items-center justify-between p-2 w-full'><div>Received file <span class='font-semibold'>{$row['fileName']}</span> from {$row['Name']}</div> <div>{$timeAgo}</div></div>";
                    } else {
                        $groupedResults[$date][] = "<div class='receivedEntry px-4 flex flex-row items-center justify-between p-2 w-full'><div>Sent file <span class='font-semibold'>{$row['fileName']}</span> to {$row['Name']}</div> <div>{$timeAgo}</div></div>";
                    }
                }
            ?>

                    <?php
                    foreach ($groupedResults as $date => $entries) {
                    ?>
                        <div class="receivedDayEntry flex flex-col">
                            <div class="flex flex-row items-center">

                                <i class="fa fa-calendar"></i>
                                <div class="receivedDate p-2 font-semibold hover:underline w-fit"><?php echo $date ?></div>
                            </div>
                            <?php
                        foreach ($entries as $entry) {
                            echo $entry;
                        }
                        ?>
                        </div>
                        <?php
                    }
                    ?>


            <?php

            } else {
            ?>
                <div class="w-full h-full flex items-center justify-center flex-col gap-8">
                    <div class="text-center text-xl md:text-2xl lg:text-4xl ">No History of File Shares</div>
                    <i class="fa fa-history text-gray-200 text-9xl opacity-5" ></i>
                </div>
            <?php
            }
            ?>



        </div>
    </div>

</body>

</html>