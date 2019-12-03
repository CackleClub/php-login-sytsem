<?php

if(isset($_POST['register'])){
    $uname = $_POST['uname'];
    $pword = $_POST['pword'];
    $pwordr = $_POST['pwordr'];
    
    $unamec = filter_var($uname, FILTER_SANITIZE_STRING);
    $pwordc = filter_var($pword, FILTER_SANITIZE_STRING);
    $pwordrc = filter_var($pwordr, FILTER_SANITIZE_STRING);
    
    $uname1 = mysqli_escape_string($con, $unamec);
    $pword1 = mysqli_escape_string($con, $pwordc);
    $pwordr1 = mysqli_escape_string($con, $pwordrc);
    if(!empty($uname1) or !empty($pword1) or !empty($pwordr1)){
        if($pword1 === $pwordr1){
            $sql = "SELECT * FROM login WHERE uname = '$uname1' ;";
            $query = mysqli_query($con, $sql);
            $res = mysqli_fetch_array($query);
            $options = [
                'cost' => 12,
            ];
            $pword_hash = password_hash($pword1, PASSWORD_BCRYPT, $options);
            if(!isset($res['uname'])){
                $insertq = "INSERT INTO login (uname, pword_hash) VALUES ('$uname1', '$pword_hash');";
                mysqli_query($con, $insertq);
                echo "your account has been created!";
            }
            else{
                echo "this username is taken.";
            }
        }
        else{
            echo "please repeat your password.";
        }
    }
    else{
        echo "you left a field empty.";
    }
}