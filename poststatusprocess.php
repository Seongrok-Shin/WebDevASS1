<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, charset=utf-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Web Development Assignment 1</title>
</head>

<body>
    <h1>Status Posting System</h1>
    <div class=content>
        <?php
        //homepage button to back home.
        $homepage = '<a href="http://rpy1983.cmslamp14.aut.ac.nz/assign1/"><input class="py-2 px-4 font-semibold rounded-lg shadow-md
        text-white bg-green-500 hover:bg-green-700" type="submit" value = "Homepage"/></a>';

        // settings.php is required as there are datas that are stored as host, user, pswd, dbnm and table_name
        require_once('../../conf/settings.php');

        // make connection with mysql, this is the oriented.
        $conn = @mysqli_connect(
            $host,
            $user,
            $pswd,
            $dbnm
        );

        // if connection failed it echo the backhome button and die with error message. 
        if (!$conn) {
            echo $backhome;
            die("Connection failed: " . mysqli_connect_error());
        } else {
            //else file open to append writing sql scripts
            $fp = fopen("sqlscript.txt", "a+") or die("Unable to open file!");
            //if a table is not existed, will be created with requirements.
            $sql_table = "CREATE TABLE IF NOT EXISTS $table_name (  
                id MEDIUMINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                statuscode VARCHAR(5) NOT NULL UNIQUE,
                content_status VARCHAR(100) NOT NULL,
                share VARCHAR(10),
                chosen_date VARCHAR(10),
                checkbox VARCHAR(50)
                );";
            //creating table script will be written and
            //this is always walking to check the table is existed or not.
            //So, it could be written all the time.
            fwrite($fp, $sql_table . PHP_EOL);

            //read inputs from POST request.
            $statuscode = $_POST['statuscode'];
            $status = $_POST['status'];
            $share = $_POST['share'];
            $date = $_POST['date'];
            $list_checkbox = $_POST['checkbox'];
            //separate by ',' list of checkbox into checkbox.
            $checkbox = implode(",", $list_checkbox);
            //select query for check number of rows
            $select_query = "SELECT * FROM $table_name WHERE statuscode = '$statuscode';";
            //check number of rows that will be checked statuscode is existed or not.
            $num_rows = mysqli_num_rows(mysqli_query($conn, $select_query));
            //pattern for requirements.
            $pattern = "/[0-9A-Za-z.,?! ]+$/";
            //writing a select query into sqlscripts.txt
            fwrite($fp, $select_query . PHP_EOL);

            //if query is not existed it cannot be created and return to homepage.
            if ($conn->query($sql_table) === FALSE) {
                echo "<p>Table is not created successfully</p>";
            } else {
                //checking validation of statuscode
                if (strlen($statuscode) != 5 || substr($statuscode, 0, 1) != "S") {
                    echo "<p>Wrong format! The status code must start with an “S” followed by four digits, like \"S0001\".</p>";
                } elseif (empty($statuscode)) {
                    echo "<p>Please fill in statuscode</p>";
                } elseif ($num_rows > 0) {
                    echo "<p>Sorry, the status code has been used. Please try another status code!</p>";
                }
                //checking status is empty and match patterns then it return error message.
                elseif (empty($status) || preg_match($pattern, $status) == 0) {
                    echo "<p>Wrong format! The status must not be empty and can only contain letters, numbers, spaces, commas, full stops, exclamation marks and question marks.</p>";
                }
                //checkdate it is right format and not empty.
                elseif (!checkdate(substr($date, 3, 2), substr($date, 0, 2), substr($date, 6, 4))) {
                    echo "<p>Wrong format! The date must be in the format of dd/mm/yyyy.</p>";
                } elseif (empty($date)) {
                    echo "<p>Please fill in date</p>";
                } else {
                    //Insert datas into table
                    $sql_query = "INSERT INTO $table_name (statuscode, content_status, share, chosen_date, checkbox) VALUES ('$statuscode', '$status', '$share', '$date', '$checkbox');";
                    //the query is working
                    $query_result = mysqli_query($conn, $sql_query);
                    //Again writing the sqlscripts
                    fwrite($fp, $sql_query . PHP_EOL);
                    //if query result is failure it return error message
                    if (!$query_result) {
                        echo "<p>Unable to insert the record</p>";
                        //close file
                        fclose($fp);
                    } else {
                        //if success, return confirmation and close file.
                        echo "<p>Record is posted successfully</p>";
                        fclose($fp);
                    }
                    //frees memories.
                    mysqli_free_result($query_result);
                }
            }
            //close previously opened database connection
            mysqli_close($conn);
        }
        ?>
        <!-- button to back home -->
        <button class="py-2 px-4 font-semibold rounded-lg shadow-md
            text-white bg-green-500 hover:bg-green-700" onclick="location.href='index.html'">
            Homepage
        </button>
    </div>
</body>

</html>