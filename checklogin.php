<?php

session_start();

if (isset($_SESSION["customer"])) {
    echo "1";
} else{
    echo "2";
}

?>