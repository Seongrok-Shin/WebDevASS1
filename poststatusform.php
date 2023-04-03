<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Web Development Assignment 1 - Status Posting System</title>
</head>
<body>
    <h1>Status Posting System</h1>
    <form method="post" action="poststatusform.php">
        <div class="input-container">
            <label for="statusCode">Status Code:</label>
            <input type="text" name="statusCode" id="statuscode" required pattern="S\d{4}">
        </div>
        
        <div class="input-container">
            <label for="status">Status:</label>    
            <input type="text" name="status" id="status" required pattern="^(?!\s*$)[a-zA-Z0-9,.!? ]+$">
        </div>
        
        <div class="input-container">
            <label>Share:</label>
                <input type="radio" name="share" value="public" id="public" required>
                <label for="public">Public</label>
                <input type="radio" name="share" value="friends" id="friends" required>
                <label for="friends">Friends</label>
                <input type="radio" name="share" value="onlyme" id="onlyme" required>
                <label for="onlyme">Only Me</label>
        </div>
        
        <div class="input-container">
            <label for="date">Date:</label>    
            <input type="text" name="date" id="date" required pattern="\d{2}/\d{2}/\d{4}" 
            title="Date must be in the format of dd/mm/yyyy" value="<?php echo date('d/m/Y'); ?>">
        </div>
        
        <div class="input-container">        
            <label>Permission:</label>
            <input type="checkbox" name="allowlike" value="yes" id="allowlike">
            Allow Like
            <input type="checkbox" name="allowcomment" value="yes" id="allowcomment">
            Allow Comments
            <input type="checkbox" name="allowshare" value="yes" id="allowshare">
            Allow Share
        </div>
        
        <div class="input-container">        
            <button type="submit">Post</button>
        </div> 
        <div class="input-container">
            <a href="http://rpy1983.cmslamp14.aut.ac.nz/assign1/">
                Return to Home Page
            </a>
        </div>
    </form>
</body>