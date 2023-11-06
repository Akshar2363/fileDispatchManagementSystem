<?php
include '../includes/db.php';

if(isset($_POST['filePath'])){
    echo $_POST['filePath'];
    $url =  '../' . $_POST['filePath']; 
    readfile($url);  
    $file_name = basename($url); 
        echo "File downloaded successfully"; 
}
else{
    echo "File downloading failed."; 

}

?> 