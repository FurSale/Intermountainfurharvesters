<?php
include_once("db_connection.php");

session_name("login");
session_start();

if (isset($_COOKIE['rememberme'])&&!isset($_SESSION['user_id'])) {
    $query="SELECT id, username FROM user
			WHERE `username`='{$_COOKIE['rememberme']}'";
    $result=mysqli_query($connection, $query);
    if (mysqli_num_rows($result)==1) {
        $found_user=mysqli_fetch_array($result);
        $_SESSION['user_id']=$found_user['id'];
        $_SESSION['username']=$found_user['username'];

        $date=date("Y/m/d H:i:s");
        $query="UPDATE `user` SET
				`last_logged_in` = '{$date}'
				WHERE `id` = {$_SESSION['user_id']}";
        $result=mysqli_query($connection, $query);
        confirm_query($result);
    }
}

if (!function_exists('logged_in')) {
    function logged_in()
    {
        return isset($_SESSION['user_id']);
    }
}

function confirm_logged_in($pageadmin = true)
{
    if (!logged_in()) {
        header("Location: ".$GLOBALS['HOST']."/pages/login.php");
    }
}
