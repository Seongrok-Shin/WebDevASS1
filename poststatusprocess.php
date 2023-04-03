<?php
    $openScript = fopen("sqlscript.txt", a+) or die ("the file is not existed!");
    fread($openScript,filesize("sqlscript.txt"));
?>