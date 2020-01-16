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

function verify_logged_in($allowedRoles = array())
{
    global $connection;

    if (!logged_in()) {
        header("Location: ".$GLOBALS['HOST']."/pages/login.php");
    }

    $query="SELECT role FROM `user`
	WHERE `id`= {$_SESSION['user_id']}";
    $result=mysqli_query($connection, $query);
    $found_user=mysqli_fetch_array($result);

    if (!in_array($found_user['role'], $allowedRoles)) {
        switch ($found_user['role']) {
            case "administrator":
                header("Location: ".$GLOBALS['HOST']."/pages/sellers/list_sellers.php");
                break;
            case "buyer":
                header("Location: ".$GLOBALS['HOST']."/pages/frontend/index.php");
                break;

            default:
                header("Location: ".$GLOBALS['HOST']."/pages/logout.php");
                break;
        }
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
