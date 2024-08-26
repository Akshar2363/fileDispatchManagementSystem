<?php
include '../includes/db.php';

if(isset($_POST['submit'])){

    $userID=mysqli_real_escape_string($con, $_POST["userID"]);
    $password=md5(mysqli_real_escape_string($con, $_POST["password"]));

    $folderID = -1;
    $sql = "SELECT * FROM user NATURAL JOIN folders WHERE userID='$userID' AND password='$password'";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result)==0){
        ?>
            <script>
                alert("Incorrect UserID or Password!!");
                location.href='../login.php';
            </script>
        <?php
    }
    else{
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

        $_SESSION["userID"] = $row["userID"];
        $_SESSION['Name'] = $row["Name"];
        $_SESSION["emailID"] = $row["emailID"];
        $_SESSION["password"] = $row["password"];
        $_SESSION["contactNo"] = $row["contactNo"];
        $folderName = $_SESSION["userID"] . $_SESSION["Name"] . $_SESSION["contactNo"];
        $_SESSION["currentPath"] = $folderName;
        $_SESSION["folders"][0] = $row['folderID'];
        $_SESSION["currentFolderIndex"] = 0;
        $_SESSION["rootFolderID"] = $row['folderID'];
        ?>
            <script>
                alert("You have logged in successfully!!");
                location.href = "../dashboard.php"; 
            </script>
        <?php
    }
}
?>

