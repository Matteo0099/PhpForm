<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Primo file php | Form validation | By zippo_107</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <main>
            <div class="wrapper">
                <h2>Php form</h2>
                <!-- <p>
                    <span class="error">* campi richiesti</span>
                </p> -->
                <form method="post" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]);?>">
                        Name: 
                    <input type="text" name="name" value="<?php echo $name;?>">
                    <span class="error">
                        <?php echo $nameErr;?>
                    </span>
                        E-mail: 
                    <input type="text" name="email" value="<?php echo $email;?>">
                    <span class="error">
                        <?php echo $emailErr;?>
                    </span>
                        Website: 
                    <input type="text" name="website" value="<?php echo $website;?>">
                    <span class="error">
                        <?php echo $websiteErr;?>
                    </span>
                        Comment: 
                    <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>Gender:
                    <div class="gender">
                        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female" ) echo "checked" ;?> value="female">Female
                    </div>
                    <div class="gender">
                        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male" ) echo "checked" ;?> value="male">Male
                    </div>
                    <div class="gender">
                        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other" ) echo "checked" ;?> value="other">Other
                    </div>
                    <span class="error">
                        <?php echo $genderErr;?>
                    </span>
                    <input type="submit" name="submit" value="Submit">
                </form>
            </div>
            
            <?php
                $nameErr = $emailErr = $genderErr = $websiteErr = "";
                $name = $email = $gender = $comment = $website = "";

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (empty($_POST["name"])) {
                        $nameErr = "Name is required";
                    } else {
                        $name = test_input($_POST["name"]);
                    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                        $nameErr = "Only letters and white space allowed";
                    }
                }

                if (empty($_POST["email"])) {
                    $emailErr = "Email is required";
                } else {
                    $email = test_input($_POST["email"]);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $emailErr = "Invalid email format";
                    }
                }
                    
                if (empty($_POST["website"])) {
                    $website = "";
                } else {
                    $website = test_input($_POST["website"]);
                    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
                        $websiteErr = "Invalid URL";
                    }
                }

                if (empty($_POST["comment"])) {
                    $comment = "";
                } else {
                    $comment = test_input($_POST["comment"]);
                }

                if (empty($_POST["gender"])) {
                    $genderErr = "Gender is required";
                } else {
                    $gender = test_input($_POST["gender"]);
                }
                }

                //return value
                function test_input($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
            ?>

            <div class="wrapper output">
                <h2 class="input">Your Input:</h2>
                <h4>Name:</h4>
                <?php
                    echo $name;
                ?>
                <h4>Email:</h4>
                <?php 
                    echo $email;
                ?>
                <h4>Website:</h4>
                <?php
                    echo $website;
                ?>
                <h4>Comment:</h4>    
                <?php 
                    echo $comment;
                ?>
                <h4>Gender</h4>
                <?php 
                    echo $gender;
                ?>
            </div>
        </main>
    </body>
</html>