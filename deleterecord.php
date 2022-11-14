<?php
require("connection.php");
$id = $_GET['id'];
$sql = 'SELECT Profile FROM students WHERE Sr_no='.$id;
$result = mysqli_query($conn, $sql);

// getting the image filename and removing it
$profile = mysqli_fetch_assoc($result)['Profile'];
unlink('Uploads/'.$profile);

// Deleting the data from the database.
$deletesql = 'DELETE FROM students where Sr_no='.$id;
$deleteresult = mysqli_query($conn, $deletesql);

// Message ...
if ($deleteresult){
   
    echo '<script type = "text/Javascript">';
    echo 'alert("Record Deleted Successfully...");';
    echo 'window.location.href="submit.php"';
    echo '</script>';
}
else{
    echo '<script>window.alert("Record Update Failed...");</script>';
}

exit();

?>