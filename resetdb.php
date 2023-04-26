<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, charset=utf-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Web Development Assignment 1</title>
</head>

<body>
    <div class="contents">
        <?php

        function drop_table()
        {
            include('../../conf/settings.php');

            $conn = @mysqli_connect($host, $user, $pswd, $dbnm);
            
            if (!$conn) {
                die("Connection Failure!" . mysqli_connect_error());
            } else {
                echo "Connect Successfully! <br />";
                
                $fp = fopen("sqlscript.txt","a+");
                $select_table = "SELECT * FROM $table_name";
                $is_exist = mysqli_query($conn, $select_table);
                
                fwrite($fp,$select_table);
                
                if (!$is_exist) {
                    die("Failed Reset Database!");
                } else {
                    $script = "DROP TABLE IF EXISTS $table_name";
                    fwrite($fp,$script);
                    $result = mysqli_query($conn, $script);
                    if ($result === TRUE) {
                        echo "Successfully Reset Database!";
                    }
                }
            }
        }

        if (isset($_POST['reset'])) {
            drop_table();
        }
        ?>
        <div class="antialiased mx-auto my-12 px-8">
            <div class="relative block md:flex items-center">
                <button class="py-2 px-4 font-semibold rounded-lg shadow-md
                text-white bg-green-500 hover:bg-green-700" onclick="location.href='index.html'">
                    Homepage
                </button>
            </div>
        </div>
    </div>
</body>