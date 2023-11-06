<?php
include '../includes/db.php';

if (isset($_POST['submit'])) {
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $name = $fname . " " . $lname;
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = md5(mysqli_real_escape_string($con, $_POST['password']));
    $dept = mysqli_real_escape_string($con, $_POST['department']);
    $phone = mysqli_real_escape_string($con, $_POST['contact']);

    mysqli_autocommit($con, false); // Turn off autocommit to start a transaction

    $sql = "SELECT username FROM user WHERE username='$username'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO user (userName, Name, emailID, password, department, contactNo) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "ssssss", $username, $name, $email, $password, $dept, $phone);
        $insertUserSuccess = mysqli_stmt_execute($stmt);

        if ($insertUserSuccess) {
            
            $sql = "SELECT * FROM user WHERE emailID='$email' AND password='$password'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $_SESSION["userID"] = $row["userID"];
            $_SESSION['userName'] = $row["userName"];
            $_SESSION['Name'] = $row["Name"];
            $_SESSION["emailID"] = $row["emailID"];
            $_SESSION["password"] = $row["password"];
            $_SESSION["department"] = $row["department"];
            $_SESSION["contactNo"] = $row["contactNo"];
            
            $folderName = $_SESSION["userID"] . $_SESSION['userName'] . $_SESSION['contactNo'];
            $parentID = -1;

            if (mkdir("../userFolders/" . $folderName)) {
                
                if(mkdir("../userFolders/" . $folderName . '/' . 'Received')){
                    $query = "INSERT INTO folders (folderName, folderDept, parentID, userID) VALUES (?, ?, ?, ?)";
                    $stmt = mysqli_prepare($con, $query);
                    mysqli_stmt_bind_param($stmt, "ssss", $folderName, $dept, $parentID, $_SESSION["userID"]);
                    $insertFolderSuccess = mysqli_stmt_execute($stmt);

                    if ($insertFolderSuccess) {
                        $insertID=mysqli_insert_id($con);
                        $_SESSION['rootFolderID'] = $insertID;
                        $_SESSION["folders"][0] = $insertID;
                        $_SESSION["currentFolderIndex"] = 0;
                        $_SESSION["currentPath"] = $folderName;
                        mysqli_commit($con); // Commit the transaction
                        mysqli_autocommit($con, true); // Re-enable autocommit
                        ?>
                        <script>
                            alert("You have successfully signed up!");
                            location.href = "../dashboard.php";
                        </script>
                        <?php
                    } else {
                        mysqli_rollback($con); // Rollback the transaction if folder insertion fails
                        mysqli_autocommit($con, true); // Re-enable autocommit

                        ?>
                        <script>
                            alert("An error occurred. Try again later!");
                            location.href = "../signup.php";
                        </script>
                        <?php
                        mysqli_stmt_close($stmt);
                    }
                }else{
                    mysqli_rollback($con); // Rollback the transaction if folder creation fails
                    mysqli_autocommit($con, true); // Re-enable autocommit
                }

            } else {
                mysqli_rollback($con); // Rollback the transaction if folder creation fails
                mysqli_autocommit($con, true); // Re-enable autocommit

                ?>
                <script>
                    alert("An error occurred. Try again later!");
                    location.href = "../signup.php";
                </script>
                <?php
                mysqli_stmt_close($stmt);
            }
        } else {
            mysqli_rollback($con); // Rollback the transaction if user insertion fails
            mysqli_autocommit($con, true); // Re-enable autocommit

            ?>
            <script>
                alert("An error occurred. Try again later!");
                location.href = "../signup.php";
            </script>
            <?php
            mysqli_stmt_close($stmt);
        }
    } else {
        ?>
        <script>
            alert("User with this username already exists");
            location.href = "../login.php";
        </script>
        <?php
    }
}
?>
