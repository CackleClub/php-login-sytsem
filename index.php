<?php

include("config/db.php");

session_start();

if ($_SESSION['login_state'] === 1) {
    include("views/logged-in.php");
} else {
    include("inc/login.php");
    include("views/not-logged-in.php");
}
