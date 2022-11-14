<!DOCTYPE html>

<head>
    <title>Document</title>
    <style>
        tr {
            font-size: 20px;
        }

        #deleteicon:hover {
            color: darkred;
        }
    </style>
</head>

<body style="width: 100%;background-image:url('Images/Minecraft Wallpaper.jpg');background-repeat:no-repeat;background-size:100%; background-attachment:fixed; ">

    <?php
    require("connection.php");
    error_reporting(0);


    // Fetching the data from the Database and showing it in the form of table...

    function showData()
    {
        global $conn, $uploads;

        $selectallsql = 'SELECT * FROM students ORDER BY Timestamp Desc';
        $dataresult = mysqli_query($conn, $selectallsql);
        $no = 1;

    ?>
        <div style="height:90px;text-align:center;width:90%;margin-top:5%;margin-left:5%;margin-right:5%;display:flex;border:1px solid gray;background-color: rgba(255, 255, 255, 0.623);">
            <h2 style="width:93%;font-size:400%;" border:1px solid gray;>Registration Data</h2>
            <form name="formname" action="register_form.php">
                <div style="margin-left:5%;margin-right:5%;width:100px;text-align:center;">
                    <button type="submit" style="margin:10px;font-weight:bold;padding-left:15px;padding-right:15px;padding-top:0px;padding-bottom:5px;font-size:40px" class='btn btn-secondary'> + </button>
                </div>
            </form>
        </div>


        <!-- Table -->

        <div style='background-color: rgba(255, 255, 255, 0.623);width: 90%; margin-left:5%; margin-right:5%;border:1px solid gray'>
            <table id='mytable' class='table'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Sr No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone_no</th>
                        <th>Address</th>
                        <th>Profile</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    if ($dataresult->num_rows > 0) {

                        while ($row = $dataresult->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $row['Name'];
                                    $no += 1; ?></td>
                                <td><?php echo $row['Email']; ?></td>
                                <td><?php echo $row['Phone_no']; ?></td>
                                <td><?php echo $row['Address']; ?></td>
                                <td><img style='height:80px; width:80px;' src="<?php echo $uploads . $row["Profile"]; ?>"><br><?php echo $row['Profile'] ?></td>
                                <?php $idname = $row["Sr_no"]; ?>
                                <td>
                                    <a href='register_form.php?id=<?php echo $idname; ?>'>
                                        <i style=" padding:5px; font-size:40px;" class="fas fa-edit"></i>
                                    </a>
                                    <a href='deleterecord.php?id=<?php echo $idname; ?>' onclick="return confirm('Are you sure want to delete this record?')">
                                        <i id="deleteicon" style="color:red;padding:5px; font-size:40px;" class="fa fa-trash"></i>
                                    </a>
                                </td>


                            </tr>
                        <?php
                        }
                    } else {
                        echo "<tr><td justify 0kl;9io= 'center' colspan = '6'> No Record Found</td></td>";
                        ?>

                </tbody>
            </table>
        </div>
<?php
                    }
                }


                // Renaming the file name 
                function renamefilename($id, $filetype)
                {
                    $ext = '';
                    if ($filetype == "image/jpeg") {
                        $ext = '.jpeg';
                    } elseif ($filetype == "image/jpg") {
                        $ext = ".jpg";
                    } elseif ($filetype == "image/png") {
                        $ext = ".png";
                    } elseif ($filetype == "image/gif") {
                        $ext = ".gif";
                    }
                    return $id . $ext;
                }
?>


</body>

</html>