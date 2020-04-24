<?php
    //Takes care of the logout takes user back to index.html
    session_start();
    session_destroy();
    header("Location: http://localhost:8080/part2/index.html");
?>