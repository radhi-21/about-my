<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$connection = new mysqli( "localhost","root",  "", "radhi-portfolio");

$connection->set_charset("utf8mb4");