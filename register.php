<?php

include("config/db.php");

session_start();

if ($_SESSION['login_state'] === 1) {
    header("location: index.php");
} else {
    include("inc/register.php");
    include("views/register.php");
}
