<?php

if (isset($_POST['login'])) {
    $uname = $_POST['uname'];
    $pword = $_POST['pword'];

    $unamec = filter_var($uname, FILTER_SANITIZE_STRING);
    $pwordc = filter_var($pword, FILTER_SANITIZE_STRING);

    $uname1 = mysqli_escape_string($con, $unamec);
    $pword1 = mysqli_escape_string($con, $pwordc);


    if (!empty($uname1) or !empty($pword1)) {
        $sql = "SELECT * FROM login WHERE uname = '$uname1' ;";
        $query = mysqli_query($con, $sql);
        $res = mysqli_fetch_array($query);
        $verify_pword = password_verify($pword1, $res['pword_hash']);
        if (password_verify($pword1, $res['pword_hash']) === true) {
            $_SESSION['id'] = $res['id'];
            $_SESSION['login_state'] = 1;
            header("location: index.php");
        }
        if (password_verify($pword1, $res['pword_hash']) === false) {
            echo "wrong password :(";
        }
    } else {
        echo "And i oop";
    }
}
