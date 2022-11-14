<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    // show_data.php is required to show table.
    require "show_data.php";
    require("connection.php");

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        $name = $_POST['Name'];
        $email = $_POST['email'];
        $phone = (int)$_POST['phone'];
        $address = $_POST['address'];
        $filename = $_FILES['file']['name'];
        $tmpname = $_FILES['file']['tmp_name'];
        $filetype = $_FILES['file']['type'];
        $uploads = 'uploads/';
        $uploadfolder = "C:/xampp/htdocs/RedSpark/Uploads/";

        $tablesql = "CREATE table if not exists students(Sr_no int not null primary key auto_increment, Name varchar(24) not null default 'Unknown', Email varchar(55) not null, Phone_no bigint not null, Address varchar(100) not null, Profile varchar(50) not null, `Timestamp` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP )";
        mysqli_query($conn, $tablesql);

        # Extracting the Maximun id for record
        $lastidsql = "SELECT max(Sr_no) as id FROM students";
        $idresult = mysqli_query($conn, $lastidsql);
        $row = mysqli_fetch_assoc($idresult);
        $id = $row['id'];                                       // Getting the maximum id.
        $id += 1;                                                       // Creating the new id by incrementing it;

        // UPloading the image and remaninng
        $uploaded_file_name = renamefilename($id, $filetype);  // this function will rename the filename - This is user defined function - available in 'submit.php'
        move_uploaded_file($tmpname, $uploads . $filename);
        rename($uploads . $filename, $uploads . $uploaded_file_name);

        $sql = "INSERT INTO students(Sr_no, Name, Email, Phone_no, Address, Profile) VALUES (NULL, '$name', '$email', $phone, '$address', '$uploaded_file_name')";
        mysqli_query($conn, $sql);
        showData();                             // Calling the function to show the table
    } else {
        showData();     // if there is no data posted then just show data table;
    }
    ?>
</body>

</html>