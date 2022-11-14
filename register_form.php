<html>
<!-- This file is common for new registeration and Updatation of data -->

<head>
    <title>Register Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="validate.js"></script>
</head>

<body style="width: 100%;background-image:url('Images/me and the skeleton.jpg');background-repeat:no-repeat;background-size:100%;background-attachment:fixed;">
    <style>
        /* First two block of code here is used to remove the scroll in input type=number scroll. */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        /* Preview Image */
        #display_image {
            max-width: 100%;
            max-height: 40%;
            border: 0px solid black;
            background-position: center;
            background-size: cover;
        }
    </style>

    <?php

    // Database Connection
    require "connection.php";

    // Updation of data - if the id is pass - then this is updatation, else new registeration.
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];

        // Fetching the data from id.
        $selectalsql = 'SELECT * FROM students where Sr_no=' . $id;
        $result = mysqli_query($conn, $selectalsql);
        $data = mysqli_fetch_assoc($result);

        // Storing it into the variables.
        $name = $data['Name'];
        $email = $data['Email'];
        $phone = $data['Phone_no'];
        $address = $data['Address'];
        $file = $data['Profile'];
        $action = "update.php";  // Action performed by the form

    } else {
        // NULL values for New Registeration.
        $id = NULL;
        $name = NULL;
        $email = NULL;
        $phone = NULL;
        $address = NULL;
        $file = NULL;
        $action = "submit.php";  // Action performed by the Form
    }

    ?>

    <!-- <<<<<<<<<<<<<<<<   Form   >>>>>>>>>>>>>>>>> -->


    <div style="background-color: rgba(255, 255, 255, 0.623);border: 2px solid gray;border-radius:10px;padding:2%; margin: 2%;margin-left:58%; width: 40%;">


        <form action='<?php echo $action; ?>' onsubmit="return Validateentries(document.form1.id, document.form1.Name, document.form1.email, document.form1.phone, document.form1.file)" method="post" name="form1" enctype="multipart/form-data">
            <label style="margin-bottom:3%;font-weight:bold;text-align: center;display: block; font-size: 30px;">Register Form</label>
            <div class="mb-3" style="padding-left: 20px; padding-right: 20px;">
                <input placeholder='Full Name' class="form-control" value="<?php echo $name; ?>" name="Name" required>
            </div>
            <div class="mb-3" style="display: flex;">
                <div style="width: 31%; padding-left: 20px;">
                    <input style="max-width:100%;border-radius:2px 0px 0px 2px; border-right:0px solid gray" placeholder="Email" class="form-control" value="<?php echo $email; ?>" name="email" required>
                </div>
                <span class="input-group-text" style=" width:130px;border-radius:0px 2px 2px 0px;" id="basic-addon1">@example.com</span>
                <div style="width: 50%; padding-left: 20px; padding-right: 20px;">
                    <input placeholder="Phone No." type='number' class="form-control" value="<?php echo $phone; ?>" name="phone" required>
                </div>
            </div>
            <div class="mb-3" style="padding-left: 20px; padding-right: 20px;">
                <textarea placeholder="Flat No., Area, Locality, Distict, State, Country." class="form-control" name="address" rows='3' required><?php echo $address ?></textarea>
            </div>
            <div class="mb-3" style="padding-left: 20px; padding-right: 20px;">
                <label for="file" class="form-label">Profile</label>
                <input type='file' id="image_input" class="form-control" name="file" <?php if ($id == NULL) {
                                                                                            echo "required";
                                                                                        } ?>>
            </div>
            <div class="mb-3" style="padding-left: 20px; padding-right: 20px;">
                <?php
                require "connection.php";
                require "show_data.php";
                if ($id != NULL) {
                    $sql = "SELECT * FROM students where Sr_no=$id";
                    $result = mysqli_query($conn, $sql);
                    $array = mysqli_fetch_assoc($result);
                    $image = $array['Profile'];
                }
                ?>

                <!-- Preview Image container -->
                <div id="display_image">
                    <?php
                    if (isset($image)) {
                    ?>
                        <script>
                            // Preview Image Script when the image is selected from none for Updation process
                            const path = 'uploads/';
                            document.querySelector('#display_image').style.width = '300px'
                            document.querySelector("#display_image").style.height = "200px"
                            document.querySelector("#display_image").style.margin = "auto"
                            document.querySelector("#display_image").style.border = "1px solid lightgray";
                            document.querySelector("#display_image").style.backgroundImage = "url('Uploads/<?php echo $image; ?>')";
                        </script>
                    <?php
                    }
                    ?>
                </div>

            </div>
            <script>
                const image_input = document.querySelector("#image_input");
                image_input.addEventListener("change", function() {
                    const reader = new FileReader();
                    reader.addEventListener("load", () => {
                        const uploaded_image = reader.result;
                        document.querySelector("#display_image").style.width = "300px";
                        document.querySelector("#display_image").style.height = "200px";
                        document.querySelector("#display_image").style.margin = "auto";
                        document.querySelector("#display_image").style.border = "1px solid lightgray";

                        document.querySelector("#display_image").style.backgroundImage = `url(${uploaded_image})`;
                    });
                    reader.readAsDataURL(this.files[0]);
                });
            </script>

            <div style="display: flex;height:10%;padding-left:1%;padding-right:1%;">
                <div class="mb-4" style="width: 50%; padding: 10px;">
                    <input type='hidden' name='id' value=<?php echo $id ?>>
                    <button type="reset" style="width:100%;" class="btn btn-primary">Reset</button>
                </div>
                <div class="mb-4" style="width:50%;padding: 10px; margin-left: 10px;">
                    <button type="submit" style="width:100%;" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>
        <form action="submit.php">
            <div class="mb-4" style="height:5%;padding-left:2%;padding-right:2%;width: 100%; text-align:right;">
                <button style="width:100%;" class="btn btn-primary">Show Data</button>
            </div>
        </form>
    </div>
</body>

</html>