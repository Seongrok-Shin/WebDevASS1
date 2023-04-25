<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, charset=utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Web Development Assignment 1</title>
</head>
<body>
    <div class="contents">
        <?php
            $homepage = '<a href="http://rpy1983.cmslamp14.aut.ac.nz/assign1/"><input class="text-white px-4 sm:px-8 py-2 sm:py-3 bg-sky-700 hover:bg-sky-800" type="submit" value = "Homepage"/></a>';
            $searchingpage = '<a href="http://rpy1983.cmslamp14.aut.ac.nz/assign1/searchstatusform.html"><input class="text-white px-4 sm:px-8 py-2 sm:py-3 bg-sky-700 hover:bg-sky-800" type="submit" value = "Search Page"/></a>';
            $postingpage = '<a href="http://rpy1983.cmslamp14.aut.ac.nz/assign1/poststatusform.php"><input class="text-white px-4 sm:px-8 py-2 sm:py-3 bg-sky-700 hover:bg-sky-800" type="submit" value = "Post Status Page"/></a>';
            $search = $_GET['Search'];
            $fp = fopen("sqlscript.txt", "a+");
            if(empty($search) || ctype_space($search)){
                echo "<p>Search bar cannot be empty or only white space to search! Please fill in!</p>";
                echo $homepage;
                echo $searchingpage;
            } else{
                require_once('../../conf/settings.php');
                $conn = @mysqli_connect(
                    $host,
                    $user,
                    $pswd,
                    $dbnm
                );
                $select_table = "SELECT * FROM PostStatus;";
                $is_exist = mysqli_query($conn,$select_table);
                fwrite($fp,$select_table . PHP_EOL);

                if($is_exist === FALSE){
                    echo "<p>No status found in the system. Please go to the post status page to post one.</p>";
                    echo "<p>Or to search another status.</p>";
                    echo $postingpage;
                    echo $searchingpage;
                } else{
                    $sql_query = "SELECT * FROM PostStatus WHERE content_status LIKE '%".$search."%';";
                    fwrite($fp, $sql_query . PHP_EOL);

                    $query_result = mysqli_query($conn,$sql_query);
                    $num_row = mysqli_num_rows($query_result);

                    if($num_row > 0){
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