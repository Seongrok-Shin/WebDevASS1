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
            //homepage button to back home
            $homepage = '<a href="http://rpy1983.cmslamp14.aut.ac.nz/assign1/"><input class="py-2 px-4 font-semibold rounded-lg shadow-md
            text-white bg-green-500 hover:bg-green-700" type="submit" value = "Homepage"/></a>';
            //button to back searching page
            $searchingpage = '<a href="http://rpy1983.cmslamp14.aut.ac.nz/assign1/searchstatusform.html"><input class="py-2 px-4 font-semibold rounded-lg shadow-md
            text-white bg-green-500 hover:bg-green-700" type="submit" value = "Search Page"/></a>';
            //button to back posting page
            $postingpage = '<a href="http://rpy1983.cmslamp14.aut.ac.nz/assign1/poststatusform.php"><input class="py-2 px-4 font-semibold rounded-lg shadow-md
            text-white bg-green-500 hover:bg-green-700" type="submit" value = "Post Status Page"/></a>';
            //get inputs from GET request
            $search = $_GET['Search'];
    
            $fp = fopen("sqlscript.txt", "a+");
            //check it is only with white space or empty
            //if it is, it return error messages with buttons to back where they want.
            if(empty($search) || ctype_space($search)){
                echo "<p>Search bar cannot be empty or only white space to search! Please fill in!</p>";
                echo $homepage;
                echo $searchingpage;
            } else{
                //required settings.
                require_once('../../conf/settings.php');
                //connect with mysql server
                $conn = @mysqli_connect(
                    $host,
                    $user,
                    $pswd,
                    $dbnm
                );
                //select table to check is exist.
                $select_table = "SELECT * FROM $table_name;";
                $is_exist = mysqli_query($conn,$select_table);
                //writing sql script
                fwrite($fp,$select_table . PHP_EOL);
                //if it is not existed, it return error message with buttons.
                if($is_exist === FALSE){
                    echo "<p>No status found in the system. Please go to the post status page to post one.</p>";
                    echo "<p>Or to search another status.</p>";
                    echo $postingpage;
                    echo $searchingpage;
                } else{
                    //else, selecting table to show the request search.
                    //if the keyword is contained more than one it could return all of tables.
                    $sql_query = "SELECT * FROM $table_name WHERE content_status LIKE '%".$search."%';";
                    fwrite($fp, $sql_query . PHP_EOL);

                    $query_result = mysqli_query($conn,$sql_query);
                    //check number of rows
                    $num_row = mysqli_num_rows($query_result);

                    if($num_row > 0){
                        //table settings
                        echo "<div class=\"relative overflow-x-auto\">";
                            echo "<table class=\"w-full text-sm text-left text-gray-500 dark:text-gray-400\">";
                                echo "<thead class=\"text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400\">
                                            <tr>
                                                <th scope=\"col\" class=\"px-6 py-3 bg-gray-50 dark:bg-gray-800\">Status</th>
                                                <th scope=\"col\" class=\"px-6 py-3 bg-gray-50 dark:bg-gray-800\">Status Code</th>
                                                <th scope=\"col\" class=\"px-6 py-3 bg-gray-50 dark:bg-gray-800\">Share</th>
                                                <th scope=\"col\" class=\"px-6 py-3 bg-gray-50 dark:bg-gray-800\">Date Posted</th>
                                                <th scope=\"col\" class=\"px-6 py-3 bg-gray-50 dark:bg-gray-800\">Permission</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                        //loop to make the rows of table.
                                        while($row = $query_result->fetch_assoc()) {
                                            echo "<tr class=\"bg-white border-b dark:bg-gray-800 dark:border-gray-700\">";
                                                echo "<td scope=\"row\" class=\"px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white\">". $row["content_status"] ."</td>";
                                                echo "<td scope=\"row\" class=\"px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white\">". $row["statuscode"] . "</td>";
                                                echo "<td scope=\"row\" class=\"px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white\">". $row["share"] . "</td>";
                                                echo "<td scope=\"row\" class=\"px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white\">". $row["chosen_date"] . "</td>";
                                                echo "<td scope=\"row\" class=\"px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white\">". $row["checkbox"] . "</td>";
                                            echo "</tr>";
                                        }
                                echo "</tbody>";
                            echo "</table>";
                        echo "</div>";
                        echo $homepage;
                        echo $searchingpage;
                    } else{
                        // if is not existed, error message will be shown with buttons
                        echo "<p>Given status cannot be found! Please try another status!</p>";
                        echo $homepage;
                        echo $searchingpage;
                    }
                }
            }
        ?>
    </div>
</body>
</html>