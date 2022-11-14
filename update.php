<?php
require "connection.php";
require "show_data.php";

// All entries values
$id = $_POST['id'];
$name = $_POST['Name'];
$email = $_POST['email'];
$phone = (int)$_POST['phone'];
$address = $_POST['address'];
$filename = $_FILES['file']['name'];
$tmpname = $_FILES['file']['tmp_name'];
$filetype = $_FILES['file']['type'];
$uploads = 'Uploads/';


// <<<<<<< <<<<<<< if some file choosen by the user >>>>>>> >>>>>>>
// 1. Remove previous file from the folder.
// 2. Write a new file to the folder.

if (!empty($filename)) {

    // Removing the Old file..
    $sql = "SELECT Profile FROM students WHERE Sr_no=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $toremovefilename = "Uploads/" . $row['Profile'];
    if (file_exists($toremovefilename)) {
        unlink($toremovefilename);
    }

    // Renaming the New Profile.
    $newfilename = renamefilename($id, $filetype);
    move_uploaded_file($tmpname, $uploads . $filename);
    rename($uploads . $filename, $uploads . $newfilename);


    $sql = "UPDATE students SET Name='$name', Email='$email', Phone_no=$phone, Address='$address', Profile='$newfilename' WHERE Sr_no=$id";

    
} else {
    $sql = "UPDATE students SET Name='$name', Email='$email', Phone_no=$phone, Address='$address' WHERE Sr_no=$id";
}
$updateresult = mysqli_query($conn, $sql);

if ($updateresult) {
    echo '<script type = "text/Javascript">';
    echo 'alert("Record Updated Successfully...");';
    echo 'window.location.href="submit.php"';
    echo '</script>';
} else {
    echo '<script>window.alert("Record Delete Failed...");</script>';
}
?>
<script>
    window.location.href = "submit.php";
</script>