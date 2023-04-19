<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Web Development Assignment 1</title>
</head>

<body>
    <h1>Status Posting System</h1>
    <?php
    require_once('../../conf/settings.php');
    $conn = @mysqli_connect(
        $host,
        $user,
        $pswd,
        $dbnm
    );

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        echo "<p>Database connection successful</p>";
        function validateDate($date, $format = 'd/m/Y')
        {
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) === $date;
        }

        $sql_table = "CREATE TABLE IF NOT EXISTS PostStatus (  
                id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                statuscode VARCHAR(5) NOT NULL,
                nstatus VARCHAR(100) NOT NULL,
                radio VARCHAR(10),
                datechosen VARCHAR(10),
                checkbox VARCHAR(50)
                )";

        if (mysqli_query($conn, $sql_table)) {
            $statuscode = $_POST['statuscode'];
            $status = $_POST['status'];
            $share = $_POST['share'];
            $date = $_POST['date'];
            $allowlike = $_POST['allowlike'];
            $allowcomment = $_POST['allowcomment'];
            $allowshare = $_POST['allowshare'];
            $checkbox = $allowlike . $allowcomment . $allowshare;
            $result = mysqli_query($conn, $sql_table);
            $num_rows = mysqli_num_rows($result);

            if (strlen($statuscode) != 5 || substr($statuscode, 0, 1) != "S" || !is_numeric(substr($statuscode, 1, 4))) {
                echo "<p>Wrong format! The status code must start with an “S” followed by four digits, like “S0001”.</p>";
            } elseif ($num_rows > 0) {
                echo "<p>Sorry, the status code has been used. Please try another status code!</p>";
            } elseif ($status == "" || $status != "^(?!\s*$)[a-zA-Z0-9,.!? ]+$") {
                echo "<p>Wrong format! The status must not be empty and can only contain letters, numbers, spaces, commas, full stops, exclamation marks and question marks.</p>";
            } elseif ($date != validateDate($date)) {
                echo "<p>Wrong format! The date must be in the format of dd/mm/yyyy.</p>";
            } else {
                $sql_query = "INSERT INTO PostStatus (statuscode, nstatus, radio, datechosen, checkbox) 
                VALUES ('$statuscode', '$status', '$share', '$date', '$checkbox')";

                if (mysqli_query($conn, $sql_query)) {
                    echo "<p>Record is inserted successfully</p>";
                } else {
                    echo "<p>Unable to insert the record</p>";
                }
            }
        } else {
            echo "<p>Table is not created successfully</p>";
        }
    }
    ?>
</body>