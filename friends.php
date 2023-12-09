<?php
include "includes/db.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Dispatch | Find Friends</title>
    <script src="assets/js/tailwind.js"></script>
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/leftbar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/c97f0fb9ac.js" crossorigin="anonymous"></script>
</head>

<style>
    #searchFriends:focus {
        outline: none;
    }
</style>

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

    <div class="body dashboardBody flex flex-col lg:flex-row w-full">
        <?php
        require "includes/leftbar.php"
        ?>
        <div class="bodyContent w-full overflow-y-scroll grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 ">

            <div class="xl:border-b-0 border-b md:border-r border-dashed friendsSection border-dashed yourFriends flex flex-col w-full gap-4 p-4 ">

                <?php
                $userID = $_SESSION['userID'];
                $query = "SELECT * from friends, user WHERE 
                    ((friends.userID='$userID' AND friends.friendID=user.userID) 
                    OR 
                    (friends.friendID='$userID' AND friends.userID=user.userID)) 
                    AND status='Accepted'";

                $result = mysqli_query($con, $query);

                ?>
                <div>Your Friends (<?php echo mysqli_num_rows($result) ?>)</div>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $row) {
                ?>
                        <div class="text-lg flex flex-row items-center justify-between w-full ">
                            <div class="profile flex flex-row items-center gap-3">
                                <img src="assets/icons/profile.png" class="w-[48px]" alt="">
                                <div class="profileDetails flex flex-col ">
                                    <p class="name text-lg font-semibold"><?php echo $row['Name'] ?></p>
                                    <p class="username "><?php echo $row['userName'] ?></p>
                                </div>
                            </div>
                            <button onclick="deleteFriend('<?php echo $row['userID'] ?>')" class="addFriend bg-red-500 rounded-lg px-4 py-1 text-white"> <i class="fa fa-trash"></i> </button>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="xl:border-b-0 border-b xl:border-r border-dashed friendsSection border-dashed  friendRequestsSent flex flex-col w-full gap-4 p-4 ">


                <?php
                $userID = $_SESSION['userID'];
                $query = "SELECT * from friends, user WHERE friends.userID='$userID' AND friends.friendID=user.userID AND status='Pending'";
                $result = mysqli_query($con, $query);
                ?>
                <div>Requests Sent (<?php echo mysqli_num_rows($result) ?>)</div>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $row) {
                ?>
                        <div class="text-lg flex flex-row items-center justify-between w-full ">
                            <div class="profile flex flex-row items-center gap-3">
                                <img src="assets/icons/profile.png" class="w-[48px]" alt="">
                                <div class="profileDetails flex flex-col ">
                                    <p class="name text-lg font-semibold"><?php echo $row['Name'] ?></p>
                                    <p class="username "><?php echo $row['userName'] ?></p>
                                </div>
                            </div>
                            <button onclick="withdrawRequest('<?php echo $row['userID'] ?>')" class="acceptRequest py-1 px-4 rounded-lg text-white bg-red-500"><i class="fa fa-trash"></i></button>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="xl:border-b-0 border-b md:border-r  border-dashed friendsSection border-dashed  friendRequestsReceived flex flex-col w-full gap-4 p-4 ">


                <?php
                $userID = $_SESSION['userID'];
                $query = "SELECT * from friends, user WHERE friends.friendID='$userID' AND friends.userID=user.userID AND status='Pending'";
                $result = mysqli_query($con, $query);
                ?>
                <div>Requests Received (<?php echo mysqli_num_rows($result) ?>)</div>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $row) {
                ?>
                        <div class="text-lg flex flex-row items-center justify-between w-full ">
                            <div class="profile flex flex-row items-center gap-3">
                                <img src="assets/icons/profile.png" class="w-[48px]" alt="">
                                <div class="profileDetails flex flex-col ">
                                    <p class="name text-lg font-semibold"><?php echo $row['Name'] ?></p>
                                    <p class="username "><?php echo $row['userName'] ?></p>
                                </div>
                            </div>
                            <button onclick="acceptFriend('<?php echo $row['userID'] ?>')" class="acceptRequest py-1 px-4 rounded-lg text-white bg-green-500">Yes</button>
                            <button onclick="rejectFriend('<?php echo $row['userID'] ?>')" class="rejectRequest py-1 px-4 rounded-lg text-white bg-gray-500">No</button>

                        </div>
                <?php
                    }
                }
                ?>
            </div>

            <div class="md:xl:border-b-0 border-b friendsSection border-dashed  findFriends flex flex-col w-full gap-4 p-4">
                <?php
                $userID = $_SESSION['userID'];
                $query = "SELECT *
                FROM user 
                WHERE userID NOT IN (
                    (SELECT friendID
                    FROM friends
                    WHERE friends.userID = '$userID') UNION
                    (SELECT userID
                    FROM friends
                    WHERE friends.friendID = '$userID')
                )
                AND userID <> '$userID'";

                $result = mysqli_query($con, $query);
                ?>
                <div>Suggested Friends (<?php echo mysqli_num_rows($result) ?>)</div>
                <div class="searchBar bg-white flex flex-row items-center rounded-lg">
                    <i class="fa fa-magnifying-glass text-gray-600 px-2 bg-dark"></i>
                    <input type="text" id="searchFriends" onkeyup="searchFriends()" placeholder="Search for names.." class="p-2 rounded-lg w-full text-black">
                </div>

                <ul id="friendList">
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        foreach ($result as $row) {
                    ?>
                            <li>
                                <div class="text-lg flex flex-row items-center justify-between w-full ">
                                    <div class="profile flex flex-row items-center gap-3">
                                        <img src="assets/icons/profile.png" class="w-[48px]" alt="">
                                        <div class="profileDetails flex flex-col ">
                                            <p class="name text-lg font-semibold"><?php echo $row['Name'] ?></p>
                                            <p class="username"><?php echo $row['userName'] ?></p>
                                        </div>
                                    </div>
                                    <button onclick="requestFriend('<?php echo $row['userID'] ?>')" class="addFriend bg-green-500 rounded-lg px-4 py-1 text-white"> + </button>
                                </div>
                            </li>

                    <?php
                        }
                    }
                    ?>

                </ul>

            </div>
        </div>
    </div>

</body>

<script>
    function requestFriend(userID) {
        $.ajax({
            type: 'POST',
            url: "ajaxCalls/requestFriend.php",
            data: {
                userID: userID
            },
            success: function(response) {
                alert(response);
                location.reload();
            },
            error: function(error) {
                alert(error);
            }
        });
    }

    function rejectFriend(userID) {
        $.ajax({
            type: 'POST',
            url: "ajaxCalls/rejectFriend.php",
            data: {
                userID: userID
            },
            success: function(response) {
                alert(response);
                location.reload();
            },
            error: function(error) {
                alert(error);
            }
        });
    }

    function acceptFriend(userID) {
        $.ajax({
            type: 'POST',
            url: "ajaxCalls/acceptFriend.php",
            data: {
                userID: userID
            },
            success: function(response) {
                alert(response);
                location.reload();
            },
            error: function(error) {
                alert(error);
            }
        });
    }

    function deleteFriend(userID) {
        $.ajax({
            type: 'POST',
            url: "ajaxCalls/deleteFriend.php",
            data: {
                userID: userID
            },
            success: function(response) {
                alert(response);
                location.reload();
            },
            error: function(error) {
                alert(error);
            }
        });
    }

    function withdrawRequest(userID) {
        $.ajax({
            type: 'POST',
            url: "ajaxCalls/withdrawRequest.php",
            data: {
                userID: userID
            },
            success: function(response) {
                alert(response);
                location.reload();
            },
            error: function(error) {
                alert(error);
            }
        });
    }

    function searchFriends() {
        // Declare variables
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById('searchFriends');
        filter = input.value.toUpperCase();
        ul = document.getElementById("friendList");
        li = ul.getElementsByTagName('li');
        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByClassName("name")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
</script>

</html>