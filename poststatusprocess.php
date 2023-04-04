<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Web Development Assignment 1</title>
</head>
<body>
    require_once('../sqlinfo.inc.php');
    <h1>Status Posting System</h1>
    <?php
        $conn = @mysqil_connect($host,$username,$password,$db);
        if(!$conn){
            echo"<p>Database is failed to connect</p>";
        } else {
            $statusCode = $_POST["statuscode"];
            $status = $_POST["status"];
            $share = $_POST["share"];
            $date = $_POST["date"];
            $permission = $_POST["permisson"];
        }
    ?>
</body>