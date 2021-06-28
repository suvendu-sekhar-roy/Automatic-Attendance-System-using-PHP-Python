<?php
    session_start();
    session_destroy();
    echo "This is logout page";
    header ('location: index.html');
     
?>