<?php

echo "processing";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo  $_POST['month'];
}


// if (isset($_POST['data'])) {
// echo "month ".$_POST['data']; 
// }0