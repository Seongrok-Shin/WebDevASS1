<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Web Development Assignment 1</title>
</head>
<body>    
    <?php
        $backhome = '<a href="http://rpy1983.cmslamp14.aut.ac.nz/assign1/"><input class="button-1" type="submit" value = "Homepage"/></a>';
        $search = $_GET['Search'];
        if(empty($search)){
            echo "Search bar cannot be empty to search! Please fill in!";
            echo $backhome;
        }elseif($search !== $status){
            echo "The search status must be match with exist status!";
        } else{
            require_once('../../conf/settings.php');
            $conn = @mysqli_connect(
                $host,
                $user,
                $pswd,
                $dbnm
            );

            $is_exist = "SELECT * FROM PostStatus";
            if(mysqli_query($conn,$is_exist)){

            } else{
                
            }
        }
    ?>
    <a href="http://rpy1983.cmslamp14.aut.ac.nz/assign1/">Return to Home Page </a>
</body>
</html>