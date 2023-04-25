<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, charset=utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Web Development Assignment 1</title>
</head>

<?php include('header.php'); ?>

<body>
    <h1>Status Posting System</h1>
    <div class=content>
        <?php

        $backhome = "<a href=\"http://rpy1983.cmslamp14.aut.ac.nz/assign1/\">Return to Home Page </a>";

        require_once('../../conf/settings.php');
        $conn = @mysqli_connect(
            $host,
            $user,
            $pswd,
            $dbnm
        );

        if (!$conn) {
            echo $backhome;
            die("Connection failed: " . mysqli_connect_error());
        } else {
            echo "<p>Database connection successful</p>";
            $fp = fopen("sqlscript.txt", "a+") or die("Unable to open file!");

            $sql_table = "CREATE TABLE IF NOT EXISTS PostStatus (  
                id MEDIUMINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                statuscode VARCHAR(5) NOT NULL UNIQUE,
                content_status VARCHAR(100) NOT NULL,
                share VARCHAR(10),
                chosen_date VARCHAR(10),
                checkbox VARCHAR(50)
                );";
            
            fwrite($fp, $sql_table . PHP_EOL);

            $statuscode = $_POST['statuscode'];
            $status = $_POST['status'];
            $share = $_POST['share'];
            $date = $_POST['date'];
            $list_checkbox = $_POST['checkbox'];
            $checkbox = implode(",", $list_checkbox);
            $select_query = "SELECT * FROM PostStatus WHERE statuscode = '$statuscode';";
            $num_rows = mysqli_num_rows(mysqli_query($conn, $select_query));
            $pattern = "/[0-9A-Za-z.,?! ]+$/";
            
            fwrite($fp, $select_query . PHP_EOL);

            if ($conn->query($sql_table) === FALSE) {
                echo "<p>Table is not created successfully</p>";
            } else {
                if (strlen($statuscode) != 5 || substr($statuscode, 0, 1) != "S") {
                    echo "<p>Wrong format! The status code must start with an “S” followed by four digits, like \"S0001\".</p>";
                } elseif (empty($statuscode)) {
                    echo "<p>Please fill in statuscode</p>";
                } elseif ($num_rows > 0) {
                    echo "<p>Sorry, the status code has been used. Please try another status code!</p>";
                } elseif (empty($status) || preg_match($pattern, $status) == 0) {
                    echo "<p>Wrong format! The status must not be empty and can only contain letters, numbers, spaces, commas, full stops, exclamation marks and question marks.</p>";
                } elseif (!checkdate(substr($date, 3, 2), substr($date, 0, 2), substr($date, 6, 4))) {
                    echo "<p>Wrong format! The date must be in the format of dd/mm/yyyy.</p>";
                } elseif (empty($date)) {
                    echo "<p>Please fill in date</p>";
                } else {
                    $sql_query = "INSERT INTO PostStatus (statuscode, content_status, share, chosen_date, checkbox) VALUES ('$statuscode', '$status', '$share', '$date', '$checkbox');";
                    $query_result = mysqli_query($conn, $sql_query);
                    fwrite($fp, $sql_query . PHP_EOL);
                    if (!$query_result) {
                        echo "<p>Unable to insert the record</p>";
                        fclose($fp);
                    } else {
                        echo "<p>Record is posted successfully</p>";
                        fclose($fp);
                    }
                }
            }
            mysqli_close($conn);
        }
        ?>
        <a href="http://rpy1983.cmslamp14.aut.ac.nz/assign1/">
            Return to Home Page
        </a>
    </div>
    <?php include('footer.php'); ?>
</body>

</html>